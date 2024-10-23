@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Monitoring</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Monitoring</a></li>
                            <li class="breadcrumb-item active" aria-current="page">DSRT</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card-header border-0 pb-0 mb-3">
                                <h3 class="card-title ">List DSRT</h3>
                                <div class="ms-auto pageheader-btn">
                                    <button id="export-dsrt-btn" class="btn btn-success btn-icon text-white">
                                        <span>
                                            <i class="fe fe-log-in"></i>
                                        </span> Export DSRT
                                    </button>
                                    <button id="export-dsart-btn" class="btn btn-success btn-icon text-white">
                                        <span>
                                            <i class="fe fe-log-in"></i>
                                        </span> Export DSART
                                    </button>
                                    <button id="export-mon-btn" class="btn btn-info btn-icon text-white">
                                        <span>
                                            <i class="fe fe-log-in"></i>
                                        </span> Export Monitoring
                                    </button>
                                </div>
                            </div>
                            <div class="card-header pt-0 d-flex justify-content-center">
                                <div class="row col">
                                    <div class="alert alert-info" role="alert">
                                        <ul>
                                            <li>
                                                Angka Desil bisa berubah jika melakukan filter kabupaten kota, jika tidak
                                                filter maka angka provinsi
                                            </li>
                                            <li>
                                                Desil ke-3 dari data rata-rata perkapita adalah sebesar Rp
                                                <b> {{ round($desil[3]) }}</b>
                                            </li>
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
                                                    <div class="col-11">
                                                        <div class="row mb-1">
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
                                                            <div class="col-sm-1">
                                                                <select name="tahun_filter" id="tahun_filter"
                                                                    class="form-control select2 form-select">
                                                                    <option value="">Pilih tahun</option>
                                                                    <option value="2022"
                                                                        @if ($request->tahun_filter == '2022') selected @endif>
                                                                        2022
                                                                    </option>
                                                                    <option value="2023"
                                                                        @if ($request->tahun_filter == '2023') selected @endif>
                                                                        2023
                                                                    </option>
                                                                    <option value="2024"
                                                                        @if ($request->tahun_filter == '2024') selected @endif>
                                                                        2024
                                                                    </option>

                                                                </select>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <select name="semester_filter" id="semester_filter"
                                                                    class="form-control select2 form-select">
                                                                    <option value="">Pilih Semester</option>
                                                                    <option value="1"
                                                                        @if ($request->semester_filter == '1') selected @endif>1
                                                                    </option>
                                                                    <option value="2"
                                                                        @if ($request->semester_filter == '2') selected @endif>2
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="bs_filter" id="bs_filter"
                                                                    placeholder="cari BS" class="form-control"
                                                                    @if ($request->bs_filter) value="{{ $request->bs_filter }}" @endif>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="nks_filter" id="nks_filter"
                                                                    placeholder="cari NKS" class="form-control"
                                                                    @if ($request->nks_filter) value="{{ $request->nks_filter }}" @endif>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <select name="status_filter" id="status_filter"
                                                                    class="form-control select2 form-select">
                                                                    <option value="">Pilih Status Pencacahan</option>
                                                                    <option value="0"
                                                                        @if ($request->status_filter == '0') selected @endif>
                                                                        Belum
                                                                        Cacah
                                                                    </option>
                                                                    <option value="2"
                                                                        @if ($request->status_filter == '2') selected @endif>
                                                                        Sudah
                                                                        Upload
                                                                    </option>
                                                                    <option value="5"
                                                                        @if ($request->status_filter == '5') selected @endif>
                                                                        Sudah
                                                                        Upload Pemeriksaan Pengawas
                                                                    </option>
                                                                </select>

                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <input type="text" name="minimum_filter"
                                                                    id="minimum_filter" placeholder="Perkapita Minimum"
                                                                    class="form-control"
                                                                    @if ($request->minimum_filter) value="{{ $request->minimum_filter }}" @endif>
                                                            </div>
                                                            <div class="col-2">
                                                                <input type="text" name="maksimum_filter"
                                                                    id="maksimum_filter" placeholder="Perkapita Maksimum"
                                                                    class="form-control"
                                                                    @if ($request->maksimum_filter) value="{{ $request->maksimum_filter }}" @endif>
                                                            </div>
                                                            <div class="col-7"></div>

                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <button type="submit" class="btn btn-primary">Cari</button>
                                                    </div>

                                                </div>

                                            </fieldset>
                                        </form>
                                    </div>
                                </div>

                                @if (sizeof($data) > 0)
                                    <div class="table-responsive">
                                        <table
                                            class="table border text-nowrap text-md-nowrap table-bordered mg-b-0 table-sm">
                                            <thead>
                                                <tr class="text-center align-middle">
                                                    <th class="text-center align-middle">No</th>
                                                    <th class="text-center align-middle">ID BS / NKS</th>
                                                    <th class="text-center align-middle">NU RT - KRT Import</th>
                                                    <th class="text-center align-middle">Status<br>Pencacahan</th>
                                                    <th class="text-center align-middle">Pengeluaran</th>
                                                    <th class="text-center align-middle">Jumlah<br>ART</th>
                                                    <th class="text-center align-middle">Rata2 <br>Perkapita</th>
                                                    <th class="text-center align-middle">GSMP</th>
                                                    <th class="text-center align-middle">Bantuan</th>
                                                    <th class="text-center align-middle">Status<br>Rumah</th>
                                                    <th class="text-center align-middle">FOTO</th>
                                                    <th class="text-center align-middle">Desil</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $key => $dt)
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ ++$key }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $dt->id_bs }} / {{ $dt->nks }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('dsrt/' . \Crypt::encryptString($dt->id)) }}">{{ $dt->nu_rt }}
                                                                - {{ $dt->nama_krt_prelist }} </a>
                                                        </td>
                                                        <td class="text-center ">
                                                            @switch($dt->status_pencacahan)
                                                                @case(0)
                                                                    <span>Belum Cacah</span>
                                                                @break

                                                                @case(2)
                                                                    <span class="badge bg-primary">Sudah Cacah</span>
                                                                @break

                                                                @case(5)
                                                                    <span class="badge bg-success">
                                                                        Sudah <br> Pemeriksaan Pengawas
                                                                    </span>
                                                                @break
                                                            @endswitch
                                                        </td>
                                                        <td class="text-center">{{ $dt->makanan_sebulan }}</td>
                                                        <td class="text-center">{{ $dt->jml_art_cacah }}</td>
                                                        <td class="text-end">{{ round($dt->avg_perkapita) }}</td>
                                                        <td class="text-center">{{ $dt->gsmp_desk }}</td>
                                                        <td class="text-center">{{ $dt->bantuan_desk }}</td>
                                                        <td class="text-center">{{ $dt->status_rumah }}</td>
                                                        <td class="text-center">
                                                            <a href="javascript:void(0);">
                                                                <img class="br-5 img_btn" data-foto="{{ $dt->foto }}"
                                                                    src="{{ url('foto') . '/' . $dt->foto }}"
                                                                    alt="Belum Ada Foto" style="max-height:150px"
                                                                    data-bs-toggle="modal" data-bs-target="#modal_gambar">
                                                            </a>

                                                        </td>
                                                        <td class="text-center">
                                                            @if ($dt->avg_perkapita == 0)
                                                            @elseif (round($dt->avg_perkapita) > 0 && round($dt->avg_perkapita) <= round($desil[1]))
                                                                <span class="badge bg-danger me-1 mb-1 mt-1">Desil 1</span>
                                                            @elseif (round($dt->avg_perkapita) > round($desil[1]) && round($dt->avg_perkapita) <= round($desil[2]))
                                                                <span class="badge bg-danger me-1 mb-1 mt-1">Desil 2</span>
                                                            @elseif (round($dt->avg_perkapita) > round($desil[2]) && round($dt->avg_perkapita) <= round($desil[3]))
                                                                <span class="badge bg-danger me-1 mb-1 mt-1">Desil 3</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    Belum ada data DSRT / belum digenerate
                                @endif

                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_gambar">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <img alt="Foto modal" id="modal_gambar_foto">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
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
        $('#export-dsrt-btn').on('click', function() {
            var form = $('#form_filter');
            window.open("{{ url('mon_dsrt_export') }}" + "?" + form.serialize(), "_blank")
        });
        $('#export-dsart-btn').on('click', function() {
            var form = $('#form_filter');
            window.open("{{ url('mon_dsart_export') }}" + "?" + form.serialize(), "_blank")
        });

        $('#export-mon-btn').on('click', function() {
            var form = $('#form_filter');
            window.open("{{ url('mon_dsrt_export_webmon') }}" + "?" + form.serialize(), "_blank")
        });
        var APP_URL = {!! json_encode(url('/')) !!}
        $('.img_btn').click(function() {
            console.log(APP_URL + "/foto/" + $(this).data('foto'))
            $('#modal_gambar').find('#modal_gambar_foto').attr("src", APP_URL + "/foto/" + $(this).data('foto'))
        })
    </script>
@endsection
