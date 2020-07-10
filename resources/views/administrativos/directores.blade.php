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
            <h2>Asignar fecha de sustentación</h2>
            <form method="post" action="{{action('AdministrativosController@setDirectoresPropuesta', $propuesta->prop_id)}}" role="form" class="form" >
                {{ csrf_field() }}
                
                <div class="form-group">
                    
                    <strong>Código:</strong><p>{{ $propuesta->prop_id }}</p>
                    <strong>Título:</strong><p>{{ $propuesta->prop_titulo }}</p>
                    
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
                            <option value="">Sin asignar</option>
                            @foreach($usuarios as $usr)
                            <option value="{{ $usr->id }}">{{ $usr->nombres }} {{ $usr->apellidos }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            <div class="boton">
                <input id="registrar" type="submit" value="Asignar">
            </div>


            </form>

        </div>

    </div>

@endsection