@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Update Alokasi</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Alokasi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <form action="{{ url('alokasi/' . $id) }}" method="POST" class="p-5">
                                @csrf
                                @method('put')
                                @include('alokasi.form')
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a class="btn btn-primary" type="button" href="{{ url('alokasi') }}">Kembali</a>
                                    <button class="btn btn-primary" type="submit" id="simpanbtn">simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('script')
    <script></script>
@endsection --}}
