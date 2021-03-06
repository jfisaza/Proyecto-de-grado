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
            <h2>Editar idea</h2>
            <form method="POST" action="{{route('banco.update',$banco->ban_id)}}" role="form" class="form">
            {{ csrf_field()}}
                <input type="hidden" name="_method" value="patch">

                <div class="form-group">
                    <label for="ban_nombre">Titulo</label>
                    <input type="text" class="form-control" name="ban_nombre"  id="ban_nombre" placeholder="" value="{{ $banco->ban_nombre }}" required>
                </div>
                <div class="form-group">
                    <label for="ban_mod_id"></label>
                    <select id="ban_mod_id" name="ban_mod_id" class="form-control" required>
                        <option value="{{ $banco->ban_mod_id }}" selected>{{ $banco->modalidad->mod_nombre }}</option>
                        @foreach($modalidades as $mod)
                        <option value="{{ $mod->mod_id }}">{{ $mod->mod_nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="ban_pro_id"></label>
                    <select id="ban_pro_id" name="ban_pro_id" class="form-control" required>
                        <option value="{{ $banco->ban_pro_id }}" selected>{{ $banco->programa->pro_nombre }}</option>
                        @foreach($programas as $pro)
                        <option value="{{ $pro->pro_id }}">{{ $pro->pro_nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="boton">
                    <input id="registrar" type="submit" name="registrar" value="Actualizar">
                </div>


            </form>

        </div>

    </div>

@endsection