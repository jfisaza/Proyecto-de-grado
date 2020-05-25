<?php

namespace App\Exports;

use App\Desarrollo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DesarrollosExport implements FromView
{
    
public function view(): View
    {
        return view('exports.Desarrollo', [
            'desarrollo' => Desarrollo::all()
        ]);
    }
}
