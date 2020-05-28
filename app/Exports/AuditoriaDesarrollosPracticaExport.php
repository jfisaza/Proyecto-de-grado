<?php

namespace App\Exports;

use App\Auditoria_desarrollo_practicas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AuditoriaDesarrollosPracticaExport implements FromView
{
    public function view(): View
    {
        return view('exports.AuditoriaDesarrolloPracticas', [
            'desarrollo' => Auditoria_desarrollo_practicas::all()
        ]);
    }
}