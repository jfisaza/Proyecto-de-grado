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
        <h2>Propuesta practica</h2>
        <p>"La manera de empezar algo es dejar de hablar y empezar a hacerlo"</p>
        <form method="POST" action="{{action('EstudiantesController@storep')}}" role="form" class="form" enctype="multipart/form-data">
            {{ csrf_field()}}


            <div class="form-group">

                <label for="pp_titulo">Titulo practica propuesta</label>
                <input type="text" class="form-control" name="pp_titulo" id="pp_titulo" placeholder="" required>
            </div>
            <div class="form-group">
                    <label for="pp_emp_id"></label>
                    <select id="pp_emp_id" name="pp_emp_id" class="form-control" required>
                        <option value="" selected> Empresa</option>
                        @foreach($empresas as $emp)
                        <option value="{{ $emp->emp_id }}">{{ $emp->emp_nombre }}</option>
                        @endforeach
                    </select>

                </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="pp_numconvenio">Numero de convenio</label>
                    <input type="number" min="0" class="form-control" name="pp_numconvenio" id="pp_numconvenio" placeholder="" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="pp_fechaconvenio">Fecha de convenio</label>
                    <input type="date" class="form-control" name="pp_fechaconvenio" id="pp_fechaconvenio" placeholder="" required>
                </div>
            </div>
            

                <div class="form-group">
                    <label for="pp_dir_usu_id"></label>
                    <select id="pp_dir_usu_id" name="pp_dir_usu_id" class="form-control" required>
                        <option value="" selected> Docente Director</option>
                        @foreach($usuarios as $usr)
                        <option value="{{ $usr->id }}">{{ $usr->nombres }} {{ $usr->apellidos }}</option>
                        @endforeach
                    </select>

                </div>
            <div class="form-group">
                <div class="custom-file col-md-14">
                    <label for="pp_formato">Formato RDC</label>
                    <input type="file" class="form-control" id="customFileLangHTML" name="pp_formato" required>
                </div>
            </div>

            <div class="form-group">
                <div class="custom-file col-md-14">
                    <label for="pp_liquidacion">Liquidación <br> (Adjunta las liquidaciones en un solo archivo PDF)</label>
                    <input type="file" class="form-control" id="customFileLangHTML" name="pp_liquidacion" required>
                </div>
            </div>

            <div class="boton">
                <input id="registrar" type="submit" name="registrar" value="Registrar Propuesta">
            </div>


        </form>

    </div>

</div>

@endsection