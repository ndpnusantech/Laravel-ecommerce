@extends('layouts.top-app')

@section('title', 'Detail Produk')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">

        @if (session()->has('message'))
            <div class="alert alert-primary alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session('message') }}
                </div>
            </div>
        @endif
        @foreach ($datas as $data)
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                    <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators3" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators3" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators3" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('storage/img/gambar/' . $data->gambar) }}"
                                    alt="First slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators3" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators3" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-primary">{{ ucwords($data->nama_produk) }}</h3>
                        </div>
                        <div class="card-body">
                            <h6>Rp.{{ number_format($data->harga) }} </h6>
                            {{ ucwords($data->desk_produk) }}
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="number" name="jumlah" min="1" max="999" value="1"
                                    id="" class="form-control">
                                <input type="hidden" name="idproduk" value="{{ $data->id }}">
                                <input type="hidden" name="harga" value="{{ $data->harga }}">
                                <div class="button mt-3">
                                    @if (Auth::check())
                                        <button type="submit" name="button" value="keranjang" class="btn btn-danger">
                                            <i class="fa-solid fa-cart-plus"></i> Keranjang
                                        </button>
                                        <button type="submit" name="button" value="beli" class="btn btn-primary">
                                            <i class="fa-solid fa-money-bill-wave"></i> Beli Langsung
                                        </button>
                                    @else
                                        <a href="{{ url('login') }}" class="btn btn-danger">
                                            <i class="fa-solid fa-cart-plus"></i> Keranjang
                                        </a>
                                        <a href="{{ url('login') }}" class="btn btn-primary">
                                            <i class="fa-solid fa-money-bill-wave"></i> Beli Langsung
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
