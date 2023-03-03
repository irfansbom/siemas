@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Alokasi DSBS-USER</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Alokasi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card-header border-0 pb-0">
                                <h3 class="card-title mb-0">List DS BS</h3>
                                <div class="ms-auto pageheader-btn">
                                    @hasanyrole(['SUPER ADMIN|ADMIN PROVINSI|ADMIN KABKOT'])
                                        <div class="btn-group mt-2 mb-2">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#modal_import_alokasi">Import Alokasi User</button>
                                        </div>
                                    @endhasanyrole
                                </div>
                            </div>
                            <div class="card-header pt-0 d-flex justify-content-center">
                                <div class="row col">
                                    <div class="alert alert-info" role="alert">
                                        <ul style="list-style-type:initial;">
                                            <li> Alokasi Dapat dilakukan dengan 2 cara, yaitu manual dengan pilih pencacah
                                                pada list
                                                dibawah secara satu persatu atau sekaligus dengan import excel.</li>
                                            <li><strong> Import alokasi </strong> dengan excel dapat dilalukan dengan cara
                                                <strong> mengexport terlebih
                                                    dahulu DSBS </strong> di list berikut(export sesuai filter yang
                                                dipilih), kemudian
                                                melakukan pengisian email pencacah pada kolom pencacah dan <strong> Import
                                                    kembali</strong>
                                                excel yang sudah diisikan.
                                            </li>
                                            <li> Apabila email user tidak terdaftar pada menu user
                                                maka dsbs tidak akan teralokasi ke siapapun, pastikan
                                                user dan email telah terdaftar pada menu user.
                                            </li>
                                            <li>Pengawas terisi secara otomatis dari
                                                pengisian pengawas pada menu user.</li>
                                            <li> Apabila ada DSBS yang tidak sesuai lapor ke admin provinsi.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <form action="" id="form_filter">
                                            <fieldset>
                                                <div class="mb-1 row">
                                                    {{-- <label for="kab_filter" class="col-sm-2 col-form-label">Kab/Kot</label> --}}
                                                    <div class="col-sm-2">
                                                        <select name="kab_filter" id="kab_filter"
                                                            class="form-control select2-show-search form-select">
                                                            <option value="">Pilih Kab/Kot</option>
                                                            <option value=""> [00] PROVINSI SUMSEL</option>
                                                            @foreach ($kabs as $kab)
                                                                <option value="{{ $kab->id_kab }}"
                                                                    @if ($kab->id_kab == $request->kab_filter) selected @endif>
                                                                    [{{ $kab->id_kab }}]
                                                                    {{ $kab->alias }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <select name="tahun_filter" id="tahun_filter"
                                                            class="form-control select2 form-select">
                                                            <option value="">Pilih tahun</option>
                                                            <option value="2022"
                                                                @if ($request->tahun_filter == '2022') selected @endif>2022
                                                            </option>
                                                            <option value="2023"
                                                                @if ($request->tahun_filter == '2023') selected @endif>2023
                                                            </option>

                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <select name="semester_filter" id="semester_filter"
                                                            class="form-control select2 form-select">
                                                            <option value="">Pilih Semester</option>
                                                            <option value="1"
                                                                @if ($request->semester_filter == '1') selected @endif>1</option>
                                                            <option value="2"
                                                                @if ($request->semester_filter == '2') selected @endif>2</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" name="bs_filter" id="bs_filter"
                                                            placeholder="cari ID BS" class="form-control"
                                                            @if ($request->bs_filter) value="{{ $request->bs_filter }}" @endif>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <select name="dummy_filter" id="dummy_filter"
                                                            class="form-control select2-show-search form-select">
                                                            <option value="">Sample Filter</option>
                                                            <option value="">Semua Sampel</option>
                                                            <option value="1"
                                                                @if ($request->dummy_filter == '1') selected @endif>Sampel
                                                                Latihan
                                                            </option>
                                                            <option value="0"
                                                                @if ($request->dummy_filter == '0') selected @endif>Sampel
                                                                Lapangan
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <button type="submit" class="btn btn-primary"
                                                                    style="width: 100%">Cari</button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button class="btn btn-success" id="export-btn"
                                                                    style="width: 100%">export</button>
                                                            </div>
                                                        </div>
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
                                                <th>Kec</th>
                                                <th>desa</th>
                                                <th>NBS</th>
                                                <th>ID BS</th>
                                                <th>NKS</th>
                                                <th>Tahun</th>
                                                <th>Semester</th>
                                                <th colspan="2">Pencacah</th>
                                                <th>Pengawas</th>
                                                {{-- <th>Aksi</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            @foreach ($data as $key => $dt)
                                                <tr class="align-middle">
                                                    <td class="text-center align-middle">{{ ++$key }}</td>
                                                    <td class="align-middle text-center">{{ $dt->kd_kab }}</td>
                                                    <td class="align-middle text-center">{{ $dt->kd_kec }}</td>
                                                    <td class="align-middle text-center">{{ $dt->kd_desa }}</td>
                                                    <td class="align-middle text-center">{{ $dt->nbs }}</td>
                                                    <td class="align-middle text-center">{{ $dt->id_bs }}</td>
                                                    <td class="align-middle text-center">{{ $dt->nks }}</td>
                                                    <td class="align-middle text-center">{{ $dt->tahun }}</td>
                                                    <td class="align-middle text-center">{{ $dt->semester }}</td>
                                                    <td class="align-middle text-center"
                                                        style="word-break: break-word; overflow-wrap: break-word;">
                                                        @isset($dt->pcl->name)
                                                            {{ $dt->pcl->name }}
                                                        @endisset
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($auth->hasanyrole('SUPER ADMIN|ADMIN PROVINSI|ADMIN KABKOT'))
                                                            <button class="btn btn-outline-secondary btn_pencacah"
                                                                data-bs-toggle="modal" data-bs-target="#modal_edit_pencacah"
                                                                data-id="{{ $dt->id }}"
                                                                data-id_bs="{{ $dt->id_bs }}">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                        @else
                                                            <button class="btn btn-outline-dark" data-bs-placement="top"
                                                                data-bs-toggle="tooltip" title="BUKAN ADMIN">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                        @endif
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        @isset($dt->pcl->pml)
                                                            {{ $dt->pcl->pml->name }}
                                                        @endisset

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

    <div class="modal fade" id="modal_tambah">
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
                                        <option value="{{ $pcl->email }}">{{ $pcl->name }}</option>
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
                                            <option value="{{ $pcl->email }}">{{ $pcl->name }}</option>
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

    <div class="modal fade" id="modal_import_alokasi">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import Alokasi<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('import_alokasi_dsbs_user') }}" method="post" id="form_import"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row ">
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

            $('#export-btn').on('click', function() {
                var form = $('#form_filter');
                window.open("{{ url('export_alokasi_dsbs_user') }}" + "?" + form.serialize(), "_blank")
            });
        });
        // $('#modal_edit_pencacah').find("#pencacah").select2({
        //     dropdownParent: $("#modal_edit_pencacah")
        // });
        // $('.btn_roles').click(function() {
        //     $('#modal_edit_roles').find('#id').val($(this).data("id"));
        //     $('#modal_edit_roles').find('#id_bs').val($(this).data("id_bs"));
        //     var roles = [];
        //     $(this).data("roles").forEach(element => {
        //         roles.push(element['name']);
        //     });
        //     $('#modal_edit_roles').find('input[name="roles[]"]').each(function() {
        //         if (roles.includes(this.value)) {
        //             $(this).prop('checked', true);
        //         } else {
        //             $(this).prop('checked', false);
        //         }
        //     });
        // })

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
