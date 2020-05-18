@extends('layout')

@section('content')
<div class="pagina-info">

    <div class="container">
        <div class="row justify-content-center">

            <div class="card">
                <div class="card-header p-3 mb-2 bg-success text-white">
                    <br>
                    <center>
                        <h1> Administrativos</h1>
                    </center>
                </div>
                <div class="card-body">

                    <section class="tablas">

                        <div class="tabs">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="#propuestas">Propuestas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#trabajos">Trabajos</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#practicas" class="nav-link">Prácticas</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#solicitudes" class="nav-link">Solicitudes</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#empresas" class="nav-link">Empresas</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#docentes" class="nav-link">Docentes</a>
                                </li>
                            </ul>
                        </div>
                        <br>
                        <br>
                        <article id="propuestas">

                            <div class="table-responsive-xl">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Titulo</th>
                                            <th>Director</th>
                                            <th>Codirector</th>
                                            <th>Modalidad</th>
                                            <th>Estado</th>
                                            <th>Formato RDC</th>
                                            <th>Fecha Entrega</th>
                                            <th>Fecha Calificacion</th>
                                            <th>Calificador</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($propuestas->count())
                                        @foreach($propuestas as $prop)
                                        <tr>
                                            <td>{{$prop->prop_id}}</td>
                                            <td>{{$prop->prop_titulo }}</td>
                                            <td>{{$prop->director->nombres}}</td>
                                            <td> @if(isset($prop->codirector->nombres))
                                                {{$prop->codirector->nombres}}
                                                {{$prop->codirector->apellidos}}
                                                @endif
                                            </td>
                                            <td>{{$prop->modalidad->mod_nombre}}</td>
                                            <td>@if(isset($prop->concepto->con_nombre))
                                                {{$prop->concepto->con_nombre}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($prop->prop_formato))
                                                {{$prop->prop_formato}} 
                                                @endif
                                            </td>
                                            <td>{{$prop->prop_fecha_entrega}}</td>
                                            <td>{{$prop->prop_fecha_calificacion}}</td>

                                            <td>@if(isset ($prop->concepto->calificador))
                                                {{$prop->concepto->calificador->nombres}}
                                                @endif
                                            </td>

                                            <td></td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="8">No hay registro !!</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </article>
                        <article id="trabajos">
                            <div class="table-responsive-xl">

                                <table class="table">
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
                                    <tbody></tbody>
                                </table>
                            </div>
                        </article>
                        <article id="practicas">
                            <div class="table-responsive-xl">

                                <table class="table">
                                    <thead>
                                        <th>Código</th>
                                        <th>Programa</th>
                                        <th>Estudiante</th>
                                        <th>Director</th>
                                        <th>Empresa</th>
                                        <th>Formato RDC</th>
                                        <th>Calificador</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </article>
                        <article id="solicitudes">
                            <div class="table-responsive-xl">

                                <table class="table">
                                    <thead>
                                        <th>Programa</th>
                                        <th>Empresa</th>
                                        <th>Representante</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Dirección</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                                <a href="" class="btn btn-primary">Agregar</a>
                                <br>
                            </div>
                        </article>
                        <article id="empresas">
                            <div class="table-responsive-xl">

                                <table class="table">
                                    <thead>
                                        <th>Nombre</th>
                                        <th>Representante</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Dirección</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </article>
                        <article id="docentes">
                            <div class="table-responsive-sm">

                                <table class="table">
                                    <thead>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Programa</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </article>
                </div>

                </section>
            </div>
        </div>
    </div>
</div>
@endsection