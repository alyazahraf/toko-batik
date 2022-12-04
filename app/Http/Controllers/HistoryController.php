<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detail()
    {
        $pesanan = DB::select('select * from keranjangs join barangs on barangs.id = keranjangs.barang_id join pesanans on pesanans.id = keranjangs.pesanan_id where keranjangs.user_id = ? AND keranjangs.pesanan_id is not null', [auth()->user()->id]);

        $total_harga = 0;
        foreach ($pesanan as $keranjang) {
            $total_harga += $keranjang->jumlah_harga;
        }
        return view('pesan.detail', ['pesanans' => $pesanan, 'total_harga' => $total_harga]);
    }

    public function checkout(Request $request)
    {
        $pesanan = DB::table("pesanans")->insertGetId(
            [
                'user_id' => Auth::user()->id,
                'tanggal' => now(),
                'status' => 1,
                'total_harga' => $request->total_harga
            ]
        );

        $keranjangs = $request->keranjang;
        $query = "UPDATE keranjangs SET pesanan_id = :pesanan_id WHERE id in (";
        foreach ($keranjangs as $keranjang) {
            $query .= "$keranjang";
            if ($keranjang != collect($keranjangs)->last()) {
                $query .= ", ";
            }
        }
        $query .= ")";

        DB::update($query, [
            'pesanan_id' => $pesanan
        ]);
        return redirect()->route('detail')->with('success', 'Data Batik berhasil disimpan');
    }

    public function ubah(Request $request, $id)
    {
        $keranjang = DB::select("SELECT *  FROM keranjangs JOIN barangs ON barangs.id = keranjangs.barang_id WHERE keranjangs.id = ?", [$id]);
        // dd($keranjang[0]->harga);
        DB::update(
            'UPDATE keranjangs SET jumlah_harga = :jumlah_harga, jumlah_barang = :jumlah_barang WHERE id = :id',
            [
                'id' => $id,
                'jumlah_barang' => $request->jumlah_barang,
                'jumlah_harga' => $keranjang[0]->harga * $request->jumlah_barang

            ]
        );
        return redirect()->route('checkout')->with('success', 'Data Batik berhasil diubah');
    }
}
