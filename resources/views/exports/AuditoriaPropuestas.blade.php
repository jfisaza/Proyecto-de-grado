<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Titulo</th>
            <th>Documento</th>
            <th>Estudiante 1</th>
            <th>Documento</th>
            <th>Estudiante 2</th>
            <th>Documento</th>
            <th>Estudiante 3</th>
            <th>Director</th>
            <th>Codirector</th>
            <th>Modalidad</th>
            <th>Programa</th>
            <th>Formato RDC</th>
            <th>Fecha Entrega</th>
            <th>Calificador</th>
            <th>Estado</th>
            <th>Fecha Calificación</th>
            <th>Número Acta</th>
        </tr>
    </thead>
    <tbody>
    @if($propuestas->count())
        @foreach($propuestas as $a)
        @if($a->programas->coordinacion->coo_nombre === auth()->user()->programas->coordinacion->coo_nombre)
        <tr>
            <td>{{$a->ap_id}}</td>
            <td>{{$a->ap_titulo }}</td>
            <td>{{ $a->est1->documento }}</td>
            <td>{{ $a->est1->nombres }} {{ $a->est1->apellidos }}</td>
            @if(isset($a->est2))
            <td>{{ $a->est2->documento }}</td>
            <td>{{ $a->est2->nombres }} {{ $a->est2->apellidos }}</td>
            @else
            <td></td>
            <td></td>
            @endif
            @if(isset($a->est3))
            <td>{{ $a->est3->documento }}</td>
            <td>{{ $a->est3->nombres }} {{ $a->est3->apellidos }}</td>
            @else
            <td></td>
            <td></td>
            @endif
            <td>{{$a->director->nombres}}</td>
            <td> @if(isset($a->codirector->nombres))
                {{$a->codirector->nombres}}
                {{$a->codirector->apellidos}}
                @endif
            </td>
            <td>{{$a->modalidad->mod_nombre}}</td>
            <td>{{ $a->programas->pro_nombre }}</td>
            <td>
                @if(isset($a->ap_formato))
                {{$a->ap_formato}}
                @endif
            </td>
            <td>{{$a->created_at}}</td>
            <td>@if(isset ($a->concepto->calificador))
                {{$a->concepto->calificador->nombres}}
                @endif
            </td>
            <td>@if(isset($a->concepto->con_nombre))
                {{$a->concepto->con_nombre}}
                @endif
            </td>
            <td>
                @if(isset($a->concepto->con_fecha))
                {{$a->concepto->con_fecha}}
                @endif
            </td>
            <td>
                @if(isset($a->concepto->con_acta))
                {{ $a->concepto->con_acta }}
                @endif
            </td>
        </tr>
        @endif
        @endforeach
        @else
        <tr>
            <td colspan="8">No hay registro !!</td>
        </tr>
        @endif
    </tbody>
</table>