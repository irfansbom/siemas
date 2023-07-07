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
                            <div class="card-header border-0 pb-0">
                                <h3 class="card-title mb-0">List DSRT</h3>
                                <div class="ms-auto pageheader-btn">
                                    @hasanyrole(['SUPER ADMIN|ADMIN PROVINSI|ADMIN KABKOT'])
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#modal_swap_dsart">Tukar ART </button>

                                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#modal_swap_dsrt">Tukar Nomor Ruta</button>

                                        <div class="btn-group mt-2 mb-2">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#modal_import_dsrt">Import DSRT</button>
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

                            <div class="card-header pt-0 d-flex justify-content-center">
                                <div class="row col">
                                    <div class="alert alert-info" role="alert">
                                        Generate DSRT untuk membuat list daftar DSRT kosongan(NU RT 1-10), sedangkan IMPORT
                                        DSRT membuar DSRT sesuai NU_RT yg sesuai dengan aplikasi pemutakhiran<br>
                                        <strong>Apabila dilakukan keduanya</strong> maka akan membuat dsrt yang tak ada isi
                                        akibat masih tersisanya hasil generate, apabila ada maka cukup <b> dihapus </b> saja
                                        yang tidak terpakai
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <form action="" id="form_filter">
                                            <fieldset>
                                                <div class="mb-2 row">
                                                    <div class="col-sm-2">
                                                        <select name="tahun_filter" id="tahun_filter"
                                                            class="form-control select2 form-select">
                                                            <option value="">Pilih tahun</option>
                                                            <option value="2022"
                                                                @if ($tahun == '2022') selected @endif>2022
                                                            </option>
                                                            <option value="2023"
                                                                @if ($tahun == '2023') selected @endif>2023
                                                            </option>
                                                            <option value="2024"
                                                                @if ($tahun == '2024') selected @endif>2024
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <select name="semester_filter" id="semester_filter"
                                                            class="form-control select2 form-select">
                                                            <option value="">Pilih Semester</option>
                                                            <option value="1"
                                                                @if ($semester == '1') selected @endif>1</option>
                                                            <option value="2"
                                                                @if ($semester == '2') selected @endif>2</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <select name="flag_active" id="flag_active"
                                                            class="form-control select2-show-search form-select">
                                                            <option value="0"
                                                                @if ($flag_active == '0') selected @endif>
                                                                Inaktif/Dummy
                                                            </option>
                                                            <option value="1"
                                                                @if ($flag_active == '1') selected @endif>
                                                                Aktif/Lapangan
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3"></div>
                                                    {{-- <div class="col-sm-1">
                                                        <button class="btn btn-success" id="export-btn"
                                                            style="width: 100%">export</button>
                                                    </div> --}}
                                                </div>
                                                <div class="mb-2 row">
                                                    <div class="col-sm-2">
                                                        <select name="kab_filter" id="kab_filter"
                                                            class="form-control select2-show-search form-select">
                                                            <option value="">Semua Kab/Kot</option>
                                                            @foreach ($kabs as $kab)
                                                                <option value="{{ $kab->id_kab }}"
                                                                    @if ($kab->id_kab == $request->kab_filter) selected @endif>
                                                                    [{{ $kab->id_kab }}] {{ $kab->alias }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <select name="kec_filter" id="kec_filter"
                                                            class="form-control select2-show-search form-select">
                                                            <option value="">Semua Kecamatan</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <select name="desa_filter" id="desa_filter"
                                                            class="form-control select2-show-search form-select">
                                                            <option value="">Semua Desa</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="nks_filter" id="nks_filter"
                                                            placeholder="cari NKS" class="form-control"
                                                            @if ($request->nks_filter) value="{{ $request->nks_filter }}" @endif>
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
                                                <th>ID BS</th>
                                                <th>NKS</th>
                                                <th>NU RT</th>
                                                <th>KRT Prelist</th>
                                                <th>KRT Cacah</th>
                                                <th>JML Art</th>
                                                <th>DSART</th>
                                                <th>Pencacah</th>
                                                <th>Pengawas</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            @foreach ($data as $key => $dt)
                                                <tr class="align-middle text-center">
                                                    <td class="align-middle">{{ ++$key }}</td>
                                                    <td class="align-middle ">
                                                        {{ '16' . $dt->kd_kab . $dt->kd_kec . $dt->kd_desa . $dt->kd_bs }}
                                                    </td>
                                                    <td class="align-middle ">{{ $dt->nks }}</td>
                                                    <td class="align-middle ">{{ $dt->nu_rt }}</td>
                                                    <td class="align-middle text-start">{{ $dt->nama_krt_prelist }}</td>
                                                    <td class="align-middle text-start">{{ $dt->nama_krt_cacah }}</td>
                                                    <td class="align-middle ">{{ $dt->jml_art_cacah }}</td>
                                                    <td class="align-middle">
                                                        <ul>
                                                            @foreach ($dt->art as $art)
                                                                <li> {{ $art->nama_art }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td class="align-middle text-center"
                                                        style="word-break: break-word; overflow-wrap: break-word;">
                                                        @isset($dt->pencacah)
                                                            {{ $dt->pcl->name }}
                                                        @endisset
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        @isset($dt->pengawas)
                                                            {{ $dt->pml->name }}
                                                        @endisset
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn btn-outline-primary"
                                                            href="{{ url('dsrt/' . \Crypt::encryptString($dt->id)) }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <button class="btn btn-outline-danger btn_hapus"
                                                            data-id="{{ $dt->id }}"
                                                            data-kd_kab="{{ $dt->kd_kab }}"
                                                            data-kd_kec="{{ $dt->kd_kec }}"
                                                            data-kd_desa="{{ $dt->kd_desa }}"
                                                            data-kd_bs="{{ $dt->kd_bs }}"
                                                            data-nu_rt="{{ $dt->nu_rt }}" data-bs-toggle="modal"
                                                            data-bs-target="#modal_hapus">
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
                    <form action="{{ url('dsrt_generate') }}" method="post" id="form_generate">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="modal_generate_tahun" class="form-label">Tahun</label>
                                <select name="tahun" id="modal_generate_tahun" class="form-control select2 form-select"
                                    required>
                                    <option value="">Pilih tahun</option>
                                    <option value="2022">2022</option>
                                    <option value="2023" @if ($tahun == '2023') selected @endif>2023</option>
                                    <option value="2024" @if ($tahun == '2024') selected @endif>2024
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="modal_generate_semester" class="form-label">Semester</label>
                                <select name="semester" id="modal_generate_semester"
                                    class="form-control select2 form-select" required>
                                    <option value="">Pilih semester</option>
                                    <option value="1" @if ($semester == '1') selected @endif>1</option>
                                    <option value="2" @if ($semester == '2') selected @endif>2</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="modal_generate_kabkot" class="form-label">Pilih Kab/kot</label>
                                <select name="kab" id="modal_generate_kabkot"
                                    class="form-control select2-show-search form-select" required>
                                    <option value="">Pilih Kab/kot</option>
                                    @foreach ($kabs as $kab)
                                        <option value="{{ $kab->id_kab }}"> [{{ $kab->id_kab }}] {{ $kab->alias }}
                                        </option>
                                    @endforeach
                                </select>
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
                    <h4 class="modal-title">Hapus DSRT<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_hapus">
                        @csrf
                        @method('delete')
                        <div class="row ">
                            <div class="mb-3 ">
                                <label for="modal_hapus_id_bs" class="form-label">ID BS</label>
                                <input type="text" class="form-control" id="modal_hapus_id_bs" name="id_bs"
                                    readonly>
                            </div>
                            <div class="mb-3 ">
                                <label for="modal_hapus_nu_rt" class="form-label">NURT</label>
                                <input type="text" class="form-control" id="modal_hapus_nu_rt" name="nu_rt"
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

    <div class="modal fade" id="modal_import_dsrt">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import DSRT<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('dsrt_import') }}" method="post" id="form_import"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row ">
                            <input type="text" name="user_id" id="user_id" hidden>
                            <div class="mb-3 ">
                                <div class="form-group">
                                    <label class="form-label mt-0">File Excel (sesuai template)</label>
                                    <input class="form-control" type="file" name="import_file" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="modal_generate_tahun">Tahun</label>
                                    <select name="tahun" id="modal_generate_tahun" class="select2" required>
                                        <option value="2022">2022</option>
                                        <option value="2023" @if ($tahun == '2023') selected @endif>2023
                                        </option>
                                        <option value="2024" @if ($tahun == '2024') selected @endif>2024
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="modal_generate_semester">Semester</label>
                                <select name="semester" id="modal_import_semester" class="select2" required>
                                    <option value="1" @if ($semester == '1') selected @endif>1</option>
                                    <option value="2" @if ($semester == '2') selected @endif>2</option>
                                </select>
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

    <div class="modal fade" id="modal_swap_dsrt">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tukar DSRT<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('dsrt_swap') }}" method="post" id="form_tukar">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-5">
                                <div class="form-group">
                                    <label for="id_bs" class="form-label"> Piih BS </label>
                                    <select name="id_bs" id="modal_swap_idbs" class="form-select select2-show-search ">
                                        @foreach ($dsbs as $bs)
                                            <option value="{{ $bs->id_bs }}">{{ $bs->id_bs }} /
                                                {{ $bs->nks }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 col-2 text-center">
                                <div class="form-group">
                                    <label for="ruta1" class="form-label">Ruta 1</label>
                                    <select name="ruta1" id="modal_swap_ruta1" class="form-select">
                                        @for ($i = 1; $i <= 20; $i++)
                                            <option value="{{ $i }}">{{ $i }} </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 col-1 text-center">
                                <label for="id_bs" class="form-label"> </label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" />
                                </svg>
                            </div>
                            <div class="mb-3 col-2 text-center">
                                <div class="form-group">
                                    <label for="ruta2" class="form-label">Ruta 2</label>
                                    <select name="ruta2" id="modal_swap_ruta2" class="form-select">
                                        @for ($j = 1; $j <= 20; $j++)
                                            <option value="{{ $j }}">{{ $j }} </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form_tukar">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_swap_dsart">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tukar Art Saja<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('dsart_swap') }}" method="post" id="form_tukar_art">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-5">
                                <div class="form-group">
                                    <label for="id_bs" class="form-label"> Piih BS </label>
                                    <select name="id_bs" id="modal_swap_idbs" class="form-select select2-show-search ">
                                        @foreach ($dsbs as $bs)
                                            <option value="{{ $bs->id_bs }}">{{ $bs->id_bs }} /
                                                {{ $bs->nks }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 col-2 text-center">
                                <div class="form-group">
                                    <label for="ruta1" class="form-label">Ruta 1</label>
                                    <select name="ruta1" id="modal_swap_ruta1" class="form-select">
                                        @for ($i = 1; $i <= 20; $i++)
                                            <option value="{{ $i }}">{{ $i }} </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 col-1 text-center">
                                <label for="id_bs" class="form-label"> </label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" />
                                </svg>
                            </div>
                            <div class="mb-3 col-2 text-center">
                                <div class="form-group">
                                    <label for="ruta2" class="form-label">Ruta 2</label>
                                    <select name="ruta2" id="modal_swap_ruta2" class="form-select">
                                        @for ($j = 1; $j <= 20; $j++)
                                            <option value="{{ $j }}">{{ $j }} </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form_tukar_art">Submit</button>
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

        .select2-container {
            width: 100%;
        }

        .select2-dropdown {
            z-index: 9001;
        }
    </style>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            const kab_value = {!! json_encode($request->kab_filter) !!}
            const kec_value = {!! json_encode($request->kec_filter) !!}
            const desa_value = {!! json_encode($request->desa_filter) !!}
            if (kab_value) {
                set_kab(kab_value)
                    .then(function() {
                        select_kabs()
                    }).then(function() {
                        if (kec_value) {
                            set_kec(kec_value)
                        }
                    }).then(function() {
                        select_kecs()
                    }).then(function() {
                        if (desa_value) {
                            set_desa(desa_value)
                        }
                    }).catch(function(error) {
                        console.log(error);
                    });
            }

            $('#kab_filter').change(function() {
                select_kabs();
            })
            $('#kec_filter').change(function() {
                select_kecs();
            })

            $('#export-btn').on('click', function() {
                var form = $('#form_filter');
                window.open("{{ url('alokasi_export') }}" + "?" + form.serialize(), "_blank")
            });

            $('#modal_swap_dsrt').find("#modal_swap_idbs").select2({
                dropdownParent: $("#modal_swap_dsrt"),
                width: '100%',
            });
            $('#modal_swap_dsart').find("#modal_swap_idbs").select2({
                dropdownParent: $("#modal_swap_dsart"),
                width: '100%',
            });
            $('#modal_generate').find("#modal_generate_kabkot").select2({
                dropdownParent: $("#modal_generate"),
                width: '100%',
            });
        });

        $('.btn_hapus').click(function() {
            $('#modal_hapus').find('#form_hapus').attr('action', "{{ url('dsrt') }}" + "/" + $(this).data('id'));
            $('#modal_hapus').find('#modal_hapus_id_bs').val('16' + $(this).data("kd_kab") +
                $(this).data("kd_kec") + $(this).data("kd_desa") + $(this).data("kd_bs"));
            $('#modal_hapus').find('#modal_hapus_nu_rt').val($(this).data("nu_rt"));
        })

        function select_kabs() {
            return new Promise((resolve, reject) => {
                const kab_filter = document.getElementById('kab_filter').value;
                var request = new XMLHttpRequest();
                request.open('GET', "{{ url('list_kec?kab_filter=') }}" +
                    kab_filter,
                    false
                ); // Set argumen ketiga menjadi false untuk menjalankan permintaan secara sinkron
                request.send();
                if (request.status === 200) {
                    var data = JSON.parse(request.responseText);
                    const kec_select = document.getElementById('kec_filter');
                    kec_select.innerHTML = "";
                    var option = document.createElement('option');
                    option.value = "";
                    option.textContent = "Semua";
                    kec_select.appendChild(option);
                    data.data.forEach(element => {
                        var option = document.createElement('option');
                        option.value = element.id_kec;
                        option.textContent = '[' + element.id_kec + '] ' + element.nama_kec;
                        kec_select.appendChild(option);
                    });
                } else {
                    console.error('Error:', request.status);
                }
                resolve();
            })
        }

        function select_kecs() {
            return new Promise((resolve, reject) => {
                const kec_filter = document.getElementById('kec_filter').value;
                const kab_filter = document.getElementById('kab_filter').value;
                var request = new XMLHttpRequest();
                request.open('GET', "{{ url('list_desa?kab_filter=') }}" +
                    kab_filter +
                    '&kec_filter=' + kec_filter,
                    false
                ); // Set argumen ketiga menjadi false untuk menjalankan permintaan secara sinkron
                request.send();
                if (request.status === 200) {
                    var data = JSON.parse(request.responseText);
                    const desa_select = document.getElementById('desa_filter');
                    desa_select.innerHTML = "";
                    var option = document.createElement('option');
                    option.value = "";
                    option.textContent = "Semua";
                    desa_select.appendChild(option);
                    data.data.forEach(element => {
                        var option = document.createElement('option');
                        option.value = element.id_desa;
                        option.textContent = '[' + element.id_desa + '] ' + element
                            .nama_desa;
                        desa_select.appendChild(option);
                    });
                } else {
                    console.error('Error:', request.status);
                }
                resolve();
            })
        }

        function set_kab(kab_value) {
            return new Promise((resolve, reject) => {
                const kab_select = document.getElementById('kab_filter');
                kab_select.value = kab_value
                resolve();
            });
        }

        function set_kec(kec_value) {
            return new Promise((resolve, reject) => {
                const kec_select = document.getElementById('kec_filter');
                kec_select.value = kec_value
                // $('#kec_filter').val(kec_value);
                kec_select.dispatchEvent(new Event('change'));
                resolve();
            });
        }

        function set_desa(desa_value) {
            return new Promise((resolve, reject) => {
                const desa_select = document.getElementById('desa_filter');
                desa_select.value = desa_value
                desa_select.dispatchEvent(new Event('change'));
                resolve();
            });
        }
    </script>
@endsection
