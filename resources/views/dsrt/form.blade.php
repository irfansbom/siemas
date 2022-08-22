 <fieldset class="p-5">
     <input type="text" name="id" id="id" hidden value="{{ old('id', $data->id) }}">
     <div class="mb-3 row">
         <label class="col-sm-2 form-label">ID BS</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('id_bs', $data->id_bs) }}" name="id_bs">
         </div>
         <label class="col-sm-2 form-label">NKS</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('nks', $data->nks) }}" name="nks">
         </div>
     </div>
     <div class="mb-3 row">
         <label class="col-sm-2 form-label">Nomor Urut RT</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('nu_rt', $data->nu_rt) }}" name="nu_rt">
         </div>
         <label class="col-sm-2 form-label">Semester</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('semester', $data->semester) }}" name="semester">
         </div>
     </div>
     <div class="mb-3 row">
         <label class="col-sm-2 form-label">Nama KRT</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('nama_krt', $data->nama_krt) }}" name="nama_krt">
         </div>
         <label class="col-sm-2 form-label">Nama KRT 2</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('nama_krt2', $data->nama_krt2) }}"
                 name="nama_krt2">
         </div>
     </div>
     <div class="mb-3 row">
         <label class="col-sm-2 form-label">Jumlah Art</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('jml_art', $data->jml_art) }}" name="jml_art">
         </div>
         <label class="col-sm-2 form-label">Jumlah ART 2</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('jml_art2', $data->jml_art2) }}" name="jml_art2">
         </div>
     </div>
     <div class="mb-3 row">
         <label class="col-sm-2 form-label">Alamat</label>
         <div class="col-sm-10">
             <input type="text" class="form-control" value="{{ old('alamat', $data->alamat) }}" name="alamat">
         </div>
     </div>
     <div class="mb-3 row">
         <label class="col-sm-2 form-label">Makanan Sebulan</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('makanan_sebulan', $data->makanan_sebulan) }}"
                 name="makanan_sebulan">
         </div>
         <label class="col-sm-2 form-label">NonMakanan Sebulan</label>
         <div class="col-sm-4">
             <input type="text" class="form-control"
                 value="{{ old('nonmakanan_sebulan', $data->nonmakanan_sebulan) }}" name="nonmakanan_sebulan">
         </div>
     </div>
     <div class="mb-3 row">
         <label class="col-sm-2 form-label">Transportasi</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('transportasi', $data->transportasi) }}"
                 name="transportasi">
         </div>
         <label class="col-sm-2 form-label">Peliharaan</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('peliharaan', $data->peliharaan) }}"
                 name="peliharaan">
         </div>
     </div>
     <div class="mb-3 row">
         <label class="col-sm-2 form-label">ART Sekolah</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('art_sekolah', $data->art_sekolah) }}"
                 name="art_sekolah">
         </div>
         <label class="col-sm-2 form-label">ART BPJS</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('art_bpjs', $data->art_bpjs) }}"
                 name="art_bpjs">
         </div>
     </div>
     <div class="mb-3 row">
         <label class="col-sm-2 form-label">Ijazah Krt</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('ijazah_krt', $data->ijazah_krt) }}"
                 name="ijazah_krt">
         </div>
         <label class="col-sm-2 form-label">Kegiatan Seminggu</label>
         <div class="col-sm-4">
             <input type="text" class="form-control"
                 value="{{ old('kegiatan_seminggu', $data->kegiatan_seminggu) }}" name="kegiatan_seminggu">
         </div>
     </div>
     <div class="mb-3 row">
         <label class="col-sm-2 form-label">Keikutsertaan Gerakan Sumsel Mandiri Pangan</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('gsmp', $data->gsmp) }}" name="gsmp">
         </div>
         <label class="col-sm-2 form-label">Deskripsi Kegiatan</label>
         <div class="col-sm-4">
             <input type="text" class="form-control"
                 value="{{ old('deskripsi_kegiatan', $data->deskripsi_kegiatan) }}" name="deskripsi_kegiatan">
         </div>
     </div>
     <div class="mb-3 row">
         <label class="col-sm-2 form-label">Status Rumah</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('status_rumah', $data->status_rumah) }}"
                 name="status_rumah">
         </div>
         <label class="col-sm-2 form-label">Luas Lantai</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" value="{{ old('luas_lantai', $data->luas_lantai) }}"
                 name="luas_lantai">
         </div>
     </div>
     <div class="mb-3 row">
         <div class="col-6">
             <label class="form-label">Foto</label>
             <div class="col-12 text-center"> <img class="br-5 border" src="{{ url('foto') . '/' . $data->foto }}"
                     alt="Belum Ada Foto"></div>

         </div>
         <div class="col-6">
             <label class="form-label">Status Pencacahan</label>
             <input type="text" class="form-control"
                 value="{{ old('status_pencacahan', $data->status_pencacahan) }}" name="status_pencacahan">
             <label class="form-label">Lama Pencacahan</label>
             <input type="text" class="form-control" value="{{ old('lama_pencacahan', $data->lama_pencacahan) }}"
                 name="lama_pencacahan">
         </div>
     </div>
     {{-- <div class="d-grid gap-2 d-md-flex justify-content-md-end">
         <button class="btn btn-primary" type="submit" id="simpanbtn">simpan</button>
     </div> --}}
 </fieldset>
