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
                            {{-- <div class="card-header pt-0 d-flex justify-content-center">
                                <div class="row col">
                                    <div class="alert alert-info" role="alert">
                                        Generate DSRT untuk membuat list daftar DSRT kosongan setelah dilakukan import DS
                                        BS, <br>
                                        Apabila telah memiliki list DSRT (nama KRT, dan Jumlah ART), dapat dilakukan IMPORT
                                        langsung DSRT dengan excel

                                    </div>
                                </div>
                            </div> --}}

                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-10">
                                        <form action="" id="form_filter">
                                            <fieldset>
                                                <div class="mb-1 row">
                                                    {{-- <label for="kab_filter" class="col-sm-2 col-form-label">Kab/Kot</label> --}}

                                                    <div class="col-sm-2">
                                                        <input type="text" name="bs_filter" id="bs_filter"
                                                            placeholder="cari ID BS" class="form-control"
                                                            @if ($request->bs_filter) value="{{ $request->bs_filter }}" @endif>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <select name="status_filter" id="status_filter"
                                                            class="form-control select2 form-select">
                                                            <option value="">Pilih Status Pencacahan</option>
                                                            <option value="0"
                                                                @if ($request->status_filter == '0') selected @endif>Belum
                                                                Cacah
                                                            </option>
                                                            <option value="1"
                                                                @if ($request->status_filter == '1') selected @endif>Sudah
                                                                Cacah
                                                            </option>
                                                            <option value="4"
                                                                @if ($request->status_filter == '4') selected @endif>Sudah
                                                                Upload Pemeriksaan Pencacah
                                                            </option>
                                                            <option value="5"
                                                                @if ($request->status_filter == '5') selected @endif>Sudah
                                                                Pemeriksaan Pengawas
                                                            </option>
                                                            <option value="6"
                                                                @if ($request->status_filter == '6') selected @endif>Sudah
                                                                Upload Pemeriksaan Pengawas
                                                            </option>
                                                        </select>

                                                    </div>
                                                    <div class="col-sm-1">
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
                                                <th>DSBS</th>
                                                <th>NKS</th>
                                                <th>NU RT</th>
                                                <th>KRT</th>
                                                <th>KRT Isian</th>
                                                <th>Status</th>
                                                <th>Foto</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            @foreach ($data as $key => $dt)
                                                <tr class="align-middle">
                                                    <td class="text-center align-middle">{{ ++$key }}</td>
                                                    <td class="align-middle text-center">{{ $dt->id_bs }}</td>
                                                    <td class="align-middle text-center">{{ $dt->nks }} </td>
                                                    <td class="align-middle text-center">{{ $dt->nu_rt }} </td>
                                                    <td class="align-middle ">{{ $dt->nama_krt }} </td>
                                                    <td class="align-middle ">{{ $dt->nama_krt2 }} </td>
                                                    <td class="align-middle ">
                                                        @switch($dt->status_pencacahan)
                                                            @case(0)
                                                                <span>Belum Cacah</span>
                                                            @break

                                                            @case(1)
                                                                <span>Sudah Cacah</span>
                                                            @break

                                                            @case(4)
                                                                <span>Sudah Upload <br> Pemeriksaan Pencacah</span>
                                                            @break

                                                            @case(5)
                                                                <span>Sudah Pemeriksaan <br> Pengawas</span>
                                                            @break

                                                            @case(6)
                                                                <span>Sudah Upload <br> Pemeriksaan Pengawas</span>
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    <td class="align-middle "><img class="br-5"
                                                            src="{{ url('foto') . '/' . $dt->foto }}" alt="Belum Ada Foto"
                                                            style="max-height:150px"> </td>
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
