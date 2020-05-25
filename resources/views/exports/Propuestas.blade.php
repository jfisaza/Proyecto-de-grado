<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Titulo</th>
            <th>Documento</th>
            <th>Estudiante</th>
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
        @foreach($propuestas as $prop)
        @if($prop->programas->coordinacion->coo_nombre === auth()->user()->programas->coordinacion->coo_nombre)
        @foreach($prop->estudiantes as $est)
        <tr>
            <td>{{$est->propuestas->prop_id}}</td>
            <td>{{$est->propuestas->prop_titulo }}</td>
            <td>{{ $est->documento }}</td>
            <td>{{ $est->nombres }} {{ $est->apellidos }}</td>
            <td>{{$est->propuestas->director->nombres}} {{ $est->propuestas->director->apellidos }}</td>
            <td> @if(isset($est->propuestas->codirector->nombres))
                {{$est->propuestas->codirector->nombres}}
                {{$est->propuestas->codirector->apellidos}}
                @endif
            </td>
            <td>{{$est->propuestas->modalidad->mod_nombre}}</td>
            <td>{{ $est->propuestas->programas->pro_nombre }}</td>
            <td>
                @if(isset($est->propuestas->prop_formato))
                {{$est->propuestas->prop_formato}}
                @endif
            </td>
            <td>{{$est->propuestas->created_at}}</td>
            <td>@if(isset ($est->propuestas->concepto->calificador))
                {{$est->propuestas->concepto->calificador->nombres}}
                @endif
            </td>
            <td>@if(isset($est->propuestas->concepto->con_nombre))
                {{$est->propuestas->concepto->con_nombre}}
                @endif
            </td>
            <td>
                @if(isset($est->propuestas->concepto->con_fecha))
                {{$est->propuestas->concepto->con_fecha}}
                @endif
            </td>
            <td>
                @if(isset($est->propuestas->concepto->con_acta))
                {{ $est->propuestas->concepto->con_acta }}
                @endif
            </td>
            
        </tr>
        @endforeach
        @endif
        @endforeach
        @else
        <tr>
            <td colspan="8">No hay registro !!</td>
        </tr>
        @endif
    </tbody>
</table>