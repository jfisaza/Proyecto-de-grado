@extends('layouts.app')
@section('content')

<section>
<article class="logo"height="70px" width="110px">
    <article>
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
        <form action="{{ route('usuarios.update',$user->id) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="patch">
            <div class="form-group">
                <label for="documento">Documento</label>
                <input type="text" class="form-control" name="documento" value="{{ $user->documento }}">
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nombres">Nombres</label>
                <input type="text" class="form-control" name="nombres" value="{{ $user->nombres }}">
            </div>
            <div class="form-group col-md-6">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="{{ $user->apellidos }}">
            </div>
            </div>
            
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" name="telefono" value="{{ $user->telefono }}">
            </div>
            <div class="form-group">
                <label for="ciudad">Sede</label>
                <select name="ciudad" class="form-control">
                    <option value="{{ auth()->user()->ciudad }}">{{ auth()->user()->ciudad }}</option>
                    <option value="BUCARAMANGA">BUCARAMANGA</option>
                    <option value="REGIONAL BARRANCABERMEJA">REGIONAL BARRANCABERMEJA</option>
                    <option value="REGIONAL VELEZ">REGIONAL VÉLEZ</option>
                    <option value="REGIONAL PIEDECUESTA">REGIONAL PIEDECUESTA</option>
                </select>
            </div>
            <div class="form-group">
                <label for="programa">programa</label>
                <select name="programa" class="form-control">
                    <option value="{{ auth()->user()->programa }}">{{ auth()->user()->programas->pro_nombre }}</option>
                    @foreach($programas as $pro)
                        <option value="{{$pro->pro_id}}">{{ $pro->pro_nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Guardar">
            </div>
        </form>
        </div>
        </div>
    </article>
</section>

@endsection