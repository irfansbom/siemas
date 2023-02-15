<?php

namespace App\Exports;

use App\Models\Dsrt;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DsrtWebMonExport implements FromQuery, WithHeadings, WithMapping, WithStyles, WithColumnWidths
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

    public function query()
    {
        //
        return Dsrt::query()->where('kd_kab', "LIKE", "%" . $this->kab . "%")
            ->where('dummy_dsrt', '0')
            ->where('tahun', $this->request->tahun_filter)
            ->where('semester', $this->request->semester_filter)
            ->where('id_bs', "LIKE", "%" . $this->request->bs_filter . "%");
    }

    public function headings(): array
    {
        return [
            ["Data Progress Pencacahan Susenas"],
            [
                'kode prop', 'kode kab',  'kode NKS', 'No Urut Ruta', 'Sudah Selesai?',
                 'Jumlah Anggota Rumah Tangga (ART)',
                 'Jumlah ART umur 10 tahun ke atas yang melakukan kegiatan untuk menenangkan hati/ pikiran?',
                 'Jumlah komoditas makanan',
                 'Jumlah Komoditas Non Makanan'
            ],
            ["","","","","","","[P.813 = 1 ]", "[KP Blok III P.304]", "[KP BLOK III P.305]"]
        ];
    }

    public function map($dsrt): array
    {

        $status = "";
        if($dsrt->status_pencacahan >= 4){
            $status = "sudah";
        }else{
            $status = "belum";
        }

        return [
            [ "16",
                $dsrt->kd_kab,
                $dsrt->nks,
                $dsrt->nu_rt,
                $status,
                $dsrt->jml_art2,
                "",
                $dsrt->jml_komoditas_makanan,
                $dsrt->jml_komoditas_nonmakanan

            ],
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I3')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A1:I3')->getAlignment()->setHorizontal('center')->setVertical('center');
        $sheet->getStyle('A1:I1')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB('974706');
        $sheet->getStyle('A2:I2')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB('ED7D31');


        $sheet->mergeCells('A1:I1');
    }

    public function columnWidths(): array
    {
        return [
            'A' => 12,
            'B' => 9.43,
            'C' => 13.86,
            'D' => 13.29,
            'E' => 16.29,
            'F' => 12.29,
            'G' => 21.57,
            'H' => 8.43,
            'I' => 12.43,
        ];
    }

}
