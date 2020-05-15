@extends('layout')

@section('content')
<div id="pagina">
<h1>Estudiante</h1>

@if(session('error'))
<div class="alert alert-danger" role="alert">
            {{ session('error') }}
</div>
@endif
<section class="tablas">
 @if(isset(auth()->user()->propuestas->prop_id))
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
    <article class="propuesta" id="propuesta">

    <table class="table-bordered table-hover table-striped">

        <thead>
            <th>Código</th>
            <th>Titulo de la propuesta</th>
            <th>Modalidad</th>
            <th>Programa</th>
            <th>Estudiantes 
            @if(count($estudiantes)<=3)
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal"><span class="fas fa-plus"></span></button>
                    @endif</th>
            <th>Director</th>
            <th>Codirector</th>
            <th>Formato RDC</th>
            <th>Calificador</th>
            <th>Estado</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            <tr>
                <td>{{ auth()->user()->propuestas->prop_id }}</td>
                <td>{{ auth()->user()->propuestas->prop_titulo }}</td>
                <td>{{ auth()->user()->propuestas->modalidad->mod_nombre }}</td>
                <td>{{ auth()->user()->programas->pro_nombre }}</td>
                <td>
                <table>
                    @foreach($estudiantes as $est)
                    <tr>
                        <td>{{ $est->nombres }} {{ $est->apellidos }}</td>
                    </tr>
                    @endforeach
                    
                </table>
                </td>
                <td>{{ auth()->user()->propuestas->director->nombres }} {{ auth()->user()->propuestas->director->apellidos }}</td>
                <td>
                    @if(isset(auth()->user()->propuestas->codirector))
                    {{ auth()->user()->propuestas->codirector->nombres }}
                    {{ auth()->user()->propuestas->codirector->apellidos }}
                    @endif
                </td>
                <td>
                    @if(isset(auth()->user()->propuestas->prop_formato))
                    <a href="{{ action('EstudiantesController@propuestaDownload') }}">{{ auth()->user()->propuestas->prop_formato }} <span class="fas fa-download"></span></a>
                    @endif
                </td>
                <td>
                    @if(isset(auth()->user()->propuestas->concepto->calificador))
                    {{ auth()->user()->propuestas->concepto->calificador->nombres }}
                    {{ auth()->user()->propuestas->concepto->calificador->apellidos }}
                    @endif
                </td>
                <td id="estado">
                    @if(isset(auth()->user()->propuestas->concepto->con_nombre))
                    {{ auth()->user()->propuestas->concepto->con_nombre}}
                    @endif
                </td>
                <td>
                    <a href="" class="btn btn-sm btn-primary ml-3"><span class="fas fa-edit"></span></a>
                    <a href="{{ action('EstudiantesController@crearDesarrollo') }}" class="btn btn-sm btn-primary"><span class="fas fa-arrow-right"></span></a>
                    <a href="{{ action('EstudiantesController@abandonar') }}" onclick="return confirm('¿Esta seguro de abandonar el trabajo de grado?')" class="btn btn-sm btn-danger"><span class="fas fa-arrow-left"></span></a>

                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
    <div class="btn-group">
</div> 
    </article>
    <article class="desarrollo" id="desarrollo">
    <table class="table-bordered table-hover table-striped">
        <thead>
            <th>Código</th>
            <th>Nombre de la propuestas</th>
            <th>Modalidad</th>
            <th>Programa</th>
            <th>Estudiantes
            @if(count($estudiantes)<=3)
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal"><span class="fas fa-plus"></span></button>
            @endif
            </th>
            <th>Director</th>
            <th>Codirector</th>
            <th>Formato RDC</th>
            <th>Calificador</th>
            <th>Estado</th>
            <th>Novedades</th>
            <th>Acciones</th>
        </thead>
        <tbody>
        @if(isset($desarrollo))
            @foreach($desarrollo as $des)
            <tr>
                <td>{{ $des->des_id }}</td>
                <td>{{ $des->propuesta->prop_titulo }}</td>
                <td>{{ $des->propuesta->modalidad->mod_nombre }}</td>
                <td>{{ auth()->user()->programas->pro_nombre }}</td>
                <td>
                <table>
                    @foreach($estudiantes as $est)
                    <tr>
                        <td>{{ $est->nombres }} {{ $est->apellidos }}</td>
                    </tr>
                    @endforeach
                    
                </table>
                </td>
                <td>{{ $des->propuesta->director->nombres }} {{ $des->propuesta->director->apellidos }}</td>
                <td>
                @if(isset($des->propuesta->codirector))
                    {{ $des->propuesta->codirector->nombres }}
                    {{ $des->propuesta->codirector->apellidos }}
                @endif
                </td>
                <td>
                @if( isset($des->des_formato) ))
                <a href="{{ action('EstudiantesController@desarrolloDownload') }}">{{ $des->des_formato }} <span class="fas fa-download"></span></a>
                @endif
                </td>
                <td>
                @if(isset($des->concepto->calificador))
                    {{ $des->concepto->calificador->nombres }}
                    {{ $des->concepto->calificador->apellidos }}
                @endif
                </td>
                <td>
                @if(isset($des->concepto))
                    {{ $des->concepto->con_nombre }}
                @endif
                </td>
                <td>
                @if(isset($novedades))
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal2"><span class="fas fa-eye"></span></button>
                @endif
                </td>
                <td>
                    <a href="" class="btn btn-sm btn-primary ml-3"><span class="fas fa-edit"></span></a>
                    <a href="" class="btn btn-sm btn-primary"><span class="fas fa-arrow-right"></span></a>
                    <a href="{{ action('EstudiantesController@abandonar') }}" onclick="return confirm('¿Esta seguro de abandonar el trabajo de grado?')" class="btn btn-sm btn-danger"><span class="fas fa-arrow-left"></span></a>

                </td>
            </tr>
            @endforeach
        @endif
        </tbody>
        
    </table>
    
    </article>

</section>
</div>
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
                    
                

@else
<a href="{{route('estudiantes.create')}}" class="btn btn-primary">Registrar Popuesta</a>
@endif
@endsection