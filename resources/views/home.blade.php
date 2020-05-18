@extends('layout')

@section('content')
<link rel="stylesheet" href="../public/css/error.css">
<div class="pagina-info">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header p-3 mb-2 bg-success text-white">
                    <h4> <center><strong>Bienvenid@ {{ auth()->user()->nombres }}
                          Aquí tu  Información Personal</strong></center> </h4></div>

                <div class="">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <section class="tablas">
                        <article id="article">
                            <!-- table-bordered table-striped -->

                            <table class=" table">
                                <tr>
                                <td><strong>Documento:</strong></td>
                                    <td>{{ auth()->user()->documento }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nombres:</strong></td>
                                    <td>{{ auth()->user()->nombres }}</td>
                                    
                                </tr>
                                <tr class="" >
                                    <td><strong>Apellidos:</strong></td>
                                    <td>{{ auth()->user()->apellidos }}</td>
                                </tr>
                                <tr class="" >
                                    <td><strong>Correo:</strong></td>
                                    <td>{{ auth()->user()->email }}</td>
                                   
                                   
                                </tr>
                                <tr class=""  >
                                <td><strong>Teléfono:</strong></td>
                                    <td>{{ auth()->user()->telefono }}</td>
                                </tr>
                                <tr class=""  > <td><strong>Ciudad</strong></td>
                                    <td>{{ auth()->user()->ciudad }}</td></tr>
                                <tr>
                                    <td><strong>Programa:</strong></td>
                                    <td>{{ auth()->user()->programas->pro_nombre }}</td>
                                </tr>
                            </table>
                            <a href="{{ route('usuarios.edit', auth()->user()->id) }}" class="btn btn-sm btn-success mt-3 mb-3 ml-3" title="Editar"><span class="fas fa-user-edit"></span></a>
                            @if(auth()->user()->hasRole('estudiante'))
                            <a href="{{ action('EstudiantesController@index') }}" class="btn btn-sm btn-success mt-3 mb-3 ml-3">Ir a proyecto <span class="fas fa-arrow-right"></span></a>
                            @endif
                            @if(auth()->user()->hasRole('docente'))
                            <a href="{{ route('docentes.index') }}" class="btn btn-sm btn-success" title="Trabajos"><span class="fas fa-arrow-right"></span></a>
                            @endif
                            @if(auth()->user()->hasRole('administrativo'))
                            <a href="{{ route('administrativos.index') }}" class="btn btn-sm btn-success" title="Trabajos"><span class="fas fa-arrow-right"></span></a>
                            @endif
                        </article>
                    </section>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
