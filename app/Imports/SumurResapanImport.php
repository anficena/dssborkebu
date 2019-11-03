<?php

namespace App\Imports;

use App\SumurResapan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SumurResapanImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            SumurResapan::create([
                'observasi_id' => $row[1],
                'user_id' => $row[2],
                'waktu' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]),
                'lokasi' => $row[4],
                'kedalaman' => $row[5],
                'kondisi' => $row[6],
                'photo' => $row[7]
            ]);
        }
    }
}
