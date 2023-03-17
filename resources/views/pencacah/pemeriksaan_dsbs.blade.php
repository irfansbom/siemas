@extends('layout.layout_mobile')

@section('content')
    <style>
        .center {
            /* position: fixed; */
            top: 20%;
        }

        .bg-btn {
            background-color: wheat;
            border: 0
        }

        .shadow {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important
        }
    </style>
    <div class="main-content app-content m-0">
        <div class="side-app">
            <div class="main-container container-fluid" style="min-height: 87vh;">
                @include('alert')
                <div class="container" style="margin-top:20%">
                    <div class="center m-auto text-center">
                        @foreach ($dsbs as $bs)
                            <div class="row" style="widht:100%">
                                <div class="col">
                                    <a href="{{ url('pcl_pemeriksaan_dsrt') . '/' . $bs->id_bs }}"
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
