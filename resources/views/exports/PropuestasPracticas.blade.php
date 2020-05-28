<table>
    <thead>
    <tr>
        <th>Código</th>
        <th>Titulo</th>
        <th>Programa</th>
        <th># Convenio</th>
        <th>Estudiante</th>
        <th>Director</th>
        <th>Empresa</th>
        <th>Formato RDC</th>
        <th>Fecha Entrega</th>
        <th>Calificador</th>
        <th>Estado</th>
        <th>Fecha Calificacion</th>
        <th>Número Acta</th>
    </tr>
    </thead>
    <tbody>@if($pp->count())
        @foreach($pp as $pr)
        @if($pr->programas->coordinacion->coo_nombre === auth()->user()->programas->coordinacion->coo_nombre)
        <tr>
            <td>{{$pr->pp_id}}</td>
            <td>{{$pr->pp_titulo }}</td>
            <td>{{$pr->programas->pro_nombre }}</td>
            <td>{{$pr->pp_numconvenio}}</td>
            <td>{{$pr->estudiante->nombres}} {{$pr->estudiante->apellidos}}</td>
            <td>{{$pr->director->nombres}} {{ $pr->director->apellidos }}</td>
            <td>{{$pr->empresa->emp_nombre}}</td>
            <td>
                @if(isset($pr->pp_formato))
                {{$pr->pp_formato}}
                @endif
            </td>
            <td>{{$pr->created_at}}</td>

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
        @endif</tbody>
</table>