@extends('layout')

@section('content')

<h1>Administrativos</h1>

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
    <article id="propuestas">
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
            <tbody></tbody>
        </table>
    </article>
    <article id="trabajos">
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
            <tbody></tbody>
        </table>
    </article>
    <article id="practicas">
        <table class="table-bordered table-hover table-striped">
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
    </article>
    <article id="solicitudes">
        <table class="table-bordered table-hover table-striped">
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
    </article>
    <article id="empresas">
        <table class="table-bordered table-hover table-striped">
            <thead>
                <th>Nombre</th>
                <th>Representante</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Dirección</th>
            </thead>
            <tbody></tbody>
        </table>
    </article>
    <article id="docentes">
        <table class="table-bordered table-hover table-striped">
            <thead>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Programa</th>
                <th>Teléfono</th>
                <th>Correo</th>
            </thead>
            <tbody></tbody>
        </table>
    </article>
</section>

@endsection