@extends('layouts.app')
@section('content')
<article class="logo" height="70px" width="110px">
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
        <h2>Edicion Desarrollo practica</h2>
        <p>"La manera de empezar algo es dejar de hablar y empezar a hacerlo"</p>
        <form method="post" action="{{action('EstudiantesController@desarrolloPracticaUpdate', $desarrollo->dp_id)}}" role="form" class="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">

                <label for="pp_titulo">Titulo de Propuesta</label>
                <input type="text" class="form-control" name="dp_titulo" id="dp_titulo" placeholder="" required value="{{ $desarrollo->dp_titulo }}">
            </div>
            <div class="form-row">

            </div>
            <div class="form-group">
                <label for="dp_dir_usu_id">Director</label>
                <select id="dp_dir_usu_id" name="dp_dir_usu_id" class="form-control" required>
                    <option selected value="{{ $desarrollo->director->id }}">{{ $desarrollo->director->nombres }} {{ $desarrollo->director->apellidos }}</option>
                    @foreach($usuarios as $usr)
                    <option value="{{ $usr->id }}">{{ $usr->nombres }} {{ $usr->apellidos }}</option>
                    @endforeach
                </select>
            </div>

    

    <div class="form-group">
        <div class="custom-file col-md-14">
            <input type="file" class="form-control" id="customFileLangHTML" name="dp_formato">
        </div>
    </div>

    <div class="boton">
        <input id="registrar" type="submit" name="registrar" value="Actualizar">
    </div>


    </form>

</div>

</div>

@endsection