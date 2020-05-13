@extends('layout')

@section('content')
<div id="pagina">
<h1>Estudiante</h1>

<section class="tablas">
 @if(isset(auth()->user()->propuestas->prop_id))
    <div class="tabs">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="#propuesta">Propuesta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="btn-desarrollo" href="#desarrollo">Desarrollo</a>
            </li>
        </ul>
    </div>
    <article class="propuesta" id="propuesta">

    <table class="table-bordered table-hover table-striped">

        <thead>
            <th>Código</th>
            <th>Titulo de la propuesta</th>
            <th>Modalidad</th>
            <th>Programa</th>
            <th>Estudiantes</th>
            <th>Director</th>
            <th>Codirector</th>
            <th>Formato RDC</th>
            <th>Calificador</th>
            <th>Estado</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            <tr>
                <td>{{ auth()->user()->propuestas->prop_id }}</td>
                <td>{{ auth()->user()->propuestas->prop_titulo }}</td>
                <td>{{ auth()->user()->propuestas->modalidad->mod_nombre }}</td>
                <td>{{ auth()->user()->programas->pro_nombre }}</td>
                <td>
                <table>
                    @foreach($estudiantes as $est)
                    <tr>
                        <td>{{ $est->nombres }} {{ $est->apellidos }}</td>
                    </tr>
                    @endforeach
                </table>
                </td>
                <td>{{ auth()->user()->propuestas->director->nombres }} {{ auth()->user()->propuestas->director->apellidos }}</td>
                <td>
                    @if(isset(auth()->user()->propuestas->codirector))
                    {{ auth()->user()->propuestas->codirector->nombres }}
                    {{ auth()->user()->propuestas->codirector->apellidos }}
                    @endif
                </td>
                <td>
                    @if(isset(auth()->user()->propuestas->prop_formato))
                    <a href="{{ action('EstudiantesController@download') }}">{{ auth()->user()->propuestas->prop_formato }} <span class="fas fa-download"></span></a>
                    @endif
                </td>
                <td>
                    @if(isset(auth()->user()->propuestas->concepto->calificador))
                    {{ auth()->user()->propuestas->concepto->calificador->nombres }}
                    @endif
                </td>
                <td>
                    @if(isset(auth()->user()->propuestas->concepto->con_nombre))
                    {{ auth()->user()->propuestas->concepto->con_nombre}}
                    @endif
                </td>
                <td>
                    <a href="" class="btn btn-primary ml-3"><span class="fas fa-edit"></span></a>
                    <a href="" class="btn btn-primary"><span class="fas fa-arrow-right"></span></a>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
    <div class="btn-group">
</div> 
    </article>
    <article class="desarrollo" id="desarrollo">
    <table class="table-bordered table-hover table-striped">
        <thead>
            <th>Código</th>
            <th>Nombre de la propuestas</th>
            <th>Modalidad</th>
            <th>Programa</th>
            <th>Estudiantes</th>
            <th>Director</th>
            <th>Codirector</th>
            <th>Formato RDC</th>
            <th>Calificador</th>
            <th>Estado</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            
        </tbody>
        
    </table>

    </article>
@else
<a href="{{route('estudiantes.create')}}" class="btn btn-primary">Registrar Popuesta</a>
@endif
</section>
</div>
@endsection