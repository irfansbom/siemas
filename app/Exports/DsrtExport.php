<?php

namespace App\Exports;

use App\Models\Dsrt;
use App\Models\Periode;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DsrtExport implements
    FromCollection,
    WithHeadings,
    WithMapping
{
    /**
     * return \Illuminate\Support\Collection
     */
    use Exportable;
    private $request;
    private $kab;

    public function __construct(Request $request, string $kab)
    {
        $this->request = $request;
        $this->kab = $kab;
    }

    public function collection()
    {
        //
        $periode = Periode::first();
        return Dsrt::where('kd_kab', "LIKE", "%" . $this->kab . "%")
            // ->where('dummy_dsrt', '0')
            ->where('tahun', $this->request->tahun_filter)
            ->where('semester', $this->request->semester_filter)
            ->where('id_bs', "LIKE", "%" . $this->request->bs_filter . "%")
            ->where('nks', "LIKE", "%" . $this->request->nks . "%")
            ->get();
    }

    public function headings(): array
    {
        $column = [
            'kab',
            'Tahun',
            'Semester',
            'ID BS',
            'NKS',
            'No Urut Ruta',
            'Alamat',
            'Nama KRT',
            'Jumlah ART',
            'Status Pencacahan',
            'Makanan Sebulan',
            'Nonmakanan Sebulan',
            'Makanan Sebulan PML',
            'Nonmakanan Sebulan PML',
            'Rata-rata Perkapita',
            'Transportasi',
            'Peliharaan',
            'ART yang Sekolah',
            'ART punya BPJS',
            'Ijazah KRT',
            'Kegiatan Seminggu',
            'Deskripsi Kegiatan',
            'Keikutsertaan GSMP',
            'GSMP yang diterima',
            'Status Kepemilikan Rumah',
            'Luas Lantai',
            'Jam Mulai',
            'Jam Selesai',
            'Durasi Pencacahan',
            'Longitude',
            'Latitude',
            'Pencacah',
            'Pengawas',
        ];
        return $column;
    }
    public function map($data): array
    {
        $format_rp = array("Rp", ".");

        $status_pencchan = "Belum Cacah";
        switch ($data->status_pencacahan) {
            case 0:
                $status_pencchan = "Belum Cacah";
                break;

            case 1:
                $status_pencchan = "Sudah Cacah";
                break;

            case 4:
                $status_pencchan = "Sudah Upload Pemeriksaan Pencacah";
                break;

            case 5:
                $status_pencchan = "Sudah Pemeriksaan Pengawas";
                break;

            case 6:
                $status_pencchan = "Sudah Upload Pemeriksaan Pengawas";
                break;
        }

        $pengeluaran_perkapita = 0;
        if ($data->jml_art_cacah != 0) {
            $pengeluaran_perkapita = round(((int) str_replace($format_rp, "", $data->makanan_sebulan) + (int) str_replace($format_rp, "", $data->nonmakanan_sebulan)) / $data->jml_art_cacah, 2);
        }

        $dms = $this->decimalToDMS(abs($data->latitude), abs($data->longitude));

        return [
            $data->kd_kab,
            $data->tahun,
            $data->semester,
            $data->id_bs,
            $data->nks,
            $data->nu_rt,
            $data->alamat,
            $data->nama_krt_cacah,
            $data->jml_art_cacah,
            $status_pencchan,
            str_replace($format_rp, "", $data->makanan_sebulan),
            str_replace($format_rp, "", $data->nonmakanan_sebulan),
            str_replace($format_rp, "", $data->makanan_sebulan_bypml),
            str_replace($format_rp, "", $data->nonmakanan_sebulan_bypml),
            $pengeluaran_perkapita,
            str_replace($format_rp, "", $data->transportasi),
            str_replace($format_rp, "", $data->peliharaan),
            $data->art_sekolah,
            $data->art_bpjs,
            $data->ijazah_krt,
            $data->kegiatan_seminggu,
            $data->deskripsi_kegiatan,
            $data->gsmp,
            $data->gsmp_deskripsi,
            $data->status_rumah,
            $data->luas_lantai,
            $data->jam_mulai,
            $data->jam_selesai,
            $data->durasi_pencacahan,
            $dms['longitude'],
            $dms['latitude'],
            $data->pencacah,
            $data->pengawas,
        ];
    }

    function decimalToDMS($lat_decimal, $long_decimal)
    {
        $lat_degrees = floor($lat_decimal);
        $lat_decimal -= $lat_degrees;
        $lat_decimal *= 60;
        $lat_minutes = floor($lat_decimal);
        $lat_decimal -= $lat_minutes;
        $lat_decimal *= 60;
        $lat_seconds = round($lat_decimal);
        $lat_dms = array("degrees" => $lat_degrees, "minutes" => $lat_minutes, "seconds" => $lat_seconds);
        if ($lat_decimal < 0) {
            $latitude_dms = 'S ';
        } else {
            $latitude_dms = 'U ';
        }
        $latitude_dms .= $lat_dms['degrees'] . '° ' . $lat_dms['minutes'] . '\' ' . $lat_dms['seconds'] . '"';

        $long_degrees = floor($long_decimal);
        $long_decimal -= $long_degrees;
        $long_decimal *= 60;
        $long_minutes = floor($long_decimal);
        $long_decimal -= $long_minutes;
        $long_decimal *= 60;
        $long_seconds = round($long_decimal);
        $long_dms = array("degrees" => $long_degrees, "minutes" => $long_minutes, "seconds" => $long_seconds);
        if ($long_decimal < 0) {
            $longitude_dms = 'B ';
        } else {
            $longitude_dms = 'T ';
        }
        $longitude_dms .= $long_dms['degrees'] . '° ' . $long_dms['minutes'] . '\' ' . $long_dms['seconds'] . '"';

        return ["latitude" => $latitude_dms, "longitude" => $longitude_dms];
    }
}
