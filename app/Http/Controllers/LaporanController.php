<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    protected $routeName = 'laporan';
    protected $viewName = 'laporan';
    protected $title = 'Laporan';
    
    public function index()
    {
        $route = $this->routeName;
        return view($this->viewName.'.index',compact('route'));
    }
}
