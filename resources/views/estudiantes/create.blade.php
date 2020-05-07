@extends('layout')

@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="../../public/css/propuesta.css"> -->
<link rel="stylesheet" type="text/css" href="../../public/css/propuesta.css">

<link rel="stylesheet" type="text/css" href="../../public/css/estilos.css">


<article class="logo"height="70px" width="110px">
</article>
<body>

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
            <h2>Propuesta Trabajo de Grado</h2>
            <p>"La manera de empezar algo es dejar de hablar y empezar a hacerlo"</p>
            <form method="POST" action="{{route('estudiantes.store')}}" role="form" class="form" enctype="multipart/form-data">
            {{ csrf_field()}}


                <input type="hidden" id="prop_est_usu_id" name="prop_est_usu_id" value="{{auth()->user()->id}}">
                <div class="form-group">
                    
                    <label for="prop_titulo">Titulo de Propuesta</label>
                    <input type="text" class="form-control" name="prop_titulo"  id="prop_titulo" placeholder="">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="prop_dir_usu_id"></label>
                        <select id="prop_dir_usu_id" name="prop_dir_usu_id" class="form-control">
                            <option selected> Director</option>
                            <option value="1">Sergio</option>
                            <option value="2">Carlos</option>
                            <option value="3">Leydi</option>


                        </select>

                    </div>
                    <div class="form-group col-md-6">
                        <label for="prop_codir_usu_id"></label>
                        <select id="prop_codir_usu_id" name="prop_codir_usu_id" class="form-control">
                            <option selected> Co-Director</option>
                            <option value="1">Sergio</option>
                            <option value="2">Carlos</option>
                            <option value="3">Leydi</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="prop_mod_id"></label>
                    <select id="prop_mod_id" name="prop_mod_id" class="form-control">
                        <option selected>Modalidad</option>
                        <option value="1">Desarrollo</option>
                        <option value="2">Monografia</option>
                        <option value="3">Seminario</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <a href="https://www.dropbox.com/sh/op8bmnpioxnutkq/AAA3aYa4B9loRyLJkkcaX3Sma/DOCUMENTOS%20DE%20GRADO?dl=0&preview=R-DC-124+Registro+Propuesta+Trabajo+Grado+PI+DTeI+Mono+Emprend+V1.doc&subfolder_nav_tracking=1" class="btn btn-light " target="blank">Ver Formato</a>
                    </div>
                    <div class="custom-file col-md-4">
                        <input type="file" class="custom-file-input" id="customFileLangHTML">
                        <label class="custom-file-label" for="customFileLangHTML" data-browse="">Subir Formato</label>
                    </div>
                </div>

                <div class="boton">
                    <input id="registrar" type="submit" name="registrar" value="Registrar Propuesta">
                </div>


            </form>

        </div>

    </div>

</body>

@endsection