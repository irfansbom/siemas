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
                                                <li><a href="{{ url('template/Template User.xlsx') }}">Template Import User</a>
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
                                        Username berguna untuk melakukan login di aplikasi android sehingga pastikan
                                        username telah benar,<br>
                                        Import dengan excel memberikan akses pengimport untuk melakukan update apabila ada
                                        email yang duplikat, pastikan email tidak terduplikat di baris lain <br>
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
                                                    {{-- <label for="kab_filter" class="col-sm-2 col-form-label">Kab/Kot</label> --}}
                                                    <div class="col-sm-3">
                                                        <select name="kab_filter" id="kab_filter"
                                                            class="form-control select2-show-search form-select">
                                                            <option value="">Pilih Kab/Kot</option>
                                                            <option value=""> [00]
                                                                PROVINSI SUMSEL</option>
                                                            @foreach ($kabs as $kab)
                                                                <option value="{{ $kab->id_kab }}"
                                                                    @if ($kab->id_kab == $request->kab_filter) selected @endif>
                                                                    [{{ $kab->id_kab }}]
                                                                    {{ $kab->alias }}</option>
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
                                            <tr class="text-center align-middle">
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>KD <br> Wilayah</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th colspan="2">Pengawas</th>
                                                <th colspan="2">Roles</th>
                                                <th style="width: 8%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            @foreach ($user as $key => $usr)
                                                <tr class="align-middle">
                                                    <td class="text-center align-middle">{{ ++$key }}</td>
                                                    <td class="align-middle">
                                                        {{ $usr->name }}
                                                    </td>
                                                    <td class="align-middle text-center">{{ $usr->kd_wilayah }}</td>
                                                    <td class="align-middle"
                                                        style="word-break: break-word; overflow-wrap: break-word;">
                                                        {{ $usr->email }}</td>
                                                    <td class="align-middle"
                                                        style="word-break: break-word; overflow-wrap: break-word;">
                                                        {{ $usr->username }}</td>
                                                    <td class="align-middle"
                                                        style="word-break: break-word; overflow-wrap: break-word;">
                                                        {{ $usr->pengawas }}</td>
                                                    <td class="text-center">
                                                        @if ($auth->hasanyrole('SUPER ADMIN|ADMIN PROVINSI|ADMIN KABKOT'))
                                                            <button class="btn btn-outline-secondary btn_pengawas"
                                                                data-bs-toggle="modal" data-bs-target="#modal_edit_pengawas"
                                                                data-id="{{ $usr->id }}"
                                                                data-pengawas="{{ $usr->pengawas }}"
                                                                data-nama="{{ $usr->name }}">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                        @else
                                                            <button class="btn btn-outline-secondary"
                                                                data-bs-placement="top" data-bs-toggle="tooltip"
                                                                title="BUKAN ADMIN">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                        @endif
                                                    </td>

                                                    <td class="align-middle">
                                                        <ul class="m-0">
                                                            @foreach ($usr->roles->pluck('name') as $role)
                                                                <li>{{ $role }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($auth->hasanyrole('SUPER ADMIN|ADMIN PROVINSI|ADMIN KABKOT'))
                                                            <button
                                                                class="btn btn-outline-secondary btn_roles"data-bs-toggle="modal"
                                                                data-bs-target="#modal_edit_roles"
                                                                data-id="{{ $usr->id }}"
                                                                data-roles="{{ $usr->roles }}"
                                                                data-nama="{{ $usr->name }}">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                        @else
                                                            <button class="btn btn-outline-secondary"
                                                                data-bs-placement="top" data-bs-toggle="tooltip"
                                                                title="BUKAN ADMIN">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                        @endif
                                                    </td>

                                                    <td class="text-center">
                                                        <a class="btn btn-outline-primary "
                                                            href="{{ url('users/' . \Crypt::encryptString($usr->id)) }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <button class="btn btn-outline-danger  btn_hapus"
                                                            data-id="{{ $usr->id }}"
                                                            data-nama="{{ $usr->name }}" data-bs-toggle="modal"
                                                            data-bs-target="#modal_hapus">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{ $user->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
            </div>
            <!-- ROW-5 END -->
        </div>
        <!-- CONTAINER END -->
    </div>

    <div class="modal fade" id="modal_edit_roles">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Roles<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ url('users/roles') }}" method="post" id="edit_form_roles">
                        @csrf
                        <div class="row ">
                            <input type="text" name="user_id" id="user_id" hidden>
                            <div class="mb-3 ">
                                <label for="nama_user" class="form-label">Nama user</label>
                                <input type="text" class="form-control" id="user_name" name="nama" readonly>
                            </div>

                        </div>
                        Roles
                        @foreach ($data_roles as $role)
                            <div class="form-check">
                                <input class="form-check-input roles" type="checkbox" value="{{ $role->name }}"
                                    name="roles[]" id="{{ $role->name }}">
                                <label class="form-check-label" for="{{ $role->name }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach

                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="edit_form_roles">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_edit_pengawas">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Pengawas<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ url('users/pengawas') }}" method="post" id="edit_form_pengawas">
                        @csrf
                        <div class="row">
                            <input type="text" name="user_id" id="user_id" hidden>
                            <div class="mb-3 ">
                                <label for="nama_user" class="form-label">Nama user</label>
                                <input type="text" class="form-control" id="user_name" name="nama" readonly>
                            </div>
                        </div>
                        Pengawas
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="pengawas" id="pengawas"
                                        class="form-control select2-show-search form-select"
                                        data-placeholder="Pilih Pengawas" style="width:100%">
                                        <option value=" ">Pilih Pengawas</option>
                                        @foreach ($data_pengawas as $pms)
                                            <option value="{{ $pms->email }}">{{ $pms->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="edit_form_pengawas">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
                    <form action="{{ url('users/delete') }}" method="post" id="form_hapus">
                        @csrf
                        <div class="row ">
                            <input type="text" name="user_id" id="user_id" hidden>
                            <div class="mb-3 ">
                                <label for="nama_user" class="form-label">Nama user</label>
                                <input type="text" class="form-control" id="user_name" name="nama" readonly>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form_hapus">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
        $(document).ready(function() {
            $('#modal_edit_pengawas').find("#pengawas").select2({
                dropdownParent: $("#modal_edit_pengawas ")
            });
        });

        $('.btn_roles').click(function() {
            console.log($(this).data("id"))
            $('#modal_edit_roles').find('#user_id').val($(this).data("id"));
            $('#modal_edit_roles').find('#user_name').val($(this).data("nama"));
            var roles = [];
            $(this).data("roles").forEach(element => {
                roles.push(element['name']);
            });
            $('#modal_edit_roles').find('input[name="roles[]"]').each(function() {
                if (roles.includes(this.value)) {
                    $(this).prop('checked', true);
                } else {
                    $(this).prop('checked', false);
                }
            });
        })

        $('.btn_pengawas').click(function() {
            // console.log($(this).data("id"))
            $('#modal_edit_pengawas').find('#user_id').val($(this).data("id"));
            $('#modal_edit_pengawas').find('#user_name').val($(this).data("nama"));
            $("#modal_edit_pengawas").find("#pengawas").val($(this).data("pengawas"));
            // $("#modal_edit_pengawas").find("input[name='pengawas']").each(function() {
            //     $(this).prop('checked', false);
            // });
            // $("#modal_edit_pengawas").find("input[name='pengawas'][value='" + $(this).data("pengawas") + "']")
            //     .prop('checked', true);
        })

        $('.btn_hapus').click(function() {
            // console.log($(this).data("id"))
            $('#modal_hapus').find('#user_id').val($(this).data("id"));
            $('#modal_hapus').find('#user_name').val($(this).data("nama"));

        })
    </script>
@endsection
