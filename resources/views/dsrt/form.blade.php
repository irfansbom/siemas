 <fieldset class="p-5">

     <div class="mb-3 row">
         <label class="col-sm-2 form-label">ID BS</label>
         <div class="col-sm-4">
             <input type="text" class="form-control"
                 value="{{ old('id_bs', '16' . $data->kd_kab . $data->kd_kec . $data->kd_desa . $data->kd_bs) }}"
                 name="id_bs">
         </div>
         <label class="col-sm-2 form-label">NKS</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('nks', $data->nks) }}" name="nks">
         </div>
     </div>
     <div class="mb-3 row">
         <label class="col-sm-2 form-label">Nomor Urut RUTA</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('nu_rt', $data->nu_rt) }}" name="nu_rt">
         </div>
         <label class="col-sm-1 form-label">Tahun</label>
         <div class="col-sm-2">
             <input type="text" class="form-control" value="{{ old('tahun', $data->tahun) }}" name="tahun">
         </div>
         <label class="col-sm-1 form-label">Semester</label>
         <div class="col-sm-2">
             <input type="text" class="form-control" value="{{ old('semester', $data->semester) }}" name="semester">
         </div>
     </div>
     <div class="mb-3 row">
         <label class="col-sm-2 form-label">Nama KRT Prelist</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('nama_krt_prelist', $data->nama_krt_prelist) }}"
                 name="nama_krt_prelist">
         </div>
         <label class="col-sm-2 form-label">Nama KRT Cacah</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('nama_krt_cacah', $data->nama_krt_cacah) }}"
                 name="nama_krt_cacah">
         </div>
     </div>
     <div class="mb-3 row">
         <label class="col-sm-2 form-label">Alamat</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('alamat', $data->alamat) }}" name="alamat">
         </div>
         <label class="col-sm-2 form-label">Jumlah ART Cacah</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('jml_art_cacah', $data->jml_art_cacah) }}"
                 name="jml_art_cacah">
         </div>
     </div>

     <hr>
     <div class="row">
         <div class="col-6">
             <div class="row mb-3">
                 <label class=" col-sm-4 form-label">Status Pencacahan</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control"
                         value="{{ old('status_pencacahan', $data->status_pencacahan) }}" name="status_pencacahan">
                 </div>
             </div>

             <div class="row mb-3">

             </div>
         </div>
         <div class="col-6">
             <div class="row mb-3">
                 <label class="col-sm-4 form-label">Status Rumah</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control" value="{{ old('status_rumah', $data->status_rumah) }}"
                         name="status_rumah">
                 </div>
             </div>
             <div class="row mb-3">
                 <label class="col-sm-4 form-label">Luas Lantai</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control" value="{{ old('luas_lantai', $data->luas_lantai) }}"
                         name="luas_lantai">
                 </div>
             </div>
         </div>
     </div>

     <hr>
     <div class="row">
         <div class="col-6">
             <div class="row mb-3">
                 <label class="col-sm-4 form-label">Makanan Sebulan</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control"
                         value="{{ old('makanan_sebulan', $data->makanan_sebulan) }}" name="makanan_sebulan">
                 </div>
             </div>
             <div class="row mb-3">
                 <label class="col-sm-4 form-label">NonMakanan Sebulan</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control"
                         value="{{ old('nonmakanan_sebulan', $data->nonmakanan_sebulan) }}" name="nonmakanan_sebulan">
                 </div>
             </div>
         </div>

         <div class="col-6">
             <div class="row mb-3">
                 <label class="col-sm-4 form-label">Makanan Sebulan By PML</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control"
                         value="{{ old('makanan_sebulan_bypml', $data->makanan_sebulan_bypml) }}"
                         name="makanan_sebulan_bypml">
                 </div>
             </div>
             <div class="row mb-3">
                 <label class="col-sm-4 form-label">NonMakanan Sebulan PML</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control"
                         value="{{ old('nonmakanan_sebulan_bypml', $data->nonmakanan_sebulan_bypml) }}"
                         name="nonmakanan_sebulan_bypml">
                 </div>
             </div>

             <div class="row mb-3">
                 <label class="col-sm-4 form-label">Transportasi</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control"
                         value="{{ old('transportasi', $data->transportasi) }}" name="transportasi">
                 </div>
             </div>

             <div class="row mb-3">
                 <label class="col-sm-4 form-label">Peliharaan</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control" value="{{ old('peliharaan', $data->peliharaan) }}"
                         name="peliharaan">
                 </div>
             </div>
         </div>
     </div>

     <hr>
     <div class="row">
         <div class="col-6">
             <div class="row mb-3">
                 <label class="col-sm-4 form-label">ART Sekolah</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control" value="{{ old('art_sekolah', $data->art_sekolah) }}"
                         name="art_sekolah">
                 </div>
             </div>
             <div class="row mb-3">
                 <label class="col-sm-4 form-label">ART BPJS</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control" value="{{ old('art_bpjs', $data->art_bpjs) }}"
                         name="art_bpjs">
                 </div>
             </div>
             <div class="row mb-3">
                 <label class="col-sm-4 form-label">Keikutsertaan Gerakan Sumsel Mandiri Pangan</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control" value="{{ old('gsmp', $data->gsmp) }}"
                         name="gsmp">
                 </div>
             </div>
             <div class="row mb-3">
                 <label class="col-sm-4 form-label">Yang Diterima dari GSMP</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control" value="{{ old('gsmp_desk', $data->gsmp_desk) }}"
                         name="gsmp_desk">
                 </div>
             </div>
             <div class="row mb-3">
                 <label class="col-sm-4 form-label">Keikutsertaan Bantuan Sosial</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control" value="{{ old('bantuan', $data->bantuan) }}"
                         name="bantuan">
                 </div>
             </div>
             <div class="row mb-3">
                 <label class="col-sm-4 form-label">Yang Diterima dari Bantuan Sosial</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control" value="{{ old('bantuan_desk', $data->bantuan_desk) }}"
                         name="bantuan_desk">
                 </div>
             </div>
             <div class="row mb-3">
                 <label class="col-sm-4 form-label">Harga Pembelian Token Listrik/Pembayaran Listrik Pascabayar</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control" value="{{ old('listrik_harga', $data->listrik_harga) }}"
                         name="listrik_harga">
                 </div>
             </div>
             <div class="row mb-3">
                 <label class="col-sm-4 form-label">Besar kWh Listrik yang Diperoleh</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control" value="{{ old('listrik_kwh', $data->listrik_kwh) }}"
                         name="listrik_kwh">
                 </div>
             </div>
             <div class="row mb-3">
                 <label class="col-sm-4 form-label">Menu Makan Bergizi Gratis yang Paling Disukai</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control" value="{{ old('menu_mbg', $data->menu_mbg) }}"
                         name="menu_mbg">
                 </div>
             </div>
         </div>

         <div class="col-6">
             <div class="row mb-3">
                 <label class="col-sm-4 form-label">Ijazah Krt</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control" value="{{ old('ijazah_krt', $data->ijazah_krt) }}"
                         name="ijazah_krt">
                 </div>
             </div>
             <div class="row mb-3">
                 <label class="col-sm-4 form-label">Kegiatan Seminggu</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control"
                         value="{{ old('kegiatan_seminggu', $data->kegiatan_seminggu) }}" name="kegiatan_seminggu">
                 </div>
             </div>

             <div class="row mb-3">
                 <label class="col-sm-4 form-label">Deskripsi Kegiatan</label>
                 <div class="col-sm-8">
                     <input type="text" class="form-control"
                         value="{{ old('deskripsi_kegiatan', $data->deskripsi_kegiatan) }}"
                         name="deskripsi_kegiatan">
                 </div>
             </div>

         </div>
     </div>

     <hr>
     <div class="mb-3 row">
         <div class="col-6">
             <label class="form-label">Foto</label>
             <div class="col-12 text-center">
                 <img class="br-5 border" src="{{ url('foto') . '/' . $data->foto }}" alt="Belum Ada Foto">
             </div>
         </div>
         <div class="col-6">
             <label class="form-label">Durasi Pencacahan</label>
             <input type="text" class="form-control"
                 value="{{ old('durasi_pencacahan', $data->durasi_pencacahan) }}" name="durasi_pencacahan">
             <div class="row mb-3">
                 <div class="col-md-6">
                     <label class="form-label">Waktu Mulai</label>
                     <input type="text" class="form-control" value="{{ old('jam_mulai', $data->jam_mulai) }}"
                         name="jam_mulai">
                 </div>
                 <div class="col-md-6">
                     <label class="form-label">Waktu Selesai</label>
                     <input type="text" class="form-control" value="{{ old('jam_selesai', $data->jam_selesai) }}"
                         name="jam_selesai">
                 </div>
             </div>
             <label class="form-label">Detail ART</label>
             <table class="table table-bordered">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Nama ART</th>
                         <th>Pendidikan</th>
                         <th>Pekerjaan</th>
                         <th>Pendapatan</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($dsart as $i => $art)
                         <tr>
                             <td>{{ ++$i }}</td>
                             <td>{{ $art->nama_art }}</td>
                             <td>{{ $art->pendidikan }}</td>
                             <td>{{ $art->pekerjaan }}</td>
                             <td>{{ $art->pendapatan }}</td>
                         </tr>
                     @endforeach

                 </tbody>
             </table>
         </div>
     </div>


 </fieldset>
