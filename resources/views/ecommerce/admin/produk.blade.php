@extends('layouts.app')

@section('title', 'Jasa')

@push('style')
    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet"
        href="assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet"
        href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css"> --}}

    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/select.bootstrap4.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> --}}
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Jasa</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="button">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-plus"></i> Tambah Data
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-2">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                            data-checkbox-role="dad" class="custom-control-input"
                                                            id="checkbox-all">
                                                        <label for="checkbox-all"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </th>
                                                <th>#</th>
                                                <th>Nama Jasa</th>
                                                <th>Kategori</th>
                                                <th>Deskripsi Jasa</th>
                                                <th>Jumlah</th>
                                                <th>Diskon</th>
                                                <th>Harga</th>
                                                <th>Gambar</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($datas as $data)
                                                <tr>
                                                    <td>
                                                        <div class="custom-checkbox custom-control">
                                                            <input type="checkbox" data-checkboxes="mygroup"
                                                                class="custom-control-input" id="checkbox-1">
                                                            <label for="checkbox-1"
                                                                class="custom-control-label">&nbsp;</label>
                                                        </div>
                                                    </td>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $data->nama_produk }}</td>
                                                    <td>{{ $data->nama_kategori }}</td>
                                                    <td>{{ $data->desk_produk }}</td>
                                                    <td>{{ number_format($data->jumlah) }}</td>
                                                    <td>{{ number_format($data->diskon) }}</td>
                                                    <td>{{ number_format($data->harga) }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/img/gambar/' . $data->gambar) }}"
                                                            alt="logo" width="100%" srcset="">
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{ $data->id }}">
                                                            <i class="fa-solid fa-edit"></i> Edit
                                                        </a>
                                                        <a href="{{ route('produk.destroy', $data->id) }}"
                                                            onclick="event.preventDefault();document.getElementById('delete-form{{ $data->id }}').submit();"
                                                            class="btn btn-danger">
                                                            <i class="fa-solid fa-trash"></i> Delete
                                                        </a>
                                                    </td>
                                                    <form id="delete-form{{ $data->id }}"
                                                        action="{{ route('produk.destroy', $data->id) }}" method="POST">
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
        </section>

        <!-- Modal Insert-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Jasa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Kategori</label>
                                    <select name="id_kategori" id="" class="form-control">
                                        @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-12">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" name="nama_produk" id="nama" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="desk" class="form-label">Deskripsi</label>
                                    <input type="text" name="desk_produk" id="desk" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="diskon" class="form-label">Diskon</label>
                                    <input type="number" name="diskon" id="diskon" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for=harga"" class="form-label">Harga</label>
                                    <input type="number" name="harga" id="harga" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" name="gambar" id="gambar" class="form-control">
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

        @foreach ($datas as $data)
            <!-- Modal Update-->
            <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Jasa</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('produk.update', $data->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="" class="form-label">Kategori</label>
                                        <select name="id_kategori" id="" class="form-control">
                                            @foreach ($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}"
                                                    {{ $data->id_kategori == $kategori->id ? 'selected' : '' }}>
                                                    {{ $kategori->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" name="nama_produk" value="{{ $data->nama_produk }}"
                                            id="nama" class="form-control">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="desk" class="form-label">Deskripsi</label>
                                        <input type="text" name="desk_produk" value="{{ $data->desk_produk }}"
                                            id="desk" class="form-control">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="jumlah" class="form-label">Jumlah</label>
                                        <input type="number" name="jumlah" value="{{ $data->jumlah }}" id="jumlah"
                                            class="form-control">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="diskon" class="form-label">Diskon</label>
                                        <input type="number" name="diskon" value="{{ $data->diskon }}" id="diskon"
                                            class="form-control">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for=harga"" class="form-label">Harga</label>
                                        <input type="number" name="harga" value="{{ $data->harga }}" id="harga"
                                            class="form-control">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="gambar" class="form-label">Gambar</label>
                                        <input type="file" name="gambar" value="{{ $data->gambar }}" id="gambar"
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
    @endsection

    @push('scripts')
        <!-- JS Libraies -->
        {{-- <script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script> --}}
        <script src="{{ asset('library/datatables/media/js/datatables.min.js') }}"></script>
        <script src="{{ asset('library/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('library/datatables/media/js/dataTables.select.min.js') }}"></script>

        {{-- <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script> --}}

        <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

        <!-- Page Specific JS File -->
        <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    @endpush
