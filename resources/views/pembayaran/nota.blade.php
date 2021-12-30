<style>
    table{
        width: 100%;
        border: 1px solid #ddd;
    }
</style>

<table>
    <tr align="center">
        <td colspan="3">PDAM</td>
    </tr>
    <tr align="center">
        <td colspan="3">Jl.Poros 1 Kec.Loa Kulu Kab.Kutai Kartanegara Kaltim</td>
    </tr>
    <tr align="center">
        <td colspan="3" style="padding-bottom:40px">{{ date("d-M-Y") }}</td>
    </tr>
    
    <tr>
        <td>No. Pelanggan</td>
        <td>:</td>
        <td>{{ $datas->tagihan->pelanggan->id_pelanggan }}</td>
    </tr>
    <tr>
        <td>Nama Pelanggan</td>
        <td>:</td>
        <td>{{ $datas->tagihan->pelanggan->name }}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{ $datas->tagihan->pelanggan->alamat }}</td>
    </tr>
    <tr>
        <td>No. Telepon</td>
        <td>:</td>
        <td>{{ $datas->tagihan->pelanggan->no_telepon }}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td>No. Tagihan</td>
        <td>:</td>
        <td>{{ $datas->tagihan->id_tagihan }}</td>
    </tr>
    <tr>
        <td>Jumlah Penggunaan</td>
        <td>:</td>
        <td>{{ $datas->tagihan->meter_penggunaan }} m³</td>
    </tr>
    <tr>
        <td>Total Bayar</td>
        <td>:</td>
        <td>Rp. {{ number_format($datas->tagihan->jumlah_pembayaran) }}</td>
    </tr>

    <tr align="center" >
        <td colspan="3" style="padding-top:40px">Terima Kasih</td>
    </tr>
</table>