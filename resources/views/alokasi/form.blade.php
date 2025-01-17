@php
    $year_now = date("Y");
    $tahun_array = [$year_now - 2, $year_now - 1, $year_now, $year_now + 1, $year_now + 2];
@endphp
<fieldset class="">
    <div class="mb-3 row">
        <div class="col-sm-3">
            <label for="tahun" class="form-label">Tahun*</label>
            <select name="tahun" id="tahun" class="form-select" disabled required>
            @foreach ($tahun_array as $t)
                <option value="{{ $t }}" @if ($periode->tahun == (string) $t) selected @endif>{{ $t }}</option>
            @endforeach
            </select>
        </div>
        <div class="col-sm-3">
            <label for="semester" class="form-label">Semester*</label>
            <select name="semester" id="semester" class="form-select" disabled required>
                <option value="1" @if ($periode->semester == '1') selected @endif>1</option>
                <option value="2" @if ($periode->semester == '2') selected @endif>2</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-3">
            <label for="kd_kab" class="form-label">Kabupaten/Kota*</label>
            <select name="kd_kab" id="kd_kab" class="form-control select2-show-search form-select" disabled
                required>
                <option value="">Pilih Kab/Kota</option>
                @foreach ($kabs as $kab)
                    <option value="{{ $kab->id_kab }}" @if ($kab->id_kab == $data->kd_kab) selected @endif>
                        [{{ $kab->id_kab }}] {{ $kab->nama_kab }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3">
            <label for="kd_kec" class="form-label">Kecamatan*</label>
            <select name="kd_kec" id="kd_kec" class="form-control select2-show-search form-select" disabled
                required>
            </select>
        </div>
        <div class="col-sm-3">
            <label for="kd_desa" class="form-label">Kelurahan/Desa*</label>
            <select name="kd_desa" id="kd_desa" class="form-control select2-show-search form-select" disabled
                required>
            </select>
        </div>
        <div class="col-sm-3">
            <label for="kd_bs" class="form-label">NBS (001B, 009B, dll) *</label>
            <input name="kd_bs" type="text" id="kd_bs" class="form-control" maxlength="4"
                pattern="[A-Za-z0-9]{4}" oninput="validateInput(this)" required value="{{ old('kd_bs', $data->kd_bs) }}"
                disabled>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-3">
            <label for="nks" class="form-label">nks (6 digit)</label>
            <input name="nks" id="nks" class="form-control" type="number" max="999999" min="0"
                oninput="checkInputLength(this)" value="{{ old('nks', $data->nks) }}" disabled>
        </div>
        <div class="col-sm-3">
            <label for="sls" class="form-label">SLS (RT 01 RW 01) *</label>
            <input name="sls" type="text" id="sls" class="form-control"
                value="{{ old('sls', $data->sls) }}" disabled>
        </div>

        <div class="col-sm-3">
            <label for="jml_rt" class="form-label">Jumlah Ruta</label>
            <input name="jml_rt" type="number" id="jml_rt" class="form-control" max="999999" min="0"
                oninput="checkInputLength(this)" value="{{ old('jml_rt', $data->jml_rt) }}" disabled>
        </div>
    </div>

    <div class="mb-3 row">
        <div class="col-sm-6">
            <label for="pencacah" class="form-label">pencacah</label>
            <select name="pencacah" id="pencacah" class="form-control select2-show-search form-select">
                <option value="">Pilih Pencacah</option>
                @foreach ($list_pencacah as $pcl)
                    <option value="{{ $pcl->email }}" @if ($data->pencacah == "$pcl->email") selected @endif>
                        {{ $pcl->name . ' | ' . $pcl->email }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="pengawas" class="form-label">pengawas</label>
            <select name="pengawas" id="pengawas" class="form-control select2-show-search form-select">
                <option value="">Pilih Pengawas</option>
                @foreach ($list_pengawas as $pml)
                    <option value="{{ $pml->email }}" @if ($data->pengawas == "$pml->email") selected @endif>
                        {{ $pml->name . ' | ' . $pml->email }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</fieldset>
@section('script')
    <script>
        $(document).ready(function() {
            const kab_value = {!! json_encode($data->kd_kab) !!}
            const kec_value = {!! json_encode($data->kd_kec) !!}
            const desa_value = {!! json_encode($data->kd_desa) !!}

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

            $('#kd_kab').change(function() {
                select_kabs();
            })
            $('#kd_kec').change(function() {
                select_kecs();
            })
        });

        function checkInputLength(input) {
            if (input.value.length > 6) {
                input.value = input.value.slice(0, 6);
            }
        }

        function validateInput(input) {
            const regex = /^[A-Za-z0-9]{4}$/;
            if (!regex.test(input.value)) {
                input.setCustomValidity("Input hanya boleh terdiri dari huruf dan angka, dengan panjang 4 karakter");
            } else {
                input.setCustomValidity("");
            }
        }

        function select_kabs() {
            return new Promise((resolve, reject) => {
                const kab_filter = document.getElementById('kd_kab').value;
                var request = new XMLHttpRequest();
                request.open('GET', "{{ url('list_kec?kab_filter=') }}" +
                    kab_filter,
                    false
                ); // Set argumen ketiga menjadi false untuk menjalankan permintaan secara sinkron
                request.send();
                if (request.status === 200) {
                    var data = JSON.parse(request.responseText);
                    const kec_select = document.getElementById('kd_kec');
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
                const kec_filter = document.getElementById('kd_kec').value;
                const kab_filter = document.getElementById('kd_kab').value;
                var request = new XMLHttpRequest();
                request.open('GET', "{{ url('list_desa?kab_filter=') }}" +
                    kab_filter +
                    '&kec_filter=' + kec_filter,
                    false
                ); // Set argumen ketiga menjadi false untuk menjalankan permintaan secara sinkron
                request.send();
                if (request.status === 200) {
                    var data = JSON.parse(request.responseText);
                    const desa_select = document.getElementById('kd_desa');
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
                const kab_select = document.getElementById('kd_kab');
                kab_select.value = kab_value
                resolve();
            });
        }

        function set_kec(kec_value) {
            return new Promise((resolve, reject) => {
                const kec_select = document.getElementById('kd_kec');
                kec_select.value = kec_value
                kec_select.dispatchEvent(new Event('change'));
                resolve();
            });
        }

        function set_desa(desa_value) {
            return new Promise((resolve, reject) => {
                const desa_select = document.getElementById('kd_desa');
                desa_select.value = desa_value
                desa_select.dispatchEvent(new Event('change'));
                resolve();
            });
        }
    </script>
@endsection
