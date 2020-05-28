<?php

namespace App\Exports;

use App\DesarrolloPractica;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DesarrollosPracticaExport implements FromView
{
    public function view(): View
    {
        return view('exports.DesarrolloPractica', [
            'pd' => DesarrolloPractica::all()
        ]);
    }
}
