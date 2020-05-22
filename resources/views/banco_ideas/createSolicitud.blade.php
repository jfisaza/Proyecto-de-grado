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
            <h2>Registrar Solicitud</h2>
            <form method="POST" action="{{action('BancoController@storeSolicitud')}}" role="form" class="form">
            {{ csrf_field()}}

                <div class="form-group">
                    <label for="sol_pro_id"></label>
                    <select id="sol_pro_id" name="sol_pro_id" class="form-control" required>
                        <option value="" selected>Programa</option>
                        @foreach($programas as $pro)
                        <option value="{{ $pro->pro_id }}">{{ $pro->pro_nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="sol_emp_id"></label>
                    <select id="sol_emp_id" name="sol_emp_id" class="form-control" required>
                        <option value="" selected>Empresa</option>
                        @foreach($empresas as $emp)
                        <option value="{{ $emp->emp_id }}">{{ $emp->emp_nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="boton">
                    <input id="registrar" type="submit" name="registrar" value="Registrar">
                </div>


            </form>

        </div>

    </div>

@endsection