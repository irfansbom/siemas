<?php

namespace App\Exports;

use App\Models\Dsbs;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlokasiDsbsExport implements FromCollection, WithHeadings, WithColumnWidths
{
    use Exportable;
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
            ->where('id_bs', "LIKE", "%" . $this->request->bs_filter . "%")
            ->select('kd_kab', 'kd_kec', 'kecamatan', 'kd_desa', 'desa', 'nbs', 'id_bs', 'nks', 'sls_wilkerstat', 'pencacah')
            ->get();
    }

    public function headings(): array
    {
        $column = ['Kab', 'kd kec', 'Kecamatan', 'kd desa', 'Desa', 'NBS', 'ID BS', 'NKS', 'SLS Wilkerstat', 'pencacah'];
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
            'I' => 35,
            'J' => 27,
        ];
    }
}
