<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    
    protected $routeName = 'user';
    protected $viewName = 'user';
    protected $title = 'Pengguna';
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


    public function datatable(Request $request)
    {
        $datas = User::join('roles', 'users.role_id','=','roles.id')->select('name','email','users.created_at','users.id','roles.nama_role');

        $datatables = DataTables::of($datas)
            ->addIndexColumn()
            ->editColumn('created_at',function($data){
                return $data->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($data) {
                $route = 'user';
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
        $roles = Role::all();
        $title = $this->title;
        $route = $this->routeName;
        return view($this->viewName.'.create',compact('route','title','roles'));
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
            'email' => 'required|string|email|max:100|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'no_telepon'=>'string|required|max:100',
            'role_id'=>'string|required|max:100',
        ]);

        try{
            $query = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'no_telepon'=>$request->no_telepon,
                'role_id'=>$request->role_id
            ]);
    
            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menambah Data User : '.$query->name]);
        } catch (\Exception $e){
            return redirect()->back()->with(['error'=>'Gagal Menambah Data User : '.$e->getMessage()])->withErrors($request->all());
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
        $title = $this->title;
        $datas = User::findOrFail($id);
        $roles = Role::all();
        $route = $this->routeName;
        return view($this->viewName.'.edit', compact('datas','route','id','roles','title'));
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
            'email' => 'required|string|email|max:100',
            // 'password' => ['confirmed', Rules\Password::defaults()],
            'no_telepon'=>'string|max:100',
            'role_id'=>'string|required|max:100',
        ]);
        try{
            $datas = User::findOrFail($id);
            if(!$request->password){
                $datas->update([
                    'name'=> $request->name,
                    'email'=> $request->email,
                    'no_telepon'=> $request->no_telepon,
                    'role_id'=>$request->role_id
                ]);
            }else if($request->password){
                $datas->update([
                    'name'=> $request->name,
                    'email'=> $request->email,
                    'no_telepon'=> $request->no_telepon,
                    'password'=> Hash::make($request->password),
                    'role_id'=>$request->role_id
                ]);
            }
            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Mengubah Data User : '.$datas->name]);
        }catch (\Exception $e){
            return redirect()->back()->with(['error'=>'Gagal Mengubah Data User : '.$e->getMessage()])->withErrors($request->all());
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
            $datas = User::findOrFail($id);
            $datas->delete();

            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Mengubah Data User : '.$datas->name]);
        }catch (\Exception $e){
            return redirect()->back()->with(['error'=>'Gagal Menghapus Data User : '.$e->getMessage()])->withErrors($request->all());
        }
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
