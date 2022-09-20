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
                            <li class="breadcrumb-item active" aria-current="page">User</li>
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
                                    <a href="javascript:void(0);" class="btn btn-success btn-icon text-white">
                                        <span>
                                            <i class="fe fe-log-in"></i>
                                        </span> Export
                                    </a>
                                </div>
                            </div>
                            <div class="card-header pt-0 d-flex justify-content-center">
                                <div class="row col">
                                    <div class="alert alert-info" role="alert">
                                        <ul>
                                            <li>
                                                KRT ISIAN adalah nama KRT yang diisi oleh petugas ketika di lapangan
                                            </li>
                                            <li>
                                                Desil ke-3 dari data rata-rata perkapita adalah sebesar Rp
                                                {{ $d3->avg_perkapita }}
                                            </li>
                                        </ul>

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
                                                    <div class="col-2">
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
                                                    <div class="col-3">
                                                        <input type="text" name="bs_filter" id="bs_filter"
                                                            placeholder="cari BS" class="form-control"
                                                            @if ($request->bs_filter) value="{{ $request->bs_filter }}" @endif>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" name="minimum_filter" id="minimum_filter"
                                                            placeholder="Perkapita Minimum" class="form-control"
                                                            @if ($request->minimum_filter) value="{{ $request->minimum_filter }}" @endif>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" name="maksimum_filter" id="maksimum_filter"
                                                            placeholder="Perkapita Maksimum" class="form-control"
                                                            @if ($request->maksimum_filter) value="{{ $request->maksimum_filter }}" @endif>
                                                    </div>
                                                    <div class="col-1">
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
                                    <table class="table border text-nowrap text-md-nowrap table-bordered mg-b-0 table-sm">
                                        <thead>
                                            <tr class="text-center align-middle">
                                                <th class="text-center align-middle">No</th>
                                                <th class="text-center align-middle">ID BS</th>
                                                <th class="text-center align-middle">NU RT</th>
                                                <th class="text-center align-middle">KRT Import</th>
                                                <th class="text-center align-middle">KRT Isian</th>
                                                <th class="text-center align-middle">Jumlah <br> ART</th>
                                                <th class="text-center align-middle">Status <br> Rumah</th>
                                                <th class="text-center align-middle">Rata2 <br>Perkapita</th>
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
                                                        {{ $dt->id_bs }}
                                                    </td>
                                                    <td class="text-center">{{ $dt->nu_rt }}</td>
                                                    <td class="">{{ $dt->nama_krt }}</td>
                                                    <td class=""><a href="{{ url('mon_dsrt').'/'.$dt->id }}">{{ $dt->nama_krt2 }}</a></td>
                                                    <td class="text-center">{{ $dt->jml_art2 }}</td>
                                                    <td class="text-center">{{ $dt->status_rumah }}</td>
                                                    <td class="text-end">{{ round($dt->avg_perkapita) }}</td>
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
                                                        @elseif($dt->avg_perkapita <= $d3->avg_perkapita)
                                                            <span class="badge bg-danger me-1 mb-1 mt-1">Desil 3</span>
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
