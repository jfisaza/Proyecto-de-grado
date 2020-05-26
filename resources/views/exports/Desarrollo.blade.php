<table class="table">
    <thead>
        <th>Código</th>
        <th>Nombre del trabajo</th>
        <th>Documento</th>
        <th>Estudiante</th>
        <th>Director</th>
        <th>Codirector</th>
        <th>Modalidad</th>
        <th>Programa</th>
        <th>Formato RDC</th>
        <th>Calificador</th>
        <th>Estado</th>
        <th>Fecha calificación</th>
        <th>Número de acta</th>
    </thead>
    <tbody>
    @if($desarrollo->count())
        @foreach($desarrollo as $des)
        @if($des->programas->coordinacion->coo_nombre === auth()->user()->programas->coordinacion->coo_nombre)
        @foreach($des->estudiantes as $est)
        <tr>
            <td>{{ $est->desarrollos->des_id }}</td>
            <td>{{ $est->desarrollos->des_titulo }}</td>
            <td>{{ $est->documento }}</td>
            <td>{{ $est->nombres }} {{ $est->apellidos }}</td>
            <td>{{$est->desarrollos->director->nombres}} {{ $est->desarrollos->director->apellidos }}</td>
            <td>
                @if(isset($est->desarrollos->codirector))
                {{$est->desarrollos->codirector->nombres}} {{ $est->desarrollos->codirector->apellidos }}
                @endif
            </td>
            <td>{{ $est->desarrollos->modalidad->mod_nombre }}</td>
            <td>{{ $est->desarrollos->programas->pro_nombre }}</td>
            <td>
                @if(isset($est->desarrollos->des_formato))
                {{$est->desarrollos->des_formato}}
                @endif
            </td>
            <td>@if(isset ($est->desarrollos->concepto->calificador))
                {{$prop->concepto->calificador->nombres}}
                @endif
            </td>
            <td>@if(isset($est->desarrollos->concepto->con_nombre))
                {{$est->desarrollos->concepto->con_nombre}}
                @endif
            </td>
            <td>
                @if(isset($est->desarrollos->concepto->con_fecha))
                {{$est->desarrollos->concepto->con_fecha}}
                @endif
            </td>
            <td>
                @if(isset($est->desarrollos->concepto->con_acta))
                {{ $est->desarrollos->concepto->con_acta }}
                @endif
            </td>
            
        </tr>
        @endforeach
        @endif
        @endforeach
        @endif
    </tbody>
</table>