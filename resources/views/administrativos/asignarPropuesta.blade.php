@extends('layouts.app')
@section('content')
<article class="logo"height="70px" width="110px">
</article>

    @if (count($errors) >0)
    <div class="alert alert-danger">
        <strong>Error!</strong>Revise los cambios obligatorios.<br><br>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(Session::has('success'))
    <div class="alert alert-info">
        {{Session::get('success')}}
    </div>
    @endif
    <div id="pagina">
        <div id="formulario">
            <h2>Calificar</h2>
            <form method="post" action="{{action('AdministrativosController@asignarCalificadorPropuesta')}}" role="form" class="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <div class="form-group">
                    
                    <strong>Código: </strong><p>{{ $propuesta->prop_id }}</p>
                    <strong>Titulo: </strong><p>{{ $propuesta->prop_titulo }}</p>
                    
                </div>
                <input type="hidden" name="prop_id" value="{{ $propuesta->prop_id }}">
                

                    <div class="form-group">
                        <label for="con_usu_id"></label>
                        <select id="con_usu_id" name="con_usu_id" class="form-control" required>
                            <option value="">Docente</option>
                            @foreach($docentes as $doc)
                            <option value="{{ $doc->id }}">{{ $doc->nombres }} {{ $doc->apellidos }}</option>
                            @endforeach
                        </select>

                    </div>
                <div class="boton">
                    <input id="registrar" type="submit" name="registrar" value="Asignar">
                </div>


            </form>

        </div>

    </div>

@endsection