<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\Pembayaran;

class HomeController extends Controller
{
    public function index()
    {
        

        try {
            
            $pelanggan = Pelanggan::count();
            $tagihan = Tagihan::count();
            $pembayaran = Pembayaran::count();

            $pembayaran_telat = Pembayaran::join('tagihans','tagihans.id','=','pembayarans.tagihan_id')->join('pelanggans','pelanggans.id','=','tagihans.pelanggan_id')
            ->whereRaw(' pembayarans.tanggal > tagihans.tanggal')
            ->select('pembayarans.id','pembayarans.id_pembayaran','pelanggans.id_pelanggan','pelanggans.name','tagihans.jumlah_pembayaran','tagihans.id_tagihan','pembayarans.created_at','tagihan_id')->count();

            $datas = [
                'pelanggan' => $pelanggan,
                'tagihan' => $tagihan,
                'pembayaran' => $pembayaran,
                'pembayaran_telat' => $pembayaran_telat
            ];
            $data = [
                'status' => 200,
                'data' => $datas,
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => 500,
                'data' => null,
                'error' => $th->getMessage(),
            ]; 
        }
        return response()->json($data,$data['status']);	
    }
}
