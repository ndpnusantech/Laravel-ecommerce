@extends('layouts.top-app')

@section('title', 'Invoice')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                @foreach ($datas as $data)
                    <div class="invoice">
                        <div class="invoice-print">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="invoice-title">
                                        <h2>Invoice</h2>
                                        <div class="invoice-number">Order {{ $data->id }}</div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <address>
                                                <strong>Billed To:</strong><br>
                                                {{ session('namaWeb') }}<br>
                                            </address>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <address>
                                                <strong>Shipped To:</strong><br>
                                                {{ $data->name }}<br>
                                                {{ $data->alamat }}
                                            </address>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <address>
                                                <strong>Payment Method:</strong><br>
                                                Visa ending **** 4242<br>
                                                {{ $data->email }}
                                            </address>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <address>
                                                <strong>Order Date:</strong><br>
                                                {{ $data->created_at }}<br><br>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="section-title">Order Summary</div>
                                    <p class="section-lead">All items here cannot be deleted.</p>
                                    <div class="table-responsive">
                                        <table class="table-striped table-hover table-md table">
                                            <tr>
                                                <th data-width="40">#</th>
                                                <th>Item</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-right">Totals</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>{{ ucwords($data->nama_produk) }}</td>
                                                <td class="text-center">{{ number_format($data->harga) }}</td>
                                                <td class="text-center">{{ number_format($data->jumlah) }}</td>
                                                <td class="text-right">{{ number_format($data->harga * $data->jumlah) }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-8">
                                            <div class="section-title">Payment Method</div>
                                            <p class="section-lead">The payment method that we provide is to make it easier
                                                for
                                                you to pay invoices.</p>
                                            <div class="images">
                                                <img src="{{ asset('img/payment/visa.png') }}" alt="visa">
                                                <img src="{{ asset('img/payment/jcb.png') }}" alt="jcb">
                                                <img src="{{ asset('img/payment/mastercard.png') }}" alt="mastercard">
                                                <img src="{{ asset('img/payment/paypal.png') }}" alt="paypal">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 text-right">
                                            <div class="invoice-detail-item">
                                                <div class="invoice-detail-name">Subtotal</div>
                                                <div class="invoice-detail-value">
                                                    Rp.{{ number_format($data->harga * $data->jumlah) }}</div>
                                            </div>
                                            <div class="invoice-detail-item">
                                                <div class="invoice-detail-name">Shipping</div>
                                                <div class="invoice-detail-value">Rp.0</div>
                                            </div>
                                            <hr class="mt-2 mb-2">
                                            <div class="invoice-detail-item">
                                                <div class="invoice-detail-name">Total</div>
                                                <div class="invoice-detail-value invoice-detail-value-lg">
                                                    {{ number_format($data->harga * $data->jumlah) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-md-right">
                            <div class="float-lg-left mb-lg-0 mb-3">
                                <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-print"></i>
                                    Print</button>
                            </div>
                            <a href="{{ route('transaksi.create') }}" class="btn btn-warning btn-icon icon-left"><i
                                    class="fas fa-arrow-left"></i> Back</a>
                        </div>
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
