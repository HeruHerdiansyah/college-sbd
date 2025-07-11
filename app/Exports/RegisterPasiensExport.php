<?php

namespace App\Exports;

use App\Models\RegisterPasien;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RegisterPasiensExport implements FromView
{
    public function view(): View
    {
        return view('register-pasien.export', [
            'datas' => RegisterPasien::orderBy('created_at', 'DESC')->withTrashed()->get()
        ]);
    }
}
