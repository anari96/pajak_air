<?php

namespace App\Http\Controllers;

use App\Models\UptDaerah;
use App\Models\User;
use App\Models\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class UptDaerahController extends Controller
{
    protected $routeName = 'upt_daerah';
    protected $viewName = 'upt_daerah';
    protected $title = 'UPT Daerah';

    public function index()
    {
        $route = $this->routeName;
        $title = $this->title;
        return view($this->viewName.'.index',compact('route','title'));
    }

    public function datatable()
    {
        $datas = UptDaerah::select('nama_daerah','created_at','id');

        $datatables = DataTables::of($datas)
            ->addIndexColumn()
            ->editColumn('created_at',function($data){
                return $data->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($data) {
                $route = 'upt_daerah';
                return view('layouts.includes.table-action',compact('data','route'));
            });

        return $datatables->make(true);
    }

    public function create(Request $request)
    {
        $route = $this->routeName;
        $title = $this->title;
        
        return view($this->viewName.'.create',compact('route','title'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'nama_daerah' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try{

            $role = Role::where('nama_role','UPT. Daerah')->first();

            $query1 = UptDaerah::create([
                'nama_daerah' => $request->nama_daerah
            ]);

            $query = User::create([
                'name' => $request->nama_daerah,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'upt_daerah_id' => $query1->id,
                'role_id' => $role->id
            ]);

            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menambah Data Upt Daerah : '.$query1->nama_daerah]);
        } catch (\Exception $e){
            return redirect()->back()->with(['error'=>'Gagal Menambah Data Upt Daerah : '.$e->getMessage()])->withErrors($request->all());
        }
        
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
    
    public function destroy(Request $request,$id)
    {
        try {
            $query1 = User::where('upt_daerah_id', $id);
            $query = UptDaerah::find($id);
            $nama_daerah = $query->nama_daerah;
            $query->delete();
            $query1->delete();

            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menghapus Data Daerah : '.$nama_daerah]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error'=>'Gagal Menghapus Data Daerah : '.$e->getMessage()])->withErrors($request->all());
        }
    }
}
