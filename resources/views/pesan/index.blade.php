@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-1">
                <a href="{{ url('home') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Kembali</a>
                <div class="col-md-12 mt-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Library</li>
                        </ol>
                    </nav>
                    <div class="card">
                        <div class="card-body">
                            <div class='row'>
                                <div class='col-md-6'>
                                    <img src="{{ url('uploads') }}/{{ $barang->gambar }}" class="rounded mx-auto d-block"
                                        width="100%" alt="">
                                </div>
                                <div class="col-md-6 mt-5">
                                    <form method="post" action="{{ route('order', $barang->id) }}">
                                        @csrf
                                        <h2>{{ $barang->nama_barang }}</h2>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Harga</td>
                                                    <td>:</td>
                                                    <td>Rp{{ number_format($barang->harga) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Stok</td>
                                                    <td>:</td>
                                                    <td>{{ number_format($barang->stok) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Keterangan</td>
                                                    <td>:</td>
                                                    <td>{{ $barang->keterangan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah Barang</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="number" name="jumlah_barang" class="form-control"
                                                            required="">
                                                    </td>
                                                </tr>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <input type="hidden" name="harga" value="{{ $barang->harga }}">
                                                    <button type="submit" class="btn btn-primary mt-3"><i
                                                            class="fa fa-shopping-cart"></i>Masukkan Keranjang</button>
                                                </td>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
