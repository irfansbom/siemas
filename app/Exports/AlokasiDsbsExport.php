<?php

namespace App\Exports;

use App\Models\Dsbs;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlokasiDsbsExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder  implements
    FromCollection,
    WithHeadings,
    WithColumnWidths,
    WithCustomValueBinder,
    WithMapping
{
    use Exportable;

    private $request;
    private $tahun;
    private $semester;
    private $kab;
    private $flag_active;

    public function __construct(Request $request, string $kab)
    {
        $periode = Periode::first();
        $this->request = $request;
        $this->tahun = ($request->tahun_filter) ? $request->tahun_filter : $periode->tahun;
        $this->semester = ($request->semester_filter) ? $request->semester_filter : $periode->semester;
        $this->flag_active = '1';
        if ($request->flag_active == '0') {
            $this->flag_active = '0';
        }
        $this->kab = $kab;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Dsbs::where('tahun', "LIKE", "%" . $this->tahun . "%")
            ->where('semester', "LIKE", "%" . $this->semester . "%")
            ->where('kd_kab', "LIKE", "%" . $this->kab . "%")
            ->where('kd_kec', "LIKE", "%" . $this->request->kec_filter . "%")
            ->where('kd_desa', "LIKE", "%" . $this->request->desa_dilter . "%")
            ->where('nks', 'LIKE', '%' . $this->request->nks_filter  . '%')
            ->where('flag_active', "LIKE", "%" . $this->flag_active . "%")
            ->get();

        return $data;
    }

    public function map($data): array
    {
        return [
            $data->tahun,
            $data->semester,
            $data->kd_kab,
            $data->kd_kec,
            $data->kd_desa,
            $data->kd_bs,
            $data->nks,
            $data->sls,
            $data->pencacah,
            $data->pengawas,
        ];
    }

    public function headings(): array
    {
        $column = [
            'tahun',
            'semester',
            'kd_kab',
            'kd_kec',
            'kd_desa',
            'kd_bs/kd_sls',
            'nks',
            'sls',
            'pencacah',
            'pengawas'
        ];
        return $column;
    }
    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 8,
            'C' => 8,
            'D' => 8,
            'E' => 8,
            'F' => 8,
            'G' => 8,
            'H' => 18,
            'I' => 18,
        ];
    }
}
