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
                                    <td>{{ auth()->user()->programas->pro_nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Estudiantes
                                        @if(count($estudiantes)<=3) <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal" title="Añadir estudiante"><span class="fas fa-plus"></span></button>
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
                                        <a href="{{ action('EstudiantesController@edit', auth()->user()->propuesta) }}" class="btn btn-sm btn-primary ml-3" title="Editar"><span class="fas fa-edit"></span></a>
                                        @if(isset(auth()->user()->propuestas->concepto->con_nombre) and count($desarrollo)===0 and auth()->user()->propuestas->concepto->con_nombre === 'APROBADO')
                                        <a href="{{ action('EstudiantesController@crearDesarrollo') }}" class="btn btn-sm btn-primary"><span class="fas fa-arrow-right">Seguir a Desarrollo</span></a>
                                        @endif
                                        <a href="{{ action('EstudiantesController@abandonar') }}" onclick="return confirm('¿Esta seguro de abandonar el trabajo de grado?')" title="Abandonar propuesta" class="btn btn-sm btn-danger"><span class="fas fa-arrow-left"></span></a>
                                    </td>
                                </tr>


                            </table>
                        </article>


                        <div class="btn-group">
                        </div>
                        <article class="desarrollo panels-item" id="desarrollo">
                            <table class="table">
<<<<<<< HEAD
                                @if(isset(auth()->user()->propuestas->concepto->con_nombre) and count($desarrollo)!==0 and auth()->user()->propuestas->concepto->con_nombre === 'APROBADO')
=======
                            @if(count($desarrollo)!=0)
>>>>>>> 1cf002d53f82aacec6a2232d85e9dfaebd401e57


                                @if(isset($desarrollo))
                                @foreach($desarrollo as $des)

                                <tr>
                                    <th>Código</th>
                                    <td>{{ $des->des_id }}</td>
                                </tr>
                                <tr>
                                    <th>Nombre de la propuestas</th>
                                    <td>{{ $des->propuesta->prop_titulo }}</td>
                                </tr>
                                <tr>
                                    <th>Modalidad</th>
                                    <td>{{ $des->propuesta->modalidad->mod_nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Programa</th>
                                    <td>{{ auth()->user()->programas->pro_nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Estudiantes
                                        @if(count($estudiantes)<=3) <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" title="Agregar Estudiante" data-target="#modal"><span class="fas fa-plus"></span></button>
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
                                    <td>{{ $des->propuesta->director->nombres }} {{ $des->propuesta->director->apellidos }}</td>
                                </tr>
                                <tr>
                                    <th>Codirector</th>
                                    <td> @if(isset($des->propuesta->codirector))
                                        {{ $des->propuesta->codirector->nombres }}
                                        {{ $des->propuesta->codirector->apellidos }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Formato RDC</th>
                                    <td>
                                        @if( isset($des->des_formato) )
                                        <a href="{{ action('EstudiantesController@desarrolloDownload') }}" title="Descargar">{{ $des->des_formato }} <span class="fas fa-download"></span></a>
                                        @else
                                        <button type="button" title="subir informe final" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal3"><span class="fas fa-upload"></span></button>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Calificador</th>
                                    <td>
                                        @if(isset($des->concepto->calificador))
                                        {{ $des->concepto->calificador->nombres }}
                                        {{ $des->concepto->calificador->apellidos }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td>
                                        @if(isset($des->concepto))
                                        {{ $des->concepto->con_nombre }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Novedades</th>

                                    <td>
                                        @if(isset($novedades))
                                        <button type="button" class="btn btn-sm btn-primary" title="Novedades" data-toggle="modal" data-target="#modal2"><span class="fas fa-eye"></span></button>
                                        @endif
                                        <button type="button" class="btn btn-sm btn-primary" title="Nueva novedad" data-toggle="modal" data-target="#novedades"><span class="fas fa-plus"></span></button>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Acciones</th>

                                    <td>
<<<<<<< HEAD
                                        <a href="" class="btn btn-sm btn-primary ml-3" title="Editar informe final"><span class="fas fa-edit"></span></a>
=======
                                        <a href="{{ action('EstudiantesController@desarrolloEdit', auth()->user()->propuesta) }}" class="btn btn-sm btn-primary ml-3" title="Editar" ><span class="fas fa-edit"></span></a>
>>>>>>> 1cf002d53f82aacec6a2232d85e9dfaebd401e57
                                        @if(isset(auth()->user()->propuestas->concepto->con_nombre) and count($desarrollo)===0 and auth()->user()->propuestas->concepto->con_nombre === 'APROBADO')
                                        <a href="{{ action('EstudiantesController@crearDesarrollo') }}" class="btn btn-sm btn-primary"><span class="fas fa-arrow-right"> Seguir a Desarrollo</span></a>
                                        @endif
                                        <a href="{{ action('EstudiantesController@abandonar') }}" onclick="return confirm('¿Esta seguro de abandonar el trabajo de grado?')" title="Dejar trabajo de grado" class="btn btn-sm btn-danger"><span class="fas fa-arrow-left"></span></a>

                                    </td>
                                </tr>


                                @endforeach
                                @endif

<<<<<<< HEAD
                                @elseif(isset(auth()->user()->propuestas->concepto->con_nombre) and count($desarrollo)===0 and auth()->user()->propuestas->concepto->con_nombre === 'APROBADO')
                                <div class="jumbotron">
                                    <h1 class="display-4">Propuesta de Grado Aprobada!!</h1>
                                    <a href="{{ action('EstudiantesController@crearDesarrollo') }}" class="btn btn-sm btn-primary"><span class="fas fa-arrow-right">Seguir a Informe final</span></a>
                                </div>
                                @else
                                <div class="jumbotron">
                                    <h1 class="display-4">Aun tu propuesta de Grado no ha sido Aprobada!!</h1>
                                    <hr class="my-4">
                                    <p>cuando tu propuesta de grado sea aprobada aparecerá un boton para seguir con el informe final</p>

                                </div>
=======
                            @elseif(isset(auth()->user()->propuestas->concepto) && count($desarrollo)===0 && auth()->user()->propuestas->concepto->con_nombre === 'APROBADO')
                            <div class="jumbotron">
                                <h1 class="display-4">Propuesta de Grado Aprobada!!</h1>
                                <a href="{{ action('EstudiantesController@crearDesarrollo') }}" class="btn btn-sm btn-primary"><span class="fas fa-arrow-right">Seguir a Informe final</span></a>
                            </div>
                            @else
                            <div class="jumbotron">
                                <h1 class="display-4">Aun tu propuesta de Grado no ha sido Aprobada!!</h1>
                                <hr class="my-4">
                                <p>cuando tu propuesta de grado sea aprobada aparecerá un boton para seguir con el informe final</p>
                                
                            </div>
>>>>>>> 1cf002d53f82aacec6a2232d85e9dfaebd401e57




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
<a href="{{route('estudiantes.create')}}" class="btn btn-primary">Registrar Popuesta</a>
@endif
@endsection