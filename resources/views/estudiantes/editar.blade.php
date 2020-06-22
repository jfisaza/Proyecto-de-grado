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
            <h2>Propuesta Trabajo de Grado</h2>
            <p>"La manera de empezar algo es dejar de hablar y empezar a hacerlo"</p>
            <form method="post" action="{{action('EstudiantesController@desarrolloUpdate', $desarrollo->des_id)}}" role="form" class="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    
                    <label for="prop_titulo">Titulo de Propuesta</label>
                    <input type="text" class="form-control" name="prop_titulo"  id="prop_titulo" placeholder="" required value="{{ $desarrollo->propuesta->prop_titulo }}">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="prop_dir_usu_id"></label>
                        <select id="prop_dir_usu_id" name="prop_dir_usu_id" class="form-control" required>
                            <option selected value="{{ $desarrollo->propuesta->director->id }}">{{ $desarrollo->propuesta->director->nombres }} {{ $desarrollo->propuesta->director->apellidos }}</option>
                            @foreach($usuarios as $usr)
                            <option value="{{ $usr->id }}">{{ $usr->nombres }} {{ $usr->apellidos }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group col-md-6">
                        <label for="prop_codir_usu_id"></label>
                        <select id="prop_codir_usu_id" name="prop_codir_usu_id" class="form-control">
                            @if(isset($desarrollo->propuesta->prop_codir_usu_id))
                            <option value="{{ $desarrollo->propuesta->codirector->id }}" selected>{{ $desarrollo->propuesta->codirector->nombres }} {{ $desarrollo->propuesta->codirector->apellidos }}</option>
                            @else
                            <option value="" selected> Co-Director</option>
                            @endif
                            @foreach($usuarios as $usr)
                            <option value="{{ $usr->id }}">{{ $usr->nombres }} {{ $usr->apellidos }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                        <label for="des_pro_id"></label>
                        <select id="des_pro_id" name="des_pro_id" class="form-control" required>
                            <option selected value="{{ $desarrollo->programas->pro_id }}">{{ $desarrollo->programas->pro_nombre }}</option>
                            @foreach($programas as $pro)
                            <option value="{{ $pro->pro_id }}">{{ $pro->pro_nombre }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="des_mod_id"></label>
                        <select id="des_mod_id" name="des_mod_id" class="form-control" required>
                            <option selected value="{{ $desarrollo->modalidad->mod_id }}">{{ $desarrollo->modalidad->mod_nombre }}</option>
                            @foreach($modalidades as $mod)
                            <option value="{{ $mod->mod_id }}">{{ $mod->mod_nombre }}</option>
                            @endforeach
                        </select>

                    </div>
                <div class="form-row">
                    <div class="custom-file col-md-4">
                        <input type="file" class="custom-file-input" id="customFileLangHTML" name="des_formato">
                        <label class="custom-file-label" for="customFileLangHTML" data-browse="">Subir Formato</label>
                    </div>
                </div>
            </div>

                <div class="boton">
                    <input id="registrar" type="submit" name="registrar" value="Actualizar">
                </div>


            </form>

        </div>

    </div>

@endsection