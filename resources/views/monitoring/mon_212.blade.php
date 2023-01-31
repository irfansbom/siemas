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
                            <li class="breadcrumb-item active" aria-current="page">Dokumen</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card-header border-0 pb-0 mb-3">
                                <h3 class="card-title ">List Laporan 212</h3>
                                <div class="ms-auto pageheader-btn">
                                    {{-- <button id="export-btn" class="btn btn-success btn-icon text-white">
                                        <span>
                                            <i class="fe fe-log-in"></i>
                                        </span> Export
                                    </button> --}}
                                </div>
                            </div>
                            <div class="card-header pt-0 d-flex justify-content-center">
                                <div class="row col">
                                    <div class="alert alert-info" role="alert">
                                        <ul>
                                            <li>
                                                Laporan 212 adalah laporan yang dilakukan pengawas ketika dokumen lapangan
                                                pencacah telah diberikan ke pada pengawas, Adapun jadwal 212 antara lain:
                                                <ul>
                                                    @foreach ($jadwal as $jad)
                                                        <span>{{ $jad->tanggal }}, </span>
                                                    @endforeach
                                                </ul>
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
                                                    <th class="text-center align-middle">Pengawas</th>
                                                    <th class="text-center align-middle">Jumlah Dokumen</th>
                                                    <th class="text-center align-middle">Tanggal dan RUTA</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $key => $dt)
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ ++$key }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $dt->name }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ count($dt->mon_212) }}
                                                        </td>
                                                        <td>
                                                            <ul style=" list-style-type: circle; " class="ms-4">
                                                                @foreach ($dt->mon_212 as $m212)
                                                                    <li>
                                                                        {{ $m212->tanggal }} :
                                                                        {{ $m212->id_bs }}-{{ $m212->nu_rt }}
                                                                    </li>
                                                                @endforeach

                                                            </ul>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    Belum ada yang melaporkan 212 atau penerimaan dokumen
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
        $('#export-btn').on('click', function() {
            var form = $('#form_filter');
            window.open("{{ url('mon_dsrt_export') }}" + "?" + form.serialize(), "_blank")
        });
        var APP_URL = {!! json_encode(url('/')) !!}
        $('.img_btn').click(function() {
            console.log(APP_URL + "/foto/" + $(this).data('foto'))
            $('#modal_gambar').find('#modal_gambar_foto').attr("src", APP_URL + "/foto/" + $(this).data('foto'))
        })
    </script>
@endsection
