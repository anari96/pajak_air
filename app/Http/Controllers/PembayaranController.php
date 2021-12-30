<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Pelanggan;
use App\Models\Pembayaran;

use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    protected $routeName = 'pembayaran';
    protected $viewName = 'pembayaran';
    protected $title = 'Pembayaran';
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
        $datas = Pembayaran::join('tagihans','tagihans.id','=','pembayarans.tagihan_id')->join('pelanggans','pelanggans.id','=','tagihans.pelanggan_id')->select('pembayarans.id','pembayarans.id_pembayaran','tagihans.tanggal','pelanggans.id_pelanggan','pelanggans.name','tagihans.jumlah_pembayaran');

        $datatables = DataTables::of($datas)
            ->addIndexColumn()
            ->editColumn('jumlah_pembayaran',function($data){
                $jumlah = $data->jumlah_pembayaran;
                return "Rp. ".number_format($jumlah);
            })
            ->editColumn('tanggal',function($data){
                return $data->tanggal->format('F');
            })
            ->addColumn('action', function ($data) {
                $route = 'pembayaran';
                return view('layouts.includes.table-action-nota',compact('data','route'));
            });

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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

        $tagihans = Tagihan::orderBy('created_at','desc')->doesntHave('pembayaran')->get();

        $years = [];
        for ($year=2020; $year <= date('Y'); $year++) $years[$year] = $year;

        return view($this->viewName.'.create',compact('route','title','dates','years','tagihans','request'));
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
            'id_tagihan' => 'required|string|max:100',
        ]);

        $datas = Tagihan::find($request->id_tagihan);

        // $tagihans_sebelumnya = Tagihan::where('pelanggan_id', $datas->pelanggan_id)->whereNotIn('id', [$datas->id])->where('created_at','<',$datas->created_at)->orderBy('created_at','desc');

        // $jumlah_tagihan = $tagihans_sebelumnya->count();

        // if($jumlah_tagihan > 0){
        //     $meter_sebelumnya = $tagihans_sebelumnya->first()->meter_penggunaan;
        // }else if($jumlah_tagihan <= 0){
        //     $meter_sebelumnya = 0;
        // }

        // $total_pemakaian = $datas->meter_penggunaan - $meter_sebelumnya;

        try{
            $number = rand(0,1000);
            $txt = date("Ymdhis").''.$number;
            
            $id = $txt.$number;
            $query = Pembayaran::create([
                'id_pembayaran' => $txt,
                'tagihan_id' => $datas->id,
                'tanggal' => date('Y-m-d'),
            ]);

            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menambah Data Pembayaran : '.$query->id_pembayaran]);
        } catch (\Exception $e){
            return redirect()->back()->with(['error'=>'Gagal Menambah Data Pembayaran : '.$e->getMessage()])->withErrors($request->all());
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
        $datas = Pembayaran::find($id);

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

        $tagihans = Tagihan::orderBy('created_at','desc')->get();

        $years = [];
        for ($year=2020; $year <= date('Y'); $year++) $years[$year] = $year;

        return view($this->viewName.'.edit',compact('datas','route','title','dates','years','tagihans','id'));
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
            'id_tagihan' => 'required|string|max:100',
        ]);

        $datas = Tagihan::find($request->id_tagihan);
        try{
            $query = Pembayaran::find($id);
            $query->update([
                'tagihan_id' => $datas->id,
            ]);

            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Mengubah Data Pembayaran : '.$query->id_pembayaran]);
        } catch (\Exception $e){
            return redirect()->back()->with(['error'=>'Gagal Mengubah Data Pembayaran : '.$e->getMessage()])->withErrors($request->all());
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
            $query = Pembayaran::findOrFail($id);
            $query->delete();

            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menghapus Data Pembayaran : '.$query->id_pembayaran]);
        }catch (\Exception $e){
            return redirect()->back()->with(['error'=>'Gagal Menghapus Data Pembayaran : '.$e->getMessage()])->withErrors($request->all());
        }
    }

    public function nota($id)
    {
        $datas = Pembayaran::find($id);
        return view('pembayaran.nota' , compact('datas'));
    }
}
