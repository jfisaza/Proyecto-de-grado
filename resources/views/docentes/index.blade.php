@extends('layout')

@section('content')
<div class="pagina-info">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header p-3 mb-2 bg-success text-white">
                    <br>
                    <center>
                        <h1>Hola Docente {{ auth()->user()->nombres }}</h1>
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
                                    <a class="nav-link" href="#trabajos">Informes Finales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#practicas">Prácticas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#practicasFinal">Prácticas Final</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#banco" class="nav-link">Banco de ideas</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#calificar" class="nav-link">Calificar </a>
                                </li>

                            </ul>
                        </div>

                        <article id="propuestas"  >
                          <center><h3>Eres director de estas propuestas:</h3></center>  
                          <div class="art">

                            <table class="table table-hover" class="art">
                                <thead class="table-success">
                                    <th>Código</th>
                                    <th>Titulo</th>
                                    <th>Modalidad</th>
                                    <th>Programa</th>
                                    <th>Estudiantes</th>
                                    <th>Codirector</th>
                                    <th>Formato RDC</th>
                                    <th>Calificador</th>
                                    <th>Estado</th>
                                </thead>
                                <tbody>
                                    @if(isset($propuestas))
                                    @foreach($propuestas as $pro)
                                    <tr>
                                        <td>{{ $pro->prop_id }}</td>
                                        <td>{{ $pro->prop_titulo }}</td>
                                        <td>{{ $pro->modalidad->mod_nombre }}</td>
                                        <td>{{ $pro->programas->pro_nombre }}</td>
                                        <td>
                                            <table>
                                                @foreach($pro->estudiantes as $est)
                                                <tr>
                                                    <td>{{ $est->nombres }} {{ $est->apellidos }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            @if(isset($pro->prop_codir_usu_id))
                                            {{ $pro->codirector->nombres }} {{ $pro->codirector->apellidos }}
                                            @endif
                                        </td>
                                        <td><a href="{{ action('DocentesController@downloadPropuesta',$pro->prop_id) }}">{{ $pro->prop_formato }} <span class="fas fa-download"></span></a></td>
                                        <td>
                                            @if(isset($pro->prop_con_id))
                                            {{ $pro->concepto->calificador->nombres }} {{ $pro->concepto->calificador->apellidos }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($pro->prop_con_id))
                                            {{ $pro->concepto->con_nombre }}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8">No tienes propuestas asignadas.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                          </div>
                            <center><h3>Eres codirector de estas propuestas:</h3></center>
                            <div class="art">

                            <table class="table">
                                <thead class="table-success">
                                    <th>Código</th>
                                    <th>Titulo</th>
                                    <th>Modalidad</th>
                                    <th>Programa</th>
                                    <th>Estudiantes</th>
                                    <th>Codirector</th>
                                    <th>Formato RDC</th>
                                    <th>Calificador</th>
                                    <th>Estado</th>
                                </thead>
                                <tbody>
                                    @if(isset($propuestasc))
                                    @foreach($propuestasc as $pro)
                                    <tr>
                                        <td>{{ $pro->prop_id }}</td>
                                        <td>{{ $pro->prop_titulo }}</td>
                                        <td>{{ $pro->modalidad->mod_nombre }}</td>
                                        <td>{{ $pro->programas->pro_nombre }}</td>
                                        <td>
                                            <table>
                                                @foreach($pro->estudiantes as $est)
                                                <tr>
                                                    <td>{{ $est->nombres }} {{ $est->apellidos }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            @if(isset($pro->prop_codir_usu_id))
                                            {{ $pro->codirector->nombres }} {{ $pro->codirector->apellidos }}
                                            @endif
                                        </td>
                                        <td><a href="{{ action('DocentesController@downloadPropuesta',$pro->prop_id) }}">{{ $pro->prop_formato }} <span class="fas fa-download"></span></a></td>
                                        <td>
                                            @if(isset($pro->prop_con_id))
                                            {{ $pro->concepto->calificador->nombres }} {{ $pro->concepto->calificador->apellidos }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($pro->prop_con_id))
                                            {{ $pro->concepto->con_nombre }}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8">No tienes propuestas asignadas.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            </div>
                        </article>
                        <article id="trabajos"  >
                           <center> <h3>Eres director de estos Trabajos de grado:</h3></center>
                            <div class="art">

                            <table class="table">
                                <thead class="table-success">
                                    <th>Código</th>
                                    <th>Titulo</th>
                                    <th>Modalidad</th>
                                    <th>Programa</th>
                                    <th>Estudiantes</th>
                                    <th>Director</th>
                                    <th>Codirector</th>
                                    <th>Formato RDC</th>
                                    <th>Calificador</th>
                                    <th>Estado</th>
                                    <th>Sustentación</th>
                                </thead>
                                <tbody>
                                    @if(isset($desarrollo))
                                    @foreach($desarrollo as $des)
                                    <tr>
                                        <td>{{ $des->des_id }}</td>
                                        <td>{{ $des->des_titulo }}</td>
                                        <td>{{ $des->modalidad->mod_nombre }}</td>
                                        <td>{{ $des->programas->pro_nombre }}</td>
                                        <td>
                                            <table>
                                                @foreach($des->estudiantes as $est)
                                                <tr>
                                                    <td>{{ $est->nombres }} {{ $est->apellidos }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>{{ $des->director->nombres }} {{ $des->director->apellidos }}</td>
                                        <td>
                                            @if(isset($des->des_codir_usu_id))
                                            {{ $des->codirector->nombres }} {{ $des->codirector->apellidos }}
                                            @endif
                                        </td>
                                        <td><a href="{{ action('DocentesController@downloadDesarrollo',$des->des_id) }}">{{ $des->des_formato }} <span class="fas fa-download"></span></a></td>
                                        <td>
                                            @if(isset($des->prop_con_id))
                                            {{ $des->concepto->calificador->nombres }} {{ $des->concepto->calificador->apellidos }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($des->des_con_id))
                                            {{ $des->concepto->con_nombre }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($des->des_citacion))
                                            {{ $des->des_citacion }}
                                            <a href="{{ action('DocentesController@sustentacion',$des->des_id) }}" class="btn btn-sm btn-primary" title="Editar fecha de sustentación"><span class="fas fa-pen"></span></a>
                                            @else
                                            <a href="{{ action('DocentesController@sustentacion',$des->des_id) }}" class="btn btn-sm btn-primary" title="Agregar fecha de sustentación"><span class="fas fa-plus"></span></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8">No tienes trabajos asignados.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            </div>
                           <center> <h3>Eres codirector de estos Trabajos de grado:</h3></center>
                           <div class="art">

                            <table class="table">
                                <thead class="table-success">
                                    <th>Código</th>
                                    <th>Titulo</th>
                                    <th>Modalidad</th>
                                    <th>Programa</th>
                                    <th>Estudiantes</th>
                                    <th>Director</th>
                                    <th>Codirector</th>
                                    <th>Formato RDC</th>
                                    <th>Calificador</th>
                                    <th>Estado</th>
                                </thead>
                                <tbody>
                                    @if(isset($desarrolloc))
                                    @foreach($desarrolloc as $des)

                                    <tr>
                                        <td>{{ $des->des_id }}</td>
                                        <td>{{ $des->des_titulo }}</td>
                                        <td>{{ $des->modalidad->mod_nombre }}</td>
                                        <td>{{ $des->programas->pro_nombre }}</td>
                                        <td>
                                            <table>
                                                @foreach($des->estudiantes as $est)
                                                <tr>
                                                    <td>{{ $est->nombres }} {{ $est->apellidos }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>{{ $des->director->nombres }} {{ $des->director->apellidos }}</td>
                                        <td>
                                            @if(isset($des->des_codir_usu_id))
                                            {{ $des->codirector->nombres }} {{ $des->codirector->apellidos }}
                                            @endif
                                        </td>
                                        <td><a href="{{ action('DocentesController@downloadDesarrollo',$des->des_id) }}">{{ $des->des_formato }} <span class="fas fa-download"></span></a></td>
                                        <td>
                                            @if(isset($des->prop_con_id))
                                            {{ $des->concepto->calificador->nombres }} {{ $des->concepto->calificador->apellidos }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($des->des_con_id))
                                            {{ $des->concepto->con_nombre }}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8">No tienes trabajos asignados.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            </div>
                        </article>
                        <article id="practicas" >
                          <center><h3>Eres director de estas practicas:</h3></center>  
                          <div class="art">
                            <table class="table">
                                <thead class="table-success">
                                    <th>Código</th>
                                    <th>Titulo</th>
                                    <th>Programa</th>
                                    <th># Convenio</th>
                                    <th>Estudiante</th>
                                    <th>Empresa</th>
                                    <th>Formato RDC</th>
                                    <th>Calificador</th>
                                    <th>Estado</th>
                                </thead>
                                <tbody>
                                    @if(isset($propPractica))
                                    @foreach($propPractica as $pro)
                                    <tr>
                                        <td>{{ $pro->pp_id }}</td>
                                        <td>{{ $pro->pp_titulo }}</td>
                                        <td>{{ $pro->programas->pro_nombre }}</td>
                                        <td>{{$pro->pp_numconvenio}}</td>
                                        <td>{{$pro->estudiante->nombres}}</td>
                                        <td>{{$pro->empresa->emp_nombre}} </td>
                                        <td><a href="{{ action('DocentesController@downloadPropuestaPractica',$pro->pp_id) }}">{{ $pro->pp_formato }} <span class="fas fa-download"></span></a></td>
                                        <td>
                                            @if(isset($pro->pp_con_id))
                                            {{ $pro->concepto->calificador->nombres }} {{ $pro->concepto->calificador->apellidos }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($pro->pp_con_id))
                                            {{ $pro->concepto->con_nombre }}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8">No tienes propuestas asignadas.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            </div>
                            
                        </article>
                        <article id="practicasFinal" >
                          <center><h3>Eres director de estas practicas de Informe Final:</h3></center>  
                          <div class="art">

                            <table class="table">
                                <thead class="table-success table-hover">
                                    <th>Código</th>
                                    <th>Titulo</th>
                                    <th>Programa</th>
                                    <th># Convenio</th>
                                    <th>Estudiante</th>
                                    <th>Empresa</th>
                                    <th>Formato RDC</th>
                                    <th>Calificador</th>
                                    <th>Estado</th>
                                </thead>
                                <tbody>
                                    @if(isset($desPractica))
                                    @foreach($desPractica as $des)
                                    <tr>
                                        <td>{{ $des->dp_id }}</td>
                                        <td>{{ $des->dp_titulo }}</td>
                                        <td>{{ $des->programas->pro_nombre }}</td>
                                        <td>{{$des->dp_numconvenio}}</td>
                                        <td>{{$des->estudiante->nombres}}</td>
                                        <td>{{$des->empresa->emp_nombre}} </td>
                                        <td><a href="{{ action('DocentesController@downloadDesarrolloPractica',$des->dp_id) }}">{{ $des->dp_formato }} <span class="fas fa-download"></span></a></td>
                                        <td>
                                            @if(isset($des->dp_con_id))
                                            {{ $des->concepto->calificador->nombres }} {{ $des->concepto->calificador->apellidos }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($des->dp_con_id))
                                            {{ $des->concepto->con_nombre }}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8">No tienes propuestas asignadas.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                          </div>
                            
                        </article>
                        <article id="banco" >
                            <br>
                            <div class="art">

                            <table class="table">
                                <thead class="table-success">
                                    <th>Nombre</th>
                                    <th>Modalidad</th>
                                    <th>Programa</th>
                                    <th>Director</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach($banco as $ban)
                                    <tr>
                                        <td>{{ $ban->ban_nombre }}</td>
                                        <td>{{ $ban->modalidad->mod_nombre }}</td>
                                        <td>{{ $ban->programa->pro_nombre }}</td>
                                        <td>{{ $ban->usuarios->nombres }} {{ $ban->usuarios->apellidos }}</td>
                                        <td>{{ $ban->usuarios->telefono }}</td>
                                        <td>{{ $ban->usuarios->email }}</td>
                                        <td>
                                            <a href="{{ route('banco.edit',$ban->ban_id) }}" class="btn btn-sm btn-primary" title="Editar"><span class="fas fa-edit"></span></a>
                                            <a href="{{ route('banco.destroy', $ban->ban_id) }}" class="btn btn-sm btn-primary" title="Eliminar" onclick="return confirm('¿Esta seguro de eliminar esta idea del banco?')"><span class="fas fa-trash"></span></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                            <div>
                            <a href="{{ route('banco.create') }}" class="btn btn-sm btn-success mt-3"><span class="fas fa-plus"></span></a>
                            </div>
                        </article>

                        <article id="calificar"  >
                        <div class="art">
                        <br>
                            <table class="table">
                                <thead class="table-success">
                                    <th>Tipo</th>
                                    <th>Código</th>
                                    <th>Titulo</th>
                                    <th>Modalidad</th>
                                    <th>Programa</th>
                                    <th>Estudiantes</th>
                                    <th>Director</th>
                                    <th>Codirector</th>
                                    <th>Formato RDC</th>
                                    <th>Calificar</th>
                                </thead>
                                <tbody>
                                    @if(isset($calificar))
                                    @foreach($calificar as $cal)
                                    @if(empty($cal->con_nombre) || $cal->con_nombre==='ESPERA')
                                    @if(isset($cal->propuestas))

                                    <tr>
                                        <td>PROPUESTA</td>
                                        <td>{{ $cal->propuestas->prop_id }}</td>
                                        <td>{{ $cal->propuestas->prop_titulo }}</td>
                                        <td>{{ $cal->propuestas->modalidad->mod_nombre }}</td>
                                        <td>{{ $cal->propuestas->programas->pro_nombre }}</td>
                                        <td>
                                            <table>
                                                @foreach($cal->propuestas->estudiantes as $est)
                                                <tr>
                                                    <td>{{ $est->nombres }} {{ $est->apellidos }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>{{ $cal->propuestas->director->nombres }} {{ $cal->propuestas->director->apellidos }}</td>
                                        <td>
                                            @if(isset($cal->propuestas->codirector))
                                            {{ $cal->propuestas->codirector->nombres }} {{ $cal->propuestas->codirector->apellidos }}
                                            @endif
                                        </td>
                                        <td><a href="{{ action('DocentesController@downloadPropuesta', $cal->propuestas->prop_id) }}">{{ $cal->propuestas->prop_formato }}</a></td>
                                        <td>
                                            <a href="{{ route('docentes.edit', $cal->con_id) }}" class="btn btn-primary btn-sm" title="Calificar"><span class="fas fa-pen-alt"></span></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @if(isset($cal->desarrollos))
                                    <tr>
                                        <td>TRABAJO</td>
                                        <td>{{ $cal->desarrollos->des_id }}</td>
                                        <td>{{ $cal->desarrollos->des_titulo }}</td>
                                        <td>{{ $cal->desarrollos->modalidad->mod_nombre }}</td>
                                        <td>{{ $cal->desarrollos->programas->pro_nombre }}</td>
                                        <td>
                                            <table>
                                                @foreach($cal->desarrollos->estudiantes as $est)
                                                <tr>
                                                    <td>{{ $est->nombres }} {{ $est->apellidos }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>{{ $cal->desarrollos->director->nombres }} {{ $cal->desarrollos->director->apellidos }}</td>
                                        <td>
                                            @if(isset($cal->desarrollos->codirector))
                                            {{ $cal->desarrollos->codirector->nombres }} {{ $cal->desarrollos->codirector->apellidos }}
                                            @endif
                                        </td>
                                        <td><a href="{{ action('DocentesController@downloadDesarrollo', $cal->desarrollos->des_id) }}">{{ $cal->desarrollos->des_formato }}</a></td>
                                        <td>
                                            <a href="{{ route('docentes.edit', $cal->con_id) }}" class="btn btn-primary btn-sm" title="Calificar"><span class="fas fa-pen-alt"></span></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @if(isset($cal->propuestasP))
                                    <tr>
                                        <td>PROPUESTA PRACTICA</td>
                                        <td>{{ $cal->propuestasP->pp_id }}</td>
                                        <td>{{ $cal->propuestasP->pp_titulo }}</td>
                                        <td>PRACTICA</td>
                                        <td>{{ $cal->propuestasP->programas->pro_nombre }}</td>
                                        <td>{{ $cal->propuestasP->estudiante->nombres }} {{ $cal->propuestasP->estudiante->apellidos}}</td>
                                        <td>{{ $cal->propuestasP->director->nombres }} {{ $cal->propuestasP->director->apellidos }}</td>
                                        <td></td>
                                        <td><a href="{{ action('DocentesController@downloadPropuestaPractica', $cal->propuestasP->pp_id) }}">{{ $cal->propuestasP->pp_formato }}</a></td>
                                        <td>
                                            <a href="{{ route('docentes.edit', $cal->con_id) }}" class="btn btn-primary btn-sm" title="Calificar"><span class="fas fa-pen-alt"></span></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @if(isset($cal->desarrollosP))
                                    <tr>
                                        <td>TRABAJO FINAL PRACTICA</td>
                                        <td>{{ $cal->desarrollosP->dp_id }}</td>
                                        <td>{{ $cal->desarrollosP->dp_titulo }}</td>
                                        <td>PRACTICA</td>
                                        <td>{{ $cal->desarrollosP->programas->pro_nombre }}</td>
                                        <td>{{ $cal->desarrollosP->estudiante->nombres }} {{ $cal->desarrollosP->estudiante->apellidos}}</td>
                                        <td>{{ $cal->desarrollosP->director->nombres }} {{ $cal->desarrollosP->director->apellidos }}</td>
                                        <td></td>
                                        <td><a href="{{ action('DocentesController@downloadDesarrolloPractica', $cal->desarrollosP->dp_id) }}">{{ $cal->desarrollosP->dp_formato }}</a></td>
                                        <td>
                                            <a href="{{ route('docentes.edit', $cal->con_id) }}" class="btn btn-primary btn-sm" title="Calificar"><span class="fas fa-pen-alt"></span></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endif

                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8">No tienes trabajos asignados.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        </article>
                      
                </div>
            </div>
        </div>
    </div>
</div>

@endsection