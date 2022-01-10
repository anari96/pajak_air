<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tagihan;
use App\Models\TagihanPemasangan;
use App\Models\Pembayaran;
use App\Models\Pelanggan;
use App\Models\PembayaranPemasangan;

use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class LaporanController extends Controller
{
    protected $routeName = 'laporan';
    protected $viewName = 'laporan';
    protected $title = 'Laporan';
    
    
    public function pembayaran()
    {
        $route = $this->routeName;
        $title = $this->title.' Pembayaran';
        return view($this->viewName.'.pembayaran',compact('route','title'));
    }

    public function datatable_pembayaran(Request $request)
    {
        $date1 = $request->date1;
        $date2 = $request->date2;

        $datas = Pembayaran::join('tagihans','tagihans.id','=','pembayarans.tagihan_id')->join('pelanggans','pelanggans.id','=','tagihans.pelanggan_id')->select('pembayarans.id','pembayarans.id_pembayaran','tagihans.tanggal','pelanggans.id_pelanggan','pelanggans.name','tagihans.jumlah_pembayaran')->whereHas('tagihan', function($q)use($date1,$date2){
            $q->whereBetween('tagihans.tanggal',[$date1,$date2]);
        });

        $datatables = DataTables::of($datas)
            ->addIndexColumn()
            ->editColumn('jumlah_pembayaran',function($data){
                $jumlah = $data->jumlah_pembayaran;
                return "Rp. ".number_format($jumlah);
            })
            ->editColumn('tanggal',function($data){
                return $data->tanggal->format('F');
            });

        return $datatables->make(true);
    }

    public function pelanggan()
    {
        $route = $this->routeName;
        $title = $this->title. ' Pelanggan';
        return view($this->viewName.'.pelanggan',compact('route','title'));
    }

    public function datatable_pelanggan()
    {
        $datas = Pelanggan::select('id_pelanggan','name','no_telepon','created_at','pelanggans.id','nik');

        $datatables = DataTables::of($datas)
            ->addIndexColumn()
            ->editColumn('created_at',function($data){
                return $data->created_at->format('Y-m-d H:i:s');
            });

        return $datatables->make(true);
    }

    public function pembayaran_pemasangan()
    {
        $route = $this->routeName;
        $title = $this->title.' Pembayaran Pemasangan';
        return view($this->viewName.'.pembayaran_pemasangan',compact('route','title'));
    }

    public function datatable_pembayaran_pemasangan()
    {
        $datas = PembayaranPemasangan::join('tagihan_pemasangans','tagihan_pemasangans.id','=','pembayaran_pemasangans.tagihan_pemasangan_id')->join('pelanggans','pelanggans.id','=','tagihan_pemasangans.pelanggan_id')->select('pembayaran_pemasangans.id','pembayaran_pemasangans.id_pembayaran_pemasangan','pembayaran_pemasangans.created_at','pelanggans.id_pelanggan','pelanggans.name','pembayaran_pemasangans.jumlah_pembayaran');

        $datatables = DataTables::of($datas)
            ->addIndexColumn()
            ->editColumn('jumlah_pembayaran',function($data){
                $jumlah = $data->jumlah_pembayaran;
                return "Rp. ".number_format($jumlah);
            })
            ->editColumn('created_at',function($data){
                return $data->created_at->format('d F Y');
            });

        return $datatables->make(true);
    }

    public function tagihan()
    {
        $route = $this->routeName;
        $title = $this->title.' Tagihan';
        return view($this->viewName.'.tagihan',compact('route','title'));
    }

    public function datatable_tagihan(Request $request)
    {
        if($request->status_pembayaran == '2'){
            $datas = Tagihan::join('pelanggans','pelanggans.id','=','tagihans.pelanggan_id')->select('tagihans.id','id_tagihan','tanggal','meter_penggunaan','pelanggans.name','tagihans.jumlah_pembayaran','tagihans.file_name','tagihans.file_path');
        }else if($request->status_pembayaran == '1'){
            $datas = Tagihan::has('pembayaran')->join('pelanggans','pelanggans.id','=','tagihans.pelanggan_id')->select('tagihans.id','id_tagihan','tanggal','meter_penggunaan','pelanggans.name','tagihans.jumlah_pembayaran','tagihans.file_name','tagihans.file_path');
        }else if($request->status_pembayaran == '0'){
            $datas = Tagihan::doesntHave('pembayaran')->join('pelanggans','pelanggans.id','=','tagihans.pelanggan_id')->select('tagihans.id','id_tagihan','tanggal','meter_penggunaan','pelanggans.name','tagihans.jumlah_pembayaran','tagihans.file_name','tagihans.file_path');
        }
        

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
            });

        return $datatables->make(true);
    }

    public function tagihan_pemasangan()
    {
        $route = $this->routeName;
        $title = $this->title.' Tagihan Pemasangan';
        return view($this->viewName.'.tagihan_pemasangan',compact('route','title'));
    }

    public function datatable_tagihan_pemasangan()
    {
        $datas = TagihanPemasangan::join('pelanggans','pelanggans.id','=','tagihan_pemasangans.pelanggan_id')->select('tagihan_pemasangans.id','id_tagihan_pemasangan','tanggal','pelanggans.name','tagihan_pemasangans.jumlah_pembayaran');

        $datatables = DataTables::of($datas)
            ->addIndexColumn()
            ->editColumn('jumlah_pembayaran',function($data){
                $jumlah = $data->jumlah_pembayaran;
                return "Rp. ".number_format($jumlah);
            })
            ->editColumn('tanggal',function($data){
                return $data->tanggal->format('d F Y');
            })
            // ->addColumn('tahun', function ($data) {
            //     return $data->tanggal->format('Y');
            // })
            ->addColumn('status', function ($data){
                return $data->status;
            });

        return $datatables->make(true);
    }
    
    
}
