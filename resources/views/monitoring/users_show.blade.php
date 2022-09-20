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


                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-10">
                                        <form action="" id="form_filter">
                                            <fieldset>
                                                <div class="mb-1 row">
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
                                                    <td class="align-middle "><a
                                                            href="{{ url('mon_dsrt') . '/' . $dt->id }}">{{ $dt->nama_krt2 }}
                                                        </a>
                                                    </td>
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
                                                    <td class="align-middle ">
                                                        {{-- <img class="br-5" src="{{ url('foto') . '/' . $dt->foto }}"
                                                            alt="Belum Ada Foto" style="max-height:150px"> --}}
                                                        <a href="javascript:void(0);">
                                                            <img class="br-5 img_btn" data-foto="{{ $dt->foto }}"
                                                                src="{{ url('foto') . '/' . $dt->foto }}"
                                                                alt="Belum Ada Foto" style="max-height:150px"
                                                                data-bs-toggle="modal" data-bs-target="#modal_gambar">
                                                        </a>
                                                    </td>
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
        var APP_URL = {!! json_encode(url('/')) !!}
        $(document).ready(function() {
            $('#modal_edit_pencacah').find("#pencacah").select2({
                dropdownParent: $("#modal_edit_pencacah")
            });
        });

        $('.img_btn').click(function() {
            console.log(window.location.origin + "/foto/" + $(this).data('foto'))
            console.log(APP_URL)
            $('#modal_gambar').find('#modal_gambar_foto').attr("src", APP_URL + "/foto/" + $(this)
                .data(
                    'foto'))
        })

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
