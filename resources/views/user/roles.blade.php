@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Roles</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Roles</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title mb-0">List Roles</h3>
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
                                                <th>Role</th>
                                                <th>Permissions</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_roles as $key => $role)
                                                <tr>
                                                    <td class="text-center align-middle">{{ ++$key }}</td>
                                                    <td class="px-3 align-middle">
                                                        {{ $role['name'] }}
                                                    </td>
                                                    <td class="px-3 align-middle"
                                                        style="word-break: break-word; overflow-wrap: break-word; white-space:initial">
                                                        @foreach ($role['permissions'] as $permission)
                                                            <span class="badge bg-primary">{{ $permission->name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <button class="btn btn-outline-warning btn_edit"
                                                            data-id="{{ $role['id'] }}" data-name="{{ $role['name'] }}"
                                                            id="btn_edit" data-bs-toggle="modal"
                                                            data-permission="{{ $role['permissions'] }}"
                                                            data-bs-target="#modal_edit">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-outline-danger btn_hapus"
                                                            data-id="{{ $role['id'] }}" data-name="{{ $role['name'] }}"
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h6 class="modal-title">Add Roles</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('roles/add') }}" method="post" id="tambah_form">
                        @csrf
                        <div class="row col">
                            <div class="mb-3 col-6">
                                <label for="name_role" class="form-label">Nama Role</label>
                                <input type="text" class="form-control" id="name_role" name="name">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="guard_name" class="form-label">Guard Name</label>
                                <input type="text" class="form-control" id="guard_name" value="siemas" readonly
                                    name="guard_name">
                            </div>
                        </div>

                        <label for="" class="label">Permissions</label>
                        <div class="row col">
                            @foreach ($data_permission as $perm)
                                <div class="col-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $perm->name }}"
                                            name="permissions[]" id="{{ $perm->name }}">
                                        <label class="form-check-label" for="{{ $perm->name }}">
                                            {{ $perm->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="tambah_form">Submit</button>
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
    <div class="modal fade" id="modal_edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Roles<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ url('roles/edit') }}" method="post" id="edit_form">
                        @csrf
                        <div class="row col">
                            <input type="text" name="id" id="role_id" hidden>
                            <div class="mb-3 col-6">
                                <label for="name_role" class="form-label">Nama Role</label>
                                <input type="text" class="form-control" id="name_role" name="name">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="guard_name" class="form-label">Guard Name</label>
                                <input type="text" class="form-control" value="siemas" readonly name="guard_name">
                            </div>
                        </div>
                        Permissions
                        {{-- <div class="row">
                            @foreach ($data_permission as $perm)
                                <div class="col-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $perm->name }}"
                                            name="permissions[]" id="{{ $perm->name }}">
                                        <label class="form-check-label" for="{{ $perm->name }}">
                                            {{ $perm->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div> --}}
                        <div class="row col">
                            @foreach ($data_permission as $keys => $perm)
                                <div class="col-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $perm->name }}"
                                            name="permissions[]" id="{{ $perm->name . '2' }}">
                                        <label class="form-check-label"
                                            for="{{ $perm->name . '2' }}">{{ $perm->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="edit_form">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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

        $(".btn_edit").click(function() {
            $('#modal_edit').find('#role_id').val($(this).data("id"));
            $('#modal_edit').find('#name_role').val($(this).data("name"));
            var permissions = [];
            $(this).data("permission").forEach(element => {
                permissions.push(element['name']);
            });
            console.log(permissions)
            $('#modal_edit').find('input[name="permissions[]"]').each(function() {
                if (permissions.includes(this.value)) {
                    $(this).prop('checked', true);
                } else {
                    $(this).prop('checked', false);
                }
            });
        })
    </script>
@endsection
