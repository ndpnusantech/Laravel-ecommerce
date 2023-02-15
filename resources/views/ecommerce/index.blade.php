@extends('layouts.top-app')

@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">

            <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators3" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators3" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators3" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('img/news/bg.jpg') }}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('img/news/bg.jpg') }}" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('img/news/bg.jpg') }}" alt="Third slide">
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

            <h4 class="text-center mt-3">Jasa Kami</h4>
            <p class="text-center">Pesan Sekarang! untuk jasa favorite pilihan mu</p>
            <div class="row">
                @foreach ($datas as $data)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <a class="text-decoration-none" href="{{ url('detail-produk?id=' . $data->id) }}">
                            <article class="article article-style-b">
                                <div class="article-header">
                                    <div class="article-image"
                                        data-background="{{ asset('storage/img/gambar/' . $data->gambar) }}">
                                    </div>
                                    <div class="article-badge">
                                        <div class="article-badge-item bg-danger"><i class="fas fa-heart"></i>
                                            {{ $data->nama_kategori }}</div>
                                    </div>
                                </div>
                                <div class="article-details">
                                    <div class="article-title">
                                        <h6 class="text-bold text-primary">{{ ucwords($data->nama_produk) }}</h6>
                                    </div>
                                    <p>Rp. {{ number_format($data->harga) }} </p>
                                </div>
                            </article>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
