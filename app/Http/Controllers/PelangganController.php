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
    protected $title = 'Pelanggan';
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

    public function data(Request $request){
        $datas = Pelanggan::find($request->id);

        if(!isset($request->edit)){
            $tagihans = Tagihan::where('pelanggan_id', $datas->id)->orderBy('created_at','desc');
        }else if(isset($request->edit)){
            $tagihans = Tagihan::where('pelanggan_id', $datas->id)->whereNotIn('id', [$datas->edit])->orderBy('created_at','desc');
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
            'name' => $datas->name,
            'no_telepon' => $datas->no_telepon,
            'alamat' => $datas->alamat,
            'meter_sebelumnya' => $meter_sebelumnya,
        ];

        return response()->json($data);
    }

    public function datatable()
    {
        $datas = Pelanggan::select('id_pelanggan','name','no_telepon','created_at','pelanggans.id');

        $datatables = DataTables::of($datas)
            ->addIndexColumn()
            ->editColumn('created_at',function($data){
                return $data->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($data) {
                $route = 'pelanggan';
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
        
        return view($this->viewName.'.create',compact('route'));
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
        $route = $this->routeName;
        return view($this->viewName.'.edit', compact('datas','route','id'));
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
}
