@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="Card">
                        <div class="card-body">
                            <h3><i class="fa fa-shopping-cart"></i>Data Sampah Batik</h3>
                            <div class="row justify-content-center">
                                @foreach ($barangs as $barang)
                                    <div class="col-md-4">
                                        <div class="card">
                                            <img class="card-img-top" src="{{ url('uploads') }}/{{ $barang->gambar }}"
                                                alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <strong>{{ $barang->nama_barang }}</strong>
                                                </h5>
                                                <p class="card-text">
                                                    <strong>Harga :</strong> Rp{{ number_format($barang->harga) }}<br>
                                                    <strong>Stok :</strong> {{ $barang->stok }} <br>
                                                    <hr>
                                                    <strong>Keterangan :</strong> <br>
                                                    {{ $barang->keterangan }}
                                                </p>
                                                <ul>
                                                    <a href="{{ route('restore', $barang->id) }}" type="button"
                                                        class="btn btn-warning rounded-3">Restore</a>
                                                    <form method="POST" action="{{ route('delete', $barang->id) }}"> @csrf
                                                        <br><button type="submit" class="btn btn-danger"
                                                            data-bs-toggle="modal"
                                                            data-bstarget="#hapusModal{{ $barang->id }}"><i
                                                                class="fa-solid fa-trash"></i>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                    {{-- <a href="{{ route('restore', $barang->id) }}" type="button"
                            class="btn btn-warning rounded-3">Restore</a>
                        <form action="{{ route('hard', $barang->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger border-0"
                                onclick="return confirm('Upps, Yakin mau hapus data?')">Hapus</button> --}}
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endsection
