<?php

namespace App\Exports;

use App\Models\Dsbs;
use App\Models\Periode;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MonUsersExport implements FromCollection, WithMapping, WithHeadings
{
    private $kab;
    public function __construct($request)
    {
        $this->kab = $request->kab_filter;
    }
    public function collection()
    {
        //
        $periode = Periode::first();
        $kab = $this->kab;

        $dsbs = Dsbs::select('pencacah')
            ->where('tahun', $periode->tahun)
            ->where('semester', $periode->semester)
            ->where('kd_kab', "LIKE", "%" . $kab . "%")
            ->where('dummy', 0)->groupby('pencacah')
            ->get()->toArray();

        return  User::wherein('email', $dsbs)
            ->where('dummy_user', 0)
            // ->where('name', "LIKE", "%" . $request->nama_filter . "%")
            ->get();
    }

    public function map($data): array
    {

        $persen = 0;
        // dd($data->dsrt);
        if (count($data->dsrt) != 0) {
            $persen = round((count($data->dsrt_sdh_cacah) / count($data->dsrt)) * 100, 2);
        }
        return [
            $data->kd_wilayah,
            $data->name,
            count($data->dsbs),
            count($data->dsrt),
            count($data->dsrt_sdh_cacah),
            $persen
        ];
    }
    public function headings(): array
    {
        return [
            'Kab',
            'Nama',
            'DSBS',
            'DSRT',
            'Selesai Dicacah',
            'Persen'
        ];
    }
}
