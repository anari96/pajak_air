<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\TagihanPemasangan;
use App\Models\PembayaranPemasangan;


class HomeController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::count();
        $tagihan = Tagihan::count();
        $pembayaran = Pembayaran::count();

        $jumlah_pembayaran = Tagihan::sum('jumlah_pembayaran');
        $jumlah_hutang = Tagihan::doesntHave('pembayaran')->sum('jumlah_pembayaran');

        $jumlah_pembayaran_pemasangan = TagihanPemasangan::sum('jumlah_pembayaran');
        $jumlah_hutang_pemasangan = 0;

        $tagihan_pemasangan = TagihanPemasangan::all();

        $datas = Tagihan::doesntHave('pembayaran')->orderBy('created_at', 'DESC')->get();

        $pembayaran_telat = 0;

        foreach($datas as $d){
            if($d->tanggal->format('Y-m-d') < date('Y-m-d')){
                $pembayaran_telat += 1;
            }
        }


        foreach ($tagihan_pemasangan as $tp) {
            $jumlah = $tp->pembayaran->sum('jumlah_pembayaran');

            if($jumlah < $tp->jumlah_pembayaran){
                $jumlah_hutang_pemasangan += $tp->jumlah_pembayaran - $jumlah;
            }else if($jumlah >= $tp->jumlah_pembayaran){
                // return "Sudah Lunas";
            }else{
                $jumlah_hutang_pemasangan += $tp->jumlah_pembayaran - $jumlah;
            }
        }



        // dd($jumlah_pembayaran_pemasangan);

        // $pembayaran_telat = Pembayaran::join('tagihans','tagihans.id','=','pembayarans.tagihan_id')->join('pelanggans','pelanggans.id','=','tagihans.pelanggan_id')
        //     ->whereRaw(' pembayarans.tanggal > tagihans.tanggal')
        //     ->select('pembayarans.id','pembayarans.id_pembayaran','pelanggans.id_pelanggan','pelanggans.name','tagihans.jumlah_pembayaran','tagihans.id_tagihan','pembayarans.created_at','tagihan_id')->count();

        return view('index',compact('pelanggan','tagihan','pembayaran','pembayaran_telat','jumlah_pembayaran','jumlah_hutang','jumlah_pembayaran_pemasangan','jumlah_hutang_pemasangan'));
    }
}
