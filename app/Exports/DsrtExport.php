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
     * @return \Illuminate\Support\Collection
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
            ->where('dummy_dsrt', '0')
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
            'Pencacah',
            'Pengawas',
        ];
        return $column;
    }
    public function map($data): array
    {
        // This example will return 3 rows.
        // First row will have 2 column, the next 2 will have 1 column
        $format_rp = array("Rp", ".");
        return [
            $data->kd_kab,
            $data->tahun,
            $data->semester,
            $data->id_bs,
            $data->nks,
            $data->nu_rt,
            $data->alamat,
            $data->nama_krt2,
            $data->jml_art2,
            $data->status_pencacahan,
            str_replace($format_rp, "", $data->makanan_sebulan),
            str_replace($format_rp, "", $data->nonmakanan_sebulan),
            str_replace($format_rp, "", $data->makanan_sebulan_bypml),
            str_replace($format_rp, "", $data->nonmakanan_sebulan_bypml),
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
            $data->pencacah,
            $data->pengawas,
        ];
    }
}
