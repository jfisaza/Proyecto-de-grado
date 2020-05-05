@extends('layout')

@section('content')

<h1>Estudiante</h1>

<section class="tablas">

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
    <article class="prupuesta" id="propuesta">

    <table class="table-bordered table-hover table-striped">
        <thead>
            <th>Código</th>
            <th>Nombre del trabajo</th>
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
                <td>{{ auth()->user()->trabajos->tra_id }}</td>
                <td>{{ auth()->user()->trabajos->tra_titulo }}</td>
                <td>{{ auth()->user()->trabajos->modalidad->mod_nombre }}</td>
                <td>{{ auth()->user()->programas->pro_nombre }}</td>
                <td>
                    <table class="table-bordered table-hover">
                    @foreach($usuarios as $usu)
                        <tr>
                            <td>{{ $usu->nombres }}</td>
                        </tr>
                    @endforeach
                    </table>
                </td>
                <td>{{ auth()->user()->trabajos->director->nombres }}</td>
                <td>
                @if( isset(auth()->user()->trabajos->codirector->nombres) )
                {{ auth()->user()->trabajos->codirector->nombres }}
                @endif
                </td>
                <td>
                @if( isset(auth()->user()->trabajos->propuesta->prop_formato) )
                {{ auth()->user()->trabajos->propuesta->prop_formato }}
                @endif
                </td>
                <td>
                @if( isset(auth()->user()->trabajos->propuesta->concepto->calificador->nombres) )
                {{ auth()->user()->trabajos->propuesta->concepto->calificador->nombres }}
                @endif
                </td>
                <td id="estado">
                @if( isset(auth()->user()->trabajos->propuesta->concepto->con_nombre) )
                {{ auth()->user()->trabajos->propuesta->concepto->con_nombre }}
                @endif
                </td>
                <td>
                    <a href="" class="btn btn-primary ml-3"><span class="fas fa-edit"></span></a>
                    <a href="" class="btn btn-primary"><span class="fas fa-arrow-right"></span></a>
                </td>
            </tr>
        </tbody>
    </table>
    </article>
    <article class="desarrollo" id="desarrollo">
    <table class="table-bordered table-hover table-striped">
        <thead>
            <th>Código</th>
            <th>Nombre del trabajo</th>
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
                <td>{{ auth()->user()->trabajos->tra_id }}</td>
                <td>{{ auth()->user()->trabajos->tra_titulo }}</td>
                <td>{{ auth()->user()->trabajos->modalidad->mod_nombre }}</td>
                <td>{{ auth()->user()->programas->pro_nombre }}</td>
                <td>
                    <table class="table-bordered table-hover">
                    @foreach($usuarios as $usu)
                        <tr>
                            <td>{{ $usu->nombres }}</td>
                        </tr>
                    @endforeach
                    </table>
                </td>
                <td>{{ auth()->user()->trabajos->director->nombres }}</td>
                <td>
                @if( isset(auth()->user()->trabajos->propuesta->prop_formato) )
                {{ auth()->user()->trabajos->propuesta->prop_formato }}
                @endif
                </td>
                <td>
                @if( isset(auth()->user()->trabajos->propuesta->prop_formato) )
                {{ auth()->user()->trabajos->propuesta->prop_formato }}
                @endif
                </td>
                <td>
                @if( isset(auth()->user()->trabajos->propuesta->concepto->calificador->nombres) )
                {{ auth()->user()->trabajos->propuesta->concepto->calificador->nombres }}
                @endif
                </td>
                <td id="estado">
                @if( isset(auth()->user()->trabajos->propuesta->concepto->con_nombre) )
                {{ auth()->user()->trabajos->propuesta->concepto->con_nombre }}
                @endif
                </td>
                <td>
                    <a href="" class="btn btn-primary ml-3"><span class="fas fa-edit"></span></a>
                    <a href="" class="btn btn-primary"><span class="fas fa-arrow-right"></span></a>
                </td>
            </tr>
        </tbody>
    </table>
    </article>
</section>

@endsection