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
                                <h3 class="card-title ">List User</h3>
                                <div class="ms-auto pageheader-btn">
                                    <button class="btn btn-success btn-icon text-white btn_export">
                                        <span>
                                            <i class="fe fe-log-in"></i>
                                        </span> Export
                                    </button>
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
                                                        <input type="text" name="nama_filter" id="nama_filter"
                                                            placeholder="cari user" class="form-control"
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

                                @if (sizeof($data) > 0)
                                    <div class="table-responsive">
                                        <table
                                            class="table border table-bordered text-nowrap text-md-nowrap mg-b-0 table-sm">
                                            <thead>
                                                <tr class="text-center align-middle">
                                                    <th>No</th>
                                                    <th>Kab</th>
                                                    <th>Nama</th>
                                                    <th>BS</th>
                                                    <th>Dsrt</th>
                                                    <th>Jumlah Selesai</th>
                                                    <th>Persentase</th>
                                                </tr>
                                            </thead>
                                            <tbody class="align-middle">
                                                @foreach ($data as $key => $dt)
                                                    <tr class="align-middle">
                                                        <td class="text-center align-middle">{{ ++$key }}</td>
                                                        <td class="align-middle text-center">{{ $dt->kd_kab }}</td>
                                                        <td class="align-middle "><a
                                                                href="{{ url('mon_users/') . '/' . $dt->id }}">{{ $dt->name }}</a>
                                                        </td>
                                                        <td class="align-middle text-center">{{ count($dt->dsbs) }}</td>
                                                        <td class="align-middle text-center">{{ count($dt->dsrt) }}</td>
                                                        <td class="align-middle text-center">
                                                            {{ count($dt->dsrt_sdh_cacah) }}
                                                        </td>
                                                        @if (count($dt->dsrt) != 0)
                                                            <td class="text-center">
                                                                {{ round((count($dt->dsrt_sdh_cacah) / count($dt->dsrt)) * 100, 2) }}
                                                            </td>
                                                        @else
                                                            <td class="text-center"> 0%</td>
                                                        @endif

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    DSRT belum dialokasikan atau belum ada data
                                @endif

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

        $('.btn_export').click(function() {
            var form = $('#form_filter')
            window.open("{{ url('mon_users_export') }}" + "?" + form.serialize(), "_blank")
            // console.log(a)
        })
    </script>
@endsection
