@extends('layout')

@section('content')
<div class="pagina-info">
<div class="container">
<div class="card">
<div class="card-header p-3 mb-2 bg-success text-white">
                        <h1>
                            <center><strong>Banco de ideas </strong></center>
                        </h1>
                    </div>
<div class="card-body">
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
                        <td>{{ $ban->usuarios->nombres }} {{ $ban->usuarios->apellidos }}</td>
                        <td>{{ $ban->usuarios->telefono }}</td>
                        <td>{{ $ban->usuarios->email }}</td>
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
</div>
</div>
</div>
</div>
@endsection