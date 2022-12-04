<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $barang = Barang::where('id', $id)->first();
        return view('pesan.index', compact('barang'));
    }

    public function create()
    {
        return view('create');
    }

    public function batik(Request $request)
    {
        $request->validate([
            'nama_barang' => ['required'],
            'gambar' => ['required'],
            'harga' => ['required'],
            'stok' => ['required'],
            'keterangan' => ['required']
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        // dd($request->all());
        DB::insert(
            'INSERT INTO barangs(nama_barang, gambar, harga, stok, keterangan) VALUES (:nama_barang, :gambar, :harga, :stok, :keterangan)',
            [
                'nama_barang' => $request->nama_barang,
                'gambar' => $request->gambar,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'keterangan' => $request->keterangan
            ]
        );
        return redirect()->route('home')->with('success', 'Data Batik berhasil disimpan');
    }

    public function edit($id)
    {
        $data = DB::table('barangs')->where('id', $id)->first();
        return view('edit')->with('barangs', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'gambar' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'keterangan' => 'required'
        ]);

        // dd($request->all());
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update(
            'UPDATE barangs SET nama_barang = :nama_barang, gambar = :gambar, harga = :harga, stok = :stok, keterangan = :keterangan WHERE id = :id',
            [
                'id' => $id,
                'nama_barang' => $request->nama_barang,
                'gambar' => $request->gambar,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'keterangan' => $request->keterangan
            ]
        );
        return redirect()->route('home')->with('success', 'Data Batik berhasil diubah');
    }

    public function delete($id)
    {

        // Menggunakan Query Builder Laravel dan Named  Bindings untuk valuesnya
        DB::delete('DELETE FROM barangs WHERE id =  :id', ['id' => $id]);
        return redirect()->route('home')->with('success', 'Data Batik berhasil dihapus');
    }

    public function pesan(Request $request, $id)
    {
        return redirect()->route('pesanan')->with('success', 'Data Batik berhasil disimpan');
    }


    public function order(Request $request, $id)
    {

        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        // $cek_keranjang = Keranjang::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
        $cart = DB::select(
            'select * from keranjangs where user_id = :user_id AND barang_id = :barang_id',
            [
                'user_id' => Auth::user()->id,
                'barang_id' => $id
            ]
        );

        if ($cart) {
            DB::update(
                'UPDATE keranjangs SET jumlah_barang = jumlah_barang + :jumlah_barang, jumlah_harga = jumlah_harga + :jumlah_harga WHERE id = :id',
                [
                    'id' => $cart[0]->id,
                    'jumlah_barang' => $request->jumlah_barang,
                    'jumlah_harga' => $request->harga * $request->jumlah_barang
                ]
            );
        } else {
            DB::insert(

                'INSERT INTO keranjangs(user_id, barang_id, jumlah_barang, jumlah_harga) VALUES (:user_id, :barang_id, :jumlah_barang, :jumlah_harga)',
                [
                    'user_id' => Auth::user()->id,
                    'barang_id' => $id,
                    'jumlah_barang' => $request->jumlah_barang,
                    'jumlah_harga' => $request->harga * $request->jumlah_barang
                ]
            );
        }

        DB::update(
            'UPDATE barangs SET stok = stok - :jumlah_barang WHERE id = :id',
            [
                'id' => $id,
                'jumlah_barang' => $request->jumlah_barang

            ]
        );
        return redirect()->route('checkout')->with('success', 'Data Batik berhasil disimpan');
    }

    public function checkout()
    {
        $data = DB::table('keranjangs')
            ->select(["keranjangs.*", "barangs.*", "keranjangs.id as keranjang_id"])
            ->join('barangs', 'barangs.id', '=', 'keranjangs.barang_id')
            ->where('user_id', Auth::user()->id)
            ->get();


        $total_harga = 0;
        foreach ($data as $keranjang) {
            $total_harga += $keranjang->jumlah_harga;
        }

        return view('pesan.checkout')->with(['keranjangs' => $data, 'total_harga' => $total_harga]);
    }

    public function hapus($id)
    {
        DB::delete('DELETE FROM keranjangs WHERE id =  :id', ['id' => $id]);
        return redirect()->route('checkout')->with('success', 'Data Batik berhasil dihapus');
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $data = DB::table('barangs')
            ->where('nama_barang', 'like', "%" . $cari . "%")
            ->get();

        // mengirim data pegawai ke view index
        return view('home', ['barangs' => $data]);
    }
}
