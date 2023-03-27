<?php

namespace App\Exports;

use App\Models\Dsart;
use App\Models\Periode;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DsartExport implements FromCollection, WithHeadings, WithMapping
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
        $periode = Periode::first();
        return Dsart::where('kd_kab', "LIKE", "%" . $this->kab . "%")

            ->where('tahun', $this->request->tahun_filter)
            ->where('semester', $this->request->semester_filter)
            ->where('id_bs', "LIKE", "%" . $this->request->bs_filter . "%")
            ->where('nks', "LIKE", "%" . $this->request->nks . "%")
            ->orderby('id_bs')
            ->orderby('nu_rt')
            ->orderby('nu_art')
            ->get();
    }

    public function headings(): array
    {
        $column = [
            'Kab',
            'Tahun',
            'Semester',
            'ID BS',
            'NKS',
            'No Urut Ruta',
            'No Urut ART',
            'Nama ART',
            'Pekerjaan',
            'Pendapatan',
            'Pendidikan',
        ];
        return $column;
    }
    public function map($data): array
    {
        $format_rp = array("Rp", ".");
        return [
            $data->kd_kab,
            $data->tahun,
            $data->semester,
            $data->id_bs,
            $data->nks,
            $data->nu_rt,
            $data->nu_art,
            $data->nama_art,
            $data->pekerjaan,
            str_replace($format_rp, "", $data->pendapatan),
            $data->pendidikan,
        ];
    }
}
