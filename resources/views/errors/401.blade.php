@extends('layout')

@section('content') 
<link rel="stylesheet" href="{{ asset('css/error.css') }}">
<div id="pagina">
<section id="error">
    <article>
        <img src="{{ asset('img/403.jpg') }}" >
    </article>
    <article>
        <h1>Error de autentificación</h1>
        <h3>Por favor inicia sesión con una cuenta de usuario valida para esta sección.</h3>
    </article>
    
</section>
</div>
@endsection