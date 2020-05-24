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
            <h2>Nueva Empresa</h2>
            <form method="POST" action="{{route('administrativos.store')}}" role="form" class="form">
            {{ csrf_field()}}

                <div class="form-group">
                    <label for="emp_nombre"></label>
                    <input type="text" class="form-control" name="emp_nombre"  id="emp_nombre" placeholder="Nombre De Empresa" required>
                </div>
                <div class="form-group">
                    <label for="emp_sector"></label>
                    <select id="emp_sector" name="emp_sector" class="form-control" required>
                        <option value="">Sector</option>
                        <option value="PUBLICO">Público</option>
                        <option value="PRIVADO">Privado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="emp_representante"></label>
                    <input type="text" class="form-control" name="emp_representante"  id="emp_representante" placeholder="Nombre De Representante" required>
                </div>
                <div class="form-group">
                    <label for="emp_direccion"></label>
                    <input type="text" class="form-control" name="emp_direccion"  id="emp_direccion" placeholder="Dirección De Empresa" required>
                </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label for="emp_telefono"></label>
                    <input type="text" class="form-control" name="emp_telefono"  id="emp_telefono" placeholder="Teléfono De Empresa" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="emp_correo"></label>
                    <input type="email" class="form-control" name="emp_correo"  id="emp_correo" placeholder="Email De Empresa" required>
                </div>
                </div>
                <div class="boton">
                    <input id="registrar" type="submit" name="registrar" value="Registrar">
                </div>


            </form>

        </div>

    </div>

@endsection