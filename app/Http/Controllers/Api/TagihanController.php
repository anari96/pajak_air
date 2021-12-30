<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\Pembayaran;

class TagihanController extends Controller
{
    public function tagihan(Request $request)
    {
        try {

            if(isset($request->id_tagihan)){
                $datas = Tagihan::join('pelanggans','pelanggans.id','=','tagihans.pelanggan_id')->select('tagihans.id','id_tagihan','pelanggans.name')->where('tagihans.id_tagihan','like','%'.$request->id_tagihan.'%')->get();
            }else{
                $datas = Tagihan::join('pelanggans','pelanggans.id','=','tagihans.pelanggan_id')->select('tagihans.id','id_tagihan','pelanggans.name')->get();
            }

            $data = [
                'status' => 200,
                'data' => $datas,
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => 500,
                'message' => 'Tagihan Tidak Ditemukan',
                'data' => null,
            ];
        }
        return response()->json($data,$data['status']);
        
    }

    public function tagihan_detail(Request $request)
    {
        try {
            $datas = Tagihan::find($request->id);
            
            $tagihans_sebelumnya = Tagihan::where('pelanggan_id', $datas->pelanggan_id)->whereNotIn('id', [$datas->id])->where('created_at','<',$datas->created_at)->orderBy('created_at','desc');

            $jumlah_tagihan = $tagihans_sebelumnya->count();
    
            if($jumlah_tagihan > 0){
                $meter_sebelumnya = $tagihans_sebelumnya->first()->meter_penggunaan;
            }else if($jumlah_tagihan <= 0){
                $meter_sebelumnya = 0;
            }
    
            if($datas->has('pembayaran')){
                $status = 'Telah Dibayar';
            }else if(!$datas->has('pembayaran')){
                $status = 'Menunggu Pembayaran';
            }else{
                $status = 'Menunggu Pembayaran';
            }
    
            $total_pemakaian = $datas->meter_penggunaan - $meter_sebelumnya;

            $tagihan = [
                'id_pelanggan' => $datas->pelanggan->id_pelanggan,
                'nama' => $datas->pelanggan->name,
                'no_telepon' => $datas->pelanggan->no_telepon,
                'alamat' => $datas->pelanggan->alamat,
                'no_tagihan' => $datas->id_tagihan,
                'periode' => $datas->tanggal->format('Y').' '.$datas->tanggal->format('F'),
                'meter_sekarang' => $datas->meter_penggunaan,
                'meter_sebelumnya' => $meter_sebelumnya,
                'pemakaian' => $total_pemakaian,
                'tagihan' => $datas->jumlah_pembayaran,
                'denda' => 0
            ];

            $data = [
                'status' => 200,
                'data' => $tagihan,
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => 500,
                'message' => 'Tagihan Tidak Ditemukan',
                'data' => null,
            ];
        }
        return response()->json($data,$data['status']);
        
    }

    public function tagihan_terlambat()
    {
        try {
            $datas = Tagihan::doesntHave('pembayaran')->orderBy('created_at', 'DESC')->get();

            $tagihan = [];

            foreach($datas as $d){
                if($d->tanggal->format('Y-m-d') < date('Y-m-d')){
                    $tagihan[] = [
                        'id' => $d->id,
                        'no_tagihan' => $d->id_tagihan,
                        'nama' => $d->pelanggan->name
                    ];
                }
            }

            $data = [
                'status' => 200,
                'data' => $tagihan,
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => 500,
                'message' => 'Tagihan Tidak Ditemukan',
                'data' => null,
            ];
        }
        return response()->json($data,$data['status']);
        
    }

    public function tagihan_terlambat_detail(Request $request)
    {
        try {
            $datas = Tagihan::find($request->id);

            $diff = $datas->tanggal->diffInDays(date('Y-m-d'));

            $tagihan = [
                'id_pelanggan' => $datas->pelanggan->id_pelanggan,
                'nama' => $datas->pelanggan->name,
                'no_telepon' => $datas->pelanggan->no_telepon,
                'alamat' => $datas->pelanggan->alamat,
                'no_tagihan' => $datas->id_tagihan,
                'periode' => $datas->tanggal->format('Y').' '.$datas->tanggal->format('F'),
                'tagihan' => $datas->jumlah_pembayaran,
                'keterlambatan' => $diff.' Hari',
                'denda' => 0,
                'total' => $datas->jumlah_pembayaran + 0,
            ];

            $data = [
                'status' => 200,
                'data' => $tagihan,
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => 500,
                'message' => 'Tagihan Tidak Ditemukan',
                'data' => null,
            ];
        }
        return response()->json($data,$data['status']);
        
    }
}
