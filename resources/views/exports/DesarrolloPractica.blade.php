<table>
    <thead>
    <tr>
        <th>Código</th>
        <th>Titulo</th>
        <th>Programa</th>
        <th>Estudiante</th>
        <th>Director</th>
        <th>Empresa</th>
        <th>Formato RDC</th>
        <th>Calificador</th>
        <th>Estado</th>
        <th>Fecha Calificacion</th>
        <th>Número Acta</th>
    </tr>
    </thead>
    <tbody>@if($pd->count())
        @foreach($pd as $pr)
        @if($pr->programas->coordinacion->coo_nombre === auth()->user()->programas->coordinacion->coo_nombre)
        <tr>
            <td>{{$pr->dp_id}}</td>
            <td>{{$pr->dp_titulo }}</td>
            <td>{{$pr->programas->pro_nombre }}</td>

            <td>{{$pr->estudiante->nombres}} {{$pr->estudiante->apellidos}}</td>
            <td>{{$pr->director->nombres}} {{ $pr->director->apellidos }}</td>
            <td>{{$pr->empresa->emp_nombre}}</td>
            <td>
                @if(isset($pr->dp_formato))
                {{$pr->dp_formato}}
                @endif
            </td>

            <td>@if(isset ($pr->concepto->calificador))
                {{$pr->concepto->calificador->nombres}} {{$pr->concepto->calificador->apellidos}}
                @endif
            </td>
            <td>@if(isset($pr->concepto->con_nombre))
                {{$pr->concepto->con_nombre}}
                @endif
            </td>
            <td>
                @if(isset($pr->concepto->con_fecha))
                {{$pr->concepto->con_fecha}}
                @endif
            </td>
            <td>
                @if(isset($pr->concepto->con_acta))
                {{ $pr->concepto->con_acta }}
                @endif
            </td>
            
        </tr>
        @endif
        @endforeach
        @endif
    </tbody>
</table>