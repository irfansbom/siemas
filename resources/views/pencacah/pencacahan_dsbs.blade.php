@extends('layout.layout_mobile')

@section('content')
    <style>
        .center {
            /* position: fixed; */
            top: 20%;
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
        <a href="{{ url('pcl_dashboard') }}" class="btn btn-transparent btn-sm border-0">
            <i class="bi bi-arrow-left-square text-white" style="font-size: 2rem;"></i>
        </a>
    </div>
    <div class="main-content app-content m-0">
        <div class="side-app">
            <div class="main-container container-fluid" style="min-height: 87vh;">
                @include('alert')
                <div class="container" style="margin-top:5%">
                    <div class="center m-auto text-center">
                        @foreach ($dsbs as $bs)
                            <div class="row my-1" style="widht:100%">
                                <div class="col">
                                    <a href="{{ url('pcl_pencacahan_dsrt') . '/' . $bs->id_bs }}"
                                        class="btn btn-info">{{ $bs->id_bs }} / {{ $bs->nks }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
