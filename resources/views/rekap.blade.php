@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Rekap</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Rekap</a></li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">Rekap</li> --}}
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Rekap Pengolahan Per Kab</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table border text-nowrap text-md-nowrap table-bordered mg-b-0 table-sm">
                                                <thead>
                                                    <tr class="text-center align-middle">
                                                        <th class="text-center align-middle">Kab</th>
                                                        <th class="text-center align-middle">jmlrutakor_val</th>
                                                        <th class="text-center align-middle">jmlrutakor_e</th>
                                                        <th class="text-center align-middle">jmlrutakor_c</th>
                                                        <th class="text-center align-middle">jmlrutakp_val</th>
                                                        <th class="text-center align-middle">jmlrutakp_e</th>
                                                        <th class="text-center align-middle">jmlrutakp_c</th>
                                                        <th class="text-center align-middle">tglupload</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($rekap as $rk)
                                                    <tr class="text-center">
                                                        <td>{{ $rk['Kab'] }}</td>
                                                        <td>{{ $rk['jmlrutakor_val'] }}</td>
                                                        <td>{{ $rk['jmlrutakor_e'] }}</td>
                                                        <td>{{ $rk['jmlrutakor_c'] }}</td>
                                                        <td>{{ $rk['jmlrutakp_val'] }}</td>
                                                        <td>{{ $rk['jmlrutakp_e'] }}</td>
                                                        <td>{{ $rk['jmlrutakp_c'] }}</td>
                                                        <td>{{ $rk['tglupload'] }}</td>
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
        </div>
    </div>
@endsection