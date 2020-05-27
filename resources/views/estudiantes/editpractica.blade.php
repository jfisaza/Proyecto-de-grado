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
        <h2>Edicion Propuesta Practica</h2>
        <p>"La manera de empezar algo es dejar de hablar y empezar a hacerlo"</p>
        <form method="post" action="{{action('EstudiantesController@updatep', $practica->pp_id)}}" role="form" class="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">

                <label for="pp_titulo">Titulo de Propuesta</label>
                <input type="text" class="form-control" name="pp_titulo" id="pp_titulo" placeholder="" required value="{{ $practica->pp_titulo }}">
            </div>
            <div class="form-group">
                    <label for="pp_emp_id"></label>
                    <select id="pp_emp_id" name="pp_emp_id" class="form-control" required>
                        <option value="{{ $practica->pp_emp_id }}" selected>{{ $practica->empresa->emp_nombre }}</option>
                        @foreach($empresas as $emp)
                        <option value="{{ $emp->emp_id }}">{{ $emp->emp_nombre }}</option>
                        @endforeach
                    </select>

                </div>
            <div class="form-row">

                <div class="form-group col-md-6">

                    <label for="pp_numconvenio">Numero de convenio</label>
                    <input type="number" min="0" class="form-control" name="pp_numconvenio" id="pp_numconvenio" placeholder="" required value="{{ $practica->pp_numconvenio }}">
                </div>
                <div class="form-group col-md-6">

                    <label for="pp_fechaconvenio">Fecha Convenio</label>
                    <input type="date" class="form-control" name="pp_fechaconvenio" id="pp_fechaconvenio" placeholder="" required value="{{ $practica->pp_fechaconvenio }}">
                </div>
            </div>
            
                <div class="form-group">
                    <label for="pp_dir_usu_id">Director</label>
                    <select id="pp_dir_usu_id" name="pp_dir_usu_id" class="form-control" required>
                        <option selected value="{{ $practica->director->id }}">{{ $practica->director->nombres }} {{ $practica->director->apellidos }}</option>
                        @foreach($usuarios as $usr)
                        <option value="{{ $usr->id }}">{{ $usr->nombres }} {{ $usr->apellidos }}</option>
                        @endforeach
                    </select>
                </div>
            <div class="form-group">
                <div class="custom-file col-md-14">
                    <input type="file" class="form-control" id="customFileLangHTML" name="prop_formato">
                </div>
            </div>

            <div class="boton">
                <input id="registrar" type="submit" name="registrar" value="Actualizar">
            </div>


        </form>

    </div>

</div>

@endsection