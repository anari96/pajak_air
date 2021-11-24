<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Pelanggan;

use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TagihanController extends Controller
{

    protected $routeName = 'tagihan';
    protected $viewName = 'tagihan';
    protected $title = 'Tagihan';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = $this->routeName;
        return view($this->viewName.'.index',compact('route'));
    }

    public function datatable()
    {
        $datas = Tagihan::join('pelanggans','pelanggans.id','=','tagihans.pelanggan_id')->select('tagihans.id','id_tagihan','tanggal','meter_penggunaan','pelanggans.name');

        $datatables = DataTables::of($datas)
            ->addIndexColumn()
            ->editColumn('tanggal',function($data){
                return $data->tanggal->format('F');
            })
            ->addColumn('tahun', function ($data) {
                return $data->tanggal->format('Y');
            })
            ->addColumn('action', function ($data) {
                $route = 'tagihan';
                return view('layouts.includes.table-action',compact('data','route'));
            });

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = $this->routeName;
        
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

        return view($this->viewName.'.create',compact('route','dates','years','pelanggans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'id_pelanggan' => 'required|string|max:100',
            'meter_sekarang' => 'numeric|required|digits_between:1,100',
            'bulan' => 'numeric|required|digits_between:1,2',
            'tahun' => 'numeric|required|digits_between:4,4',
        ]);

        $datas = Pelanggan::find($request->id_pelanggan);
        $tagihans = Tagihan::where('pelanggan_id', $datas->id)->orderBy('created_at','desc');

        $jumlah_tagihan = $tagihans->count();

        // dd($jumlah_tagihan);

        if($jumlah_tagihan > 0){
            $meter_sebelumnya = $tagihans->first()->meter_penggunaan;
        }else if($jumlah_tagihan <= 0){
            $meter_sebelumnya = 0;
        }

        $pemakaian = $request->meter_sekarang - $meter_sebelumnya;

        $jumlah_pembayaran = $pemakaian * 11000;

        // dd($jumlah_pembayaran);

        $date = $request->tahun.'-'.$request->bulan.'-01';

        $date_formated = Carbon::createFromFormat('Y-m-d',$date);

        
        // dd($date_formated->format('Y-m-d'));
        try{
            $number = rand(0,1000);
            $txt = date("Ymdhis").''.$number;
            
            $id = $txt.$number;
            $query = Tagihan::create([
                'id_tagihan' => $txt,
                'pelanggan_id' => $datas->id,
                'tanggal'=>$date_formated,
                'meter_penggunaan'=>$request->meter_sekarang,
                'jumlah_pembayaran'=> $jumlah_pembayaran
            ]);

            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menambah Data Tagihan : '.$query->id_tagihan]);
        } catch (\Exception $e){
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

        return view($this->viewName.'.edit', compact('datas','route','id','dates','years','pelanggans'));
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
        $tagihans = Tagihan::where('pelanggan_id', $datas->id)->whereNotIn('id', [$id])->orderBy('created_at','desc');

        $jumlah_tagihan = $tagihans->count();

        // dd($jumlah_tagihan);

        if($jumlah_tagihan > 0){
            $meter_sebelumnya = $tagihans->first()->meter_penggunaan;
        }else if($jumlah_tagihan <= 0){
            $meter_sebelumnya = 0;
        }

        $pemakaian = $request->meter_sekarang - $meter_sebelumnya;

        $jumlah_pembayaran = $pemakaian * 11000;

        // dd($jumlah_pembayaran);

        $date = $request->tahun.'-'.$request->bulan.'-01';

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
}
