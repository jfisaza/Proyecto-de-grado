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
                <td>asdf</td>
                <td>asdf</td>
                <td>asdf</td>
                <td>asdf</td>
                <td>
                    <table class="table-bordered table-hover">
                        <tr>
                            <td>asdf</td>
                        </tr>
                        <tr>
                            <td>asdf</td>
                        </tr>
                        <tr>
                            <td>asdf</td>
                        </tr>
                    </table>
                </td>
                <td>asdf</td>
                <td>asdf</td>
                <td>asdf</td>
                <td id="estado">APROBADO</td>
                <td>asdf</td>
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
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <table class="table-bordered table-hover">
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                    </table>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
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