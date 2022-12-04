@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="Card">
                    <div class="card-body">
                        <h5 class="card-title fw-bolder mb-3"> Tambah Data Batik</h5>
                        {{-- <p align="right">Tanggal Pesan : {{ now() }}</p> --}}
                        <table class="table table-bordered">
                            <form method="post" action="{{ route('simpan') }}">
                                @csrf
                                {{-- <div class="mb-3">
                <label for="id_barang" class="form-label">ID Barang</label>
                <input type="text" class="form-control" id="id_barang" name="id_barang">
            </div> --}}
                                <div class="mb-3">
                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang">
                                </div>
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" id="gambar" name="gambar">
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="text" class="form-control" id="harga" name="harga">
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="text" class="form-control" id="Stok" name="stok">
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan">
                                </div>
                                <div class="text-center">
                                    <input type="submit" class="btn btn-primary" value="Tambah" />
                                </div>
                            </form>
                        @endsection
