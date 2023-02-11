<?php

namespace App\Imports;

use App\Models\Country;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportCountry implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // return new Country([
        //     'name' => $row[0]
        // ]);
        set_time_limit(0);
        dd($row[0]);
    
    }
}
