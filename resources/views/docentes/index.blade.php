@extends('layout')

@section('content')
<div class="pagina-info">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header p-3 mb-2 bg-success text-white">
                    <br>
                    <center>
                        <h1>Docentes</h1>
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
                                    <a href="#banco" class="nav-link">Banco de ideas</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#calificar" class="nav-link">Calificar</a>
                                </li>
                            </ul>
                        </div>

                        <article id="propuestas">
                          <center><h3>Eres director de estas propuestas:</h3></center>  
                            <div class="table-responsive">
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
                            <div class="table-responsive">
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
                        <article id="trabajos">
                           <center> <h3>Eres director de estos Trabajos de grado:</h3></center>
                            <div class="table-responsive">

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
                            <div class="table-responsive">

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
                        <article id="banco">
                            <br>
                        <div class="table-responsive">

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
                            
                            <a href="{{ route('banco.create') }}" class="btn btn-primary mt-3">Agregar</a>
                            </div>
                        </article>

                        <article id="calificar">
                        <div class="table-responsive">
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
                                        <td>Propuesta</td>
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
                                        <td>Trabajo</td>
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