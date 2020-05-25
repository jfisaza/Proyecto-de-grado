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
        <form method="post" action="{{route('estudiantes.update', $propuesta->prop_id)}}" role="form" class="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="patch">
            <div class="form-group">

                <label for="prop_titulo">Titulo de Propuesta</label>
                <input type="text" class="form-control" name="prop_titulo" id="prop_titulo" placeholder="" required value="{{ $propuesta->prop_titulo }}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="prop_dir_usu_id"></label>
                    <select id="prop_dir_usu_id" name="prop_dir_usu_id" class="form-control" required>
                        <option selected value="{{ $propuesta->director->id }}">{{ $propuesta->director->nombres }} {{ $propuesta->director->apellidos }}</option>
                        @foreach($usuarios as $usr)
                        <option value="{{ $usr->id }}">{{ $usr->nombres }} {{ $usr->apellidos }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group col-md-6">
                    <label for="prop_codir_usu_id"></label>
                    <select id="prop_codir_usu_id" name="prop_codir_usu_id" class="form-control">
                        @if(isset($propuesta->prop_codir_usu_id))
                        <option value="{{ $propuesta->codirector->id }}" selected>{{ $propuesta->codirector->nombres }} {{ $propuesta->codirector->apellidos }}</option>
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
                <label for="prop_pro_id"></label>
                <select id="prop_pro_id" name="prop_pro_id" class="form-control" required>
                    <option selected value="{{ $propuesta->programas->pro_id }}">{{ $propuesta->programas->pro_nombre }}</option>
                    @foreach($programas as $pro)
                    <option value="{{ $pro->pro_id }}">{{ $pro->pro_nombre }}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <div class="custom-file col-md-14">
                    <input type="file" class="form-control" id="customFileLangHTML" name="prop_formato" required>
                </div>
            </div>

            <div class="boton">
                <input id="registrar" type="submit" name="registrar" value="Actualizar">
            </div>


        </form>

    </div>

</div>

@endsection