<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;

class PelangganController extends Controller
{
    protected $routeName = 'pelanggan';
    protected $viewName = 'pelanggan';
    protected $title = 'Perusahaan';
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

    public function data(Request $request){
        if(isset($request->id) || $request->id != ''){
            $datas = Pelanggan::find($request->id);
        }else if(isset($request->no) || $request->no != ''){
            $datas = Pelanggan::where('id_pelanggan',$request->no)->first();
        }else {
            $datas = Pelanggan::find($request->id);
        }
        
        $datas2 = Tagihan::find($request->edit);
        if(!isset($request->edit) || $request->edit == ''){
            $tagihans = Tagihan::where('pelanggan_id', $datas->id)->orderBy('created_at','desc');
        }else if(isset($request->edit) || ($request->edit != '')){
            $tagihans = Tagihan::where('pelanggan_id', $datas->id)->whereNotIn('id', [$request->edit])->where('created_at','<',$datas2->created_at)->orderBy('created_at','desc');
        }else{
            $tagihans = Tagihan::where('pelanggan_id', $datas->id)->orderBy('created_at','desc');
        }
        
        
        $jumlah_tagihan = $tagihans->count();

        // dd($jumlah_tagihan);

        if($jumlah_tagihan > 0){
            $meter_sebelumnya = $tagihans->first()->meter_penggunaan;
        }else if($jumlah_tagihan <= 0){
            $meter_sebelumnya = 0;
        }


        $data = [
            'id_pelanggan' => $datas->id_pelanggan,
            'name' => $datas->name,
            'no_telepon' => $datas->no_telepon,
            'alamat' => $datas->alamat,
            'meter_sebelumnya' => $meter_sebelumnya,
        ];

        return response()->json($data);
    }

    public function datatable()
    {
        $datas = Pelanggan::select('id_pelanggan','name','no_telepon','created_at','pelanggans.id','nik','alamat');

        $datatables = DataTables::of($datas)
            ->addIndexColumn()
            ->editColumn('created_at',function($data){
                return $data->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($data) {
                $route = 'pelanggan';
                return view('layouts.includes.table-action-pelanggan',compact('data','route'));
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
        $title = $this->title;
        
        return view($this->viewName.'.create',compact('route','title'));
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
            'name' => 'required|string|max:100',
            'no_telepon'=>'string|required|max:100',
            'alamat'=>'string|required|max:255',
            'no_telepon'=>'string|required|max:100',
            'nik'=>'max:20'
        ],[
            'nik.max' => 'NIK tidak boleh lebih dari 20 angka'
        ]);

        try{
            $txt = date("Ymdhis");
            // $number = rand(0,1000);
            // $id = $txt.$number;
            $query = Pelanggan::create([
                'id_pelanggan' => $txt,
                'name' => $request->name,
                'no_telepon'=>$request->no_telepon,
                'alamat'=>$request->alamat,
                'nik'=>$request->nik,
            ]);
    
            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menambah Data Pelanggan : '.$query->name]);
        } catch (\Exception $e){
            return redirect()->back()->with(['error'=>'Gagal Menambah Data Pelanggan : '.$e->getMessage()])->withErrors($request->all());
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
        $datas = Pelanggan::findOrFail($id);
        $title = $this->title;
        $route = $this->routeName;
        return view($this->viewName.'.edit', compact('datas','route','id','title'));
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
            'name' => 'required|string|max:100',
            'no_telepon'=>'string|required|max:100',
            'alamat'=>'string|required|max:255',
        ]);

        try{
            $query = Pelanggan::findOrFail($id);
            $query->update([
                'name' => $request->name,
                'no_telepon'=>$request->no_telepon,
                'alamat'=>$request->alamat,
                'nik'=>$request->nik,
            ]);
    
            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Mengubah Data Pelanggan : '.$query->name]);
        } catch (\Exception $e){
            return redirect()->back()->with(['error'=>'Gagal Mengubah Data Pelanggan : '.$e->getMessage()])->withErrors($request->all());
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
            $datas = Pelanggan::findOrFail($id);
            $datas->delete();

            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menghapus Data Pelanggan : '.$datas->name]);
        }catch (\Exception $e){
            return redirect()->back()->with(['error'=>'Gagal Menghapus Data Pelanggan : '.$e->getMessage()])->withErrors($request->all());
        }
    }

    public function history_tagihan($id)
    {
        $datas = Pelanggan::findOrFail($id);
        $route = $this->routeName;
        return view($this->viewName.'.history_tagihan', compact('datas','route','id'));
    }

    public function datatable_history_tagihan(Request $request)
    {
        $datas = Tagihan::join('pelanggans','pelanggans.id','=','tagihans.pelanggan_id')->select('tagihans.id','id_tagihan','tanggal','meter_penggunaan','pelanggans.name','tagihans.jumlah_pembayaran','tagihans.file_name','tagihans.file_path')->where('pelanggans.id', $request->id);

        $datatables = DataTables::of($datas)
            ->addIndexColumn()
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
            });

        return $datatables->make(true);
    }
}
