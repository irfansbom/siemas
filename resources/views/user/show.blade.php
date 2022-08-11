@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Users</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Show</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <form action="{{ url('users/update') }}" method="POST">
                                @csrf
                                <fieldset class="p-5">
                                    <input type="text" name="id" id="id" hidden
                                        value="{{ old('id', $user->id) }}">
                                    <div class="mb-3 row">
                                        <label for="name" class="col-sm-4 col-form-label">Nama User</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name', $user->name) }}" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="email" class="col-sm-4 col-form-label">Email</label>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email', $user->email) }}" autocomplete="off" required>
                                        </div>

                                    </div>
                                    <div class="mb-3 row">
                                        <label for="password" class="col-sm-4 col-form-label">Password</label>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control" id="password" name="password"
                                                value="{{ old('password', $user->password) }}" required autocomplete="off"
                                                disabled>
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#ubahpwmodal">Ubah</button>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="no_hp" class="col-sm-4 col-form-label">No Hp</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                                value="{{ old('no_hp', $user->no_hp) }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="instansi" class="col-sm-4 col-form-label">Instansi/Organisasi</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="instansi" name="instansi"
                                                value="{{ old('instansi', $user->instansi) }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="bagian"
                                            class="col-sm-4 col-form-label">Bagian/Bidang/Seksi/Fungsi</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="bagian" name="bagian"
                                                value="{{ old('bagian', $user->bagian) }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="kd_wilayah" class="col-sm-4 col-form-label">Kabupaten/Kota</label>
                                        <div class="col-sm-6">
                                            {{-- <input type="text" class="form-control" id="instansi" name="instansi"
                                                value="{{ old('instansi', $user->instansi) }}" autocomplete="off"> --}}
                                            <select name="kd_wilayah" id="kd_wilayah" class="form-select">
                                                @foreach ($kabs as $kab)
                                                    <option value="{{ $kab->id_kab }}">{{ $kab->nama_kab }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-primary" type="submit" id="simpanbtn">simpan</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
            </div>
            <!-- ROW-5 END -->
        </div>
        <!-- CONTAINER END -->
    </div>
    <div class="modal fade" id="ubahpwmodal" tabindex="-1" aria-labelledby="ubahpwmodallabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pwmodallabel">Ubah Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" id="form_ubah_pw" action="{{ url('/users/ubahpassword') }}"
                        method="POST">
                        @csrf<input type="text" name="id" id="id_form_ubah_pw" hidden
                            value="{{ old('id', $user->id) }}">
                        <input type="text" class="form-control" name="password" value="{{ old('password') }}"
                            id="password_form_ubah_pw">
                        <input type="text" class="form-control" name="password_confirm"
                            id="password_confirm_form_ubah_pw" value="{{ old('password_confirm') }}">
                        <button class="btn btn-danger" type="submit" id="submit_ubah_pw">Ubah Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        matchPassword(event);
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })

        $(function() {
            $('#password_confirm_form_ubah_pw').on('keyup', function() {
                matchPassword();
                console.log($('#form_ubah_pw').find('#password_form_ubah_pw').val())
                console.log($('#form_ubah_pw').find('#password_confirm_form_ubah_pw').val())
            })
        })

        function matchPassword(event) {
            var pw1 = $('#form_ubah_pw').find('#password_form_ubah_pw');
            var pw2 = $('#form_ubah_pw').find('#password_confirm_form_ubah_pw');
            if (pw1.val() != pw2.val()) {
                $('#form_ubah_pw').find('#password_confirm_form_ubah_pw').css("border", "1px solid red");
                $('#form_ubah_pw').find('#password_confirm_form_ubah_pw').addClass('is-invalid')
                event.preventDefault()
                event.stopPropagation()
            } else {
                $('#form_ubah_pw').find('#password_confirm_form_ubah_pw').css("border", "1px solid #dee2e6");
                $('#form_ubah_pw').find('#password_confirm_form_ubah_pw').removeClass('is-invalid')
            }
        }
    </script>
@endsection
