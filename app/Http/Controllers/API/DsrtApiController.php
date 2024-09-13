<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dsbs;
use App\Models\Dsrt;
use App\Models\Desas;
use App\Models\Jadwal212;
use App\Models\Laporan212;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DsrtApiController extends Controller
{
    //
    public function get_alokasi_dsrt_pcl(Request $request)
    {

        $periode = Periode::get()->first();
        $dsbs = Dsbs::select('id_bs')->where('pencacah', $request->pencacah)
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->get()
            ->toArray();

        $kd_kab = Dsbs::select('kd_kab')->where('pencacah', $request->pencacah)
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->get()->first();
        $desas_in_kab = Desas::select()->where('id_kab', $kd_kab->kd_kab);

        $data_dsrt = Dsrt::wherein('dsrt.id_bs', $dsbs)
            ->join('dsbs', function ($join) {
                $join->on('dsrt.id_bs', 'dsbs.id_bs');
            })
            ->join('kabs', function ($join) {
                $join->on('dsbs.kd_kab', 'kabs.id_kab');
            })
            ->join('kecs', function ($join) {
                $join->on('dsbs.kd_kab', 'kecs.id_kab')->on('dsbs.kd_kec', 'kecs.id_kec');
            })
            ->joinSub($desas_in_kab, 'desas', function ($join) {
                $join->on('dsbs.kd_kab', 'desas.id_kab')->on('dsbs.kd_kec', 'desas.id_kec')->on('dsbs.kd_desa', 'desas.id_desa');
            })
            ->select(
                "dsrt.id",
                "dsrt.tahun",
                "dsrt.semester",
                "dsrt.kd_kab",
                "kabs.nama_kab",
                "dsrt.kd_kec",
                "kecs.nama_kec",
                "dsrt.kd_desa",
                "desas.nama_desa",
                'dsrt.kd_bs',
                'dsrt.id_bs',
                "dsrt.nu_rt",
                "dsrt.nks",
                "dsrt.status_pencacahan",
                "dsrt.nama_krt_prelist",
                "dsrt.jml_art_prelist",
                "dsrt.nama_krt_cacah",
                "dsrt.jml_art_cacah",
                "dsrt.status_rumah",
                "dsrt.jml_komoditas_makanan",
                "dsrt.jml_komoditas_nonmakanan",
                "dsrt.makanan_sebulan",
                "dsrt.nonmakanan_sebulan",
                "dsrt.makanan_sebulan_bypml",
                "dsrt.nonmakanan_sebulan_bypml",
                "dsrt.transportasi",
                "dsrt.peliharaan",
                "dsrt.art_sekolah",
                "dsrt.art_bpjs",
                "dsrt.ijazah_krt",
                "dsrt.kegiatan_seminggu",
                "dsrt.deskripsi_kegiatan",
                "dsrt.luas_lantai",
                "dsrt.gsmp",
                "dsrt.gsmp_desk",
                "dsrt.bantuan",
                "dsrt.bantuan_desk",
                "dsrt.foto",
                "dsrt.latitude",
                "dsrt.longitude",
                "dsrt.latitude_selesai",
                "dsrt.longitude_selesai",
                "dsrt.jam_mulai",
                "dsrt.jam_selesai",
                "dsrt.durasi_pencacahan",
                "dsrt.pencacah",
                "dsrt.pengawas",
            )
            ->get()->toArray();

        if (!$data_dsrt) {
            $json = [
                'message' => 'DSRT Belum Dialokasikan',
                'status' => '0'
            ];
            return  response()->json($json, 200);
        } else {
            $json = [
                'message' => 'success',
                'body' => $data_dsrt,
                'status' => '1'
            ];
            return  response()->json($json, 200);
        }
    }

    public function get_alokasi_dsrt_pml(Request $request)
    {
        $periode = Periode::get()->first();
        $dsbs = Dsbs::select('id_bs')->where('pengawas', $request->pengawas)
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->get()->toArray();

        $kd_kab = Dsbs::select('kd_kab')->where('pengawas', $request->pengawas)
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->get()->first();
        $desas_in_kab = Desas::select()->where('id_kab', $kd_kab->kd_kab);

        $data_dsrt = Dsrt::wherein('dsrt.id_bs', $dsbs)
            ->join('dsbs', function ($join) {
                $join->on('dsrt.id_bs', 'dsbs.id_bs');
            })
            ->join('kabs', function ($join) {
                $join->on('dsbs.kd_kab', 'kabs.id_kab');
            })
            ->join('kecs', function ($join) {
                $join->on('dsbs.kd_kab', 'kecs.id_kab')->on('dsbs.kd_kec', 'kecs.id_kec');
            })
            ->joinSub($desas_in_kab, 'desas', function ($join) {
                $join->on('dsbs.kd_kab', 'desas.id_kab')->on('dsbs.kd_kec', 'desas.id_kec')->on('dsbs.kd_desa', 'desas.id_desa');
            })
            ->select(
                "dsrt.id",
                "dsrt.tahun",
                "dsrt.semester",
                "dsrt.kd_kab",
                "kabs.nama_kab",
                "dsrt.kd_kec",
                "kecs.nama_kec",
                "dsrt.kd_desa",
                "desas.nama_desa",
                'dsrt.kd_bs',
                'dsrt.id_bs',
                "dsrt.nu_rt",
                "dsrt.nks",
                "dsrt.status_pencacahan",
                "dsrt.nama_krt_prelist",
                "dsrt.jml_art_prelist",
                "dsrt.nama_krt_cacah",
                "dsrt.jml_art_cacah",
                "dsrt.status_rumah",
                "dsrt.jml_komoditas_makanan",
                "dsrt.jml_komoditas_nonmakanan",
                "dsrt.makanan_sebulan",
                "dsrt.nonmakanan_sebulan",
                "dsrt.makanan_sebulan_bypml",
                "dsrt.nonmakanan_sebulan_bypml",
                "dsrt.transportasi",
                "dsrt.peliharaan",
                "dsrt.art_sekolah",
                "dsrt.art_bpjs",
                "dsrt.ijazah_krt",
                "dsrt.kegiatan_seminggu",
                "dsrt.deskripsi_kegiatan",
                "dsrt.luas_lantai",
                "dsrt.gsmp",
                "dsrt.gsmp_desk",
                "dsrt.bantuan",
                "dsrt.bantuan_desk",
                "dsrt.foto",
                "dsrt.latitude",
                "dsrt.longitude",
                "dsrt.latitude_selesai",
                "dsrt.longitude_selesai",
                "dsrt.jam_mulai",
                "dsrt.jam_selesai",
                "dsrt.durasi_pencacahan",
                "dsrt.pencacah",
                "dsrt.pengawas",
            )
            ->get()->toArray();

        if (!$data_dsrt) {
            $json = [
                'message' => 'DSRT Belum Dialokasikan',
                'status' => '0'
            ];
            return  response()->json($json, 200);
        } else {
            $json = [
                'message' => 'success',
                'body' => $data_dsrt,
                'status' => '1'
            ];
            return  response()->json($json, 200);
        }
    }

    public function update_dsrt(Request $request)
    {
        $data_dsrt = json_decode($request->dsrt);

        $status_pencacahan = $data_dsrt->status_pencacahan;

        if ($status_pencacahan == 4) {
            $status_pencacahan = $status_pencacahan;
        } elseif ($status_pencacahan == 6) {
            $status_pencacahan = $status_pencacahan;
        } else {
            $status_pencacahan = $status_pencacahan + 1;
        }

        $latitude_selesai = null;
        $longitude_selesai = null;
        $jam_mulai = null;
        $jam_selesai = null;

        try {
            //code...
            $latitude_selesai = $data_dsrt->latitude_selesai;
            $longitude_selesai = $data_dsrt->longitude_selesai;
            $jam_mulai = $data_dsrt->jam_mulai;
            $jam_selesai = $data_dsrt->jam_selesai;
        } catch (\Throwable $th) {
            //throw $th;
        }


        // if ($data_dsrt->latitude_selesai) {
        //     $latitude_selesai = $data_dsrt->latitude_selesai;
        // }

        // if ($data_dsrt->longitude_selesai) {
        //     $longitude_selesai = $data_dsrt->longitude_selesai;
        // }

        // if ($data_dsrt->jam_mulai) {
        //     $jam_mulai = $data_dsrt->jam_mulai;
        // }

        // if ($data_dsrt->jam_selesai) {
        //     $jam_selesai = $data_dsrt->jam_selesai;
        // }



        $affectedDsrt = Dsrt::updateOrCreate(
            [
                'id' => $data_dsrt->id
            ],
            [
                'nama_krt_cacah' => $data_dsrt->nama_krt_cacah,
                'jml_art_cacah' => $data_dsrt->jml_art_cacah,
                'status_rumah' => $data_dsrt->status_rumah,
                'jml_komoditas_makanan' => $data_dsrt->jml_komoditas_makanan,
                'jml_komoditas_nonmakanan' => $data_dsrt->jml_komoditas_nonmakanan,
                'makanan_sebulan' => $data_dsrt->makanan_sebulan,
                'nonmakanan_sebulan' => $data_dsrt->nonmakanan_sebulan,
                'makanan_sebulan_bypml' => $data_dsrt->makanan_sebulan_bypml,
                'nonmakanan_sebulan_bypml' => $data_dsrt->nonmakanan_sebulan_bypml,
                'gsmp' => $data_dsrt->gsmp,
                'gsmp_desk' => $data_dsrt->gsmp_desk,
                'bantuan' => $data_dsrt->bantuan,
                'bantuan_desk' => $data_dsrt->bantuan_desk,
                'latitude' => $data_dsrt->latitude,
                'longitude' => $data_dsrt->longitude,
                'latitude_selesai' => $latitude_selesai,
                'longitude_selesai' => $longitude_selesai,
                'transportasi' => $data_dsrt->transportasi,
                'peliharaan' => $data_dsrt->peliharaan,
                'art_sekolah' => $data_dsrt->art_sekolah,
                'art_bpjs' => $data_dsrt->art_bpjs,
                'ijazah_krt' => $data_dsrt->ijazah_krt,
                'kegiatan_seminggu' => $data_dsrt->kegiatan_seminggu,
                'deskripsi_kegiatan' => $data_dsrt->deskripsi_kegiatan,
                'luas_lantai' => $data_dsrt->luas_lantai,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
                'durasi_pencacahan' => $data_dsrt->durasi_pencacahan,
                // 'foto_base64' => $data_dsrt->foto_base64,
                'status_pencacahan' => $status_pencacahan,
            ]
        );

        $file = $request->file('file_foto');
        $id_dsrt = $data_dsrt->id;
        // $dsrt = Dsrt::find($id_dsrt);

        if ($file) {
            $nama_foto = "foto_rumah_" . $data_dsrt->id_bs . "_" . $data_dsrt->nu_rt . "_" . $data_dsrt->nama_krt_cacah . ".png";
            $file->move('foto', $nama_foto);
            Dsrt::where("id", $id_dsrt)->update(['foto' => $nama_foto]);
        }
        // else {
        //     $nama_foto = $request->foto;
        // };

        if (($affectedDsrt)) {
            $json = [
                'message' => 'success',
                'status' => '1'
            ];
            return response()->json($json, 200);
        }
    }

    public function upload_foto(Request $request)
    {
        $file = $request->file('file_foto');
        $id_dsrt = $request->id_dsrt;
        $dsrt = Dsrt::find($id_dsrt);
        if ($file) {
            $nama_foto = "foto_rumah_" . $dsrt->id_bs . "_" . $dsrt->nks . "_" . $dsrt->nu_rt . ".png";
            $file->move('foto', $nama_foto);
        } else {
            $nama_foto = $request->foto;
        };

        $affectedRows = Dsrt::where("id", $id_dsrt)->update(['foto' => $nama_foto]);
        if ($affectedRows > 0) {
            $json = [
                'message' => 'success',
                'status' => 1,
            ];
            return response()->json($json, 200);
        }
    }

    public function upload_data(Request $request)
    {
        $file = $request->file('file_foto');
        $data_dsrt = json_decode($request->dsrt);
        if ($file) {
            $nama_foto = "foto_rumah_" . $data_dsrt->id_bs . "_" . $data_dsrt->nks . "_" . $data_dsrt->nu_rt . ".png";
            $file->move('foto', $nama_foto);
        } else {
            $nama_foto = $request->foto;
        }
        $status_pencacahan = $data_dsrt->status_pencacahan;

        if ($status_pencacahan == 4) {
            $status_pencacahan = $status_pencacahan;
        } elseif ($status_pencacahan == 6) {
            $status_pencacahan = $status_pencacahan;
        } else {
            $status_pencacahan = $status_pencacahan + 1;
        }

        $latitude_selesai = null;
        $longitude_selesai = null;
        $jam_mulai = null;
        $jam_selesai = null;


        if ($data_dsrt->latitude_selesai) {
            $latitude_selesai = $data_dsrt->latitude_selesai;
        }

        if ($data_dsrt->longitude_selesai) {
            $longitude_selesai = $data_dsrt->longitude_selesai;
        }

        if ($data_dsrt->jam_mulai) {
            $jam_mulai = $data_dsrt->jam_mulai;
        }

        if ($data_dsrt->jam_selesai) {
            $jam_selesai = $data_dsrt->jam_selesai;
        }


        $affectedDsrt = Dsrt::updateOrCreate(
            [
                'id' => $data_dsrt->id
            ],
            [
                'nama_krt_cacah' => $data_dsrt->nama_krt_cacah,
                'jml_art_cacah' => $data_dsrt->jml_art_cacah,
                'status_rumah' => $data_dsrt->status_rumah,
                'jml_komoditas_makanan' => $data_dsrt->jml_komoditas_makanan,
                'jml_komoditas_nonmakanan' => $data_dsrt->jml_komoditas_nonmakanan,
                'makanan_sebulan' => $data_dsrt->makanan_sebulan,
                'nonmakanan_sebulan' => $data_dsrt->nonmakanan_sebulan,
                'makanan_sebulan_bypml' => $data_dsrt->makanan_sebulan_bypml,
                'nonmakanan_sebulan_bypml' => $data_dsrt->nonmakanan_sebulan_bypml,
                'gsmp' => $data_dsrt->gsmp,
                'gsmp_desk' => $data_dsrt->gsmp_desk,
                'bantuan' => $data_dsrt->bantuan,
                'bantuan_desk' => $data_dsrt->bantuan_desk,
                'latitude' => $data_dsrt->latitude,
                'longitude' => $data_dsrt->longitude,
                'latitude_selesai' => $data_dsrt->latitude_selesai,
                'longitude_selesai' => $data_dsrt->longitude_selesai,
                'transportasi' => $data_dsrt->transportasi,
                'peliharaan' => $data_dsrt->peliharaan,
                'art_sekolah' => $data_dsrt->art_sekolah,
                'art_bpjs' => $data_dsrt->art_bpjs,
                'ijazah_krt' => $data_dsrt->ijazah_krt,
                'kegiatan_seminggu' => $data_dsrt->kegiatan_seminggu,
                'deskripsi_kegiatan' => $data_dsrt->deskripsi_kegiatan,
                'luas_lantai' => $data_dsrt->luas_lantai,
                'jam_mulai' => $data_dsrt->jam_mulai,
                'jam_selesai' => $data_dsrt->jam_selesai,
                'durasi_pencacahan' => $data_dsrt->durasi_pencacahan,
                'status_pencacahan' => $status_pencacahan,
                'foto' => $nama_foto,
            ]
        );
        if (($affectedDsrt)) {
            $json = [
                'message' => 'success',
                'status' => '1'
            ];
            return response()->json($json, 200);
        }
    }

    public function upload_data_form(Request $request)
    {
        $file = $request->file('file_foto');
        $data_dsrt = json_decode($request->dsrt);

        $nama_foto = "foto_rumah_" . $data_dsrt->id_bs . "_" . $data_dsrt->nks . "_" . $data_dsrt->nu_rt . "_" . $file->getClientOriginalName();
        $file->move('foto', $nama_foto);

        $status_pencacahan = $data_dsrt->status_pencacahan;

        if ($status_pencacahan == 4) {
            $status_pencacahan = $status_pencacahan;
        } elseif ($status_pencacahan == 6) {
            $status_pencacahan = $status_pencacahan;
        } else {
            $status_pencacahan = $status_pencacahan + 1;
        }

        $latitude_selesai = null;
        $longitude_selesai = null;
        $jam_mulai = null;
        $jam_selesai = null;


        if ($data_dsrt->latitude_selesai) {
            $latitude_selesai = $data_dsrt->latitude_selesai;
        }

        if ($data_dsrt->longitude_selesai) {
            $longitude_selesai = $data_dsrt->longitude_selesai;
        }

        if ($data_dsrt->jam_mulai) {
            $jam_mulai = $data_dsrt->jam_mulai;
        }

        if ($data_dsrt->jam_selesai) {
            $jam_selesai = $data_dsrt->jam_selesai;
        }


        $affectedDsrt = Dsrt::updateOrCreate(
            [
                'nks' => $data_dsrt->nks,
                'nu_rt' => $data_dsrt->nu_rt
            ],
            [
                'nama_krt_cacah' => $data_dsrt->nama_krt_cacah,
                'jml_art_cacah' => $data_dsrt->jml_art_cacah,
                'status_rumah' => $data_dsrt->status_rumah,
                'makanan_sebulan' => $data_dsrt->makanan_sebulan,
                'nonmakanan_sebulan' => $data_dsrt->nonmakanan_sebulan,
                'gsmp' => $data_dsrt->gsmp,
                'gsmp_desk' => $data_dsrt->gsmp_desk,
                'bantuan' => $data_dsrt->bantuan,
                'bantuan_desk' => $data_dsrt->bantuan_desk,
                'latitude' => $data_dsrt->latitude,
                'longitude' => $data_dsrt->longitude,
                'latitude_selesai' => $data_dsrt->latitude,
                'longitude_selesai' => $data_dsrt->latitude,
                'transportasi' => $data_dsrt->transportasi,
                'peliharaan' => $data_dsrt->peliharaan,
                'art_sekolah' => $data_dsrt->art_sekolah,
                'art_bpjs' => $data_dsrt->art_bpjs,
                'ijazah_krt' => $data_dsrt->ijazah_krt,
                'kegiatan_seminggu' => $data_dsrt->kegiatan_seminggu,
                'deskripsi_kegiatan' => $data_dsrt->deskripsi_kegiatan,
                'luas_lantai' => $data_dsrt->luas_lantai,
                'jam_mulai' => $data_dsrt->jam_mulai,
                'jam_selesai' => $data_dsrt->jam_selesai,
                'durasi_pencacahan' => $data_dsrt->durasi_pencacahan,
                'status_pencacahan' => $status_pencacahan,
                'foto' => $nama_foto,
            ]
        );
        if (($affectedDsrt)) {
            $json = [
                'message' => 'success',
                'status' => '1'
            ];
            return response()->json($json, 200);
        }
    }

    public function get_jadwal()
    {
        $jadwal = Jadwal212::all()->toArray();
        if (!$jadwal) {
            $json = [
                'message' => 'Jadwal 212 belum dialokasikan',
                'status' => '0'
            ];
            return  response()->json($json, 200);
        } else {
            $json = [
                'message' => 'success',
                'body' => $jadwal,
                'status' => '1'
            ];
            return  response()->json($json, 200);
        }
    }

    public function insert_laporan(Request $request)
    {
        $data_laporan = json_decode($request->laporan);

        // dd($data_laporan->tahun);

        // $data= Laporan212::where('id_bs', $data_laporan->id_bs)
        // ->where('tahun', $data_laporan->tahun)
        // ->where('semester', $data_laporan->semester)
        // ->where('nu_rt', $data_laporan->nu_rt)
        // ->first();

        // if($data){
        //     print_r("update");
        //     $affectedRow = Laporan212::where('id_bs', $data_laporan->id_bs)
        //     ->where('tahun', $data_laporan->tahun)
        //     ->where('semester', $data_laporan->semester)
        //     ->where('nu_rt', $data_laporan->nu_rt)->update([
        //         'nks' => $data_laporan->nks,
        //         'nama_krt' => $data_laporan->nama_krt,
        //         'pengawas' => $data_laporan->pengawas,
        //         'tanggal' => $data_laporan->tanggal,
        //         'status' => 2
        //     ]);
        // }else{
        //     print_r("create");
        //     $affectedRow = Laporan212::create([
        //         'id_bs' => $data_laporan->id_bs,
        //         'tahun' => $data_laporan->tahun,
        //         'semester' => $data_laporan->semester,
        //         'nu_rt' => $data_laporan->nu_rt,
        //         'nks' => $data_laporan->nks,
        //         'nama_krt' => $data_laporan->nama_krt,
        //         'pengawas' => $data_laporan->pengawas,
        //         'tanggal' => $data_laporan->tanggal,
        //         'status' => 2
        //     ]);

        // }
        $affectedRow = Laporan212::updateOrCreate(
            [
                'kd_kab' => $data_laporan->kd_kab,
                'kd_kec' => $data_laporan->kd_kec,
                'kd_desa' => $data_laporan->kd_desa,
                'kd_bs' => $data_laporan->kd_bs,
                'tahun' => $data_laporan->tahun,
                'semester' => $data_laporan->semester,
                'nu_rt' => $data_laporan->nu_rt
            ],
            [
                'nks' => $data_laporan->nks,
                'nama_krt' => $data_laporan->nama_krt,
                'pengawas' => $data_laporan->pengawas,
                'tanggal' => $data_laporan->tanggal,
                'status' => 2
            ]
        );

        if (($affectedRow)) {
            $json = [
                'message' => 'success',
                'status' => '1'
            ];
            return response()->json($json, 200);
        } else {
            $json = [
                'message' => 'failed',
                'status' => '2'
            ];
            return response()->json($json, 200);
        }
    }

    public function get_laporan(Request $request)
    {

        $periode = Periode::all()->first();
        $data_laporan = Laporan212::where('pengawas', $request->pengawas)
            ->where('tahun', $periode->tahun)->where('semester', $periode->semester)->get()->toArray();

        if (!$data_laporan) {
            $json = [
                'message' => 'Belum ada laporan yang pernah diinput & diupload',
                'status' => '0'
            ];
            return  response()->json($json, 200);
        } else {
            $json = [
                'message' => 'success',
                'body' => $data_laporan,
                'status' => '1'
            ];
            return  response()->json($json, 200);
        }
    }
}
