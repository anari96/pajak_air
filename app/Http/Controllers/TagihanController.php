<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Pelanggan;

use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagihanController extends Controller
{

    protected $routeName = 'tagihan';
    protected $viewName = 'tagihan';
    protected $title = 'Laporan Pemakaian';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = $this->routeName;
        $title = $this->title;
        return view($this->viewName.'.index',compact('route','title'));
    }

    public function datatable()
    {
        $datas = Tagihan::join('pelanggans','pelanggans.id','=','tagihans.pelanggan_id')->select('tagihans.id','id_tagihan','tanggal','meter_penggunaan_awal','meter_penggunaan','pelanggans.name','tagihans.jumlah_pembayaran','tagihans.file_name','tagihans.file_path');

        $datatables = DataTables::of($datas)
            ->addIndexColumn()
            ->editColumn('meter_penggunaan', function($data){
                if($data->meter_penggunaan_awal != null){
                    $penggunaan = $data->meter_penggunaan - $data->meter_penggunaan_awal;
                }else if($data->meter_penggunaan_awal == null){
                    $penggunaan = $data->meter_penggunaan;
                }
                return $penggunaan;
                
            })
            ->editColumn('jumlah_pembayaran',function($data){
                $jumlah = $data->jumlah_pembayaran;
                return "Rp. ".number_format($jumlah);
            })
            ->editColumn('tanggal',function($data){
                return $data->tanggal->format('F');
            })
            ->addColumn('tahun', function ($data) {
                return $data->tanggal->format('Y');
            })
            ->addColumn('status', function ($data){
                return $data->status;
            })
            ->addColumn('show_image', function ($data){
                $url = $data->file_path.''.$data->file_name;
                return view('layouts.includes.image_button',compact('data','url'));
            })
            ->addColumn('action', function ($data) {
                $route = 'tagihan';
                return view('layouts.includes.table-action-alt',compact('data','route'));
            });

        return $datatables->make(true);
    }

    public function data(Request $request){
        $datas = Tagihan::find($request->id);

        // $tagihans_sebelumnya = Tagihan::where('pelanggan_id', $datas->pelanggan_id)->whereNotIn('id', [$datas->id])->where('created_at','<',$datas->created_at)->orderBy('created_at','desc');

        // $jumlah_tagihan = $tagihans_sebelumnya->count();

        // if($jumlah_tagihan > 0){
        //     $meter_sebelumnya = $tagihans_sebelumnya->first()->meter_penggunaan;
        // }else if($jumlah_tagihan <= 0){
        //     $meter_sebelumnya = 0;
        // }

        if($datas->meter_penggunaan_awal != null){
            $meter_sebelumnya = $datas->meter_penggunaan_awal;
            $meter_sekarang = $datas->meter_penggunaan;
            $pemakaian = $meter_sekarang - $meter_sebelumnya;

            // $jumlah_pembayaran = $pemakaian * 11500;
        }else if($datas->meter_penggunaan_awal == null){

            $pemakaian = $datas->meter_penggunaan;

            // $jumlah_pembayaran = $meter_sekarang * 11500;
        }


        // $total_pemakaian = $datas->meter_penggunaan - $datas->meter_penggunaan_awal;

        $data = [
            'name' => $datas->pelanggan->name,
            'kategori_industri' => $datas->pelanggan->kategori_industri->nama_industri,
            'no_telepon' => $datas->pelanggan->no_telepon,
            'alamat' => $datas->pelanggan->alamat,
            'total_pemakaian' => number_format($pemakaian),
            'bulan' => $datas->tanggal->format('n'),
            'tahun' => $datas->tanggal->format('Y'),
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = $this->routeName;
        $title = $this->title;

        $start = \Carbon\Carbon::now()->subYear()->startOfYear();
        $end = \Carbon\Carbon::now()->subYear()->endOfYear();
        $months_to_render = $start->diffInMonths($end);
    
        $dates = [];
    
        for ($i = 0; $i <= $months_to_render; $i++) {
            $dates[] = $start->isoFormat('MMMM');
            $start->addMonth();
        }

        $pelanggans = Pelanggan::all();

        $years = [];
        for ($year=2020; $year <= date('Y'); $year++) $years[$year] = $year;

        
        // dd($dates);
        // dd(Carbon::now()->format('D MMMM Y, H:i:s'));

        return view($this->viewName.'.create',compact('route','title','dates','years','pelanggans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->meteran);
        $validator = $request->validate([
            'id_pelanggan' => 'required|string|max:100',
            'meter_sekarang' => 'numeric|required|digits_between:1,100',
            'bulan' => 'numeric|required|digits_between:1,2',
            'tahun' => 'numeric|required|digits_between:4,4',
        ]);

        if($request->has('file')){
            $validator = $request->validate([
                'file' => 'max:5000',
            ]);   
        }

        if ($request->has('file')) {
            // dd($request->file('file'));
            $file=$request->file('file');
            $direktori=public_path().'/storage/image/';          
            $nama_file=str_replace(' ','-',$request->file->getClientOriginalName());
            $file_format= $request->file->getClientOriginalExtension();
            $uploadSuccess = $request->file->move($direktori,$nama_file);
        }

        $datas = Pelanggan::find($request->id_pelanggan);
        // $tagihans = Tagihan::where('pelanggan_id', $datas->id)->orderBy('created_at','desc');

        // $jumlah_tagihan = $tagihans->count();

        // dd($jumlah_tagihan);

        // if($jumlah_tagihan > 0){
        //     $meter_sebelumnya = $tagihans->first()->meter_penggunaan;
        // }else if($jumlah_tagihan <= 0){
        //     $meter_sebelumnya = 0;
        // }

        // $pemakaian = $request->meter_sekarang - $request->meter_sebelumnya;

        // $jumlah_pembayaran = $pemakaian * 11500;

        // dd($jumlah_pembayaran);

        $date = $request->tahun.'-'.$request->bulan.'-20';

        $date_formated = Carbon::createFromFormat('Y-m-d',$date);
        
        if($request->meteran == 1){
            $meter_sebelumnya = $request->meter_sebelumnya;
            $meter_sekarang = $request->meter_sekarang;
            $pemakaian = $meter_sekarang - $meter_sebelumnya;

            $jumlah_pembayaran = $pemakaian * 11500;
        }else if($request->meteran == 0){
            $meter_sebelumnya = null;
            $meter_sekarang = $request->pemakaian;

            $jumlah_pembayaran = $meter_sekarang * 11500;
        }

        // dd($date_formated->format('Y-m-d'));
        try{
            DB::beginTransaction();
            $number = rand(0,1000);
            $txt = date("Ymdhis").''.$number;
            
            $id = $txt.$number;

            if (isset($uploadSuccess)) {
                $query = Tagihan::create([
                    'id_tagihan' => $txt,
                    'pelanggan_id' => $datas->id,
                    'tanggal'=>$date_formated,
                    'meter_penggunaan_awal'=>$meter_sebelumnya,
                    'meter_penggunaan'=>$meter_sekarang,
                    'jumlah_pembayaran'=> $jumlah_pembayaran,
                    'file_name' => $nama_file,
                    'file_path' => '/storage/image/',
                ]);
            }else{
                $query = Tagihan::create([
                    'id_tagihan' => $txt,
                    'pelanggan_id' => $datas->id,
                    'tanggal'=>$date_formated,
                    'meter_penggunaan_awal'=>$meter_sebelumnya,
                    'meter_penggunaan'=>$meter_sekarang,
                    'jumlah_pembayaran'=> $jumlah_pembayaran
                ]);
            }
            
            DB::commit();
            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menambah Data Tagihan : '.$query->id_tagihan]);
        } catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->with(['error'=>'Gagal Menambah Data Tagihan : '.$e->getMessage()])->withErrors($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = Tagihan::findOrFail($id);
        $route = $this->routeName;
        $title = $this->title;

        $pelanggans = Pelanggan::all();

        $start = \Carbon\Carbon::now()->subYear()->startOfYear();
        $end = \Carbon\Carbon::now()->subYear()->endOfYear();
        $months_to_render = $start->diffInMonths($end);
    
        $dates = [];
    
        for ($i = 0; $i <= $months_to_render; $i++) {
            $dates[] = $start->isoFormat('MMMM');
            $start->addMonth();
        }

        $years = [];
        for ($year=2020; $year <= date('Y'); $year++) $years[$year] = $year;

        //dd($datas->tanggal->format("n"));

        return view($this->viewName.'.edit', compact('datas','route','title','id','dates','years','pelanggans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'id_pelanggan' => 'required|string|max:100',
            'meter_sekarang' => 'numeric|required|digits_between:1,100',
            'bulan' => 'numeric|required|digits_between:1,2',
            'tahun' => 'numeric|required|digits_between:4,4',
        ]);
        
        $datas = Pelanggan::find($request->id_pelanggan);
        $datas2 = Tagihan::find($id);
        $tagihans = Tagihan::where('pelanggan_id', $datas->id)->whereNotIn('id', [$datas->id])->where('created_at','<',$datas2->created_at)->orderBy('created_at','desc');

        $jumlah_tagihan = $tagihans->count();

        // dd($jumlah_tagihan);

        if($jumlah_tagihan > 0){
            $meter_sebelumnya = $tagihans->first()->meter_penggunaan;
        }else if($jumlah_tagihan <= 0){
            $meter_sebelumnya = 0;
        }

        $pemakaian = $request->meter_sekarang - $meter_sebelumnya;

        $jumlah_pembayaran = $pemakaian * 11500;

        // dd($jumlah_pembayaran);

        $date = $request->tahun.'-'.$request->bulan.'-20';

        $date_formated = Carbon::createFromFormat('Y-m-d',$date);

        try{
            $query = Tagihan::findOrFail($id);
            
            $query->update([
                'pelanggan_id' => $datas->id,
                'tanggal'=>$date_formated,
                'meter_penggunaan'=>$request->meter_sekarang,
                'jumlah_pembayaran'=> $jumlah_pembayaran
            ]);

            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Mengubah Data Tagihan : '.$query->id_tagihan]);
        } catch (\Exception $e){
            return redirect()->back()->with(['error'=>'Gagal Mengubah Data Tagihan : '.$e->getMessage()])->withErrors($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $query = Tagihan::findOrFail($id);
            $query->delete();

            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menghapus Data Tagihan : '.$query->id_tagihan]);
        }catch (\Exception $e){
            return redirect()->back()->with(['error'=>'Gagal Menghapus Data Tagihan : '.$e->getMessage()])->withErrors($request->all());
        }
    }

    public function show_file($id)
    {
        $datas = Tagihan::find($id);

        $url = $datas->file_path.''.$datas->file_name;

        // dd($url);
        return response()->download(asset($url));
    }

    public function nota($id)
    {
        $datas = Tagihan::find($id);
        return view('tagihan.nota' , compact('datas'));
    }

    public function tagihan_telat()
    {
        try {
            $datas = Tagihan::doesntHave('pembayaran')->orderBy('created_at', 'DESC')->get();

            $tagihan = [];

            foreach($datas as $d){
                if($d->tanggal->format('Y-m-d') < date('Y-m-d')){
                    $diff = $d->tanggal->diffInDays(Carbon::now()->format('Y-m-d'));
                    $tagihan[] = [
                        'id' => $d->id,
                        'no_tagihan' => $d->id_tagihan,
                        'no_pelanggan' => $d->pelanggan->id_pelanggan,
                        'nama' => $d->pelanggan->name,
                        'jumlah_pembayaran' => $d->jumlah_pembayaran,
                        'hari' => $diff.' Hari'
                    ];
                }
            }

            $data = [
                'status' => 200,
                'data' => $tagihan,
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => 500,
                'message' => 'Tagihan Tidak Ditemukan',
                'data' => null,
            ];
        }
        return response()->json($data,$data['status']);
    }
}
