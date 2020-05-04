@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Información Personal</div>

                <div class="">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <section class="tablas">
                        <article>
                            <table class="table-bordered table-striped">
                                <tr>
                                    <td><strong>Nombres:</strong></td>
                                    <td>{{ auth()->user()->nombres }}</td>
                                    <td><strong>Apellidos:</strong></td>
                                    <td>{{ auth()->user()->apellidos }}</td>
                                    <td><strong>Documento:</strong></td>
                                    <td>{{ auth()->user()->documento }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Correo:</strong></td>
                                    <td>{{ auth()->user()->email }}</td>
                                    <td><strong>Teléfono:</strong></td>
                                    <td>{{ auth()->user()->telefono }}</td>
                                    <td><strong>Ciudad</strong></td>
                                    <td>{{ auth()->user()->ciudad }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Programa:</strong></td>
                                    <td>{{ auth()->user()->programas->pro_nombre }}</td>
                                </tr>
                            </table>
                            <a href="" class="btn btn-sm btn-primary mt-3 mb-3 ml-3"><span class="fas fa-user-edit"></span></a>
                            <a href="{{ action('EstudiantesController@index') }}" class="btn btn-sm btn-primary mt-3 mb-3 ml-3">Ir a proyecto <span class="fas fa-arrow-right"></span></a>
                        </article>
                    </section>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
