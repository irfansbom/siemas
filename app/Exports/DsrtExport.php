<?php

namespace App\Exports;

use App\Models\Dsrt;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DsrtExport implements
    FromCollection,
    WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function __construct(Request $request, string $kab)
    {
        $this->request = $request;
        $this->kab = $kab;
    }

    public function collection()
    {
        //
        return Dsrt::where('kd_kab', "LIKE", "%" . $this->kab . "%")
        ->where('dummy_dsrt', '0')
            ->where('id_bs', "LIKE", "%" . $this->request->bs_filter . "%")
            ->select(
                'kd_kab',
                'id_bs',
                'nks',
                'nu_rt',
                'semester',
                'alamat',
                'nama_krt2',
                'jml_art2',
                'status_rumah',
                'makanan_sebulan',
                'nonmakanan_sebulan',
                'transportasi',
                'peliharaan',
                'art_sekolah',
                'art_bpjs',
                'ijazah_krt',
                'kegiatan_seminggu',
                'deskripsi_kegiatan',
                'luas_lantai',
                'status_pencacahan',
                'gsmp',
                'durasi_pencacahan',
                'pencacah',
                'pengawas'
            )
            ->get();
    }

    public function headings(): array
    {
        $column = [
            'Kab', 'ID BS', 'NKS', 'NU RT', 'Semester',
            'alamat', 'Nama KRT', 'Jumlah ART', 'status rumah', 'makanan', 'nonmakanan', 'trasportasi',
            'peliharaan', 'art sekolah', 'art bpjs', 'ijazah krt', 'kegiatan seminggu',
            'deskripsi kegiatan', 'luas lantai', 'status pencacahan', 'gsmp',
            'durasi pencacahan', 'pencacah', 'pengawas'
        ];
        return $column;
    }
}
