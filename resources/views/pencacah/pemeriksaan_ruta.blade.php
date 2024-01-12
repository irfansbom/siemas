@extends('layout.layout_mobile')

@section('content')
    <style>
        .center {
            /* position: fixed; */
            top: 20%;
        }

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
        <a href="{{ url('pcl_pemeriksaan_dsrt') . '/' . $dsrt->id_bs }}" class="btn btn-transparent btn-sm border-0">
            <i class="bi bi-arrow-left-square text-white" style="font-size: 2rem;"></i>
        </a>
    </div>
    <div class="main-content app-content m-0 mt-5 text-dark">
        <div class="side-app">
            <div class="main-container container-fluid" style="min-height: 87vh;">

                <div class="container">
                    <form action="{{ url('pcl_pemeriksaan_ruta') . '/' . $id }}" id="form_pemeriksaan" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card bg-wheat my-2 text-dark">
                            <div class="p-2">
                                @include('alert')
                            </div>

                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label mb-0">Provinsi</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <input type="text" class="form-control" placeholder="provinsi" name="provinsi"
                                            id="provinsi" value="16" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label mb-0">Kab/Kota</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <input type="text" class="form-control" placeholder="kd_kab" name="kd_kab"
                                            id="kd_kab" value="{{ old('kd_kab', $dsrt->kd_kab) }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label mb-0">NKS</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <input type="text" class="form-control" placeholder="nks" name="nks"
                                            id="nks" value="{{ old('nks', $dsrt->nks) }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label mb-0">No Urut Ruta</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <input type="text" class="form-control" placeholder="nu_rt" name="nu_rt"
                                            id="nu_rt" value="{{ old('nu_rt', $dsrt->nu_rt) }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label mb-0">Nama KRT</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <input type="text" class="form-control" placeholder="nama_krt_cacah" name="nama_krt_cacah"
                                            id="nama_krt_cacah" value="{{ old('nama_krt_cacah', $dsrt->nama_krt_cacah) }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label mb-0">Jumlah ART</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <input type="text" class="form-control" placeholder="jml_art_cacah" name="jml_art_cacah"
                                            id="jml_art_cacah" value="{{ old('jml_art_cacah', $dsrt->jml_art_cacah) }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label mb-0">Jumlah Komo Makanan (KP Blok.IV.1)</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <input type="number" class="form-control bg-transparent"
                                            placeholder="jml_komoditas_makanan" name="jml_komoditas_makanan"
                                            id="jml_komoditas_makanan"
                                            value="{{ old('jml_komoditas_makanan', $dsrt->jml_komoditas_makanan) }}"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label mb-0">Jumlah Komo NonMakanan (KP
                                            Blok.IV.2)</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <input type="number" class="form-control bg-transparent"
                                            placeholder="jml_komoditas_nonmakanan" name="jml_komoditas_nonmakanan"
                                            id="jml_komoditas_nonmakanan"
                                            value="{{ old('jml_komoditas_nonmakanan', $dsrt->jml_komoditas_nonmakanan) }}"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label">P. Makanan Sebulan (KP BlokIV.3.2 R16 Kolom
                                            5)</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <input type="text" class="form-control bg-transparent rupiah"
                                            placeholder="makanan_sebulan" name="makanan_sebulan" id="makanan_sebulan"
                                            value="{{ old('makanan_sebulan', $dsrt->makanan_sebulan) }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label">P.Nonmakanan Sebulan (KP Blok IV.3.3 R.8
                                            Kolom 3)</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <input type="text" class="form-control bg-transparent rupiah"
                                            placeholder="nonmakanan_sebulan" name="nonmakanan_sebulan"
                                            id="nonmakanan_sebulan"
                                            value="{{ old('nonmakanan_sebulan', $dsrt->nonmakanan_sebulan) }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label">P.Transportasi (KP R.304)</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <input type="text" class="form-control bg-transparent rupiah"
                                            placeholder="transportasi" name="transportasi" id="transportasi"
                                            value="{{ old('transportasi', $dsrt->transportasi) }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label">P.Peliharaan (KP R.305)</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <input type="text" class="form-control bg-transparent rupiah"
                                            placeholder="peliharaan" name="peliharaan" id="peliharaan"
                                            value="{{ old('peliharaan', $dsrt->peliharaan) }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label">Jumlah ART Masih Sekolah (K Blok.VI)</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <input type="number" class="form-control bg-transparent "
                                            placeholder="art_sekolah" name="art_sekolah" id="art_sekolah"
                                            value="{{ old('art_sekolah', $dsrt->art_sekolah) }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label">Jumlah ART yang memiliki BPJS PBI (K Blok.XI
                                            R.1101)</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <input type="number" class="form-control bg-transparent " placeholder="art_bpjs"
                                            name="art_bpjs" id="art_bpjs"
                                            value="{{ old('art_bpjs', $dsrt->art_bpjs) }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label">Ijazah Tertinggi KRT (K Blok.VI
                                            R.614)</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <select name="ijazah_krt" id="ijazah_krt" class="form-select bg-transparent">
                                            <option value="">Pilih Ijazah</option>
                                            <option value='Paket A' @if ($dsrt->ijazah_krt == 'Paket A') selected @endif>Paket
                                                A</option>
                                            <option value='SDLB' @if ($dsrt->ijazah_krt == 'SDLB') selected @endif>SDLB
                                            </option>
                                            <option value='SD' @if ($dsrt->ijazah_krt == 'SD') selected @endif>SD
                                            </option>
                                            <option value='MI' @if ($dsrt->ijazah_krt == 'MI') selected @endif>MI
                                            </option>
                                            <option value='Paket B' @if ($dsrt->ijazah_krt == 'Paket B') selected @endif>Paket
                                                B</option>
                                            <option value='SMP LB' @if ($dsrt->ijazah_krt == 'SMP LB') selected @endif>SMP LB
                                            </option>
                                            <option value='SMP' @if ($dsrt->ijazah_krt == 'SMP') selected @endif>SMP
                                            </option>
                                            <option value='MTS' @if ($dsrt->ijazah_krt == 'MTS') selected @endif>MTS
                                            </option>
                                            <option value='Paket C' @if ($dsrt->ijazah_krt == 'Paket C') selected @endif>Paket
                                                C</option>
                                            <option value='SMA LB' @if ($dsrt->ijazah_krt == 'SMA LB') selected @endif>SMA LB
                                            </option>
                                            <option value='SMA' @if ($dsrt->ijazah_krt == 'SMA') selected @endif>SMA
                                            </option>
                                            <option value='MA' @if ($dsrt->ijazah_krt == 'MA') selected @endif>MA
                                            </option>
                                            <option value='SMK' @if ($dsrt->ijazah_krt == 'SMK') selected @endif>SMK
                                            </option>
                                            <option value='MAK' @if ($dsrt->ijazah_krt == 'MAK') selected @endif>MAK
                                            </option>
                                            <option value='D1/D2' @if ($dsrt->ijazah_krt == 'D1/D2') selected @endif>
                                                D1/D2</option>
                                            <option value='D3' @if ($dsrt->ijazah_krt == 'D3') selected @endif>D3
                                            </option>
                                            <option value='D4' @if ($dsrt->ijazah_krt == 'D4') selected @endif>D4
                                            </option>
                                            <option value='S1' @if ($dsrt->ijazah_krt == 'S1') selected @endif>S1
                                            </option>
                                            <option value='Profesi' @if ($dsrt->ijazah_krt == 'Profesi') selected @endif>
                                                Profesi</option>
                                            <option value='S2' @if ($dsrt->ijazah_krt == 'S2') selected @endif>S2
                                            </option>
                                            <option value='S3' @if ($dsrt->ijazah_krt == 'S3') selected @endif>S3
                                            </option>
                                            <option value='Tidak Punya Ijazah SD'
                                                @if ($dsrt->ijazah_krt == 'Tidak Punya Ijazah SD') selected @endif>Tidak Punya Ijazah SD
                                            </option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label">Kegiatan KRT Selama Seminggu (K Blok.VII
                                            R.706)</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <select name="kegiatan_seminggu" id="kegiatan_seminggu"
                                            class="form-select bg-transparent">
                                            <option value="">Pilih Kegiatan</option>
                                            <option value="Pertanian tanaman padi dan palawija"
                                                @if ($dsrt->kegiatan_seminggu == 'Pertanian tanaman padi dan palawija') selected @endif>Pertanian tanaman padi
                                                dan palawija </option>
                                            <option value="Holtikultura"
                                                @if ($dsrt->kegiatan_seminggu == 'Holtikultura') selected @endif>Holtikultura </option>
                                            <option value="Perkebunan" @if ($dsrt->kegiatan_seminggu == 'Perkebunan') selected @endif>
                                                Perkebunan </option>
                                            <option value="Perikanan" @if ($dsrt->kegiatan_seminggu == 'Perikanan') selected @endif>
                                                Perikanan </option>
                                            <option value="Peternakan" @if ($dsrt->kegiatan_seminggu == 'Peternakan') selected @endif>
                                                Peternakan </option>
                                            <option value="Kehutanan dan pertanian lainnya"
                                                @if ($dsrt->kegiatan_seminggu == 'Kehutanan dan pertanian lainnya') selected @endif>Kehutanan dan pertanian
                                                lainnya </option>
                                            <option value="Pertambangan dan penggalian"
                                                @if ($dsrt->kegiatan_seminggu == 'Pertambangan dan penggalian') selected @endif>Pertambangan dan
                                                penggalian </option>
                                            <option value="Industri pengolahan"
                                                @if ($dsrt->kegiatan_seminggu == 'Industri pengolahan') selected @endif>Industri pengolahan
                                            </option>
                                            <option value="Pengadaan listrik gas uap/air panas dan udara dingin"
                                                @if ($dsrt->kegiatan_seminggu == 'Pengadaan listrik gas uap/air panas dan udara dingin') selected @endif>Pengadaan listrik gas
                                                uap/air panas dan udara dingin </option>
                                            <option
                                                value="Pengelolaan air pengelolaan air limbah pengelolaan dan daur ulang sampah dan aktivitas remediasi"
                                                @if (
                                                    $dsrt->kegiatan_seminggu ==
                                                        'Pengelolaan air pengelolaan air limbah pengelolaan dan daur ulang sampah dan aktivitas remediasi') selected @endif>Pengelolaan air
                                                pengelolaan air limbah pengelolaan dan daur ulang sampah dan aktivitas
                                                remediasi </option>
                                            <option value="Konstruksi" @if ($dsrt->kegiatan_seminggu == 'Konstruksi') selected @endif>
                                                Konstruksi </option>
                                            <option
                                                value="Perdagangan besar dan eceran reparasi dan perawatan mobil dan sepeda motor"
                                                @if ($dsrt->kegiatan_seminggu == 'Perdagangan besar dan eceran reparasi dan perawatan mobil dan sepeda motor') selected @endif>Perdagangan besar dan
                                                eceran reparasi dan perawatan mobil dan sepeda motor </option>
                                            <option value="Pengangkutan dan pergudangan"
                                                @if ($dsrt->kegiatan_seminggu == 'Pengangkutan dan pergudangan') selected @endif>Pengangkutan dan
                                                pergudangan </option>
                                            <option value="Penyediaan akomodasi dan penyediaan makan minum"
                                                @if ($dsrt->kegiatan_seminggu == 'Penyediaan akomodasi dan penyediaan makan minum') selected @endif>Penyediaan akomodasi dan
                                                penyediaan makan minum </option>
                                            <option value="Informasi dan komunikasi"
                                                @if ($dsrt->kegiatan_seminggu == 'Informasi dan komunikasi') selected @endif>Informasi dan komunikasi
                                            </option>
                                            <option value="Aktivitas keuangan dan asuransi"
                                                @if ($dsrt->kegiatan_seminggu == 'Aktivitas keuangan dan asuransi') selected @endif>Aktivitas keuangan dan
                                                asuransi </option>
                                            <option value="Real estate"
                                                @if ($dsrt->kegiatan_seminggu == 'Real estate') selected @endif>Real estate </option>
                                            <option value="Aktivitas profesional ilmiah dan teknis"
                                                @if ($dsrt->kegiatan_seminggu == 'Aktivitas profesional ilmiah dan teknis') selected @endif>Aktivitas profesional
                                                ilmiah dan teknis </option>
                                            <option
                                                value="Aktivitas penyewaan dan sewa guna tanpa hak opsi ketenagakerjaan agen perjalanan dan penunjang us"
                                                @if (
                                                    $dsrt->kegiatan_seminggu ==
                                                        'Aktivitas penyewaan dan sewa guna tanpa hak opsi ketenagakerjaan agen perjalanan dan penunjang us') selected @endif>Aktivitas penyewaan dan
                                                sewa guna tanpa hak opsi ketenagakerjaan agen perjalanan dan penunjang us
                                            </option>
                                            <option value="Administrasi pemerintahan pertahanan dan jaminan sosial wajib"
                                                @if ($dsrt->kegiatan_seminggu == 'Administrasi pemerintahan pertahanan dan jaminan sosial wajib') selected @endif>Administrasi
                                                pemerintahan pertahanan dan jaminan sosial wajib </option>
                                            <option value="Pendidikan" @if ($dsrt->kegiatan_seminggu == 'Pendidikan') selected @endif>
                                                Pendidikan </option>
                                            <option value="Aktivitas kesehatan manusia dan aktivitas sosial"
                                                @if ($dsrt->kegiatan_seminggu == 'Aktivitas kesehatan manusia dan aktivitas sosial') selected @endif>Aktivitas kesehatan
                                                manusia dan aktivitas sosial </option>
                                            <option value="Kesenian hiburan dan rekreasi"
                                                @if ($dsrt->kegiatan_seminggu == 'Kesenian hiburan dan rekreasi') selected @endif>Kesenian hiburan dan
                                                rekreasi </option>
                                            <option value="Aktivitas jasa lainnya"
                                                @if ($dsrt->kegiatan_seminggu == 'Aktivitas jasa lainnya') selected @endif>Aktivitas jasa lainnya
                                            </option>
                                            <option value="Aktivitas rumah tangga sebagai pemberi kerja"
                                                @if ($dsrt->kegiatan_seminggu == 'Aktivitas rumah tangga sebagai pemberi kerja') selected @endif>Aktivitas rumah tangga
                                                sebagai pemberi kerja </option>
                                            <option
                                                value="Aktivitas badan internasional dan badan ekstra internasional lainnya"
                                                @if ($dsrt->kegiatan_seminggu == 'Aktivitas badan internasional dan badan ekstra internasional lainnya') selected @endif>Aktivitas badan
                                                internasional dan badan ekstra internasional lainnya </option>
                                            <option value="Tidak Bekerja"
                                                @if ($dsrt->kegiatan_seminggu == 'Tidak Bekerja') selected @endif>Tidak Bekerja </option>
                                            <option value="Lainnya" @if ($dsrt->kegiatan_seminggu == 'Lainnya') selected @endif>
                                                Lainnya </option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label">Deskripsi Kegiatan KRT (K Blok.VII
                                            R.706)</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <input type="text" class="form-control bg-transparent "
                                            placeholder="deskripsi_kegiatan" name="deskripsi_kegiatan"
                                            id="deskripsi_kegiatan"
                                            value="{{ old('deskripsi_kegiatan', $dsrt->deskripsi_kegiatan) }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col-5 col-md-3">
                                        <label for="" class="label">Luas Lantai Bangunan Tempat Tinggal</label>
                                    </div>
                                    <div class="col-7 col-md-9">
                                        <input type="number" class="form-control bg-transparent "
                                            placeholder="luas_lantai" name="luas_lantai" id="luas_lantai"
                                            value="{{ old('luas_lantai', $dsrt->luas_lantai) }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="container">
                    <div class="card bg-wheat p-2 text-dark">
                        <h4>Daftar ART</h4>
                        <div class="row">
                            <div class="col">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Pendidikan</th>
                                            <th>Pekerjaan</th>
                                            <th>Pendapatan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dsart as $i => $art)
                                            <tr>
                                                <td>{{ 1 + $i }}</td>
                                                <td>{{ $dsart[$i]->nama_art }}</td>
                                                <td>{{ $dsart[$i]->pendidikan }}</td>
                                                <td>{{ $dsart[$i]->pekerjaan }}</td>
                                                <td>{{ $dsart[$i]->pendapatan }}</td>
                                                <td><button class="btn btn-warning btn_art_edit" data-bs-toggle="modal"
                                                        data-bs-target="#modal_art" data-id="{{ $dsart[$i]->id }}"
                                                        data-nu_art="{{ $dsart[$i]->nu_art }}"
                                                        data-nama_art="{{ $dsart[$i]->nama_art }}"
                                                        data-pendidikan="{{ $dsart[$i]->pendidikan }}"
                                                        data-pekerjaan="{{ $dsart[$i]->pekerjaan }}"
                                                        data-pendapatan="{{ $dsart[$i]->pendapatan }}"
                                                        data-id_bs="{{ $dsart[$i]->id_bs }}"
                                                        data-tahun="{{ $dsart[$i]->tahun }}"
                                                        data-semester="{{ $dsart[$i]->semester }}">
                                                        <i class="bi bi-pencil"></i>
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
        </div>
    </div>

    <div class="footer2 d-flex justify-content-center">
        <table>
            <tr>
                <td>
                    <a href="{{ url('pcl_pemeriksaan_dsrt/') . '/' . $dsrt->id_bs }}" class="btn btn-gray border-0">
                        Batal</a>
                </td>
                <td><button type="submit" class="btn btn-primary border-0" form="form_pemeriksaan"> Simpan</button></td>
            </tr>

        </table>
    </div>

    <div class="modal fade" id="modal_art" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-wheat">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit ART</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('pcl_pemeriksaan_dsart/') }}" id="form_pemeriksaan_art" method="POST">
                        @csrf
                        <input type="text" name="id" value="{{ $dsrt->id }}" hidden>
                        <input type="text" name="id_bs" value="{{ $dsrt->id_bs }}" hidden>
                        <input type="text" name="tahun" value="{{ $dsrt->tahun }}" hidden>
                        <input type="text" name="semester" value="{{ $dsrt->semester }}" hidden>
                        <input type="text" name="nu_rt" value="{{ $dsrt->nu_rt }}" hidden>
                        <div class="form-group mb-0 p-2">
                            <div class="row d-flex align-items-center">
                                <div class="col-5 col-md-3">
                                    <label for="" class="label mb-0">No Urut ART</label>
                                </div>
                                <div class="col-7 col-md-9">
                                    <input type="text" class="form-control" placeholder="nu_art" name="nu_art"
                                        id="nu_art" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0 p-2">
                            <div class="row d-flex align-items-center">
                                <div class="col-5 col-md-3">
                                    <label for="" class="label mb-0">Nama Art</label>
                                </div>
                                <div class="col-7 col-md-9">
                                    <input type="text" class="form-control bg-transparent" placeholder="nama_art"
                                        name="nama_art" id="nama_art">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0 p-2">
                            <div class="row d-flex align-items-center">
                                <div class="col-5 col-md-3">
                                    <label for="" class="label mb-0">Pendidikan Art</label>
                                </div>
                                <div class="col-7 col-md-9">
                                    <select name="pendidikan" id="pendidikan" class="form-select bg-transparent">
                                        <option value="">Pilih Pendidikan</option>
                                        <option value="Paket A">Paket A </option>
                                        <option value="SDLB">SDLB </option>
                                        <option value="SD">SD </option>
                                        <option value="MI">MI </option>
                                        <option value="Paket B">Paket B </option>
                                        <option value="SMP LB">SMP LB </option>
                                        <option value="SMP">SMP </option>
                                        <option value="MTS">MTS </option>
                                        <option value="Paket C">Paket C </option>
                                        <option value="SMA LB">SMA LB </option>
                                        <option value="SMA">SMA </option>
                                        <option value="MA">MA </option>
                                        <option value="SMK">SMK </option>
                                        <option value="MAK">MAK </option>
                                        <option value="D1/D2">D1/D2 </option>
                                        <option value="D3">D3 </option>
                                        <option value="D4">D4 </option>
                                        <option value="S1">S1 </option>
                                        <option value="Profesi">Profesi </option>
                                        <option value="S2">S2 </option>
                                        <option value="S3">S3 </option>
                                        <option value="Tidak Punya Ijazah SD">Tidak Punya Ijazah SD </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0 p-2">
                            <div class="row d-flex align-items-center">
                                <div class="col-5 col-md-3">
                                    <label for="" class="label mb-0">Pekerjaan Art</label>
                                </div>
                                <div class="col-7 col-md-9">
                                    <select name="pekerjaan" id="pekerjaan" class="form-select bg-transparent">
                                        <option value="">Pilih Kegiatan</option>
                                        <option value="Pertanian tanaman padi dan palawija">Pertanian tanaman padi dan
                                            palawija
                                        </option>
                                        <option value="Holtikultura">Holtikultura </option>
                                        <option value="Perkebunan">Perkebunan </option>
                                        <option value="Perikanan">Perikanan </option>
                                        <option value="Peternakan">Peternakan </option>
                                        <option value="Kehutanan dan pertanian lainnya">Kehutanan dan pertanian lainnya
                                        </option>
                                        <option value="Pertambangan dan penggalian">Pertambangan dan penggalian </option>
                                        <option value="Industri pengolahan">Industri pengolahan </option>
                                        <option value="Pengadaan listrik gas uap/air panas dan udara dingin">Pengadaan
                                            listrik gas uap/air panas dan udara dingin </option>
                                        <option
                                            value="Pengelolaan air pengelolaan air limbah pengelolaan dan daur ulang sampah dan aktivitas remediasi">
                                            Pengelolaan air pengelolaan air limbah pengelolaan dan daur ulang sampah dan
                                            aktivitas remediasi </option>
                                        <option value="Konstruksi">Konstruksi </option>
                                        <option
                                            value="Perdagangan besar dan eceran reparasi dan perawatan mobil dan sepeda motor">
                                            Perdagangan besar dan eceran reparasi dan perawatan mobil dan sepeda motor
                                        </option>
                                        <option value="Pengangkutan dan pergudangan">Pengangkutan dan pergudangan </option>
                                        <option value="Penyediaan akomodasi dan penyediaan makan minum">Penyediaan
                                            akomodasi dan penyediaan makan minum </option>
                                        <option value="Informasi dan komunikasi">Informasi dan komunikasi </option>
                                        <option value="Aktivitas keuangan dan asuransi">Aktivitas keuangan dan asuransi
                                        </option>
                                        <option value="Real estate">Real estate </option>
                                        <option value="Aktivitas profesional ilmiah dan teknis">Aktivitas profesional
                                            ilmiah dan teknis </option>
                                        <option
                                            value="Aktivitas penyewaan dan sewa guna tanpa hak opsi ketenagakerjaan agen perjalanan dan penunjang us">
                                            Aktivitas penyewaan dan sewa guna tanpa hak opsi ketenagakerjaan agen perjalanan
                                            dan penunjang us </option>
                                        <option value="Administrasi pemerintahan pertahanan dan jaminan sosial wajib">
                                            Administrasi pemerintahan pertahanan dan jaminan sosial wajib </option>
                                        <option value="Pendidikan">Pendidikan </option>
                                        <option value="Aktivitas kesehatan manusia dan aktivitas sosial">Aktivitas
                                            kesehatan manusia dan aktivitas sosial </option>
                                        <option value="Kesenian hiburan dan rekreasi">Kesenian hiburan dan rekreasi
                                        </option>
                                        <option value="Aktivitas jasa lainnya">Aktivitas jasa lainnya </option>
                                        <option value="Aktivitas rumah tangga sebagai pemberi kerja">Aktivitas rumah tangga
                                            sebagai pemberi kerja </option>
                                        <option
                                            value="Aktivitas badan internasional dan badan ekstra internasional lainnya">
                                            Aktivitas badan internasional dan badan ekstra internasional lainnya </option>
                                        <option value="Tidak Bekerja">Tidak Bekerja </option>
                                        <option value="Lainnya">Lainnya </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0 p-2">
                            <div class="row d-flex align-items-center">
                                <div class="col-5 col-md-3">
                                    <label for="" class="label mb-0">Pendapatan ART</label>
                                </div>
                                <div class="col-7 col-md-9">
                                    <input type="text" class="form-control bg-transparent" placeholder="pendapatan"
                                        name="pendapatan" id="pendapatan">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-gray" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="form_pemeriksaan_art">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <script>
        $('.btn_art_edit').click(function() {
            // console.log('a')
            $('#form_pemeriksaan_art').find('#nu_art').val($(this).data('nu_art'))
            $('#form_pemeriksaan_art').find('#nama_art').val($(this).data('nama_art'))
            $('#form_pemeriksaan_art').find('#pendidikan').val($(this).data('pendidikan'))
            $('#form_pemeriksaan_art').find('#pekerjaan').val($(this).data('pekerjaan'))
            $('#form_pemeriksaan_art').find('#pendapatan').val($(this).data('pendapatan'))
        })
        $("#makanan_sebulan").keyup(function() {
            $("#makanan_sebulan").val(formatRupiah($("#makanan_sebulan").val(), 'Rp. '));
        });
        $("#nonmakanan_sebulan").keyup(function() {
            $("#nonmakanan_sebulan").val(formatRupiah($("#nonmakanan_sebulan").val(), 'Rp. '));
        });

        $("#transportasi").keyup(function() {
            $("#transportasi").val(formatRupiah($("#transportasi").val(), 'Rp. '));
        });
        $("#peliharaan").keyup(function() {
            $("#peliharaan").val(formatRupiah($("#peliharaan").val(), 'Rp. '));
        });
        $('#form_pemeriksaan_art').find('#pendapatan').keyup(function() {
            $('#form_pemeriksaan_art').find('#pendapatan').val(formatRupiah($('#form_pemeriksaan_art').find(
                '#pendapatan').val(), 'Rp. '));
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endsection
