@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Home</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">Dashboard 01</li> --}}
                        </ol>
                    </div>
                    <div class="ms-auto pageheader-btn">
                        {{-- <a href="javascript:void(0);" class="btn btn-primary btn-icon text-white me-2">
                            <span>
                                <i class="fe fe-plus"></i>
                            </span> Add Account
                        </a> --}}
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tabulasi Foto Per Kabupaten Kota</h3>
                                <div class="ms-auto pageheader-btn">
                                    {{-- <a href="javascript:void(0);" class="btn btn-success btn-icon text-white">
                                        <span>
                                            <i class="fe fe-log-in"></i>
                                        </span> Export
                                    </a> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="table-responsive">
                                            <table
                                                class="table border text-nowrap text-md-nowrap table-bordered mg-b-0 table-sm">
                                                <thead>
                                                    <tr class="text-center align-middle">
                                                        <th class="text-center align-middle">No</th>
                                                        <th class="text-center align-middle">KAB</th>
                                                        <th class="text-center align-middle">Jml <br> DSRT</th>
                                                        <th class="text-center align-middle">Jml <br> ART</th>
                                                        <th class="text-center align-middle">Selesai<br>Cacah</th>
                                                        <th class="text-center align-middle">Persentase<br>Selesai Cacah</th>
                                                        <th class="text-center align-middle">Foto <br> Masuk </th>
                                                        <th class="text-center align-middle">Persentase <br> Foto Masuk</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tab_tab1 as $key => $tab1)
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ ++$key }}
                                                            </td>
                                                            <td class="">
                                                                [{{ $tab1->kd_kab }}]
                                                                {{ $tab1->kabs ? $tab1->kabs['alias'] : '' }}
                                                            </td>
                                                            <td class="text-center">{{ $tab1->jml_dsrt }}</td>
                                                            <td class="text-center">{{ $tab1->jml_art_cacah }}</td>
                                                            <td class="text-center">{{ $tab1->selesai_cacah }}</td>
                                                            <td class="text-center">
                                                                @if ($tab1->jml_dsrt != 0)
                                                                    {{ number_format(round(($tab1->selesai_cacah / $tab1->jml_dsrt) * 100, 2), 2, '.', ',') }}
                                                                    %
                                                                @else
                                                                    0
                                                                @endif
                                                            </td>
                                                            <td class="text-center">{{ $tab1->jml_foto }}</td>
                                                            <td class="text-center">
                                                                @if ($tab1->jml_dsrt != 0)
                                                                    {{ number_format(round(($tab1->jml_foto / $tab1->jml_dsrt) * 100, 2), 2, '.', ',') }}
                                                                    %
                                                                @else
                                                                    0
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="chart-container">
                                            <canvas id="chart_cacah_foto" class="h-600"></canvas>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header border-0 pb-0 mb-3">
                                <h3 class="card-title ">List DSRT</h3>
                                <div class="ms-auto pageheader-btn">
                                    {{-- <a href="javascript:void(0);" class="btn btn-success btn-icon text-white">
                                        <span>
                                            <i class="fe fe-log-in"></i>
                                        </span> Export
                                    </a> --}}
                                </div>
                            </div>
                            <div class="card-header pt-0 d-flex justify-content-center">
                                <div class="row col">
                                    <div class="alert alert-info" role="alert">
                                        <ul>
                                            <li>Data berikut merupakan highlight dari 3 desil terbawah dari rata-rata
                                                perkapita(makanan+nonmakanan/jumlah_art) yang sudah diisi dan upload petugas
                                            </li>
                                            <li>
                                                Desil ke-3 dari data rata-rata perkapita adalah sebesar Rp
                                                {{ floor($d3->avg_perkapita) }}
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
                                                    <div class="col-sm-3">
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

                                                    <div class="col-sm-3">
                                                        <input type="number" class="form-control" placeholder="ID BS"
                                                            name="bs_filter"
                                                            @if ($request->bs_filter) value="{{ $request->bs_filter }}" @endif>
                                                    </div>
                                                    {{-- <div class="col-sm-3">
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

                                                    </div> --}}
                                                    <div class="col-sm-1">
                                                        <button type="submit" class="btn btn-primary">Cari</button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                                @if (count($dsrt) > 0)
                                    <div class="table-responsive">
                                        <table
                                            class="table border text-nowrap text-md-nowrap table-bordered mg-b-0 table-sm">
                                            <thead>
                                                <tr class="text-center align-middle">
                                                    <th class="text-center align-middle">No</th>
                                                    <th class="text-center align-middle">ID BS</th>
                                                    <th class="text-center align-middle">NKS</th>
                                                    <th class="text-center align-middle">NU RT</th>
                                                    <th class="text-center align-middle">KRT</th>
                                                    <th class="text-center align-middle">Jumlah <br> ART</th>
                                                    <th class="text-center align-middle">Status <br> Rumah</th>
                                                    <th class="text-center align-middle">Rata2 <br>Perkapita</th>
                                                    <th class="text-center align-middle">FOTO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dsrt as $key => $dt)
                                                    <tr class="text-center">
                                                        <td>
                                                            {{ ++$key }}
                                                        </td>
                                                        <td>
                                                            {{ '16' . $dt->kd_kab . $kd_kec . $kd_desa . $kd_bs }}
                                                        </td>
                                                        <td>
                                                            {{ $dt->nks }}
                                                        </td>
                                                        <td>{{ $dt->nu_rt }}</td>
                                                        <td class="text-start">
                                                            <a href="{{ url('dsrt/' . \Crypt::encryptString($dt->id)) }}">
                                                                {{ $dt->nama_krt_cacah }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $dt->jml_art_cacah }}</td>
                                                        <td>{{ $dt->status_rumah }}</td>
                                                        <td class="text-end">{{ round($dt->avg_perkapita) }}</td>
                                                        <td>
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
                                        {{ $dsrt->links() }}
                                    </div>
                                @else
                                    Data masuk Kurang Dari 10
                                @endif
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

    @section('script')
        <script>
            $(document).ready(function() {});
            $('.img_btn').click(function() {
                $('#modal_gambar').find('#modal_gambar_foto').attr("src", window.location.origin + window.location
                    .pathname + "foto/" + $(this).data(
                        'foto'))
            })

            var label_tab1 = {!! json_encode($label_tab1) !!};
            var data_chart_foto = {!! json_encode($data_chart_foto) !!};
            var data_chart_selesai = {!! json_encode($data_chart_selesai) !!};
            $(function() {
                var ctx = document.getElementById("chart_cacah_foto").getContext('2d');
                // var myChart = new Chart(ctx, {
                //     type: 'bar',
                //     data: {
                //         labels: label_tab1,
                //         datasets: [{
                //             label: 'Persentase',
                //             data: data_tab1,
                //             borderWidth: 2,
                //             backgroundColor: '#6259ca',
                //             borderColor: '#6259ca',
                //             borderWidth: 2.0,
                //             pointBackgroundColor: '#ffffff',
                //         }]
                //     },

                //     options: {
                //         title: {
                //             display: true,
                //             text: 'Persentase Petugas Kab/Kota Telah Upload Foto'
                //         },
                //         responsive: true,
                //         maintainAspectRatio: false,
                //         legend: {
                //             display: true
                //         },
                //         scales: {
                //             yAxes: [{
                //                 ticks: {
                //                     beginAtZero: true,
                //                     stepSize: 100,
                //                     fontColor: "#77778e",
                //                 },
                //                 gridLines: {
                //                     color: 'rgba(119, 119, 142, 0.2)'
                //                 }
                //             }],
                //             xAxes: [{
                //                 ticks: {
                //                     display: true,
                //                     fontColor: "#77778e",
                //                 },
                //                 gridLines: {
                //                     display: false,
                //                     color: 'rgba(119, 119, 142, 0.2)'
                //                 }
                //             }]
                //         },
                //         legend: {
                //             labels: {
                //                 fontColor: "#77778e"
                //             },
                //         },
                //     }
                // });

                data = {
                    labels: label_tab1,
                    datasets: [{
                        label: 'Foto Terupload',
                        data: data_chart_foto,
                        borderWidth: 2,
                        backgroundColor: '#6259ca',
                        pointBackgroundColor: '#0000',
                    }, {
                        label: 'Selesai Cacah',
                        data: data_chart_selesai
                    }]
                }

                options = {
                    indexAxis: 'y',
                    title: {
                        display: true,
                        text: 'Persentase Progress Pencacahan Kab/Kota'
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: true
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 100,
                                fontColor: "#77778e",
                            },
                            gridLines: {
                                color: 'rgba(119, 119, 142, 0.2)'
                            },
                            // stacked: true
                        }],
                        xAxes: [{
                            ticks: {
                                display: true,
                                fontColor: "#77778e",
                            },
                            gridLines: {
                                display: false,
                                color: 'rgba(119, 119, 142, 0.2)'
                            },
                            // stacked: true
                        }]
                    },
                    legend: {
                        labels: {
                            fontColor: "#77778e"
                        },
                    },
                }

                var myBarChart = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: data,
                    options: options
                });
            });
        </script>
    @endsection
