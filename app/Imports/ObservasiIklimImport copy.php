<?php

namespace App\Imports;
use App\ObservasiIklim;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ObservasiIklimImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            ObservasiIklim::create([
                'observasi_id' => $row[1],
                'user_id' => $row[2],
                'tanggal' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]),
                'nama_data' => $row[4],
                'hasil' => $row[5],
                'satuan' => $row[6]
            ]);
        }
    }
}
