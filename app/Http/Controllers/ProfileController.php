<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemplatePesan;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    protected $routeName = 'profile';
    protected $viewName = 'profile';
    protected $title = 'Pengaturan';
    public function index()
    {
        $route = $this->routeName;
        $title = $this->title;
        $datas = Profile::first();

        $templates = TemplatePesan::all();

        return view('profile.index', compact('title','route','templates','datas'));
    }

    public function update(Request $request)
    {
        $datas = Profile::first();

        $validator = $request->validate([
            'alamat'=>'required|string',
            'harga_per_kubik'=>'required|numeric|digits_between:1,11',
            'harga_pemasangan'=>'required|numeric|digits_between:1,11',
            'harga_pemasangan_dp'=>'required|numeric|digits_between:1,11',
            'template_pesan_id'=>'required|string|max:100',
            'template_pesan_terlambat_id'=>'required|string|max:100',
            'template_pesan_terlambat_manager_id'=>'required|string|max:100'
        ]);



        try{
            DB::beginTransaction();
            $query = $datas->update([
                'alamat'=>$request->alamat,
                'harga_per_kubik'=>$request->harga_per_kubik,
                'harga_pemasangan'=>$request->harga_pemasangan,
                'harga_pemasangan_dp'=>$request->harga_pemasangan_dp,
                'template_pesan_id'=>$request->template_pesan_id,
                'template_pesan_terlambat_id'=>$request->template_pesan_terlambat_id,
                'template_pesan_terlambat_manager_id'=>$request->template_pesan_terlambat_manager_id
            ]);

            DB::commit();
            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Mengubah Data']);
        } catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->with(['error'=>'Gagal Mengubah Data : '.$e->getMessage()])->withErrors($request->all());
        }
    }
}
