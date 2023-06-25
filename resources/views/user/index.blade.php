@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Users</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card-header border-0 pb-0">
                                <h3 class="card-title mb-0">List Users</h3>
                                <div class="ms-auto pageheader-btn">
                                    @hasanyrole(['SUPER ADMIN|ADMIN PROVINSI|ADMIN KABKOT'])
                                        <div class="btn-group mt-2 mb-2">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#modal_import_user">Import User</button>
                                            <button type="button" class="btn btn-default dropdown-toggle "
                                                data-bs-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li class="dropdown-plus-title">
                                                    Import
                                                    <b class="fa fa-angle-up"></b>
                                                </li>
                                                <li>
                                                    <a href="{{ url('template/Template User.xlsx') }}">Template Import User</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a class="btn btn-primary btn-icon text-white me-2" href="{{ url('users/create') }}"
                                            data-bs-target="#modal_tambah">
                                            <span>
                                                <i class="fe fe-plus"></i>
                                            </span> Tambah
                                        </a>
                                    @endhasanyrole
                                </div>
                            </div>
                            <div class="card-header pt-0 d-flex justify-content-center">
                                <div class="row col">
                                    <div class="alert alert-info" role="alert">
                                        <h5 class="h3">Hal yg perlu diperhatikan sebelum penambahan user</h5>

                                        Penambahan user dapat dilakukan dengan 2 cara, yaitu dengan
                                        <strong> menambah satu persatu (tombol tambah)</strong> dan menggunakan
                                        <strong> import template user (tombol import)</strong><br>

                                        <strong>Template user</strong> dapat didownload dengan menekan tombol <strong> panah
                                            bawah </strong>
                                        sebelah tombol import <br>

                                        Masukkan isian excel sesuai dengan kolom pada template, apabila satker punya 2
                                        wilayah (MURA/MURATARA & ENIM/PALI) pastikan
                                        <strong> login dengan admin yang sesuai wilayah</strong>, karena
                                        kode wilayah user yang diimpor akan disamakan dengan kode wilayah admin <br>

                                        Pastikan Email adalah email yg <strong>uniqe</strong> (belum pernah digunakan
                                        sebelumnya) ketika Melakukan Import. <strong>Pastikan Pula Email yang digunakan
                                            email yang
                                            baik/asli karena pembuatan email bisa saja sama pada kabupaten/kota lain
                                            <br>
                                            Level user yang diimport dapat dilihat pada template import user di sheet ke-2
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-10">
                                        <form action="" id="form_filter">
                                            <fieldset>
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <select name="kab_filter" id="kab_filter"
                                                            class="form-control select2-show-search form-select">
                                                            <option value="">Pilih Kab/Kot</option>
                                                            <option value=""> [00] PROVINSI SUMSEL</option>
                                                            @foreach ($kabs as $kab)
                                                                <option value="{{ $kab->id_kab }}"
                                                                    @if ($kab->id_kab == $request->kab_filter) selected @endif>
                                                                    [{{ $kab->id_kab }}] {{ $kab->alias }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <select name="role_filter" id="role_filter"
                                                            class="form-control select2-show-search form-select">
                                                            <option value="">Pilih Roles</option>
                                                            <option value="">Pilih Semua</option>
                                                            @foreach ($data_roles as $roles)
                                                                <option value="{{ $roles->name }}"
                                                                    @if ($roles->name == $request->role_filter) selected @endif>
                                                                    {{ $roles->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" name="nama_filter" id="nama_filter"
                                                            placeholder="cari nama user" class="form-control"
                                                            @if ($request->nama_filter) value="{{ $request->nama_filter }}" @endif>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="submit" class="btn btn-primary">Cari</button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table border table-bordered text-nowrap text-md-nowrap mg-b-0 table-sm">
                                        <thead>
                                            <tr class="text-center ">
                                                <th>No</th>
                                                <th>Kab</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Roles</th>
                                                <th>Flag/Active</th>
                                                <th style="width: 8%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            @foreach ($data as $key => $usr)
                                                <tr class="text-center">
                                                    <td>{{ ++$key }}</td>
                                                    <td class="align-middle">{{ $usr->kd_kab }}</td>
                                                    <td class="text-start align-middle"> {{ $usr->name }} </td>
                                                    <td class="text-start align-middle"> {{ $usr->email }} </td>
                                                    <td class="text-start align-middle">
                                                        @foreach ($usr->roles->pluck('name') as $role)
                                                            {{ $role . ', ' }}
                                                        @endforeach
                                                    </td>
                                                    <td class="align-middle"> {{ $usr->flag_active }} </td>
                                                    <td class="text-center">
                                                        <a class="btn-outline-primary btn"
                                                            href="{{ url('users/' . \Crypt::encryptString($usr->id)) }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        @if ($usr->dummy_user != 1)
                                                            <button class="btn btn-outline-danger btn_hapus"
                                                                data-id="{{ $usr->id }}"
                                                                data-nama="{{ $usr->name }}" data-bs-toggle="modal"
                                                                data-bs-target="#modal_hapus">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_hapus">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus User<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_hapus">
                        @csrf
                        @method('delete')
                        <div class="row ">
                            <input type="text" name="user_id" id="user_id" hidden>
                            <div class="mb-3 ">
                                <label for="nama_hapus" class="form-label">Nama user</label>
                                <input type="text" class="form-control" id="nama_hapus" name="nama" readonly>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" form="form_hapus">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_import_user">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import User<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('users/import') }}" method="post" id="form_import"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row ">
                            <input type="text" name="user_id" id="user_id" hidden>
                            <div class="mb-3 ">
                                <div class="form-group">
                                    <label class="form-label mt-0">File Excel (sesuai template)</label>
                                    <input class="form-control" type="file" name="import_file">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form_import">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .select2-container--open {
            z-index: 9999999
        }

        .select2-dropdown {
            z-index: 9001;
        }
    </style>
@endsection

@section('script')
    <script>
        $('.btn_hapus').click(function() {
            id = $(this).data("id")
            $('#modal_hapus').find('#nama_hapus').val($(this).data("nama"));
            $("#form_hapus").attr('action', "{{ url('users') }}" + '/' + id);
        })
    </script>
@endsection
