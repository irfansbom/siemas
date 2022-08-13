@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Desa</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Desa</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title mb-0">List Desa</h3>
                                <div class="ms-auto pageheader-btn">
                                    {{-- @hasanyrole(['SUPER ADMIN|ADMIN PROVINSI|ADMIN KABKOT'])
                                        <div class="btn-group mt-2 mb-2">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#modal_import_dsbs">Import DSBS</button>
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
                                                <li><a href="{{ url('template/Template DSBS.xlsx') }}">Template Import DSBS</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <button class="btn btn-primary btn-icon text-white" data-bs-toggle="modal"
                                            data-bs-target="#modal_tambah" data-kd_kab="{{ $auth->kd_wilayah }}">
                                            <span>
                                                <i class="fe fe-plus"></i>
                                            </span> Tambah
                                        </button>
                                    @endhasanyrole --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-10">
                                        <form action="" id="form_filter">
                                            <fieldset>
                                                <div class="mb-1 row">
                                                    {{-- <label for="kab_filter" class="col-sm-2 col-form-label">Kab/Kot</label> --}}
                                                    <div class="col-sm-4">
                                                        <select name="kab_filter" id="kab_filter"
                                                            class="form-control select2-show-search form-select" required>
                                                            <option value="">Pilih Kab/Kot</option>
                                                            @foreach ($kabs as $kab)
                                                                <option value="{{ $kab->id_kab }}"> [{{ $kab->id_kab }}]
                                                                    {{ $kab->alias }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <button type="submit" class="btn btn-primary">Cari</button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">

                                </div>

                                <div class="table-responsive">
                                    <table class="table border table-bordered text-nowrap text-md-nowrap mg-b-0 table-sm">
                                        <thead>
                                            <tr class="text-center align-middle">
                                                <th>No</th>
                                                <th>Kab</th>
                                                <th>KD KEC</th>
                                                <th>KD DESA</th>
                                                <th>DESA</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            @foreach ($data as $key => $dt)
                                                <tr class="align-middle">
                                                    <td class="text-center align-middle">{{ ++$key }}</td>
                                                    <td class="align-middle text-center">{{ $dt->id_kab }}</td>
                                                    <td class="align-middle text-center">{{ $dt->id_kec }}</td>
                                                    <td class="align-middle text-center">{{ $dt->id_desa }}</td>
                                                    <td class="align-middle ">{{ $dt->nama_desa }}</td>
                                                    <td class="text-center">
                                                        <a class="btn btn-outline-primary"
                                                            href="{{ url('dsbs/' . \Crypt::encryptString($dt->id)) }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <button class="btn btn-outline-danger btn_hapus"
                                                            data-id="{{ $dt->id }}" data-id_bs="{{ $dt->id_bs }}"
                                                            data-bs-toggle="modal" data-bs-target="#modal_hapus">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
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
@endsection

@section('css')
    <style>
        .select2-container--open {
            z-index: 9000;
        }

        .select2-dropdown {
            z-index: 9001;
        }
    </style>
@endsection

@section('script')
    <script>
        $(document).ready(function() {});

        $('.btn_hapus').click(function() {
            $('#modal_hapus').find('#modal_hapus_id').val($(this).data("id"));
            $('#modal_hapus').find('#modal_hapus_id_bs').val($(this).data("id_bs"));
        })
    </script>
@endsection
