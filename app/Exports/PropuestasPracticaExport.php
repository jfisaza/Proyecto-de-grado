<?php

namespace App\Exports;

use App\PropuestaPractica;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PropuestasPracticaExport implements FromView
{
    public function view(): View
    {
        return view('exports.PropuestasPracticas', [
            'pp' => PropuestaPractica::all()
        ]);
    }
}
