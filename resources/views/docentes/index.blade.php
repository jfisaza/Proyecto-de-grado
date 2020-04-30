@extends('layout')

@section('content')

<h1>Docentes</h1>

<section class="tablas">
    <div class="tabs">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="#proyectos">Proyectos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#calificar">Carlificar</a>
            </li>
            <li class="nav-item">
                <a href="#banco" class="nav-link">Banco de ideas</a>
            </li>
        </ul>
    </div>

    <article id="proyectos">
        <table class="table-bordered table-hover table-striped">
            <thead>
                <th>Código</th>
                <th>Nombre del trabajo</th>
                <th>Modalidad</th>
                <th>Programa</th>
                <th>Estudiantes</th>
                <th>Formato RDC</th>
                <th>Estado</th>
            </thead>
            <tbody>
            
            </tbody>
        </table>
    </article>
    <article id="calificar">
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
            </thead>
            <tbody></tbody>
        </table>
    </article>
    <article id="banco">
        <table class="table-bordered table-hover table-striped">
            <thead>
                <th>Nombre</th>
                <th>Modalidad</th>
            </thead>
        </table>
        <a href="" class="btn btn-primary">Agregar</a>
    </article>


@endsection