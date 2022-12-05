@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ url('home') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Kembali</a>
            </div>
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Check Out</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="Card">
                    <div class="card-body">
                        <h3><i class="fa fa-shopping-cart"></i>Check Out</h3>
                        {{-- <p align="right">Tanggal Pesan : {{ now() }}</p> --}}
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($keranjangs as $keranjang)
                                    {{-- @dd($keranjang->nama_barang) --}}
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $keranjang->nama_barang }}</td>
                                        <td>
                                            <form action="{{ route('ubah', $keranjang->keranjang_id) }}" method="post">
                                                @csrf
                                                <input type="number" name="jumlah_barang" id=""
                                                    value="{{ $keranjang->jumlah_barang }}">
                                                <button type="submit">Ubah</button>

                                            </form>
                                        </td>
                                        <td>Rp{{ number_format($keranjang->harga) }}</td>
                                        <td>Rp{{ number_format($keranjang->jumlah_harga) }}</td>
                                        <td>
                                            <form action="{{ url('hapus') }}/{{ $keranjang->keranjang_id }}"
                                                method="post">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" align="right"><strong>Total Harga :</strong></td>
                                    <td><strong>Rp{{ number_format($total_harga) }}</strong></td>
                                    <td>
                                        <form method="post" action="{{ route('bayar') }}">
                                            @csrf
                                            @forelse ($keranjangs as $keranjang)
                                                <input type="hidden" name="keranjang[]"
                                                    value="{{ $keranjang->keranjang_id }}">

                                                <input type="hidden" name="total_harga" value="{{ $total_harga }}">
                                                <button type="submit" class="btn btn-primary mt-3"><i
                                                        class="fa fa-shopping-cart"></i>Check Out</button>

                                            @empty

                                                <input type="hidden" name="total_harga" value="{{ $total_harga }}">
                                            @endforelse
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
