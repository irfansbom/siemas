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
        <a href="{{ url('pcl_pencacahan_dsbs') }}" class="btn btn-transparent btn-sm border-0">
            <i class="bi bi-arrow-left-square text-white" style="font-size: 2rem;"></i>
        </a>
    </div>
    <div class="main-content app-content m-0 mt-5">
        <div class="side-app">
            <div class="main-container container-fluid" style="min-height: 87vh;">
                @include('alert')
                <div class="container" style="margin-top:5%">
                    <div class=" m-auto ">
                        @foreach ($dsrt as $rt)
                            <div class="row mb-3" style="widht:100%">
                                <div class="col">
                                    <a href="{{ url('pcl_pencacahan_ruta') . '/' . $rt->id }}"
                                        class="btn bg-btn text-start shadow" style="width:100%">
                                        <div class="row">
                                            <div class="col-11">
                                                <table>
                                                    <tbody style="word-break: normal; white-space:normal">
                                                        <tr>
                                                            <td rowspan="4" class="p-2 text-center">
                                                                @if ($rt->foto)
                                                                    <img src={{ url('foto') . '/' . $rt->foto }}
                                                                        alt=""
                                                                        style="min-heigt:70px; min-width:70px; width:70px; height:70px">
                                                                @else
                                                                    <img src="" alt=""
                                                                        style="min-heigt:70px; min-width:70px; width:70px; height:auto">
                                                                @endif
                                                            </td>
                                                            <td> No Urut Ruta</td>
                                                            <td>:</td>
                                                            <td>{{ $rt->nu_rt }}</td>

                                                        </tr>
                                                        <tr>
                                                            <td>NKS</td>
                                                            <td>:</td>
                                                            <td>{{ $rt->nks }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama KRT </td>
                                                            <td>:</td>
                                                            <td>{{ $rt->nama_krt_cacah }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Status Pencacahan </td>
                                                            <td>:</td>
                                                            <td> @switch($rt->status_pencacahan)
                                                                    @case(0)
                                                                        <span>Belum Cacah</span>
                                                                    @break

                                                                    @case(1)
                                                                        <span>Sudah Cacah</span>
                                                                    @break

                                                                    @case(4)
                                                                        <span>Sudah Upload</span>
                                                                    @break

                                                                    @case(5)
                                                                        <span>Sudah Pemeriksaan Pengawas</span>
                                                                    @break

                                                                    @case(6)
                                                                        <span>Sudah Upload Pemeriksaan Pengawas</span>
                                                                    @break
                                                                @endswitch
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-1 p-2  d-flex align-items-center justify-content-middle">

                                                @if ($rt->status_pencacahan == 0)
                                                    <i class="bi bi-bookmark-fill fs-2"></i>
                                                @elseif($rt->status_pencacahan > 0)
                                                    <i class="bi bi-bookmark-fill fs-2 text-info"></i>
                                                @endif


                                            </div>

                                        </div>

                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
