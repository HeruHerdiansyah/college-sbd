<?php

namespace App\Exports;

use App\Models\Pasien;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PasiensExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pasien::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'No Pasien',
            'Name',
            'No KTP',
            'Address',
            'Place of Birth',
            'Date of Birth',
            'Gender',
            'Created At',
            'Updated At',
        ];
    }
}
