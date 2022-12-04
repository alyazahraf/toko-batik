<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Barang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $datas = DB::select('select * from barangs WHERE is_deleted = 0');
        return view('home')

            ->with('barangs', $datas);
    }

    public function soft($id)
    {
        DB::update('UPDATE barangs SET is_deleted = 1 WHERE id = :id', ['id' => $id]);

        return redirect()->route('home')->with('success', 'Data Barang berhasil dihapus');
    }
}
