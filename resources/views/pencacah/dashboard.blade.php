@extends('layout.layout_mobile')

@section('content')
    <style>
        .center {
            position: fixed;
            top: 20%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
        .header2 {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            z-index: 200;
            background-color: rgb(241, 177, 93);
            color: white;
        }
    </style>
    <div class="header2 ">
    <a href="{{ url('/') }}" class="btn btn-transparent btn-sm border-0">
        <i class="bi bi-arrow-left-square text-white" style="font-size: 2rem;"></i>
    </a>
    </div>
    <div class="main-content app-content m-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                @include('alert')
                <div class="center m-auto text-center">
                    <div class="row mb-10">
                        <div class="col">
                            <h4>Selamat Datang, {{ $auth->name }}</h4>
                            <h6>Siemas Versi Online</h6>
                        </div>
                    </div>
                    <div class="mt-5">
                        <a href="{{ url('pcl_pencacahan_dsbs') }}" class="btn btn-warning mb-6">Pencacahan</a>
                    </div>
                    <!-- <div class="">
                        <a href="{{ url('pcl_pemeriksaan_dsbs') }}" class="btn btn-danger">Pemeriksaan</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
@endsection
