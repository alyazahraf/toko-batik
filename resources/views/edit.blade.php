@extends('layouts.app')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title fw-bolder mb-3">Ubah Data Batik</h5>

            <form method="post" action="{{ route('update', $barangs->id) }}">

                @csrf
                <div class="mb-3">
                    <label for="id" class="form-label">ID Barang</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ $barangs->id }}">
                </div>

                <div class="mb-3">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                        value="{{ $barangs->nama_barang }}">
                </div>
                <div class="mb-3">

                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" value="{{ $barangs->harga }}">
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="text" class="form-control" id="gambar" name="gambar" value="{{ $barangs->gambar }}">
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="text" class="form-control" id="stok" name="stok" value="{{ $barangs->stok }}">
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="keterangan" class="form-control" id="keterangan" name="keterangan"
                        value="{{ $barangs->keterangan }}">
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Ubah" />
                </div>
            </form>
        </div>
    </div>
@stop
