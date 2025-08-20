@extends('layout.layout_mobile')

@section('content')
    <style>
        .bg-wheat {
            background-color: wheat;
        }

        .form-control:disabled,
        .form-control[readonly] {
            background-color: #d3b784;
        }

        .footer2 {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            z-index: 200;
            background-color: rgb(241, 177, 93);
            color: white;
            text-align: center;
            height: 60px;
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
        <a href="{{ url('pcl_pencacahan_dsrt') . '/' . $dsrt->id_bs }}" class="btn btn-transparent btn-sm border-0">
            <i class="bi bi-arrow-left-square text-white" style="font-size: 2rem;"></i>
        </a>
    </div>
    <div class="main-content app-content m-0 mt-5">
        <div class="side-app">
            <div class="main-container container-fluid" style="min-height: 87vh;">

                <div class="container text-dark">
                    <form action="{{ url('pcl_pencacahan_ruta') . '/' . $id }}" id="form_pencacahan" method="post"
                        enctype="multipart/form-data" text-dark>
                        @csrf
                        <div class="p-2">
                            @include('alert')
                        </div>
                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Provinsi</label>
                                        <input type="text" class="form-control " placeholder="16" name="provinsi"
                                            id="provinsi" value="16" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Kab/Kota</label>
                                        <input type="text" class="form-control" placeholder="kd_kab" name="kd_kab"
                                            id="kd_kab" value="{{ old('kd_kab', $dsrt->kd_kab) }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">NKS</label>
                                        <input type="text" class="form-control " placeholder="nks" name="nks"
                                            id="nks" value="{{ old('nks', $dsrt->nks) }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">No Urut Ruta</label>
                                        <input type="text" class="form-control " placeholder="nu_rt" name="nu_rt"
                                            id="nu_rt" value="{{ old('nu_rt', $dsrt->nu_rt) }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Nama KRT</label>
                                        <input type="text" class="form-control bg-transparent" placeholder="nama_krt_cacah"
                                            name="nama_krt_cacah" id="nama_krt_cacah" value="{{ old('nama_krt_cacah', $dsrt->nama_krt_cacah) }}"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Jumlah Art (R.301)</label>
                                        <input type="number" class="form-control bg-transparent" placeholder="jml_art_cacah"
                                            name="jml_art_cacah" id="jml_art_cacah" value="{{ old('jml_art_cacah', $dsrt->jml_art_cacah) }}"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Status Kepemilikan Bangunan Yang
                                            Ditempati</label>
                                        <select name="status_rumah" id="status_rumah" class="form-select bg-transparent"
                                            required>
                                            <option value="Milik Sendiri" @if ($dsrt->status_rumah == 'Milik Sendiri') selected @endif>
                                                Milik Sendiri
                                            </option>
                                            <option value="Kontrak" @if ($dsrt->status_rumah == 'Kontrak') selected @endif>
                                                Kontrak
                                            </option>
                                            <option value="Sewa" @if ($dsrt->status_rumah == 'Sewa') selected @endif>
                                                Sewa
                                            </option>
                                            <option value="Bebas Sewa" @if ($dsrt->status_rumah == 'Bebas Sewa') selected @endif>
                                                Bebas Sewa
                                            </option>
                                            <option value="Dinas" @if ($dsrt->status_rumah == 'Dinas') selected @endif>
                                                Dinas
                                            </option>
                                            <option value="Lainnya" @if ($dsrt->status_rumah == 'Lainnya') selected @endif>
                                                Lainnya
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Perkiraan Rata-rata Pengeluaran Sebulan</label>
                                        <input type="text" class="form-control bg-transparent rupiah"
                                            placeholder="makanan_sebulan" name="makanan_sebulan" id="makanan_sebulan"
                                            value="{{ old('makanan_sebulan', $dsrt->makanan_sebulan) }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Rata-rata Pengeluaran Non-Makanan
                                            Sebulan</label>
                                        <input type="text" class="form-control bg-transparent rupiah"
                                            placeholder="nonmakanan_sebulan" name="nonmakanan_sebulan"
                                            id="nonmakanan_sebulan"
                                            value="{{ old('nonmakanan_sebulan', $dsrt->nonmakanan_sebulan) }}" required>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 px-2 pt-2">
                                        <label for="" class="label">Apakah Menerima Program GSMP</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gsmp" id="gsmp1"
                                                required value="0" @if ($dsrt->gsmp == 0) checked @endif>
                                            <label class="form-check-label" for="gsmp1">
                                                Tidak
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gsmp" id="gsmp2"
                                                value="1" @if ($dsrt->gsmp == 1) checked @endif>
                                            <label class="form-check-label" for="gsmp2">
                                                Ya
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group  mb-0 px-3 pb-2">
                                        <div class="row p-2 d-flex align-items-center">
                                            <label for="" class="label col-4">Yang diterima</label>
                                            <input type="text" class="form-control bg-transparent col-8"
                                                placeholder="misal:pupuk,bibit,pestisida untuk holtikultura"
                                                name="gsmp_desk" id="gsmp_desk"
                                                value="{{ old('gsmp_desk', $dsrt->gsmp_desk) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 px-2 pt-2">
                                        <label for="" class="label">Apakah Menerima Program Bantuan Sosial</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="bantuan" id="bantuan1"
                                                required value="0" @if ($dsrt->bantuan == 0) checked @endif>
                                            <label class="form-check-label" for="bantuan1">
                                                Tidak
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="bantuan" id="bantuan2"
                                                value="1" @if ($dsrt->bantuan == 1) checked @endif>
                                            <label class="form-check-label" for="bantuan2">
                                                Ya
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group  mb-0 px-3 pb-2">
                                        <div class="row p-2 d-flex align-items-center">
                                            <label for="" class="label col-4">Yang diterima</label>
                                            <input type="text" class="form-control bg-transparent col-8"
                                                placeholder="misal:BPNT,PIP,PKH,BLT"
                                                name="bantuan_desk" id="bantuan_desk"
                                                value="{{ old('bantuan_desk', $dsrt->bantuan_desk) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Jenis Pembayaran Listrik</label>
                                        <select name="listrik_jenis" id="listrik_jenis" class="form-select bg-transparent"
                                            required>
                                            <option value="Token" @if ($dsrt->listrik_jenis == 'Token') selected @endif>
                                                Token
                                            </option>
                                            <option value="Pascabayar" @if ($dsrt->listrik_jenis == 'Pascabayar') selected @endif>
                                                Pascabayar
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Daya Listrik Terpasang</label>
                                        <select name="listrik_daya" id="listrik_daya" class="form-select bg-transparent"
                                            required>
                                            <option value="450 VA" @if ($dsrt->listrik_daya == '450 VA') selected @endif>
                                                450 VA
                                            </option>
                                            <option value="900 VA" @if ($dsrt->listrik_daya == '900 VA') selected @endif>
                                                900 VA
                                            </option>
                                            <option value="1300 VA" @if ($dsrt->listrik_daya == '1300 VA') selected @endif>
                                                1300 VA
                                            </option>
                                            <option value="2200 VA" @if ($dsrt->listrik_daya == '2200 VA') selected @endif>
                                                2200 VA
                                            </option>
                                            <option value="> 2200 VA" @if ($dsrt->listrik_daya == '> 2200 VA') selected @endif>
                                                &gt; 2200 VA
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Besar Pemakaian kWh Listrik Sebulan Lalu</label>
                                        <input type="text" class="form-control bg-transparent"
                                            placeholder="listrik_kwh" name="listrik_kwh" id="listrik_kwh"
                                            value="{{ old('listrik_kwh', $dsrt->listrik_kwh) }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Pengeluaran Listrik Sebulan Lalu (Rp)</label>
                                        <input type="text" class="form-control bg-transparent rupiah"
                                            placeholder="listrik_harga" name="listrik_harga" id="listrik_harga"
                                            value="{{ old('listrik_harga', $dsrt->listrik_harga) }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Adakah ART yang Mengikuti Program Sekolah Rakyat</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sekolah_rakyat" id="sekolah_rakyat1"
                                                required value="0" @if ($dsrt->sekolah_rakyat == 0) checked @endif>
                                            <label class="form-check-label" for="sekolah_rakyat1">
                                                Tidak
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sekolah_rakyat" id="sekolah_rakyat2"
                                                value="1" @if ($dsrt->sekolah_rakyat == 1) checked @endif>
                                            <label class="form-check-label" for="sekolah_rakyat2">
                                                Ya
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Adakah Perempuan Pernah Kawin Umur 10-54 Tahun yang Sedang Hamil atau Menyusui, Anak Sekolah (SD, SMP, SMA/Sederajat), atau Anak Balita (di Bawah 5 Tahun) yang Menerima MBG</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="mbg" id="mbg1"
                                                required value="0" @if ($dsrt->mbg == 0) checked @endif>
                                            <label class="form-check-label" for="mbg1">
                                                Tidak
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="mbg" id="mbg2"
                                                value="1" @if ($dsrt->mbg == 1) checked @endif>
                                            <label class="form-check-label" for="mbg2">
                                                Ya
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Kualitas Makanan pada Menu Program MBG yang Diterima</label>
                                        <select name="menu_mbg" id="menu_mbg" class="form-select bg-transparent"
                                            required>
                                            <option value="Tidak Mendapat MBG" @if ($dsrt->status_rumah == 'Tidak Mendapat MBG') selected @endif>
                                                Tidak Mendapat MBG
                                            </option>
                                            <option value="Tidak Baik" @if ($dsrt->status_rumah == 'Tidak Baik') selected @endif>
                                                Tidak Baik
                                            </option>
                                            <option value="Kurang Baik" @if ($dsrt->status_rumah == 'Kurang Baik') selected @endif>
                                                Kurang Baik
                                            </option>
                                            <option value="Baik" @if ($dsrt->status_rumah == 'Baik') selected @endif>
                                                Baik
                                            </option>
                                            <option value="Sangat Baik" @if ($dsrt->status_rumah == 'Sangat Baik') selected @endif>
                                                Sangat Baik
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Berapa Pengeluaran pada Kolom PEMBERIAN (VSEN25.KP Blok IV.1 Kolom 8) untuk Nasi Campur/Rames (R.196)</label>
                                        <input type="text" class="form-control bg-transparent rupiah"
                                            placeholder="rincian_int_1" name="rincian_int_1" id="rincian_int_1"
                                            value="{{ old('rincian_int_1', $dsrt->rincian_int_1) }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Berapa Pengeluaran pada Kolom PEMBERIAN (VSEN25.KP Blok IV.1 Kolom 8) untuk Susu Cair Pabrik (R.79)</label>
                                        <input type="text" class="form-control bg-transparent rupiah"
                                            placeholder="rincian_int_2" name="rincian_int_2" id="rincian_int_2"
                                            value="{{ old('rincian_int_2', $dsrt->rincian_int_2) }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Lokasi</label>
                                        <input type="text" class="form-control bg-transparent mb-2"
                                            placeholder="lokasi" name="lokasi" id="lokasi"
                                            value="{{ old('lokasi', $dsrt->lokasi) }}" readonly>
                                        <button class="btn btn-gray" type="button"> get Location</button>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="card bg-wheat my-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 p-2">
                                        <label for="" class="label">Foto Rumah</label>
                                        <input accept="image/*" type='file' id="foto" name="foto"
                                            class="form-control mb-2" />
                                        <div class="text-center">
                                            @if ($dsrt->foto)
                                                <img id="img_prev" src="{{ url('foto') . '/' . $dsrt->foto }}"
                                                    alt="your image" />
                                            @else
                                                <img id="img_prev" src="#" alt="your image" />
                                            @endif

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="footer2 d-flex justify-content-center">
        <table>
            <tr>
                <td>
                    <a href="{{ url('pcl_pencacahan_dsrt/') . '/' . $dsrt->id_bs }}" class="btn btn-gray border-0">
                        Batal</a>
                </td>
                <td><button type="submit" class="btn btn-primary border-0" form="form_pencacahan"> Simpan</button></td>
            </tr>

        </table>
    </div>
    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <script>
        foto.onchange = evt => {
            const [file] = foto.files
            if (file) {
                img_prev.src = URL.createObjectURL(file)
            }
        }

        $("#makanan_sebulan").keyup(function() {
            $("#makanan_sebulan").val(formatRupiah($("#makanan_sebulan").val(), 'Rp. '));
        });
        $("#nonmakanan_sebulan").keyup(function() {
            $("#nonmakanan_sebulan").val(formatRupiah($("#nonmakanan_sebulan").val(), 'Rp. '));
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endsection
