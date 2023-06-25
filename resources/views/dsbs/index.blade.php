@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">DS BS</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">DS BS</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-header border-0 pb-0">
                                <h3 class="card-title mb-0">List DS BS</h3>
                                <div class="ms-auto pageheader-btn">
                                    @hasanyrole(['SUPER ADMIN|ADMIN PROVINSI'])
                                        <div class="btn-group mt-2 mb-2">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#modal_import_dsbs">Import DSBS</button>
                                            <button type="button" class="btn btn-default dropdown-toggle "
                                                data-bs-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li class="dropdown-plus-title">
                                                    Import
                                                    <b class="fa fa-angle-up"></b>
                                                </li>
                                                <li><a href="{{ url('template/Template DSBS.xlsx') }}">Template Import DSBS</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a class="btn btn-primary btn-icon text-white" href="{{ url('dsbs/create') }}">
                                            <span>
                                                <i class="fe fe-plus"></i>
                                            </span> Tambah
                                        </a>
                                    @endhasanyrole
                                </div>
                            </div>
                            <div class="card-header pt-0 d-flex justify-content-center">
                                <div class="row col">
                                    <div class="alert alert-info" role="alert">
                                        Import DSBS dapat dilakukan sebelum Kegiatan Pencacahan, <br>
                                        Import DSBS hanya mengisi pencacah, untuk pengawas diisi di menu user
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <form action="" id="form_filter">
                                            <fieldset>
                                                <div class="mb-2 row">
                                                    <div class="col-sm-2">
                                                        <select name="tahun_filter" id="tahun_filter"
                                                            class="form-control select2 form-select">
                                                            <option value="">Pilih tahun</option>
                                                            <option value="2022"
                                                                @if ($tahun == '2022') selected @endif>2022
                                                            </option>
                                                            <option value="2023"
                                                                @if ($tahun == '2023') selected @endif>2023
                                                            </option>
                                                            <option value="2024"
                                                                @if ($tahun == '2024') selected @endif>2024
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <select name="semester_filter" id="semester_filter"
                                                            class="form-control select2 form-select">
                                                            <option value="">Pilih Semester</option>
                                                            <option value="1"
                                                                @if ($semester == '1') selected @endif>1</option>
                                                            <option value="2"
                                                                @if ($semester == '2') selected @endif>2</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <select name="flag_active" id="flag_active"
                                                            class="form-control select2-show-search form-select">
                                                            <option value="0"
                                                                @if ($flag_active == '0') selected @endif>
                                                                Inaktif/Dummy
                                                            </option>
                                                            <option value="1"
                                                                @if ($flag_active == '1') selected @endif>
                                                                Aktif/Lapangan
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-2 row">
                                                    <div class="col-sm-2">
                                                        <select name="kab_filter" id="kab_filter"
                                                            class="form-control select2-show-search form-select">
                                                            <option value="">Semua Kab/Kot</option>
                                                            @foreach ($kabs as $kab)
                                                                <option value="{{ $kab->id_kab }}"
                                                                    @if ($kab->id_kab == $request->kab_filter) selected @endif>
                                                                    [{{ $kab->id_kab }}] {{ $kab->alias }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <select name="kec_filter" id="kec_filter"
                                                            class="form-control select2-show-search form-select">
                                                            <option value="">Semua Kecamatan</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <select name="desa_filter" id="desa_filter"
                                                            class="form-control select2-show-search form-select">
                                                            <option value="">Semua Desa</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="nks_filter" id="nks_filter"
                                                            placeholder="cari NKS" class="form-control"
                                                            @if ($request->nks_filter) value="{{ $request->nks_filter }}" @endif>
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <button type="submit" class="btn btn-primary">Cari</button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table border table-bordered text-nowrap text-md-nowrap mg-b-0 table-sm">
                                        <thead>
                                            <tr class="text-center align-middle">
                                                <th>No</th>
                                                <th>Kab</th>
                                                <th>Kec</th>
                                                <th>Desa</th>
                                                <th>BS</th>
                                                <th>NKS</th>
                                                <th>SLS</th>
                                                <th>Pencacah</th>
                                                <th>Pengawas</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            @foreach ($data as $key => $dt)
                                                <tr class="align-middle text-center">
                                                    <td class="align-middle">{{ ++$key }}</td>
                                                    <td class="align-middle ">{{ $dt->kd_kab }}</td>
                                                    <td class="align-middle ">{{ $dt->kd_kec }}</td>
                                                    <td class="align-middle ">{{ $dt->kd_desa }}</td>
                                                    <td class="align-middle ">{{ $dt->kd_bs }}</td>
                                                    <td class="align-middle ">{{ $dt->nks }}</td>
                                                    <td class="align-middle text-start">{{ $dt->sls }}</td>
                                                    <td class="align-middle text-start">{{ $dt->pencacah }}</td>
                                                    <td class="align-middle text-start">{{ $dt->pengawas }}</td>
                                                    <td class="align-middle">
                                                        <a class="btn btn-outline-primary"
                                                            href="{{ url('dsbs/' . \Crypt::encryptString($dt->id)) }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <button class="btn btn-outline-danger btn_hapus"
                                                            data-id="{{ $dt->id }}"
                                                            data-kd_kab="{{ $dt->kd_kab }}"
                                                            data-kd_kec="{{ $dt->kd_kec }}"
                                                            data-kd_desa="{{ $dt->kd_desa }}"
                                                            data-kd_bs="{{ $dt->kd_bs }}"
                                                            data-nks="{{ $dt->nks }}"
                                                            data-sls="{{ $dt->sls }}" data-bs-toggle="modal"
                                                            data-bs-target="#modal_hapus">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_hapus">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus DS BS<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_hapus">
                        @csrf
                        @method('delete')
                        <input type="text" name="id" id="modal_hapus_id" hidden>
                        <div class="row mb-3 ">
                            <div class="col">
                                <label for="id_bs_hapus" class="form-label">ID BS</label>
                                <input type="text" class="form-control" id="id_bs_hapus" name="id_bs" readonly>
                            </div>
                        </div>
                        <div class="row mb-3 ">
                            <div class="col">
                                <label for="nks_hapus" class="form-label">NKS</label>
                                <input type="text" class="form-control" id="nks_hapus" name="nks" readonly>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form_hapus">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_import_dsbs">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import DSBS<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('dsbs/import') }}" method="post" id="form_import"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <select name="kab" id="kab_import" class="form-control select2-show-search form-select"
                                required>
                                <option value="">Pilih Kab/Kot</option>
                                @foreach ($kabs as $kab)
                                    <option value="{{ $kab->id_kab }}">
                                        [{{ $kab->id_kab }}] {{ $kab->nama_kab }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <select name="tahun" id="tahun_import"
                                    class="form-control select2-show-search form-select" required>
                                    <option value="">Pilih tahun</option>
                                    <option value="2022">2022</option>
                                    <option value="2023" @if ($periode->tahun == '2023') selected @endif>2023</option>
                                    <option value="2024" @if ($periode->tahun == '2024') selected @endif>2024
                                    </option>
                                </select>
                            </div>
                            <div class="col-6">
                                <select name="semester" id="semester_import"
                                    class="form-control select2-show-search form-select" required>
                                    <option value="">pilih semester</option>
                                    <option value="1"@if ($periode->semester == '1') selected @endif>1</option>
                                    <option value="2"@if ($periode->semester == '2') selected @endif>2 </option>
                                </select>
                            </div>
                        </div>
                        <div class="row ">
                            <input type="text" name="user_id" id="user_id" hidden>
                            <div class="mb-3 ">
                                <div class="form-group">
                                    <label class="form-label mt-0">File Excel (sesuai template)</label>
                                    <input class="form-control" type="file" name="import_file">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form_import">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .select2-container--open {
            z-index: 9000;
        }

        .select2-dropdown {
            z-index: 9001;
        }
    </style>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            const kab_value = {!! json_encode($request->kab_filter) !!}
            const kec_value = {!! json_encode($request->kec_filter) !!}
            const desa_value = {!! json_encode($request->desa_filter) !!}

            if (kab_value) {
                set_kab(kab_value)
                    .then(function() {
                        select_kabs()
                    }).then(function() {
                        if (kec_value) {
                            set_kec(kec_value)
                        }
                    }).then(function() {
                        select_kecs()
                    }).then(function() {
                        if (desa_value) {
                            set_desa(desa_value)
                        }
                    }).catch(function(error) {
                        console.log(error);
                    });
            }
            $('#kab_filter').change(function() {
                select_kabs();
            })
            $('#kec_filter').change(function() {
                select_kecs();
            })
        });

        $('.btn_hapus').click(function() {
            id = $(this).data("id")
            $('#modal_hapus').find('#nks_hapus').val($(this).data("nks"));
            $('#modal_hapus').find('#id_bs_hapus').val('16' + $(this).data("kd_kab") + $(this).data("kd_kec") + $(
                this).data("kd_desa") + $(this).data("kd_bs"));
            $("#form_hapus").attr('action', "{{ url('dsbs') }}" + '/' + id);
        })

        function select_kabs() {
            return new Promise((resolve, reject) => {
                const kab_filter = document.getElementById('kab_filter').value;
                var request = new XMLHttpRequest();
                request.open('GET', "{{ url('list_kec?kab_filter=') }}" +
                    kab_filter,
                    false
                ); // Set argumen ketiga menjadi false untuk menjalankan permintaan secara sinkron
                request.send();
                if (request.status === 200) {
                    var data = JSON.parse(request.responseText);
                    const kec_select = document.getElementById('kec_filter');
                    kec_select.innerHTML = "";
                    var option = document.createElement('option');
                    option.value = "";
                    option.textContent = "Semua";
                    kec_select.appendChild(option);
                    data.data.forEach(element => {
                        var option = document.createElement('option');
                        option.value = element.id_kec;
                        option.textContent = '[' + element.id_kec + '] ' + element.nama_kec;
                        kec_select.appendChild(option);
                    });
                } else {
                    console.error('Error:', request.status);
                }
                resolve();
            })
        }

        function select_kecs() {
            return new Promise((resolve, reject) => {
                const kec_filter = document.getElementById('kec_filter').value;
                const kab_filter = document.getElementById('kab_filter').value;
                var request = new XMLHttpRequest();
                request.open('GET', "{{ url('list_desa?kab_filter=') }}" +
                    kab_filter +
                    '&kec_filter=' + kec_filter,
                    false
                ); // Set argumen ketiga menjadi false untuk menjalankan permintaan secara sinkron
                request.send();
                if (request.status === 200) {
                    var data = JSON.parse(request.responseText);
                    const desa_select = document.getElementById('desa_filter');
                    desa_select.innerHTML = "";
                    var option = document.createElement('option');
                    option.value = "";
                    option.textContent = "Semua";
                    desa_select.appendChild(option);
                    data.data.forEach(element => {
                        var option = document.createElement('option');
                        option.value = element.id_desa;
                        option.textContent = '[' + element.id_desa + '] ' + element
                            .nama_desa;
                        desa_select.appendChild(option);
                    });
                } else {
                    console.error('Error:', request.status);
                }
                resolve();
            })
        }

        function set_kab(kab_value) {
            return new Promise((resolve, reject) => {
                const kab_select = document.getElementById('kab_filter');
                kab_select.value = kab_value
                resolve();
            });
        }

        function set_kec(kec_value) {
            return new Promise((resolve, reject) => {
                const kec_select = document.getElementById('kec_filter');
                kec_select.value = kec_value
                // $('#kec_filter').val(kec_value);
                kec_select.dispatchEvent(new Event('change'));
                resolve();
            });
        }

        function set_desa(desa_value) {
            return new Promise((resolve, reject) => {
                const desa_select = document.getElementById('desa_filter');
                desa_select.value = desa_value
                desa_select.dispatchEvent(new Event('change'));
                resolve();
            });
        }
    </script>
@endsection
