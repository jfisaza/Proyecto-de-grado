@extends('layout')

@section('content')
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<div class="pagina-info">
<div class="container">
<div class="card">
<div class="card-header p-3 mb-2 bg-success text-white">
                        <h1>
                            <center><strong>Banco de ideas </strong></center>
                        </h1>
                    </div>
<div class="card-body" >
<section class="tablas" >
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



    <article class="art ideas" id="ideas"  >
        <table class="table table-hover data-table" id="example" >
            <thead class="table-success">
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

    <article class="solicitudes art" id="solicitudes"  >
        <table class="table table-hover">
            <thead class="table-success">
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
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> -->
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection