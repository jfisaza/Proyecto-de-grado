<?php

namespace App\Exports;

use App\Auditoria_desarrollo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AuditoriaDesarrolloExport implements FromView
{
    public function view(): View
    {
        return view('exports.AuditoriaDesarrollo', [
            'ad' => Auditoria_desarrollo::all()
        ]);
    }
}
