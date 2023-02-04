@extends('layouts.app')

@section('title', 'User')

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
                <h1>User</h1>
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
                                                <th>Nama User</th>
                                                <th>Email</th>
                                                <th>Alamat</th>
                                                <th>Status</th>
                                                <th>Tgl Bergabung</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($users as $dataUser)
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
                                                    <td>{{ $dataUser->name }}</td>
                                                    <td>{{ $dataUser->email }}</td>
                                                    <td>{{ $dataUser->alamat }}</td>
                                                    <td>{{ $dataUser->status }}</td>
                                                    <td>{{ date('d-m-Y H:i:s', strtotime($dataUser->created_at)) }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{ $dataUser->id }}">
                                                            <i class="fa-solid fa-edit"></i> Edit
                                                        </a>
                                                        <a href="{{ route('user.destroy', $dataUser->id) }}"
                                                            onclick="event.preventDefault();document.getElementById('delete-form{{ $dataUser->id }}').submit();"
                                                            class="btn btn-danger">
                                                            <i class="fa-solid fa-trash"></i> Delete
                                                        </a>
                                                    </td>
                                                    <form id="delete-form{{ $dataUser->id }}"
                                                        action="{{ route('user.destroy', $dataUser->id) }}" method="POST">
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Nama</label>
                                    <input type="text" name="name" id="" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" name="email" id="" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" name="password" id="" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Alamat</label>
                                    <input type="text" name="alamat" id="" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
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

        @foreach ($users as $user)
            <!-- Modal Update-->
            <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('user.update', $user->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="" class="form-label">Nama</label>
                                        <input type="text" name="name" id="" value="{{ $user->name }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="" class="form-label">Email</label>
                                        <input type="email" name="email" id="" value="{{ $user->email }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="" class="form-label">Password</label>
                                        <input type="password" name="password" id="" class="form-control">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="" class="form-label">Alamat</label>
                                        <input type="text" name="alamat" id="" value="{{ $user->alamat }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="" class="form-label">Status</label>
                                        <select name="status" id="" class="form-control">
                                            <option value="admin" {{ $user->status == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="user" {{ $user->status == 'user' ? 'selected' : '' }}>User
                                            </option>
                                        </select>
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
