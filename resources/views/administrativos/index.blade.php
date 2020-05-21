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
                                    <a href="#ap" class="nav-link">Auditoria Propuestas</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#ad" class="nav-link">Auditoria Desarrollo</a>
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
                                            <th>Estudiantes</th>
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
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($propuestas->count())
                                        @foreach($propuestas as $prop)
                                        <tr>
                                            <td>{{$prop->prop_id}}</td>
                                            <td>{{$prop->prop_titulo }}</td>
                                            <td>
                                                @foreach($prop->estudiantes as $est)
                                                    <table>
                                                        <tr>
                                                        <td>{{ $est->nombres }} {{ $est->apellidos }}</td>
                                                        </tr>
                                                    </table>
                                                @endforeach
                                            </td>
                                            <td>{{$prop->director->nombres}}</td>
                                            <td> @if(isset($prop->codirector->nombres))
                                                {{$prop->codirector->nombres}}
                                                {{$prop->codirector->apellidos}}
                                                @endif
                                            </td>
                                            <td>{{$prop->modalidad->mod_nombre}}</td>
                                            <td>{{ $prop->programas->pro_nombre }}</td>
                                            <td>
                                                @if(isset($prop->prop_formato))
                                                <a href="{{ action('AdministrativosController@downloadPropuesta', $prop->prop_id) }}">{{$prop->prop_formato}} <span class="fas fa-download"></span></a>
                                                @endif
                                            </td>
                                            <td>{{$prop->created_at}}</td>
                                            <td>@if(isset ($prop->concepto->calificador))
                                                {{$prop->concepto->calificador->nombres}}
                                                @endif
                                            </td>
                                            <td>@if(isset($prop->concepto->con_nombre))
                                                {{$prop->concepto->con_nombre}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($prop->concepto->con_fecha))
                                                {{$prop->concepto->con_fecha}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($prop->concepto->con_acta))
                                                {{ $prop->concepto->con_acta }}
                                                @endif
                                            </td>
                                            
                                            <td>
                                            @if(is_null($prop->prop_con_id))
                                            <a href="{{ action('AdministrativosController@asignarPropuesta', $prop->prop_id) }}" class="btn btn-sm btn-primary" title="Asignar calificador"><span class="fas fa-check"></span></a>
                                            @endif
                                            </td>
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
                                        <th>Estudiantes</th>
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
                                    @if($desarrollo->count())
                                        @foreach($desarrollo as $des)
                                        <tr>
                                            <td>{{ $des->des_id }}</td>
                                            <td>{{ $des->des_titulo }}</td>
                                            <td>
                                                @foreach($des->estudiantes as $est)
                                                    <table>
                                                        <tr>
                                                        <td>{{ $est->nombres }} {{ $est->apellidos }}</td>
                                                        </tr>
                                                    </table>
                                                @endforeach
                                            </td>
                                            <td>{{$des->director->nombres}} {{ $des->director->apellidos }}</td>
                                            <td>
                                                @if(isset($des->codirector))
                                                {{$des->codirector->nombres}} {{ $des->codirector->apellidos }}
                                                @endif
                                            </td>
                                            <td>{{ $des->modalidad->mod_nombre }}</td>
                                            <td>{{ $des->programas->pro_nombre }}</td>
                                            <td>
                                                @if(isset($des->des_formato))
                                                <a href="{{ action('AdministrativosController@downloadDesarrollo', $des->des_id) }}">{{$des->des_formato}} <span class="fas fa-download"></span></a>
                                                @endif
                                            </td>
                                            <td>@if(isset ($des->concepto->calificador))
                                                {{$prop->concepto->calificador->nombres}}
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
                                            <td>
                                            @if(is_null($des->des_con_id))
                                            <a href="{{ action('AdministrativosController@asignarDesarrollo', $des->des_id) }}" class="btn btn-sm btn-primary" title="Asignar calificador"><span class="fas fa-check"></span></a>
                                            @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
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
                        <article id="ap">

                            <div class="table-responsive-xl">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Titulo</th>
                                            <th>Estudiantes</th>
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
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($ap->count())
                                        @foreach($ap as $a)
                                        <tr>
                                            <td>{{$a->ap_id}}</td>
                                            <td>{{$a->ap_titulo }}</td>
                                            <td>
                                                <table>
                                                    <tr>
                                                    <td>{{ $a->est1->nombres }} {{ $a->est1->apellidos }}</td>
                                                    @if(isset($a->est2))
                                                    <td>{{ $a->est2->nombres }} {{ $a->est2->apellidos }}</td>
                                                    @endif
                                                    @if(isset($a->est3))
                                                    <td>{{ $a->est3->nombres }} {{ $a->est3->apellidos }}</td>
                                                    @endif
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>{{$a->director->nombres}}</td>
                                            <td> @if(isset($a->codirector->nombres))
                                                {{$a->codirector->nombres}}
                                                {{$a->codirector->apellidos}}
                                                @endif
                                            </td>
                                            <td>{{$a->modalidad->mod_nombre}}</td>
                                            <td>{{ $a->programas->pro_nombre }}</td>
                                            <td>
                                                @if(isset($a->ap_formato))
                                                <a href="{{ action('AdministrativosController@downloadAuditoriaPropuesta', $a->ap_id) }}">{{$a->ap_formato}} <span class="fas fa-download"></span></a>
                                                @endif
                                            </td>
                                            <td>{{$a->created_at}}</td>
                                            <td>@if(isset ($a->concepto->calificador))
                                                {{$a->concepto->calificador->nombres}}
                                                @endif
                                            </td>
                                            <td>@if(isset($a->concepto->con_nombre))
                                                {{$a->concepto->con_nombre}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($a->concepto->con_fecha))
                                                {{$a->concepto->con_fecha}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($a->concepto->con_acta))
                                                {{ $a->concepto->con_acta }}
                                                @endif
                                            </td>
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
                        <article id="ad">
                            <div class="table-responsive-xl">

                                <table class="table">
                                    <thead>
                                        <th>Código</th>
                                        <th>Nombre del trabajo</th>
                                        <th>Estudiantes</th>
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
                                        <tr>
                                            <td>{{ $des->ad_id }}</td>
                                            <td>{{ $des->ad_titulo }}</td>
                                            <td>
                                                <table>
                                                    <tr>
                                                    <td>{{ $des->est1->nombres }} {{ $des->est1->apellidos }}</td>
                                                    @if(isset($des->est2))
                                                    <td>{{ $des->est2->nombres }} {{ $des->est2->apellidos }}</td>
                                                    @endif
                                                    @if(isset($des->est2))
                                                    <td>{{ $des->est3->nombres }} {{ $des->est3->apellidos }}</td>
                                                    @endif
                                                    </tr>
                                                </table>
                                            </td>
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
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </article>
                        <article id="docentes">
                            <div class="table-responsive-sm">

                                <table class="table">
                                    <thead>
                                        <th>Documento</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                    </thead>
                                    <tbody>
                                    @if(isset($docentes))
                                    @foreach($docentes as $doc)
                                    <tr>
                                        <td>{{ $doc->documento }}</td>
                                        <td>{{ $doc->nombres }}</td>
                                        <td>{{ $doc->apellidos }}</td>
                                        <td>{{ $doc->telefono }}</td>
                                        <td>{{ $doc->email }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
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