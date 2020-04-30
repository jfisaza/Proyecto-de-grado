@extends('layout')

@section('content')

<h1>Banco de ideas</h1>

<section class="tablas">
    <div class="tabs">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="#ideas">Ideas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#solicitudes">Prácticas</a>
            </li>
        </ul>
    </div>

 
        <form action="{{ action('BancoController@index') }}" method="get" id="filtro">
                <select name="ban_pro_id" id="" class="form-control">
                    <option value="">Todos</option>
                    @foreach($programa as $pro)
                    <option value="{{ $pro->pro_id }}">{{ $pro->pro_nombre }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button type="submit" class="btn-primary"><span class="fas fa-search"></span></button>
                </div>
        </form>



    <article class="ideas" id="ideas">
        <table class="table-bordered table-hover">
            <thead>
                <th>Nombre</th>
                <th>Modalidad</th>
                <th>Programa</th>
                <th>Director</th>
                <th>Teléfono</th>
                <th>Correo</th>
            </thead>
            <tbody>
            @if($banco->count())
            @foreach($banco as $ban)
                    <tr>
                        <td>{{ $ban->ban_nombre }}</td>
                        <td>{{ $ban->modalidad->mod_nombre }}</td>
                        <td>{{ $ban->programa->pro_nombre }}</td>
                        <td>{{ $ban->usuarios->usu_nombres }} {{ $ban->usuarios->usu_apellidos }}</td>
                        <td>{{ $ban->usuarios->usu_telefono }}</td>
                        <td>{{ $ban->usuarios->usu_correo }}</td>
                    </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6">No se encontraron ideas.</td>
            </tr>
            @endif
            </tbody>
        </table>    
    </article>

    <article class="solicitudes" id="solicitudes">
        <table class="table-bordered table-hover">
            <thead>
                <th>Programa</th>
                <th>Empresa</th>
                <th>Representante</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Dirección</th>
            </thead>
            <tbody>
                @if($solicitud->count())
                @foreach( $solicitud as $sol )
                <tr>
                    <td>{{ $sol->programa->pro_nombre }}</td>
                    <td>{{ $sol->empresa->emp_nombre }}</td>
                    <td>{{ $sol->empresa->emp_representante }}</td>
                    <td>{{ $sol->empresa->emp_telefono }}</td>
                    <td>{{ $sol->empresa->emp_correo }}</td>
                    <td>{{ $sol->empresa->emp_direccion }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="6">No se encontraron solicitudes de practicantes.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </article>
</section>



@endsection