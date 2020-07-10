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
        <h2>Propuesta Trabajo de Grado</h2>
        <p>"La manera de empezar algo es dejar de hablar y empezar a hacerlo"</p>
        <form method="POST" action="{{route('estudiantes.store')}}" role="form" class="form" enctype="multipart/form-data">
            {{ csrf_field()}}


            <div class="form-group">

                <label for="prop_titulo">Titulo de Propuesta</label>
                <textarea class="form-control" name="prop_titulo" id="prop_titulo" placeholder="" required></textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="prop_dir_usu_id"></label>
                    <select id="prop_dir_usu_id" name="prop_dir_usu_id" class="form-control" required>
                        <option value="" selected> Director</option>
                        @foreach($usuarios as $usr)
                        <option value="{{ $usr->id }}">{{ $usr->nombres }} {{ $usr->apellidos }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group col-md-6">
                    <label for="prop_codir_usu_id"></label>
                    <select id="prop_codir_usu_id" name="prop_codir_usu_id" class="form-control" >
                        <option value="" selected> Co-Director</option>
                        @foreach($usuarios as $usr)
                        <option value="{{ $usr->id }}">{{ $usr->nombres }} {{ $usr->apellidos }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="prop_mod_id"></label>
                <select id="prop_mod_id" name="prop_mod_id" class="form-control" required>
                    <option value="" selected>Modalidad</option>
                    @foreach($modalidades as $mod)
                    <option value="{{ $mod->mod_id }}">{{ $mod->mod_nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="prop_pro_id"></label>
                <select id="prop_pro_id" name="prop_pro_id" class="form-control" required>
                    <option selected value="">Programa</option>
                    @foreach($programas as $pro)
                    <option value="{{ $pro->pro_id }}">{{ $pro->pro_nombre }}</option>
                    @endforeach
                </select>

            </div>

            <div class="form-group">
                <div class="custom-file col-md-14">
                    <label for="prop_formato">Formato RDC-124</label>
                    <input type="file" class="form-control" id="customFileLangHTML" name="prop_formato" required>
                </div>
            </div>

            <div class="form-group">
                <div class="custom-file col-md-14">
                    <label for="prop_liquidacion">Liquidación <br> (Adjunta las liquidaciones en un solo archivo PDF)</label>
                    <input type="file" class="form-control" id="customFileLangHTML" name="prop_liquidacion" required>
                </div>
            </div>

            <div class="boton">
                <input id="registrar" type="submit" name="registrar" value="Registrar Propuesta">
            </div>


        </form>

    </div>

</div>

@endsection