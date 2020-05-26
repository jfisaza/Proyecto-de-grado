<?php

namespace App\Exports;

use App\Auditoria_propuesta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AuditoriaPropuestaExport implements FromView
{
    public function view(): View
    {
        return view('exports.AuditoriaPropuestas', [
            'propuestas' => Auditoria_propuesta::all()
        ]);
    }
}
