@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">DS RT</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">DS RT</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title mb-0">List DSRT</h3>
                                <div class="ms-auto pageheader-btn">
                                    @hasanyrole(['SUPER ADMIN|ADMIN PROVINSI|ADMIN KABKOT'])
                                        <div class="btn-group mt-2 mb-2">
                                            @hasanyrole(['SUPER ADMIN'])
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#modal_import_dsbs">Import DSRT</button>
                                            @endrole
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
                                                <li><a href="{{ url('template/Template DSRT.xlsx') }}">Template Import DSRT</a>
                                                </li>
                                            </ul>
                                        </div>
                                        {{-- <button class="btn btn-primary btn-icon text-white" data-bs-toggle="modal"
                                            data-bs-target="#modal_tambah" data-kd_kab="{{ $auth->kd_wilayah }}">
                                            <span>
                                                <i class="fe fe-plus"></i>
                                            </span> Tambah
                                        </button> --}}
                                        <button class="btn btn-primary btn-icon text-white" data-bs-toggle="modal"
                                            data-bs-target="#modal_generate" data-kd_kab="{{ $auth->kd_wilayah }}">
                                            <span>
                                                <i class="fe fe-plus"></i>
                                            </span> Generate DSRT
                                        </button>
                                    @endhasanyrole
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
                                                            <option value=""> [00] PROVINSI SUMSEL</option>
                                                            @foreach ($kabs as $kab)
                                                                <option value="{{ $kab->id_kab }}">
                                                                    [{{ $kab->id_kab }}]
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
                                                <th>SEMESTER</th>
                                                <th>ID BS</th>
                                                <th>NU RT</th>
                                                <th>Nama KRT</th>
                                                <th>Jumlah art</th>
                                                <th>Pencacah</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            @foreach ($data as $key => $dt)
                                                <tr class="align-middle">
                                                    <td class="text-center align-middle">{{ ++$key }}</td>
                                                    <td class="align-middle text-center">{{ $dt->semester }}</td>
                                                    <td class="align-middle text-center">{{ $dt->id_bs }}</td>
                                                    <td class="align-middle text-center">{{ $dt->nu_rt }}</td>
                                                    <td class="align-middle text-center">{{ $dt->nama_krt }}</td>
                                                    <td class="align-middle text-center">{{ $dt->jumlah_art }}</td>
                                                    <td class="align-middle text-center"
                                                        style="word-break: break-word; overflow-wrap: break-word;">
                                                        {{ $dt->dsbs->pencacah }}
                                                    </td>
                                                    {{-- <td class="align-middle text-center">
                                                        @isset($dt->iss->pengawas)
                                                            {{ $dt->pcl->pengawas }}
                                                        @endisset
                                                    </td> --}}
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

    {{-- <div class="modal fade" id="modal_tambah">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h6 class="modal-title">Tambah Data</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('dsbs') }}" method="post" id="form_tambah">
                        @csrf
                        <div class="row">
                            <div class="col-md-2">
                                <label for="modal_tambah_kab" class="form-label">Kab</label>
                                <input type="text" class="form-control" id="modal_tambah_kab" name="kd_kab"
                                    @hasanyrole('ADMIN KABKOT') value="{{ $auth->kd_wilayah }}" readonly @endrole>
                            </div>
                            <div class="col-md-2">
                                <label for="modal_tambah_kec" class="form-label">Kec</label>
                                <input type="text" class="form-control" id="modal_tambah_kec" name="kd_kec">
                            </div>
                            <div class="col-md-2">
                                <label for="modal_tambah_desa" class="form-label">Desa</label>
                                <input type="text" class="form-control" id="modal_tambah_desa" name="kd_desa">
                            </div>
                            <div class="col-md-2">
                                <label for="modal_tambah_nbs" class="form-label">NBS</label>
                                <input type="text" class="form-control" id="modal_tambah_nbs" name="nbs">
                            </div>
                            <div class="col-md-2">
                                <label for="modal_tambah_nks" class="form-label">NKS</label>
                                <input type="text" class="form-control" id="modal_tambah_nks" name="nks">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="id_bs" class="form-label">Pencacah</label>
                                <select name="pencacah" id="modal_tambah_pencacah"
                                    class="form-control select2-show-search form-select"
                                    data-placeholder="Pilih Pencacah">
                                    <option label="Pilih Pencacah"></option>
                                    @foreach ($data_pencacah as $pcl)
                                        <option value="{{ $pcl->username }}">{{ $pcl->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form_tambah">Submit</button>
                    <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_edit_pencacah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Pencacah<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('dsbs/pencacah') }}" method="post" id="edit_form_pencacah">
                        @csrf
                        <div class="row">
                            <input type="text" name="id" id="id" hidden>
                            <div class="mb-3 ">
                                <label for="id_bs" class="form-label">ID BS</label>
                                <input type="text" class="form-control" id="id_bs" name="id_bs" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="id_bs" class="form-label">Pencacah</label>
                                    <select name="pencacah" id="pencacah"
                                        class="form-control select2-show-search form-select col-12"
                                        data-placeholder="Pilih Pencacah" style="width: 100%">
                                        <option label="Pilih Pencacah"></option>
                                        @foreach ($data_pencacah as $pcl)
                                            <option value="{{ $pcl->username }}">{{ $pcl->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="edit_form_pencacah">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="modal_generate">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h6 class="modal-title">Generate DSRT</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('dsrt/generate') }}" method="post" id="form_generate">
                        @csrf
                        <div class="row">
                            <div class="row">
                                <div class="form-group">
                                    <label for="id_bs" class="form-label"> Piih BS untuk digenrate DSRT</label>
                                    <select name="id_bs[]" id="modal_generate_id_bs" multiple="multiple"
                                        class="multi-select">
                                        {{-- <option label="Pilih ID BS"></option> --}}
                                        @foreach ($dsbs as $bs)
                                            <option value="{{ $bs->id_bs }}">{{ $bs->id_bs }} /
                                                {{ $bs->nks }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="modal_generate_semester">Semester</label>
                                    <input type="number" name="semester" id="modal_generate_semester" value="1"
                                        readonly class="form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form_generate">Submit</button>
                    <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_hapus">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus DS BS<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('dsbs/delete') }}" method="post" id="form_hapus">
                        @csrf
                        @method('delete')
                        <div class="row ">
                            <input type="text" name="id" id="modal_hapus_id" hidden>
                            <div class="mb-3 ">
                                <label for="modal_hapus_id_bs" class="form-label">ID BS</label>
                                <input type="text" class="form-control" id="modal_hapus_id_bs" name="id_bs"
                                    readonly>
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

    <div class="modal fade" id="modal_import_dsbs">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import DSBS<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('dsbs/import') }}" method="post" id="form_import"
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
            z-index: 9000;
        }

        .select2-dropdown {
            z-index: 9001;
        }
    </style>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#modal_edit_pencacah').find("#pencacah").select2({
                dropdownParent: $("#modal_edit_pencacah")
            });
        });
        $('.btn_pencacah').click(function() {
            // console.log($(this).data("id"))
            $('#modal_edit_pencacah').find('#id').val($(this).data("id"));
            $('#modal_edit_pencacah').find('#id_bs').val($(this).data("id_bs"));
            $("#modal_edit_pencacah").find("#pencacah").val($(this).data("pencacah"));

        })

        $('.btn_hapus').click(function() {
            // console.log($(this).data("id"))
            $('#modal_hapus').find('#modal_hapus_id').val($(this).data("id"));
            $('#modal_hapus').find('#modal_hapus_id_bs').val($(this).data("id_bs"));
        })
    </script>
@endsection
