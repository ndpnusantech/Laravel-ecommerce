@extends('layouts.app')

@section('title', 'Profil')

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
                <h1>Profil</h1>
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
                                                <th>Nama</th>
                                                <th>Inisial</th>
                                                <th>Deskripsi</th>
                                                <th>Logo</th>
                                                <th>Copyright</th>
                                                <th>Tahun</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($webs as $dataWeb)
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
                                                    <td>{{ $dataWeb->nama_web }}</td>
                                                    <td>{{ $dataWeb->inis_web }}</td>
                                                    <td>{{ $dataWeb->desk_web }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/img/logo/' . $dataWeb->logo_web) }}"
                                                            alt="logo" width="100%" srcset="">
                                                    </td>
                                                    <td>{{ $dataWeb->copy_web }}</td>
                                                    <td>{{ $dataWeb->year_web }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{ $dataWeb->id }}">
                                                            <i class="fa-solid fa-edit"></i> Edit
                                                        </a>
                                                        <a href="{{ route('web.destroy', $dataWeb->id) }}"
                                                            onclick="event.preventDefault();document.getElementById('delete-form{{ $dataWeb->id }}').submit();"
                                                            class="btn btn-danger">
                                                            <i class="fa-solid fa-trash"></i> Delete
                                                        </a>
                                                    </td>
                                                    <form id="delete-form{{ $dataWeb->id }}"
                                                        action="{{ route('web.destroy', $dataWeb->id) }}" method="POST">
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Profil</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('web.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Nama</label>
                                    <input type="text" name="nama" id="" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Inisial</label>
                                    <input type="text" name="inisial" id="" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Logo</label>
                                    <input type="file" accept=".jpg, .png, .svg" name="logo" id=""
                                        class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Deskripsi</label>
                                    <input type="text" name="deskripsi" id="" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Copyright</label>
                                    <input type="text" name="copy" id="" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Year</label>
                                    <input type="number" min="1900" max="{{ date('Y') }}" name="tahun"
                                        id="" class="form-control">
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

        @foreach ($webs as $web)
            <!-- Modal Update-->
            <div class="modal fade" id="exampleModal{{ $web->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profil</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('web.update', $web->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="" class="form-label">Nama</label>
                                        <input type="text" value="{{ $web->nama_web }}" name="nama"
                                            id="" class="form-control">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="" class="form-label">Inisial</label>
                                        <input type="text" value="{{ $web->inis_web }}" name="inisial"
                                            id="" class="form-control">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="" class="form-label">Logo</label>
                                        <input type="file" accept=".jpg, .png, .svg" value="{{ $web->logo_web }}"
                                            name="logo" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="" class="form-label">Deskripsi</label>
                                        <input type="text" value="{{ $web->desk_web }}" name="deskripsi"
                                            id="" class="form-control">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="" class="form-label">Copyright</label>
                                        <input type="text" value="{{ $web->copy_web }}" name="copy"
                                            id="" class="form-control">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="" class="form-label">Year</label>
                                        <input type="number" min="1900" max="{{ date('Y') }}"
                                            value="{{ $web->year_web }}" name="tahun" id=""
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
