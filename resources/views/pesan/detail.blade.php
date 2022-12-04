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
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="Card">
                    <div class="card-body">
                        <h3><i class="fa fa-shopping-cart"></i>Detail Pemesanan</h3>
                        <p align="right">Tanggal Pesan : {{ now() }}</p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($pesanans as $pesanan)
                                    {{-- @dd($keranjang->nama_barang) --}}
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $pesanan->nama_barang }}</td>
                                        <td>{{ $pesanan->jumlah_barang }}</td>
                                        <td>Rp{{ number_format($pesanan->harga) }}</td>
                                        <td>Rp{{ number_format($pesanan->jumlah_harga) }}</td>

                                        </form>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" align="right"><strong>Total Harga :</strong></td>
                                    <td><strong>Rp{{ number_format($total_harga) }}</strong></td>
                                    <td>
                                        {{-- <form method="post" action="{{ route('order') }}">
                                        @csrf
                                        @foreach ($keranjangs as $keranjang)
                                            <input type="hidden" name="keranjang[]" value="{{ $keranjang->id }}">
                                        @endforeach
                                        <input type="hidden" name="total_harga" value="{{ $total_harga }}">


                                        <td colspan="4" align="right"><strong>Total Harga :</strong></td>
                                        <td><strong>Rp{{ number_format($total_harga) }}</strong></td>
                                        <td>
                                            <button type="submit" class="btn btn-primary mt-3"><i
                                                    class="fa fa-shopping-cart"></i>Check Out</button></a> --}}
                                        </form>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
