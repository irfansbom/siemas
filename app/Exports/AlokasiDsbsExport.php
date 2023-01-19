<?php

namespace App\Exports;

use App\Models\Dsbs;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlokasiDsbsExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder  implements FromCollection, WithHeadings, WithColumnWidths, WithCustomValueBinder
{
    use Exportable;
    private $request;
    private $kab;
    private $tahun;
    private $semester;
    public function __construct(Request $request, string $kab)
    {
        $this->request = $request;
        $this->kab = $kab;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Dsbs::where('kd_kab', "LIKE", "%" . $this->kab . "%")
            ->where('tahun', "LIKE", "%" . $this->request->tahun_filter . "%")
            ->where('semester', "LIKE", "%" . $this->request->semester_filter . "%")
            ->where('id_bs', "LIKE", "%" . $this->request->bs_filter . "%")
            ->select('kd_kab', 'kd_kec', 'kecamatan', 'kd_desa', 'desa', 'nbs', 'id_bs', 'nks','tahun','semester', 'sls_wilkerstat', 'pencacah')
            ->get();
    }

    public function headings(): array
    {
        $column = ['kab', 'kd_kec', 'kec', 'kd_desa', 'desa', 'nbs', 'id_bs', 'nks','tahun', 'semester', 'sls', 'pencacah'];
        return $column;
    }
    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 8,
            'C' => 18,
            'D' => 8,
            'E' => 18,
            'F' => 8,
            'G' => 16,
            'H' => 8,
            'I' => 8,
            'J' => 8,
            'K' => 45,
            'L' => 27,
        ];
    }
}
