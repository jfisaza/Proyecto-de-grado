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
            <form method="post" action="{{route('docentes.update', $concepto->con_id)}}" role="form" class="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="patch">
                
                <div class="form-group">
                    
                    @if(isset($concepto->desarrollos))
                    <strong>Código: </strong><p>{{ $concepto->desarrollos->des_id }}</p>
                    <strong>Titulo: </strong><p>{{ $concepto->desarrollos->des_titulo }}</p>
                    @else
                    <strong>Código: </strong><p>{{ $concepto->propuestas->prop_id }}</p>
                    <strong>Titulo: </strong><p>{{ $concepto->propuestas->prop_titulo }}</p>
                    @endif
                    
                </div>

                <div class="form-group">
                    <input type="text" name="con_acta" class="form-control" placeholder="Número de acta" required>
                </div>

                    <div class="form-group">
                        <label for="con_nombre"></label>
                        <select id="con_nombre" name="con_nombre" class="form-control" required>
                            <option value="">Calificación</option>
                            <option value="APROBADO">APROBADO</option>
                            <option value="REPROBADO">REPROBADO</option>
                        </select>

                    </div>
                <div class="boton">
                    <input id="registrar" type="submit" name="registrar" value="Calificar">
                </div>


            </form>

        </div>

    </div>

@endsection