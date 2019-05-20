<?php

namespace App\Exports;

use App\Novelty;
use Maatwebsite\Excel\Concerns\FromCollection;

class NoveltysExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Novelty::all();
    }
}
