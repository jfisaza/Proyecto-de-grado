@extends('layout')

@section('content')
<link rel="stylesheet" href="../public/css/error.css">
<div class="pagina-info">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header p-3 mb-2 bg-success text-white">
                        <h4>
                            <center><strong>Hola {{ auth()->user()->nombres }}
                                    Aquí tu proyecto </strong></center>
                        </h4>
                    </div>

                    @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <section class="tablas">
                        @if(isset(auth()->user()->propuestas->prop_id))
                        <div class="tabs">
                            <ul class="nav nav-tabs" id="tabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="#propuesta">Propuesta</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="btn-desarrollo" href="#desarrollo">Desarrollo</a>
                                </li>
                            </ul>
                        </div>
                        <article class="propuesta panels-item" id="propuesta">

                            <table class="table">


                                <tr>
                                    <th>Código</th>
                                    <td>{{ auth()->user()->propuestas->prop_id }}</td>
                                </tr>
                                <tr>
                                    <th>Titulo de la propuesta</th>
                                    <td>{{ auth()->user()->propuestas->prop_titulo }}</td>

                                </tr>
                                <tr>
                                    <th>Modalidad</th>
                                    <td>{{ auth()->user()->propuestas->modalidad->mod_nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Programa</th>
                                    <td>{{ auth()->user()->propuestas->programas->pro_nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Estudiantes
                                    @if(is_null(auth()->user()->desarrollo))
                                    @if(is_null(auth()->user()->propuestas->prop_con_id) || (isset(auth()->user()->propuestas->concepto->con_nombre) && auth()->user()->propuestas->concepto->con_nombre != 'APROBADO'))
                                        @if(count($estudiantes)<=3) 
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal" title="Añadir estudiante"><span class="fas fa-plus"></span></button>
                                        @endif
                                    @endif
                                    @endif
                                    </th>
                                    <td>
                                        <table>
                                            @foreach($estudiantes as $est)
                                            <tr>
                                                <td>{{ $est->nombres }} {{ $est->apellidos }}</td>
                                            </tr>
                                            @endforeach

                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Director</th>
                                    <td>{{ auth()->user()->propuestas->director->nombres }} {{ auth()->user()->propuestas->director->apellidos }}</td>
                                </tr>
                                <tr>
                                    <th>Codirector</th>
                                    <td>
                                        @if(isset(auth()->user()->propuestas->codirector))
                                        {{ auth()->user()->propuestas->codirector->nombres }}
                                        {{ auth()->user()->propuestas->codirector->apellidos }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Formato RDC</th>
                                    <td>

                                        @if(isset(auth()->user()->propuestas->prop_formato))
                                        <a href="{{ action('EstudiantesController@propuestaDownload') }}">{{ auth()->user()->propuestas->prop_formato }} <span class="fas fa-download"></span></a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>

                                    <th>Calificador</th>
                                    <td> @if(isset(auth()->user()->propuestas->concepto->calificador))
                                        {{ auth()->user()->propuestas->concepto->calificador->nombres }}
                                        {{ auth()->user()->propuestas->concepto->calificador->apellidos }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td id="estado">
                                        @if(isset(auth()->user()->propuestas->concepto->con_nombre))
                                        {{ auth()->user()->propuestas->concepto->con_nombre}}

                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Acciones</th>

                                    <td>
                                        
                                        @if(is_null(auth()->user()->desarrollo))
                                        @if(is_null(auth()->user()->propuestas->prop_con_id) || (isset(auth()->user()->propuestas->concepto->con_nombre) && auth()->user()->propuestas->concepto->con_nombre != 'APROBADO'))
                                        <a href="{{ action('EstudiantesController@abandonar') }}" onclick="return confirm('¿Esta seguro de abandonar el trabajo de grado?')" title="Abandonar propuesta" class="btn btn-sm btn-danger"><span class="fas fa-arrow-left"></span></a>
                                        <a href="{{ action('EstudiantesController@edit', auth()->user()->propuesta) }}" class="btn btn-sm btn-primary ml-3" title="Editar"><span class="fas fa-edit"></span></a>
                                        @endif
                                        @endif
                                        @if(isset(auth()->user()->propuestas->concepto->con_nombre) and is_null(auth()->user()->desarrollo) and auth()->user()->propuestas->concepto->con_nombre === 'APROBADO')
                                        <a href="{{ action('EstudiantesController@crearDesarrollo') }}" class="btn btn-sm btn-primary">Seguir a Desarrollo <span class="fas fa-arrow-right"></span></a>
                                        @endif
                                    </td>
                                </tr>


                            </table>
                        </article>


                        <div class="btn-group">
                        </div>
                        <article class="desarrollo panels-item" id="desarrollo">
                            <table class="table">
                            @if(isset(auth()->user()->desarrollo))
                                <tr>
                                    <th>Código</th>
                                    <td>{{ auth()->user()->desarrollos->des_id }}</td>
                                </tr>
                                <tr>
                                    <th>Titulo</th>
                                    <td>{{ auth()->user()->desarrollos->des_titulo }}</td>
                                </tr>
                                <tr>
                                    <th>Modalidad</th>
                                    <td>{{ auth()->user()->desarrollos->modalidad->mod_nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Programa</th>
                                    <td>{{ auth()->user()->desarrollos->programas->pro_nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Estudiantes
                                    </th>
                                    <td>
                                        <table>
                                            @foreach($estudiantesd as $est)
                                            <tr>
                                                <td>{{ $est->nombres }} {{ $est->apellidos }}</td>
                                            </tr>
                                            @endforeach

                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Director</th>
                                    <td>{{ auth()->user()->desarrollos->director->nombres }} {{ auth()->user()->desarrollos->director->apellidos }}</td>
                                </tr>
                                <tr>
                                    <th>Codirector</th>
                                    <td> @if(isset(auth()->user()->desarrollos->codirector))
                                        {{ auth()->user()->desarrollos->codirector->nombres }}
                                        {{ auth()->user()->desarrollos->codirector->apellidos }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Formato RDC</th>
                                    <td>
                                        @if( isset(auth()->user()->desarrollos->des_formato) )
                                        <a href="{{ action('EstudiantesController@desarrolloDownload') }}" title="Descargar">{{ auth()->user()->desarrollos->des_formato }} <span class="fas fa-download"></span></a>
                                        @else
                                        <button type="button" title="subir informe final" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal3"><span class="fas fa-upload"></span></button>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Calificador</th>
                                    <td>
                                        @if(isset(auth()->user()->desarrollos->concepto->calificador))
                                        {{ auth()->user()->desarrollos->concepto->calificador->nombres }}
                                        {{ auth()->user()->desarrollos->concepto->calificador->apellidos }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td>
                                        @if(isset(auth()->user()->desarrollos->concepto))
                                        {{ auth()->user()->desarrollos->concepto->con_nombre }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Novedades</th>

                                    <td>
                                        @if(isset($novedades))
                                        <button type="button" class="btn btn-sm btn-primary" title="Novedades" data-toggle="modal" data-target="#modal2"><span class="fas fa-eye"></span></button>
                                        @endif
                                        @if(is_null(auth()->user()->desarrollos->concepto) || (isset(auth()->user()->desarrollos->concepto) && auth()->user()->desarrollos->concepto->con_nombre != 'APROBADO'))
                                        <button type="button" class="btn btn-sm btn-primary" title="Nueva novedad" data-toggle="modal" data-target="#novedades"><span class="fas fa-plus"></span></button>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Citación</th>

                                    <td>
                                        @if(isset(auth()->user()->desarrollos->des_citacion))
                                        {{ auth()->user()->desarrollos->des_citacion }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Acciones</th>

                                    <td>
                                    @if(is_null(auth()->user()->desarrollos->concepto) || (isset(auth()->user()->desarrollos->concepto) && auth()->user()->desarrollos->concepto->con_nombre != 'APROBADO'))
                                        <a href="{{ action('EstudiantesController@desarrolloEdit', auth()->user()->desarrollo) }}" class="btn btn-sm btn-primary ml-3" title="Editar" ><span class="fas fa-edit"></span></a>
                                        <a href="{{ action('EstudiantesController@abandonar') }}" onclick="return confirm('¿Esta seguro de abandonar el trabajo de grado?')" title="Dejar trabajo de grado" class="btn btn-sm btn-danger"><span class="fas fa-arrow-left"></span></a>
                                    @endif
                                    @if(isset(auth()->user()->desarrollos->concepto) && auth()->user()->desarrollos->concepto->con_nombre === 'APROBADO')
                                        <a href="{{ action('EstudiantesController@finalizar', auth()->user()->desarrollo) }}" class="btn btn-sm btn-success">Finalizar Proceso <span class="fas fa-arrow-right"></span></a>
                                    @endif
                                    </td>
                                </tr>
                                @elseif(isset(auth()->user()->propuestas->concepto) && auth()->user()->propuestas->concepto->con_nombre === 'APROBADO')
                                <div class="jumbotron">
                                    <h1 class="display-4">Propuesta de Grado Aprobada!!</h1>
                                    <a href="{{ action('EstudiantesController@crearDesarrollo') }}" class="btn btn-sm btn-primary">Seguir a desarrollo <span class="fas fa-arrow-right"></span></a>
                                </div>
                                @else
                                <div class="jumbotron">
                                    <h1 class="display-4">Aun tu propuesta de Grado no ha sido Aprobada!!</h1>
                                    <hr class="my-4">
                                    <p>cuando tu propuesta de grado sea aprobada aparecerá un boton para seguir con el informe final</p>

                                </div>
                                @endif
                            </table>

                        </article>

                </div>
            </div>
        </div>
        </section>



        <div class="modal" tabindex="-1" role="dialog" id="modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Estudiante</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning" role="alert">
                            Nota: El estudiante debe estar previamente registrado.
                        </div>
                        <form action="{{ action('EstudiantesController@agregarEstudiante') }}" method="post">
                            {{ csrf_field()}}
                            <input type="hidden" name="propuesta" value="{{ auth()->user()->propuestas->prop_id }}">
                            <label for="documento">Documento</label>
                            <input type="text" name="documento" class="form-control">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal" tabindex="-1" role="dialog" id="modal2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Novedades</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if(isset($novedades))
                        @foreach($novedades as $nov)
                        {{ $nov->nov_descripcion }}
                        <br>
                        Fecha de creación:
                        {{ $nov->nov_fecha }}
                        <hr>
                        @endforeach
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal" tabindex="-1" role="dialog" id="modal3">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Subir formato</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ action('EstudiantesController@subirFormato') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="des_formato">Formato</label>
                                <input type="file" name="des_formato" id="des_formato">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-primary" value="Subir">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="novedades">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Novedad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-primary" role="alert">
                            Las novedades se registran cuando se realizan cambios en el trabajo.
                        </div>
                        <form action="{{ action('EstudiantesController@novedades') }}" method="post">
                            {{ csrf_field()}}
                            <textarea name="nov_descripcion" class="form-control" cols="30" rows="10" placeholder="Digite la descripcion de la novedad a registrar."></textarea>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@else
@if(is_null($restriccion) || $restriccion->res_fecha >= date('Y-m-d'))
<center><br><a href="{{route('estudiantes.create')}}" class="btn btn-info ">Propuesta Trabajo de grado</a>
<a href="{{action ('EstudiantesController@createp')}}" class="btn btn-info "> Propuesta Práctica</a><br><br></center>
@else
<h3>El periodo de registro de propuestas ha finalizado.</h3>
@endif
@endif
@endsection