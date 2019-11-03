<?php

namespace App\Imports;

use App\KemiringanDinding;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class KemiringanDindingImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            KemiringanDinding::create([
                'observasi_id' => $row[1],
                'user_id' => $row[2],
                'tanggal' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]),
                'lokasi' => $row[4],
                'titik' => $row[5],
                'sumbu_xa' => number_format($row[6], 2, '.', ','),
                'sumbu_xb' => number_format($row[7], 2, '.', ','),
                'sumbu_xh' => number_format($row[8], 2, '.', ','),
                'sumbu_ya' => number_format($row[9], 2, '.', ','),
                'sumbu_yb' => number_format($row[10], 2, '.', ','),
                'sumbu_yh' => number_format($row[11], 2, '.', ','),
                'kemiringan_x' => $row[12],
                'kemiringan_y' => $row[13],
                'pedoman_x' => $row[14],
                'pedoman_y' => $row[15],
                'selisih_x' => $row[16],
                'selisih_y' => $row[17],
                'keterangan' => $row[18]
            ]);
        }
    }
}
