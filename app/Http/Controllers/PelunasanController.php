<?php

namespace App\Http\Controllers;
use App\Models\Pembayaran;
use App\Models\Pelunasan;

use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

use Illuminate\Http\Request;

class PelunasanController extends Controller
{
    protected $routeName = 'pelunasan';
    protected $viewName = 'pelunasan';
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
        $datas = Pelunasan::join('pembayarans','pembayarans.id','=','pelunasans.pembayaran_id')->join('tagihans','tagihans.id','=','pembayarans.tagihan_id')->join('pelanggans','pelanggans.id','=','tagihans.pelanggan_id')->select('pelunasans.id','pelunasans.id_pelunasan','tagihans.tanggal','pelanggans.id_pelanggan','pelanggans.name','tagihans.jumlah_pembayaran');

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

        $pembayarans = Pembayaran::orderBy('created_at','desc')->get();

        $years = [];
        for ($year=2020; $year <= date('Y'); $year++) $years[$year] = $year;

        return view($this->viewName.'.create',compact('route','title','dates','years','pembayarans','request'));
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
            'id_pembayaran' => 'required|string|max:100',
        ]);

        $datas = Pembayaran::find($request->id_pembayaran);
        
        try{
            $number = rand(0,1000);
            $txt = date("Ymdhis").''.$number;
            
            $id = $txt.$number;
            $query = Pelunasan::create([
                'id_pelunasan' => $txt,
                'pembayaran_id' => $datas->id,
                'tanggal' => date('Y-m-d'),
            ]);

            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menambah Data Pelunasan : '.$query->id_pembayaran]);
        } catch (\Exception $e){
            return redirect()->back()->with(['error'=>'Gagal Menambah Data Pelunasan : '.$e->getMessage()])->withErrors($request->all());
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
