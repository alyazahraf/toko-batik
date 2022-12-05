@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="cari" method="GET">
            <input type="text" name="cari" placeholder="Cari Batik .." value="{{ old('cari') }}">
            <input type="submit" value="CARI">
        </form>
        <br>

        <div class="row justify-content-center">
            @foreach ($barangs as $barang)
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="{{ url('uploads') }}/{{ $barang->gambar }}" alt="...">
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
                            <a href="{{ url('pesan') }}/{{ $barang->id }}" class="btn btn-primary"><i
                                    class="fa-solid fa-cart-shopping"></i> Pesan</a>
                            <br><br>
                            <a href="{{ url('edit') }}/{{ $barang->id }}" class="btn btn-primary"><i
                                    class="fa-solid fa-pen-to-square"></i> Edit</a>
                            {{-- <form method="POST" action="{{ route('delete', $barang->id) }}"> @csrf
                                <br><button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bstarget="#hapusModal{{ $barang->id }}"><i class="fa-solid fa-trash"></i>
                                    Hapus
                                </button>
                            </form> --}}
                            <form class="ml-1 form-inline" method="POST" action="{{ route('soft', $barang->id) }}">
                                @csrf
                                <br><button onclick="return confirm('{{ __('Anda Yakin Ingin Menghapus?') }}')"
                                    type="submit" class="btn btn-warning">Hapus</button>
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
