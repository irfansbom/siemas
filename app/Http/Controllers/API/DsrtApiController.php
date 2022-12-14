<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dsrt;
use App\Models\Jadwal212;
use App\Models\Laporan212;
use Illuminate\Http\Request;

class DsrtApiController extends Controller
{
    //
    public function get_alokasi_dsrt_pcl(Request $request)
    {


        $data_dsrt = Dsrt::where('dsrt.pencacah', $request->pencacah)
            ->join('dsbs', function ($join) {
                $join->on('dsrt.id_bs', 'dsbs.id_bs');
            })
            ->join('kabs', function ($join) {
                $join->on('dsbs.kd_kab', 'kabs.id_kab');
            })
            ->join('kecs', function ($join) {
                $join->on('dsbs.kd_kab', 'kecs.id_kab')->on('dsbs.kd_kec', 'kecs.id_kec');
            })
            ->join('desas', function ($join) {
                $join->on('dsbs.kd_kab', 'desas.id_kab')->on('dsbs.kd_kec', 'desas.id_kec')->on('dsbs.kd_desa', 'desas.id_desa');
            })
            ->select("dsrt.id", "dsrt.kd_kab", "kabs.nama_kab", "kecs.id_kec", "kecs.nama_kec", "desas.id_desa", "desas.nama_desa", "dsrt.id_bs", "dsrt.nks", "dsrt.nu_rt", "dsrt.semester", "dsrt.alamat", "dsrt.nuc1", "dsrt.nama_krt", "dsrt.jml_art", "dsrt.nama_krt2", "dsrt.jml_art2", "dsrt.status_rumah", "dsrt.makanan_sebulan", "dsrt.nonmakanan_sebulan", "dsrt.transportasi", "dsrt.peliharaan", "dsrt.art_sekolah", "dsrt.art_bpjs", "dsrt.ijazah_krt", "dsrt.kegiatan_seminggu", "dsrt.deskripsi_kegiatan", "dsrt.luas_lantai", "dsrt.status_pencacahan", "dsrt.gsmp", "dsrt.foto", "dsrt.latitude", "dsrt.longitude", "dsrt.durasi_pencacahan", "dsrt.pencacah", "dsrt.pengawas", "dsrt.jumlah_rt_c1", "dsrt.sumber", "dsrt.latitude_selesai", "dsrt.longitude_selesai", "dsrt.jam_mulai", "dsrt.jam_selesai")
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


        $data_dsrt = Dsrt::where('dsrt.pengawas', $request->pengawas)
            ->join('dsbs', function ($join) {
                $join->on('dsrt.id_bs', 'dsbs.id_bs');
            })
            ->join('kabs', function ($join) {
                $join->on('dsbs.kd_kab', 'kabs.id_kab');
            })
            ->join('kecs', function ($join) {
                $join->on('dsbs.kd_kab', 'kecs.id_kab')->on('dsbs.kd_kec', 'kecs.id_kec');
            })
            ->join('desas', function ($join) {
                $join->on('dsbs.kd_kab', 'desas.id_kab')->on('dsbs.kd_kec', 'desas.id_kec')->on('dsbs.kd_desa', 'desas.id_desa');
            })
            ->select("dsrt.id", "dsrt.kd_kab", "kabs.nama_kab", "kecs.id_kec", "kecs.nama_kec", "desas.id_desa", "desas.nama_desa", "dsrt.id_bs", "dsrt.nks", "dsrt.nu_rt", "dsrt.semester", "dsrt.alamat", "dsrt.nuc1", "dsrt.nama_krt", "dsrt.jml_art", "dsrt.nama_krt2", "dsrt.jml_art2", "dsrt.status_rumah", "dsrt.makanan_sebulan", "dsrt.nonmakanan_sebulan", "dsrt.transportasi", "dsrt.peliharaan", "dsrt.art_sekolah", "dsrt.art_bpjs", "dsrt.ijazah_krt", "dsrt.kegiatan_seminggu", "dsrt.deskripsi_kegiatan", "dsrt.luas_lantai", "dsrt.status_pencacahan", "dsrt.gsmp", "dsrt.foto", "dsrt.latitude", "dsrt.longitude", "dsrt.durasi_pencacahan", "dsrt.pencacah", "dsrt.pengawas", "dsrt.jumlah_rt_c1", "dsrt.sumber", "dsrt.latitude_selesai", "dsrt.longitude_selesai", "dsrt.jam_mulai", "dsrt.jam_selesai")
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
                'nama_krt2' => $data_dsrt->nama_krt2,
                'jml_art2' => $data_dsrt->jml_art2,
                'status_rumah' => $data_dsrt->status_rumah,
                'makanan_sebulan' => $data_dsrt->makanan_sebulan,
                'nonmakanan_sebulan' => $data_dsrt->nonmakanan_sebulan,
                'gsmp' => $data_dsrt->gsmp,
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
                'status_pencacahan' => $status_pencacahan,
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

    public function upload_foto(Request $request)
    {
        $file = $request->file('file_foto');
        $id_dsrt = $request->id_dsrt;

        $dsrt = Dsrt::find($id_dsrt);


        $nama_foto = "foto_rumah_" . $dsrt->id_bs . "_" . $dsrt->nks . "_" . $dsrt->nu_rt . "_" . $file->getClientOriginalName();
        $file->move('foto', $nama_foto);

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
                'id' => $data_dsrt->id
            ],
            [
                'nama_krt2' => $data_dsrt->nama_krt2,
                'jml_art2' => $data_dsrt->jml_art2,
                'status_rumah' => $data_dsrt->status_rumah,
                'makanan_sebulan' => $data_dsrt->makanan_sebulan,
                'nonmakanan_sebulan' => $data_dsrt->nonmakanan_sebulan,
                'gsmp' => $data_dsrt->gsmp,
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
                'nama_krt2' => $data_dsrt->nama_krt2,
                'jml_art2' => $data_dsrt->jml_art2,
                'status_rumah' => $data_dsrt->status_rumah,
                'makanan_sebulan' => $data_dsrt->makanan_sebulan,
                'nonmakanan_sebulan' => $data_dsrt->nonmakanan_sebulan,
                'gsmp' => $data_dsrt->gsmp,
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

        $affectedRow = Laporan212::updateOrCreate(
            [
                'id_bs' => $data_laporan->id_bs,
                'nks' => $data_laporan->nks,
                'nu_rt' => $data_laporan->nu_rt,

            ],
            [
                'nama_krt' => $data_laporan->nama_krt,
                'pengawas' => $data_laporan->pengawas,
                'tanggal' => $data_laporan->tanggal,
                'status' => 2,
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
        $data_laporan = Laporan212::where('pengawas', $request->pengawas)->get()->toArray();

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
