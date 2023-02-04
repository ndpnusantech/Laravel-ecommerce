@extends('layouts.top-app')

@section('title', 'Detail Produk')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
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
                                <img class="d-block w-100" src="{{ asset('storage/img/gambar/'.$data->gambar) }}" alt="First slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators3" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators3" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-primary">{{ucwords($data->nama_produk)}}</h3>
                        </div>
                        <div class="card-body">
                            <h6>Rp.{{number_format($data->harga)}} </h6>
                            {{ucwords($data->desk_produk)}}
                        </div>
                        <div class="card-footer">
                            <input type="number" name="" min="1" max="999" value="1" id=""
                                class="form-control">
                            <div class="button mt-3">
                                <button class="btn btn-danger">
                                    <i class="fa-solid fa-cart-plus"></i> Keranjang
                                </button>
                                <button class="btn btn-primary">
                                    <i class="fa-solid fa-money-bill-wave"></i> Beli Langsung
                                </button>
                            </div>
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
