<?php

use \App\Models\UsuarioModel;

//FUNCION PARA VALIDAR SI EL USUARIO ESTA LOGUEADO

function validar($session){
    if (!$session->get('usuario')){
        return redirect()->route('/');
    }
}

function menu(){

    $model = new UsuarioModel();

    return  $model->construirMenu(1);
   /* return '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="http://localhost/solicitudesbackend/">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Administracion
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="http://localhost/solicitudesbackend/admin/sexo">Sexo</a></li>
                        <li><a class="dropdown-item" href="http://localhost/solicitudesbackend/admin/genero">Genero</a></li>
                        <li><a class="dropdown-item" href="http://localhost/solicitudesbackend/admin/tipo">Tipo</a></li>
                        <li><a class="dropdown-item" href="http://localhost/solicitudesbackend/admin/rol">Rol</a></li>
                        <li><a class="dropdown-item" href="http://localhost/solicitudesbackend/admin/menu">Menu</a></li>
                        <li><a class="dropdown-item" href="http://localhost/solicitudesbackend/admin/persona">Personas</a></li>
                    </ul>
                    </li>
                </ul>
                </div>
            </div>
            </nav>';*/
}

function generarContrasenia($length){
    $key = "";
    $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
    $max = strlen($pattern)-1;
    for($i = 0; $i < $length; $i++){
        $key .= substr($pattern, mt_rand(0,$max), 1);
    }
    return $key;
}