<?php

namespace App\Exports;

use App\Propuesta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PropuestasExport implements FromView
{
    public function view(): View
    {
        return view('exports.Propuestas', [
            'propuestas' => Propuesta::all()
        ]);
    }
}
