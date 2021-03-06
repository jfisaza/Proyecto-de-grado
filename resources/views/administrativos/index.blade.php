@extends('layout')

@section('content')
<div class="pagina-info">
    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header p-3 mb-2 bg-success text-white ">
                    <br>
                    <center>
                        <h1> Hola Admin {{ auth()->user()->nombres }} </h1>
                    </center>
                </div>
                <div class="card-body">

                    <section class="tablas">

                        <div class="tabs">
                            <ul class="nav nav-tabs ">
                                <li class="nav-item ">
                                    <a class="nav-link" href="#propuestas">Propuestas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#trabajos">Trabajos</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#practicas" class="nav-link">Prácticas</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#practicaFinal" class="nav-link">Prácticas Final</a>
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
                                    <a href="#apracticas" class="nav-link">Auditoria Practicas</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#apracticasf" class="nav-link">Auditoria Practicas Final</a>
                                </li>

                                <li class="nav-item">
                                    <a href="#docentes" class="nav-link">Docentes</a>
                                </li>

                                <li class="nav-item">
                                    <a href="#limite" class="nav-link">Fecha Limite de Propuestas</a>
                                </li>

                                @if(auth()->user()->hasRole('super'))
                                <li class="nav-item">
                                    <a href="#administrativos" class="nav-link">Administrativos</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <br>
                        <br>
                        <article id="propuestas" >
                            <form action="{{ action('AdministrativosController@index') }}" method="get" id="filtro">
                                <input type="text" name="prop_id" class="form-control" placeholder="Código">
                                <div class="input-group-append">
                                    <button type="submit" class="btn-primary"><span class="fas fa-search"></span></button>
                                </div>
                            </form>
                            <div class="art">
                                <table class="table">
                                    <thead class="table-success">
                                        <tr>
                                            <th>Código</th>
                                            <th>Titulo</th>
                                            <th>Estudiantes</th>
                                            <th>Director</th>
                                            <th>Codirector</th>
                                            <th>Modalidad</th>
                                            <th>Programa</th>
                                            <th>Formato RDC</th>
                                            <th>Liquidación</th>
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
                                        @if($prop->programas->coordinacion->coo_nombre === auth()->user()->programas->coordinacion->coo_nombre)
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
                                            <td>{{$prop->director->nombres}} {{ $prop->director->apellidos }}</td>
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
                                            <td>
                                                @if(isset($prop->prop_liquidacion))
                                                <a href="{{ action('AdministrativosController@downloadLiquidacionPropuesta', $prop->prop_id) }}">{{$prop->prop_liquidacion}} <span class="fas fa-download"></span></a>
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
                                                <a href="{{ action('AdministrativosController@asignarPropuesta', $prop->prop_id) }}" class="btn btn-sm btn-primary mb-3" title="Asignar calificador"><span class="fas fa-check"></span></a>
                                                @endif
                                                <a href="{{ action('AdministrativosController@cambiarDirectoresPropuesta',$prop->prop_id) }}" class="btn btn-sm btn-primary" title="Cambiar director y coodirector"><span class="fas fa-user-edit"></span></a>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="14">No hay registro !!</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                </div>
                             <div>   <a href="{{ action('AdministrativosController@exportPropuesta') }}" title="Exportar"><img src="{{ asset('img/excel.png') }}" width="25px"></a></div>
                            
                        </article>
                        <article id="trabajos"  >
                            <form action="{{ action('AdministrativosController@index') }}" method="get" id="filtro">
                                <input type="text" name="des_id" class="form-control" placeholder="Código">
                                <div class="input-group-append">
                                    <button type="submit" class="btn-primary"><span class="fas fa-search"></span></button>
                                </div>
                            </form>
                            <div class="art">

                                <table class="table">
                                    <thead class="table-success">
                                        <th>Código</th>
                                        <th>Titulo</th>
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
                                        @if($des->programas->coordinacion->coo_nombre === auth()->user()->programas->coordinacion->coo_nombre)
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
                                                <a href="{{ action('AdministrativosController@asignarDesarrollo', $des->des_id) }}" class="btn btn-sm btn-primary mb-3" title="Asignar calificador"><span class="fas fa-check"></span></a>
                                                @endif
                                                <a href="{{ action('AdministrativosController@cambiarDirectoresDesarrollo',$des->des_id) }}" class="btn btn-sm btn-primary" title="Cambiar director y coodirector"><span class="fas fa-user-edit"></span></a>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="13">No hay registro !!</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <a href="{{ action('AdministrativosController@exportDesarrollo') }}" title="Exportar"><img src="{{ asset('img/excel.png') }}" width="25px"></a></div>

                            
                        </article>
                        <article id="practicas" >
                            <form action="{{ action('AdministrativosController@index') }}" method="get" id="filtro">
                                <input type="text" name="pra_id" class="form-control" placeholder="Código">
                                <div class="input-group-append">
                                    <button type="submit" class="btn-primary"><span class="fas fa-search"></span></button>
                                </div>
                            </form>
                            <div class="art">

                                <table class="table">
                                    <thead class="table-success">
                                        <th>Código</th>
                                        <th>Titulo</th>
                                        <th>Programa</th>
                                        <th># Convenio</th>
                                        <th>Estudiante</th>
                                        <th>Director</th>
                                        <th>Empresa</th>
                                        <th>Formato RDC</th>
                                        <th>Liquidación</th>
                                        <th>Fecha Entrega</th>
                                        <th>Calificador</th>
                                        <th>Estado</th>
                                        <th>Fecha Calificacion</th>
                                        <th>Número Acta</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>@if($pp->count())
                                        @foreach($pp as $pr)
                                        @if($pr->programas->coordinacion->coo_nombre === auth()->user()->programas->coordinacion->coo_nombre)
                                        <tr>
                                            <td>{{$pr->pp_id}}</td>
                                            <td>{{$pr->pp_titulo }}</td>
                                            <td>{{$pr->programas->pro_nombre }}</td>
                                            <td>{{$pr->pp_numconvenio}}</td>
                                            <td>{{$pr->estudiante->nombres}} {{$pr->estudiante->apellidos}}</td>
                                            <td>{{$pr->director->nombres}} {{ $pr->director->apellidos }}</td>
                                            <td>{{$pr->empresa->emp_nombre}}</td>
                                            <td>
                                                @if(isset($pr->pp_formato))
                                                <a href="{{ action('AdministrativosController@downloadPropuestaPractica', $pr->pp_id) }}">{{$pr->pp_formato}} <span class="fas fa-download"></span></a>
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($pp->pp_liquidacion))
                                                <a href="{{ action('AdministrativosController@downloadLiquidacionPractica', $pp->pp_id) }}">{{$pp->pp_liquidacion}} <span class="fas fa-download"></span></a>
                                                @endif
                                            </td>
                                            <td>{{$pr->created_at}}</td>

                                            <td>@if(isset ($pr->concepto->calificador))
                                                {{$pr->concepto->calificador->nombres}} {{$pr->concepto->calificador->apellidos}}
                                                @endif
                                            </td>
                                            <td>@if(isset($pr->concepto->con_nombre))
                                                {{$pr->concepto->con_nombre}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($pr->concepto->con_fecha))
                                                {{$pr->concepto->con_fecha}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($pr->concepto->con_acta))
                                                {{ $pr->concepto->con_acta }}
                                                @endif
                                            </td>

                                            <td>
                                                @if(is_null($pr->pp_con_id))
                                                <a href="{{ action('AdministrativosController@asignarPropuestaPractica',$pr->pp_id) }}" class="btn btn-sm btn-primary" title="Asignar calificador"><span class="fas fa-check"></span></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="14">No hay registro !!</td>
                                        </tr>
                                        @endif</tbody>
                                </table>
                            </div>
                            <div>
                                <a href="{{ action('AdministrativosController@exportPropuestaPractica') }}" title="Exportar"><img src="{{ asset('img/excel.png') }}" width="25px"></a></div>

                            
                        </article>
                        <article id="practicaFinal"  >
                            <form action="{{ action('AdministrativosController@index') }}" method="get" id="filtro">
                                <input type="text" name="pra_id" class="form-control" placeholder="Código">
                                <div class="input-group-append">
                                    <button type="submit" class="btn-primary"><span class="fas fa-search"></span></button>
                                </div>
                            </form>
                            <div class="art">

                                <table class="table">
                                    <thead class="table-success">
                                        <th>Código</th>
                                        <th>Titulo</th>
                                        <th>Programa</th>
                                        <th>Estudiante</th>
                                        <th>Director</th>
                                        <th>Empresa</th>
                                        <th>Formato RDC</th>
                                        <th>Calificador</th>
                                        <th>Estado</th>
                                        <th>Fecha Calificacion</th>
                                        <th>Número Acta</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>@if($pd->count())
                                        @foreach($pd as $pr)
                                        @if($pr->programas->coordinacion->coo_nombre === auth()->user()->programas->coordinacion->coo_nombre)
                                        <tr>
                                            <td>{{$pr->dp_id}}</td>
                                            <td>{{$pr->dp_titulo }}</td>
                                            <td>{{$pr->programas->pro_nombre }}</td>

                                            <td>{{$pr->estudiante->nombres}} {{$pr->estudiante->apellidos}}</td>
                                            <td>{{$pr->director->nombres}} {{ $pr->director->apellidos }}</td>
                                            <td>{{$pr->empresa->emp_nombre}}</td>
                                            <td>
                                                @if(isset($pr->dp_formato))
                                                <a href="{{ action('AdministrativosController@downloadDesarrolloPractica', $pr->dp_id) }}">{{$pr->dp_formato}} <span class="fas fa-download"></span></a>
                                                @endif
                                            </td>

                                            <td>@if(isset ($pr->concepto->calificador))
                                                {{$pr->concepto->calificador->nombres}} {{$pr->concepto->calificador->apellidos}}
                                                @endif
                                            </td>
                                            <td>@if(isset($pr->concepto->con_nombre))
                                                {{$pr->concepto->con_nombre}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($pr->concepto->con_fecha))
                                                {{$pr->concepto->con_fecha}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($pr->concepto->con_acta))
                                                {{ $pr->concepto->con_acta }}
                                                @endif
                                            </td>

                                            <td>
                                                @if(is_null($pr->dp_con_id))
                                                <a href="{{ action('AdministrativosController@asignarDesarrolloPractica',$pr->dp_id) }}" class="btn btn-sm btn-primary" title="Asignar calificador"><span class="fas fa-check"></span></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="12">No hay registro !!</td>
                                        </tr>
                                        @endif</tbody>
                                </table>
                            </div>
                            <div>
                                <a href="{{ action('AdministrativosController@exportDesarrolloPractica') }}" title="Exportar"><img src="{{ asset('img/excel.png') }}" width="25px"></a></div>

                        </article>
                        <article id="solicitudes" >
                        <div class="art">

                                <table class="table">
                                    <thead class="table-success">
                                        <th>Programa</th>
                                        <th>Empresa</th>
                                        <th>Representante</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Dirección</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @if(isset($solicitudes))
                                        @foreach($solicitudes as $sol)
                                        @if($sol->programa->coordinacion->coo_nombre === auth()->user()->programas->coordinacion->coo_nombre)
                                        <tr>
                                            <td>{{ $sol->programa->pro_nombre }}</td>
                                            <td>{{ $sol->empresa->emp_nombre }}</td>
                                            <td>{{ $sol->empresa->emp_representante }}</td>
                                            <td>{{ $sol->empresa->emp_telefono }}</td>
                                            <td>{{ $sol->empresa->emp_correo }}</td>
                                            <td>{{ $sol->empresa->emp_direccion }}</td>
                                            <td>
                                                <a href="{{ action('BancoController@editSolicitud',$sol->sol_id) }}" class="btn btn-sm btn-primary"><span class="fas fa-edit"></span></a>
                                                <a href="{{ action('BancoController@destroySolicitud',$sol->sol_id) }}" class="btn btn-sm btn-primary"><span class="fas fa-trash" onclick="return confirm('¿Está seguro de eliminar?')"></span></a>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="7">No hay registro !!</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                        </div>
                        <div>
                                <a href="{{ action('BancoController@createSolicitud') }}" class="btn btn-sm btn-success" title="Nuevo"><span class="fas fa-plus"></span></a></div>
                            
                        </article>
                        <article id="empresas"  >
                        <div class="art">

                                <table class="table table-hover" >
                                    <thead class="table-success">
                                        <th>Nombre</th>
                                        <th>Sector</th>
                                        <th>Representante</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Dirección</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @if(isset($empresas))
                                        @foreach($empresas as $emp)
                                        <tr>
                                            <td>{{ $emp->emp_nombre }}</td>
                                            <td>{{ $emp->emp_sector }}</td>
                                            <td>{{ $emp->emp_representante }}</td>
                                            <td>{{ $emp->emp_telefono }}</td>
                                            <td>{{ $emp->emp_correo }}</td>
                                            <td>{{ $emp->emp_direccion }}</td>
                                            <td>
                                                <a href="{{ route('administrativos.edit',$emp->emp_id) }}" class="btn btn-sm btn-primary" title="Editar"><span class="fas fa-edit"></span></a>
                                                <a href="{{ route('administrativos.destroy',$emp->emp_id) }}" class="btn btn-sm btn-primary" onclick="return confirm('¿Esta seguro de eliminar?')" title="Eliminar"><span class="fas fa-trash"></span></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="7">No hay registro !!</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                    </div>
                               <div> <a href="{{ route('administrativos.create') }}" class="btn btn-sm btn-success" title="Nuevo"><span class="fas fa-plus"></span></a></div>
                            
                        </article>
                        <article id="ap" >
                            <form action="{{ action('AdministrativosController@index') }}" method="get" id="filtro">
                                <input type="text" name="ap_id" class="form-control" placeholder="Código">
                                <div class="input-group-append">
                                    <button type="submit" class="btn-primary"><span class="fas fa-search"></span></button>
                                </div>
                            </form>
                            <div class="art">

                                <table class="table">
                                    <thead class="table-success">
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
                                        @if($a->programas->coordinacion->coo_nombre === auth()->user()->programas->coordinacion->coo_nombre)
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
                                        @endif
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="14">No hay registro !!</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <a href="{{ action('AdministrativosController@exportAuditoriaPropuesta') }}" title="Exportar"><img src="{{ asset('img/excel.png') }}" width="25px"></a></div>

                            
                        </article>
                        <article id="ad"  >
                            <form action="{{ action('AdministrativosController@index') }}" method="get" id="filtro">
                                <input type="text" name="ad_id" class="form-control" placeholder="Código">
                                <div class="input-group-append">
                                    <button type="submit" class="btn-primary"><span class="fas fa-search"></span></button>
                                </div>
                            </form>
                            <div class="art">

                                <table class="table">
                                    <thead class="table-success">
                                        <th>Código</th>
                                        <th>Titulo</th>
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
                                        @if($des->programas->coordinacion->coo_nombre === auth()->user()->programas->coordinacion->coo_nombre)
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
                                                        @if(isset($des->est3))
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
                                        @endif
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="13">No hay registro !!</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <a href="{{ action('AdministrativosController@exportAuditoriaPropuesta') }}" title="Exportar"><img src="{{ asset('img/excel.png') }}" width="25px"></a></div>

                            
                        </article>


                        <article id="apracticas"  >
                            <form action="{{ action('AdministrativosController@index') }}" method="get" id="filtro">
                                <input type="text" name="ap_id" class="form-control" placeholder="Código">
                                <div class="input-group-append">
                                    <button type="submit" class="btn-primary"><span class="fas fa-search"></span></button>
                                </div>
                            </form>
                            <div class="art">

                                <table class="table">
                                    <thead class="table-success">
                                        <tr>
                                            <th>Código</th>
                                            <th>Titulo</th>
                                            <th>Estudiante</th>
                                            <th>Director</th>
                                            <th>Programa</th>
                                            <th>Empresa</th>
                                            <th># convenio</th>
                                            <th>Fecha convenio</th>
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
                                        @if($app->count())
                                        @foreach($app as $a)
                                        @if($a->programas->coordinacion->coo_nombre === auth()->user()->programas->coordinacion->coo_nombre)
                                        <tr>
                                            <td>{{$a->app_id}}</td>
                                            <td>{{$a->app_titulo }}</td>
                                            <td> {{ $a->estudiante->nombres }} {{ $a->estudiante->apellidos }}</td>
                                            <td>{{ $a->director->nombres}}</td>
                                            <td>{{ $a->programas->pro_nombre }}</td>
                                            <td>{{ $a->empresa->emp_nombre}}</td>
                                            <td>{{ $a->app_numconvenio}}</td>
                                            <td>{{ $a->app_fechaconvenio}}</td>
                                            <td>
                                                @if(isset($a->app_formato))
                                                <a href="{{ action('AdministrativosController@downloadAuditoriaPropuesta', $a->app_id) }}">{{$a->app_formato}} <span class="fas fa-download"></span></a>
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
                                        @endif
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="15">No hay registro !!</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <a href="{{ action('AdministrativosController@exportAuditoriaPropuestaPractica') }}" title="Exportar"><img src="{{ asset('img/excel.png') }}" width="25px"></a></div>

                            
                        </article>
                        <article id="apracticasf" >
                            <form action="{{ action('AdministrativosController@index') }}" method="get" id="filtro">
                                <input type="text" name="ad_id" class="form-control" placeholder="Código">
                                <div class="input-group-append">
                                    <button type="submit" class="btn-primary"><span class="fas fa-search"></span></button>
                                </div>
                            </form>
                            <div class="art">

                                <table class="table">
                                    <thead class="table-success">
                                        <th>Código</th>
                                        <th>Titulo</th>
                                        <th>Estudiante</th>
                                        <th>Director</th>
                                        <th>Programa</th>
                                        <th>Empresa</th>
                                        <th># convenio</th>
                                        <th>Fecha convenio</th>
                                        <th>Formato RDC</th>
                                        <th>Fecha Entrega</th>
                                        <th>Calificador</th>
                                        <th>Estado</th>
                                        <th>Fecha Calificación</th>
                                        <th>Número Acta</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @if($ad->count())
                                        @foreach($apd as $des)
                                        @if($des->programas->coordinacion->coo_nombre === auth()->user()->programas->coordinacion->coo_nombre)
                                        <tr>
                                            <td>{{ $des->adp_id }}</td>
                                            <td>{{ $des->adp_titulo }}</td>
                                            <td> {{ $des->estudiante->nombres }} {{ $des->estudiante->apellidos }}</td>
                                            <td>{{$des->director->nombres}} {{ $des->director->apellidos }}</td>
                                            <td>{{ $des->programas->pro_nombre }}</td>
                                            <td>{{$des->adp_numconvenio}}</td>
                                            <td>{{$des->adp_fechaconvenio}}</td>
                                            <td>
                                                @if(isset($des->adp_formato))
                                                <a href="{{ action('AdministrativosController@downloadAuditoriaDesarrollo', $des->adp_id) }}">{{$des->adp_formato}} <span class="fas fa-download"></span></a>
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
                                        @else
                                        <tr>
                                            <td colspan="15">No hay registro !!</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div>
                            
                                <a href="{{ action('AdministrativosController@exportAuditoriaDesarrolloPractica') }}" title="Exportar"><img src="{{ asset('img/excel.png') }}" width="25px"></a></div>
                            
                        </article>



                        <article id="docentes"  >
                        <div class="art">

                                <table class="table">
                                    <thead class="table-success">
                                        <th>Documento</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Acciones</th>
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
                                            <td><a href="{{ action('AdministrativosController@setRolEstudiante',$doc->id) }}" class="btn btn-sm btn-primary" title="Remover Rol" onclick="return confirm('¿Esta seguro de quitar el rol a este usuario?')"><span class="fas fa-arrow-down"></span></a></td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="6">No hay registro !!</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                        </div>
                        <div>
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal" title="Nuevo"><span class="fas fa-plus"></span></button></div>
                            
                        </article>
                        <article id="administrativos" >
                        
                            <div  class="art">

                                <table class="table">
                                    <thead class="table-success">
                                        <th>Documento</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @if(isset($administrativos))
                                        @foreach($administrativos as $admin)
                                        <tr>
                                            <td>{{ $admin->documento }}</td>
                                            <td>{{ $admin->nombres }}</td>
                                            <td>{{ $admin->apellidos }}</td>
                                            <td>{{ $admin->telefono }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td><a href="{{ action('AdministrativosController@setRolEstudiante',$admin->id) }}" class="btn btn-sm btn-primary" title="Remover Rol" onclick="return confirm('¿Esta seguro de quitar el rol a este usuario?')"><span class="fas fa-arrow-down"></span></a></td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="6">No hay registro !!</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                
                            </div>
                            
                            <div><button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal2" title="Nuevo"><span class="fas fa-plus"></span></button></div>
    
                        </article>

                        <article id="limite">
                            <h3>Fecha límite de registro de propuestas:</h3>
                            @if(isset($restriccion))
                            <h1>{{ $restriccion->res_fecha }}</h1>
                            @else
                            <h1>No se ha asignado una fecha límite para el registro de las propuestas de trabajo de grado.</h1>
                            @endif
                            <br>
                            <br>
                            <br>
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal3" title="Cambiar"><span class="fas fa-pen"></span></button>
                        </article>
                </div>

                </section>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Asignar Docente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ action('AdministrativosController@setRolDocente') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="documento">Documento</label>
                        <input type="text" name="documento" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-primary" value="Asignar">
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Asignar Administrativo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ action('AdministrativosController@setRolAdministrativo') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="documento">Documento</label>
                        <input type="text" name="documento" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-primary" value="Asignar">
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal3">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambiar fecha límite de entrega de propuestas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ action('AdministrativosController@setFechaLimitePropuestas') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        @if(isset($restriccion))
                        <input type="date" name="fecha" class="form-control" value="{{ $restriccion->res_fecha }}" required>
                        @else
                        <input type="date" name="fecha" class="form-control" value="" required>
                        @endif
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-primary" value="Cambiar">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection