@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Permission</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Permissions</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title mb-0">List Permissions</h3>
                                <div class="ms-auto pageheader-btn">
                                    <button class="btn btn-primary btn-icon text-white me-2" data-bs-toggle="modal"
                                        data-bs-target="#modal_tambah">
                                        <span>
                                            <i class="fe fe-plus"></i>
                                        </span> Tambah
                                    </button>
                                    {{-- <a class="btn btn-primary" data-bs-target="#modaldemo1" data-bs-toggle="modal"
                                        href="">View Live Demo</a> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table  border text-nowrap text-md-nowrap mg-b-0">
                                        <thead>
                                            <tr class="text-center align-middle">
                                                <th style="width: 5%">No</th>
                                                <th>Permission</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($permission as $key => $prms)
                                                <tr>
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td class="px-3">
                                                        {{ $prms->name }}
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-outline-danger btn_hapus"
                                                            data-id="{{ $prms->id }}" data-name="{{ $prms->name }}"
                                                            id="btn_hapus" data-bs-toggle="modal"
                                                            data-bs-target="#modal_hapus">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $permission->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
            </div>
            <!-- ROW-5 END -->
        </div>
        <!-- CONTAINER END -->
    </div>

    <div class="modal fade" id="modal_tambah">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h6 class="modal-title">Add Permission</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('permissions/add') }}" method="post" id="form_tambah">
                        @csrf
                        <div class="mb-3 col-6">
                            <label for="name_role" class="form-label">Nama Permission</label>
                            <input type="text" class="form-control" id="name_role" name="name">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="guard_name" class="form-label">Guard Name</label>
                            <input type="text" class="form-control" id="guard_name" value="siemas" readonly
                                name="guard_name">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form_tambah">Submit</button>
                    <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_hapus">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Delete Permission</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('permissions/delete') }}" method="post" id="hapus_form">
                        @csrf
                        <input class="form_input" type="text" name="id" id="permission_id" hidden>
                        <br>
                        Yakin menghapus permission :<b> <i><span id="permission_name"> </span></i> </b>
                        <br>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="hapus_form">Submit</button>
                    <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(".btn_hapus").click(function() {
            $('#permission_id').val($(this).data("id"))
            $('#permission_name').text($(this).data("name"))
        })
    </script>
@endsection
