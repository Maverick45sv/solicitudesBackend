<?php

use \App\Models\RolMenuModel;
use \App\Models\UsuarioRolModel;
//FUNCION PARA VALIDAR SI EL USUARIO ESTA LOGUEADO

function enviar_mail($to, $titulo, $mensaje){
    $email = \Config\Services::email();   
    foreach($to as $data){
        $email->clear();
        $email->setFrom('registro.academico@upes.edu.sv', 'Registro Academico UPES');
        $email->setTo($data);
    // $email->setCC('another@another-example.com');
    // $email->setBCC('them@their-example.com');
        $email->setSubject($titulo);
        $email->setMessage($mensaje);
        $email->send();
    }
    return $email->printDebugger();
}

function menu($usuario){
    $usuariorol = new UsuarioRolModel();
    $menurol = new RolMenuModel();
    $ur = $usuariorol->where('id_usuario='.$usuario)->first();    
    $primerN= $menurol->buscarOpcionByRol($ur->id_rol);
    //var_dump($primerN);
    $html = '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="'.base_url().'/home">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <ul class="navbar-nav">';
    foreach($primerN as $nivel){
        $html .= ' <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">' .
        $nivel->nombre .'</a>';
        $segundoN= $menurol->buscarOpcionByRol($ur->id_rol, $nivel->id);
        if($segundoN){
            $html .= '<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">';
            foreach($segundoN as $nivel2){
                $html .= '<li><a class="dropdown-item" href="' . base_url($nivel2->enlace) . '">'.$nivel2->nombre.'</a></li>';
            }
            $html .= "</ul>";
        }
        $html .= "</li>";
    }
    $html.="</ul></div></div></nav>";    
    return $html;    
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