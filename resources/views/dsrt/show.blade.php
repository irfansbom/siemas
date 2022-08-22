@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">DSRT</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dsrt') }}">DSRT</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Show</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            {{-- <form action="{{ url('dsrt/' . $id) }}" method="post"> --}}
                            <form action="#" method="post">
                                @csrf
                                @method('PUT')
                                @include('dsrt.form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#id_tujuan').change(function() {
                get_list_target();
            });
            get_list_target();
            $('#id_target').val(indikator.id_target)
        })

        function get_list_target() {
            $('#id_target option').remove()
            $('#id_target').append("<option value=''>Pilih Target</option>");
            $.ajax({
                type: "get",
                url: "{{ url('get_target') }}",
                async: false,
                data: {
                    id_tujuan: $('#id_tujuan').val()
                },
                success: function(res) {
                    res.data.forEach(element => {
                        $('#id_target').append("<option value=" + element.id_target + ">[" + element
                            .id_target + "] " + element.nama_target + "</option>");
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection
