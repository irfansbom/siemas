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
                        <a href="javascript:void(0);" class="btn btn-primary btn-icon text-white me-2">
                            <span>
                                <i class="fe fe-plus"></i>
                            </span> Add Account
                        </a>

                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                @include('alert')
                <!-- ROW-1 -->
                {{-- <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total Sales</h6>
                                                <h3 class="mb-2 number-font">34,516</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-primary"><i
                                                            class="fa fa-chevron-circle-up text-primary me-1"></i>
                                                        3%</span> last month
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div
                                                    class="counter-icon bg-primary-gradient box-shadow-primary brround ms-auto">
                                                    <i class="fe fe-trending-up text-white mb-5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total Leads</h6>
                                                <h3 class="mb-2 number-font">56,992</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-secondary"><i
                                                            class="fa fa-chevron-circle-up text-secondary me-1"></i>
                                                        3%</span> last month
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div
                                                    class="counter-icon bg-danger-gradient box-shadow-danger brround  ms-auto">
                                                    <i class="icon icon-rocket text-white mb-5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total Profit</h6>
                                                <h3 class="mb-2 number-font">$42,567</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-success"><i
                                                            class="fa fa-chevron-circle-down text-success me-1"></i>
                                                        0.5%</span> last month
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div
                                                    class="counter-icon bg-secondary-gradient box-shadow-secondary brround ms-auto">
                                                    <i class="fe fe-dollar-sign text-white mb-5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total Cost</h6>
                                                <h3 class="mb-2 number-font">$34,789</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-danger"><i
                                                            class="fa fa-chevron-circle-down text-danger me-1"></i>
                                                        0.2%</span> last month
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div
                                                    class="counter-icon bg-success-gradient box-shadow-success brround  ms-auto">
                                                    <i class="fe fe-briefcase text-white mb-5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tabulasi Foto Per Kabupaten Kota</h3>
                                <div class="ms-auto pageheader-btn">
                                    <a href="javascript:void(0);" class="btn btn-success btn-icon text-white">
                                        <span>
                                            <i class="fe fe-log-in"></i>
                                        </span> Export
                                    </a>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table border text-nowrap text-md-nowrap table-bordered mg-b-0">
                                                <thead>
                                                    <tr class="text-center align-middle">
                                                        <th class="text-center align-middle">No</th>
                                                        <th class="text-center align-middle">KAB</th>
                                                        <th class="text-center align-middle">Jml <br> DSRT</th>
                                                        <th class="text-center align-middle">Jml <br> ART</th>
                                                        <th class="text-center align-middle">Foto <br> Masuk </th>
                                                        <th class="text-center align-middle">Persentase <br> Foto Masuk
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tab_tab1 as $key => $tab1)
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ ++$key }}
                                                            </td>
                                                            <td class="">
                                                                [{{ $tab1->kd_kab }}] {{ $tab1->alias }}
                                                            </td>
                                                            <td class="text-center">{{ $tab1->jml_dsrt }}</td>
                                                            <td class="text-center">{{ $tab1->jml_art }}</td>
                                                            <td class="text-center">{{ $tab1->jml_foto }}</td>
                                                            <td class="text-center">
                                                                {{ ($tab1->jml_foto / $tab1->jml_dsrt) * 100 }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="chart-container">
                                            <canvas id="chartBar1" class="h-275"></canvas>
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
                            <div class="card-header">
                                <h3 class="card-title">Ruta 3 Desil Terbawah Berdasarkan Rata-Rata Perkapita
                                </h3>
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
                                                    <div class="col-sm-3">
                                                        <select name="status_filter" id="status_filter"
                                                            class="form-control select2 form-select">
                                                            <option value="">Pilih Status Pencacahan</option>
                                                            <option value="selesai"
                                                                @if ($request->status_filter == 'selesai') selected @endif>selesai
                                                            </option>
                                                            <option value="belum"
                                                                @if ($request->status_filter == 'belum') selected @endif>belum
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
                                @if (count($dsrt) > 0)
                                    <div class="table-responsive">
                                        <table class="table border text-nowrap text-md-nowrap table-bordered mg-b-0">
                                            <thead>
                                                <tr class="text-center align-middle">
                                                    <th class="text-center align-middle">No</th>
                                                    <th class="text-center align-middle">ID BS</th>
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
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ ++$key }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $dt->id_bs }}
                                                        </td>
                                                        <td class="text-center">{{ $dt->nu_rt }}</td>
                                                        <td class="text-center">{{ $dt->nama_krt }}</td>
                                                        <td class="text-center">{{ $dt->jml_art }}</td>
                                                        <td class="text-center">{{ $dt->status_rumah }}</td>
                                                        <td class="text-end">{{ round($dt->avg_perkapita) }}</td>
                                                        <td>
                                                            <img class="br-5" src="{{ url('foto') . '/' . $dt->foto }}"
                                                                alt="Belum Ada Foto" style="max-height:150px">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $dsrt->links() }}
                                    </div>
                                @else
                                    Data Kurang Dari 10
                                @endif
                                {{-- <div class="table-responsive">
                                    <table class="table border text-nowrap text-md-nowrap table-bordered mg-b-0">
                                        <thead>
                                            <tr class="text-center align-middle">
                                                <th class="text-center align-middle">No</th>
                                                <th class="text-center align-middle">ID BS</th>
                                                <th class="text-center align-middle">NU RT</th>
                                                <th class="text-center align-middle">KRT</th>
                                                <th class="text-center align-middle">Jumlah <br> ART</th>
                                                <th class="text-center align-middle">Status <br> Rumah</th>
                                                <th class="text-center align-middle">FOTO</th>
                                                <th class="text-center align-middle">status <br> Pencacahan</th>
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
                                                    <td class="text-center">{{ $dt->nama_krt }}</td>
                                                    <td class="text-center">{{ $dt->jml_art }}</td>
                                                    <td class="text-center">{{ $dt->status_rumah }}</td>
                                                    <td>
                                                        <ul id="lightgallery" class="list-unstyled row">
                                                            <li class=" border-bottom-0" style="max-height:300px"
                                                                data-responsive=".{{ url('foto') . '/' . $dt->foto }}"
                                                                data-src="{{ url('foto') . '/' . $dt->foto }}"
                                                                data-sub-html="<h4>Foto Rumah</h4><p>  {{ $dt->id_bs . ', NU RT : ' . $dt->nu_rt }} </p>">
                                                                <a href="">
                                                                    <img class="img-responsive br-5"
                                                                        src="{{ url('foto') . '/' . $dt->foto }}"
                                                                        alt="Belum Ada Foto" style="max-height:300px">
                                                                </a>
                                                            </li>
                                                        </ul>

                                                    </td>
                                                    <td class="text-center">{{ $dt->status_pencacahan }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $data->links() }}
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            $(document).ready(function() {

            });

            /* Bar-Chart1 */
            var label_tab1 = {!! json_encode($label_tab1) !!};
            var data_tab1 = {!! json_encode($data_tab1) !!};
            $(function() {
                console.log(label_tab1)
                var ctx = document.getElementById("chartBar1").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: label_tab1,
                        datasets: [{
                            label: 'Persentase',
                            data: data_tab1,
                            borderWidth: 2,
                            backgroundColor: '#6259ca',
                            borderColor: '#6259ca',
                            borderWidth: 2.0,
                            pointBackgroundColor: '#ffffff',

                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Persentase Petugas Kab/Kota Telah Upload Foto'
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
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    display: true,
                                    fontColor: "#77778e",
                                },
                                gridLines: {
                                    display: false,
                                    color: 'rgba(119, 119, 142, 0.2)'
                                }
                            }]
                        },
                        legend: {
                            labels: {
                                fontColor: "#77778e"
                            },
                        },
                    }
                });
            });
        </script>
    @endsection
