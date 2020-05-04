@extends('layouts')
@section('content')

<section>
    <article>
        <form action="" method="post">
            <div class="form-group">
                <label for="documento">Documento</label>
                <input type="text" class="form-control" name="documento" value="{{ auth()->user()->documento }}">
            </div>
            <div class="form-group">
                <label for="nombres">Nombres</label>
                <input type="text" class="form-control" name="nombres" value="{{ auth()->user()->nombres }}">
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="{{ auth()->user()->apellidos }}">
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" name="telefono" value="{{ auth()->user()->telefono }}">
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad</label>
                <select name="ciudad" class="form-control">
                    <option value="{{ auth()->user()->ciudad }}">{{ auth()->user()->ciudad }}</option>
                    <option value="BUCARAMANGA">BUCARAMANGA</option>
                    <option value="BOGOTA">BOGOTÁ</option>
                    <option value="MEDELLIN">MEDELLÍN</option>
                </select>
            </div>
            <div class="form-group">
                <label for="programa">programa</label>
                <select name="programa" class="form-control">
                    <option value="{{ auth()->user()->programa">{{ auth()->user()->programas->pro_nombre }}</option>
                    @foreach($programas as $pro)
                        <option value="{{$pro->pro_id}}">{{ $pro->pro_nombre }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </article>
</section>

@endsection