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
                        @if(isset($practicas))
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
                                    <td>{{ $practicas->pp_id }}</td>
                                </tr>
                                <tr>
                                    <th>Titulo de la propuesta</th>
                                    <td>{{ $practicas->pp_titulo }}</td>

                                </tr>
                                <tr>
                                    <th>Empresa</th>
                                    <td>{{ $practicas->empresa->emp_nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Numero de convenio</th>
                                    <td>{{ $practicas->pp_numconvenio }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de convenio</th>
                                    <td>{{ $practicas->pp_fechaconvenio }}</td>
                                </tr>
                                
                                <tr>
                                    <th>Director</th>
                                    <td>{{ $practicas->director->nombres }} {{ $practicas->director->apellidos }}</td>
                                </tr>
                            
                                <tr>
                                    <th>Formato RDC</th>
                                    <td>

                                        @if(isset($practicas->pp_formato))
                                        <a href="{{ action('EstudiantesController@propuestaPracticaDownload',$practicas->pp_id) }}">{{ $practicas->pp_formato }} <span class="fas fa-download"></span></a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>

                                    <th>Calificador</th>
                                    <td> @if(isset($practicas->concepto->calificador))
                                        {{ $practicas->concepto->calificador->nombres }}
                                        {{ $practicas->concepto->calificador->apellidos }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td id="estado">
                                        @if(isset($practicas->concepto->con_nombre))
                                        {{ $practicas->concepto->con_nombre}}

                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Acciones</th>

                                    <td>
                                    @if(is_null($practicas->desarrollo))
                                        @if(is_null($practicas->pp_con_id) || (isset($practicas->concepto->con_nombre) && $practicas->concepto->con_nombre != 'APROBADO'))
                                        <a href="{{ action('EstudiantesController@abandonarPractica') }}" onclick="return confirm('¿Esta seguro de abandonar el trabajo de grado?')" title="Abandonar propuesta" class="btn btn-sm btn-danger"><span class="fas fa-arrow-left"></span></a>
                                        <a href="{{ action('EstudiantesController@editp',$practicas->pp_id) }}" class="btn btn-sm btn-primary ml-3" title="Editar"><span class="fas fa-edit"></span></a>
                                        @endif
                                        @endif
                                        @if(isset($practicas->concepto->con_nombre) and is_null($practicas->desarrollo) and $practicas->concepto->con_nombre === 'APROBADO')
                                        <a href="{{ action('EstudiantesController@crearDesarrolloPractica',$practicas->pp_id) }}" class="btn btn-sm btn-primary">Seguir a Desarrollo <span class="fas fa-arrow-right"></span></a>
                                        @endif
                                    </td>
                                </tr>


                            </table>
                        </article>


                        <div class="btn-group">
                        </div>
                        <article class="desarrollo panels-item" id="desarrollo">
                            <table class="table">
                            @if(isset($desarrollo))
                                <tr>
                                    <th>Código</th>
                                    <td>{{ $desarrollo->dp_id }}</td>
                                </tr>
                                <tr>
                                    <th>Titulo</th>
                                    <td>{{ $desarrollo->dp_titulo }}</td>
                                </tr>
                                <tr>
                                    <th>Empresa</th>
                                    <td>{{ $desarrollo->empresa->emp_nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Numero de convenio</th>
                                    <td>{{ $desarrollo->dp_numconvenio }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de convenio</th>
                                    <td>{{ $desarrollo->dp_fechaconvenio }}</td>
                                </tr>
                                <tr>
                                    <th>Director</th>
                                    <td>{{ $desarrollo->director->nombres }} {{ $desarrollo->director->apellidos }}</td>
                                </tr>
                                <tr>
                                    <th>Formato RDC</th>
                                    <td>
                                        @if( $desarrollo->dp_formato)
                                        <a href="{{ action('EstudiantesController@desarrolloPracticaDownload',$desarrollo->dp_id) }}" title="Descargar">{{ $desarrollo->dp_formato }} <span class="fas fa-download"></span></a>
                                        @else
                                        <button type="button" title="subir informe final" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal3"><span class="fas fa-upload"></span></button>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Calificador</th>
                                    <td>
                                        @if(isset($desarrollo->concepto->calificador))
                                        {{ $desarrollo->concepto->calificador->nombres }}
                                        {{ $desarrollo->concepto->calificador->apellidos }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td>
                                        @if(isset($desarrollo->concepto))
                                        {{ $desarrollo->concepto->con_nombre }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Novedades</th>

                                    <td>
                                        @if(isset($novedadesp))
                                        <button type="button" class="btn btn-sm btn-primary" title="Novedades" data-toggle="modal" data-target="#modal2"><span class="fas fa-eye"></span></button>
                                        @endif
                                        @if(is_null($desarrollo->concepto) || (isset($desarrollo->concepto) && $desarrollo->concepto->con_nombre != 'APROBADO'))
                                        <button type="button" class="btn btn-sm btn-primary" title="Nueva novedad" data-toggle="modal" data-target="#novedades"><span class="fas fa-plus"></span></button>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Acciones</th>

                                    <td>
                                    @if(is_null($desarrollo->concepto) || (isset($desarrollo->concepto) && $desarrollo->concepto->con_nombre != 'APROBADO'))
                                        <a href="{{ action('EstudiantesController@desarrolloPracticaEdit',$desarrollo->dp_id) }}" class="btn btn-sm btn-primary ml-3" title="Editar" ><span class="fas fa-edit"></span></a>
                                        <a href="{{ action('EstudiantesController@abandonarPractica') }}" onclick="return confirm('¿Esta seguro de abandonar el trabajo de grado?')" title="Dejar trabajo de grado" class="btn btn-sm btn-danger"><span class="fas fa-arrow-left"></span></a>
                                    @endif
                                    @if(isset($desarrollo->concepto) && $desarrollo->concepto->con_nombre === 'APROBADO')
                                        <a href="{{ action('EstudiantesController@finalizarPractica',$desarrollo->dp_id) }}" class="btn btn-sm btn-success">Finalizar Proceso <span class="fas fa-arrow-right"></span></a>
                                    @endif
                                    </td>
                                </tr>
                                @elseif(isset($practicas->concepto) && $practicas->concepto->con_nombre === 'APROBADO')
                                <div class="jumbotron">
                                    <h1 class="display-4">Propuesta de Practica Aprobada!!</h1>
                                    <a href="{{ action('EstudiantesController@crearDesarrolloPractica',$practicas->pp_id) }}" class="btn btn-sm btn-primary">Seguir a desarrollo <span class="fas fa-arrow-right"></span></a>
                                </div>
                                @else
                                <div class="jumbotron">
                                    <h1 class="display-4">Aun tu propuesta de Practica no ha sido Aprobada!!</h1>
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




        @if(isset($desarrollo))
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
                        @if(isset($novedadesp))
                        @foreach($novedadesp as $nov)
                        {{ $nov->np_descripcion }}
                        <br>
                        Fecha de creación:
                        {{ $nov->np_fecha }}
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
                        <form action="{{ action('EstudiantesController@subirFormatoPractica',$desarrollo->dp_id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="dp_formato">Formato</label>
                                <input type="file" name="dp_formato" id="dp_formato">
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
                        <form action="{{ action('EstudiantesController@novedadesPractica',$desarrollo->dp_id) }}" method="post">
                            {{ csrf_field()}}
                            <textarea name="np_descripcion" class="form-control" cols="30" rows="10" placeholder="Digite la descripcion de la novedad a registrar."></textarea>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endif
@endsection