<?php

namespace App\Imports;

use App\TitikKontrol;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TitikKontrolImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            TitikKontrol::create([
                'observasi_id' => $row[1],
                'user_id' => $row[2],
                'tanggal' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]),
                'nama_koordinat' => $row[4],
                'titik' => $row[5],
                'sumbu_x' => number_format($row[6], 2, '.', ','),
                'sumbu_y' => number_format($row[7], 2, '.', ','),
                'sumbu_z' => number_format($row[8], 2, '.', ','),
            ]);
        }
    }
}
