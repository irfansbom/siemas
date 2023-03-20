<?php

namespace App\Http\Controllers;

use App\Models\Dsart;
use App\Models\Dsbs;
use App\Models\Dsrt;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PclController extends Controller
{
    public function dashboard()
    {
        $auth = Auth::user();
        return view('pencacah.dashboard', compact('auth'));
    }
    public function pcl_pencacahan_dsbs()
    {
        $auth = Auth::user();
        $periode = Periode::first();
        $dsbs = Dsbs::where('pencacah', $auth->email)->where('tahun', $periode->tahun)->where('semester', $periode->semester)->get();
        return view("pencacah.pencacahan_dsbs", compact('auth', 'dsbs'));
    }
    public function pcl_pencacahan_dsrt($id)
    {
        $auth = Auth::user();

        $periode = Periode::first();
        $dsrt = Dsrt::where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('id_bs', $id)
            ->get();

        // dd($dsrt);
        return view("pencacah.pencacahan_dsrt", compact('auth', 'dsrt'));
    }
    public function pcl_pencacahan_ruta($id)
    {
        $auth = Auth::user();

        $periode = Periode::first();
        $dsrt = Dsrt::find($id);
        // dd($dsbs);
        return view("pencacah.pencacahan_ruta", compact('id', 'auth', 'dsrt'));
    }
    public function pcl_pencacahan_ruta_update($id, Request $request)
    {
        $auth = Auth::user();
        $periode = Periode::first();
        $dsrt = Dsrt::find($id);
        $dsrt->nama_krt2 = $request->nama_krt2;
        $dsrt->jml_art2 = $request->jml_art2;
        $dsrt->status_rumah = $request->status_rumah;
        $dsrt->makanan_sebulan = $request->makanan_sebulan;
        $dsrt->nonmakanan_sebulan = $request->nonmakanan_sebulan;
        $dsrt->gsmp = $request->gsmp;
        $dsrt->gsmp_desk = $request->gsmp_desk;
        $file = $request->file('foto');

        if ($request->hasFile('foto')) {
            $nama_foto = "foto_rumah_" . $dsrt->id_bs . "_" . $dsrt->nks . "_" . $dsrt->nu_rt . "_" . $file->getClientOriginalName();
            $file->move('foto', $nama_foto);
            $dsrt->foto = $nama_foto;
        }

        $dsrt->status_pencacahan = 1;
        $dsrt->save();

        for ($i = 1; $i <= $request->jml_art2; $i++) {
            Dsart::updateOrCreate(
                [
                    'kd_kab' => substr($request->id_bs, 2, 2),
                    'id_bs' => $dsrt->id_bs,
                    'tahun' => $dsrt->tahun,
                    'semester' => $dsrt->semester,
                    'nu_rt' => $dsrt->nu_rt,
                    'nu_art' => $i,
                ],
                [
                    'nama_art' => $request->nama_art,
                    'pendidikan' => $request->pendidikan,
                    'pekerjaan' => $request->pekerjaan,
                    'pendapatan' => $request->pendapatan,
                ]
            );
        }

        return redirect('pcl_pencacahan_ruta' . '/' . $id)->with('success', "Berhasil Disimpan");
    }
    public function pcl_pemeriksaan_dsbs()
    {
        $auth = Auth::user();

        $periode = Periode::first();
        $dsbs = Dsbs::where('pencacah', $auth->email)->where('tahun', $periode->tahun)->where('semester', $periode->semester)->get();
        // dd($dsbs);
        return view("pencacah.pemeriksaan_dsbs", compact('auth', 'dsbs'));
    }
    public function pcl_pemeriksaan_dsrt($id)
    {
        $auth = Auth::user();
        $periode = Periode::first();
        $dsrt = Dsrt::where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('id_bs', $id)
            ->get();
        // dd($dsbs);
        return view("pencacah.pemeriksaan_dsrt", compact('auth', 'dsrt'));
    }
    public function pcl_pemeriksaan_ruta($id)
    {
        $auth = Auth::user();

        $periode = Periode::first();
        $dsrt = Dsrt::find($id);
        $dsart = Dsart::where('tahun', $dsrt->tahun)
            ->where('semester', $dsrt->semester)
            ->where('id_bs', $dsrt->id_bs)
            ->where('nu_rt', $dsrt->nu_rt)
            ->orderby('nu_art')
            ->get();
        // dd($dsbs);
        // dd($dsart);
        return view("pencacah.pemeriksaan_ruta", compact('id', 'auth', 'dsrt', 'dsart'));
    }
    public function pcl_pemeriksaan_ruta_update($id, Request $request)
    {
        $auth = Auth::user();
        $periode = Periode::first();
        $dsrt = Dsrt::find($id);
        // dd($request->all());
        $dsrt->jml_komoditas_makanan = $request->jml_komoditas_makanan;
        $dsrt->jml_komoditas_nonmakanan = $request->jml_komoditas_nonmakanan;
        $dsrt->makanan_sebulan = $request->makanan_sebulan;
        $dsrt->nonmakanan_sebulan = $request->nonmakanan_sebulan;
        $dsrt->transportasi = $request->transportasi;
        $dsrt->peliharaan = $request->peliharaan;
        $dsrt->art_sekolah = $request->art_sekolah;
        $dsrt->art_bpjs = $request->art_bpjs;
        if ($request->ijazah_krt) {
            $dsrt->ijazah_krt = $request->ijazah_krt;
        }
        if ($request->kegiatan_seminggu) {
            $dsrt->kegiatan_seminggu = $request->kegiatan_seminggu;
        }
        $dsrt->deskripsi_kegiatan = $request->deskripsi_kegiatan;
        $dsrt->luas_lantai = $request->luas_lantai;
        $dsrt->status_pencacahan = 4;
        $dsrt->save();
        return redirect('pcl_pemeriksaan_ruta' . '/' . $id)->with('success', "Berhasil Disimpan");
    }
    public function pcl_pemeriksaan_dsart_update(Request $request)
    {
        // dump($request->all());

        $dsart = Dsart::where('id_bs', $request->id_bs)
            ->where('tahun', $request->tahun)
            ->where('semester', $request->semester)
            ->where('nu_rt', $request->nu_rt)
            ->where('nu_art', $request->nu_art)
            ->first();

        $dsart->nama_art = $request->nama_art;
        $dsart->pendidikan = $request->pendidikan;
        $dsart->pekerjaan = $request->pekerjaan;
        $dsart->pendapatan = $request->pendapatan;
        $dsart->save();
        return redirect('pcl_pemeriksaan_ruta' . '/' . $request->id)->with('success', "Berhasil Disimpan");
    }
}
