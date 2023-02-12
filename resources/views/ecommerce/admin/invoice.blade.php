@extends('layouts.app')

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
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-primary">Transaksi</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-striped table" id="table-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Produk</th>
                                        @if (Auth::user()->status == 'admin')
                                            <th>Nama Pelanggan</th>
                                        @endif
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                        <th>Bukti</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->nama_produk }}</td>
                                            @if (Auth::user()->status == 'admin')
                                                <td>{{ $data->name }}</td>
                                            @endif
                                            <td>{{ number_format($data->jumlah) }}</td>
                                            <td>{{ number_format($data->harga) }}</td>
                                            <td>{{ number_format($data->jumlah * $data->harga) }}</td>
                                            <td>
                                                @if (empty($data->bukti) and $data->id_user == Auth::user()->id)
                                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#uploadBukti{{ $data->id }}">
                                                        <i class="fa-solid fa-upload"></i> Upload
                                                    </a>
                                                @endif
                                                @if (!empty($data->bukti))
                                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#lihatBukti{{ $data->id }}">
                                                        <i class="fa-solid fa-file"></i> Lihat
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ ucwords($data->status) }}</td>
                                            <td>
                                                <a href="{{ route('transaksi.show', $data->id) }}" class="btn btn-warning">
                                                    <i class="fa-solid fa-eye"></i> Invoice
                                                </a>
                                                @if ($data->status == 'pembelian')
                                                    @if ($data->id_user == Auth::user()->id)
                                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{ $data->id }}">
                                                            <i class="fa-solid fa-edit"></i> Edit
                                                        </a>
                                                        <a href="#"
                                                            onclick="event.preventDefault();document.getElementById('delete-form{{ $data->id }}').submit();"
                                                            class="btn btn-danger">
                                                            <i class="fa-solid fa-trash"></i> Delete
                                                        </a>
                                                    @endif
                                                    @if (Auth::user()->status == 'admin')
                                                        <a href="#"
                                                            onclick="event.preventDefault();document.getElementById('terima-form{{ $data->id }}').submit();"
                                                            class="btn btn-success">
                                                            <i class="fa-solid fa-check"></i> Terima
                                                        </a>
                                                        <a href="#"
                                                            onclick="event.preventDefault();document.getElementById('gagal-form{{ $data->id }}').submit();"
                                                            class="btn btn-danger">
                                                            <i class="fa-solid fa-times"></i> Gagalkan
                                                        </a>
                                                    @endif
                                                @endif
                                            </td>
                                            <form id="terima-form{{ $data->id }}"
                                                action="{{ route('transaksi.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="jenis" value="terima">
                                            </form>
                                            <form id="gagal-form{{ $data->id }}"
                                                action="{{ route('transaksi.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="jenis" value="gagal">
                                            </form>
                                            <form id="delete-form{{ $data->id }}"
                                                action="{{ route('transaksi.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($datas as $data)
        <!-- Modal Update-->
        <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('transaksi.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah" value="{{ $data->jumlah }}" id="jumlah"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($datas as $data)
        <!-- Modal Update-->
        <div class="modal fade" id="uploadBukti{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('transaksi.update', $data->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="bukti" class="form-label">Bukti</label>
                                    <input type="file" accept=".pdf, .docx, .png" name="bukti" id="bukti"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($datas as $data)
        <!-- Modal Update-->
        <div class="modal fade" id="lihatBukti{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('transaksi.update', $data->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <iframe src="{{ asset('storage/img/bukti/' . $data->bukti) }}" height="350px"
                                        width="100%" frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            {{-- <button type="submit" class="btn btn-primary">Save changes</button> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
