@extends('layout.layout')

@section('content')
    @php
        $year_now = date("Y");
        $tahun_array = [$year_now - 2, $year_now - 1, $year_now, $year_now + 1, $year_now + 2];
    @endphp
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Alokasi DSBS-USER</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Alokasi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card-header border-0 pb-0">
                                <h3 class="card-title mb-0">List DS BS</h3>
                                <div class="ms-auto pageheader-btn">
                                    @hasanyrole(['SUPER ADMIN|ADMIN PROVINSI|ADMIN KABKOT'])
                                        <div class="btn-group mt-2 mb-2">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#modal_import_alokasi">Import Alokasi User</button>
                                        </div>
                                    @endhasanyrole
                                </div>
                            </div>
                            <div class="card-header pt-0 d-flex justify-content-center">
                                <div class="row col">
                                    <div class="alert alert-info" role="alert">
                                        <ul style="list-style-type:initial;">
                                            <li> Alokasi Dapat dilakukan dengan 2 cara, yaitu manual dengan pilih pencacah
                                                pada list
                                                dibawah secara satu persatu atau sekaligus dengan import excel.</li>
                                            <li><strong> Import alokasi </strong> dengan excel dapat dilalukan dengan cara
                                                <strong> mengexport terlebih
                                                    dahulu DSBS </strong> di list berikut(export sesuai filter yang
                                                dipilih), kemudian
                                                melakukan pengisian email pencacah pada kolom pencacah dan <strong> Import
                                                    kembali</strong>
                                                excel yang sudah diisikan.
                                            </li>
                                            <li> Apabila email user tidak terdaftar pada menu user
                                                maka dsbs tidak akan teralokasi ke siapapun, pastikan
                                                user dan email telah terdaftar pada menu user.
                                            </li>
                                            <li>Pengawas terisi secara otomatis dari
                                                pengisian pengawas pada menu user.</li>
                                            <li> Apabila ada DSBS yang tidak sesuai lapor ke admin provinsi.</li>
                                        </ul>
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
                                                            @foreach ($tahun_array as $t)
                                                                <option value="{{ $t }}"
                                                                    @if ($tahun == (string) $t) selected @endif>{{ $t }}
                                                                </option>
                                                            @endforeach
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
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-success" id="export-btn"
                                                            style="width: 100%">export</button>
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
                                                            href="{{ url('alokasi/' . \Crypt::encryptString($dt->id)) }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
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
                    <form action="{{ url('dsbs/delete') }}" method="post" id="form_hapus">
                        @csrf
                        @method('delete')
                        <div class="row ">
                            <input type="text" name="id" id="modal_hapus_id" hidden>
                            <div class="mb-3 ">
                                <label for="modal_hapus_id_bs" class="form-label">ID BS</label>
                                <input type="text" class="form-control" id="modal_hapus_id_bs" name="id_bs"
                                    readonly>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form_hapus">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_import_alokasi">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import Alokasi<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('alokasi_import') }}" method="post" id="form_import"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row ">
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

            $('#export-btn').on('click', function() {
                var form = $('#form_filter');
                window.open("{{ url('alokasi_export') }}" + "?" + form.serialize(), "_blank")
            });
        });

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
