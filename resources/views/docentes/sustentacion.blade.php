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
            <form method="post" action="{{action('DocentesController@setSustentacion', $desarrollo->des_id)}}" role="form" class="form" >
                {{ csrf_field() }}
                
                <div class="form-group">
                    
                    <strong>Código:</strong><p>{{ $desarrollo->des_id }}</p>
                    <strong>Título:</strong><p>{{ $desarrollo->des_titulo }}</p>
                    @if(isset($desarrollo->des_citacion))
                    <strong>Sustentación:</strong><p>{{ $desarrollo->des_citacion }}</p>
                    @endif
                </div>
                

                <div class="form-group">
                    <input type="datetime-local" name="fecha" class="form-control" required>
                </div>

                    
                <div class="boton">
                    <input id="registrar" type="submit" name="registrar" value="Asignar">
                </div>


            </form>

        </div>

    </div>

@endsection