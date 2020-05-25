<table>
    <thead>
        <th>Código</th>
        <th>Nombre del trabajo</th>
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
        <th>Calificador</th>
        <th>Estado</th>
        <th>Fecha calificación</th>
        <th>Número de acta</th>
        <th>Acciones</th>
    </thead>
    <tbody>
    @if($ad->count())
        @foreach($ad as $des)
        @if($des->programas->coordinacion->coo_nombre === auth()->user()->programas->coordinacion->coo_nombre)
        <tr>
            <td>{{ $des->ad_id }}</td>
            <td>{{ $des->ad_titulo }}</td>
            <td>{{ $des->est1->documento }}</td>
            <td>{{ $des->est1->nombres }} {{ $des->est1->apellidos }}</td>
            @if(isset($des->est2))
            <td>{{ $des->est2->documento }}</td>
            <td>{{ $des->est2->nombres }} {{ $des->est2->apellidos }}</td>
            @else
            <td></td>
            <td></td>
            @endif
            @if(isset($des->est3))
            <td>{{ $des->est3->documento }}</td>
            <td>{{ $des->est3->nombres }} {{ $des->est3->apellidos }}</td>
            @else
            <td></td>
            <td></td>
            @endif
                    
            <td>{{$des->director->nombres}} {{ $des->director->apellidos }}</td>
            <td>
                @if(isset($des->codirector))
                {{$des->codirector->nombres}} {{ $des->codirector->apellidos }}
                @endif
            </td>
            <td>{{ $des->modalidad->mod_nombre }}</td>
            <td>{{ $des->programas->pro_nombre }}</td>
            <td>
                @if(isset($des->ad_formato))
                <a href="{{ action('AdministrativosController@downloadAuditoriaDesarrollo', $des->ad_id) }}">{{$des->ad_formato}} <span class="fas fa-download"></span></a>
                @endif
            </td>
            <td>@if(isset ($des->concepto->calificador))
                {{$des->concepto->calificador->nombres}}
                @endif
            </td>
            <td>@if(isset($des->concepto->con_nombre))
                {{$des->concepto->con_nombre}}
                @endif
            </td>
            <td>
                @if(isset($des->concepto->con_fecha))
                {{$des->concepto->con_fecha}}
                @endif
            </td>
            <td>
                @if(isset($des->concepto->con_acta))
                {{ $des->concepto->con_acta }}
                @endif
            </td>
        </tr>
        @endif
        @endforeach
    @endif
    </tbody>
    </table>