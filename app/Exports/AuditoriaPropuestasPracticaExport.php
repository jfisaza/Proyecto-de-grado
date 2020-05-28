<?php

namespace App\Exports;

use App\Auditoria_propuesta_practicas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AuditoriaPropuestasPracticaExport implements FromView
{
    public function view(): View
    {
        return view('exports.AuditoriaPropuestaPracticas', [
            'propuesta' => Auditoria_propuesta_practicas::all()
        ]);
    }
}
