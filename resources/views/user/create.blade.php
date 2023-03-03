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
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <form action="{{ url('users/store') }}" method="POST">
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
                                        <label for="username" class="col-sm-4 col-form-label">Username</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="username" name="username"
                                                value="{{ old('username', $user->username) }}" autocomplete="off" required>
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
                                                value="{{ old('password', $user->password) }}" required autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="kd_wilayah" class="col-sm-4 col-form-label">Kabupaten/Kota</label>
                                        <div class="col-sm-6">
                                            <select name="kd_wilayah" id="kd_wilayah" class="form-select">
                                                @if ($auth->kd_wilayah == '00')
                                                    <option value="00">Provinsi Sumatera Selatan</option>
                                                @endif
                                                {{-- <option value="00">Provinsi Sumatera Selatan</option> --}}
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
@endsection

@section('script')
    <script></script>
@endsection
