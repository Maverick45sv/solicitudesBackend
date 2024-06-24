<?php

use \App\Models\RolMenuModel;
use \App\Models\UsuarioRolModel;
use \App\Models\RolModel;
use \App\Models\UsuarioModel;
use \App\Models\SolicitudModel;
use \App\Models\ProcesoNotificacionModel;
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
                <a class="navbar-brand" href="'.base_url().'/home"><i class="bi bi-house-fill"></i> Inicio</a>
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
    // Agregar el botón de cierre de sesión y alineado a la derec
    $html .= '</ul>
                <div class="ms-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link" href="'.base_url().'Login" >Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>'; 

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

function Notificaciones($id, $id_solicitud, $accion, $comentario){
    $usuariorol = new UsuarioRolModel();
    $usuario = new UsuarioModel();
    $rol = new RolModel();
    $procesoNoti = new ProcesoNotificacionModel();
    $solicitudModel = new SolicitudModel();
    $nombre='';
    $correos=array();
    $correoE = $solicitudModel->buscarPersonaBySolicitud($id_solicitud);    
    if($correoE) {
        $nombre=$correoE->apellido . " " . $correoE->nombre;       
    }       
    $noti=$procesoNoti->where('id_proceso_estacion', $id)->findAll();
    if($noti){ 
        foreach($noti as $data){
            $r=$rol->find($data->id_rol);
            if($r->nombre != "ROLE_ESTUDIANTE"){                
               $cs=$solicitudModel->buscarCorreosXRol($data->id_rol);
               foreach($cs as $d){
                if(!in_array($d->correo,$correos)){ 
                    $correos[]=$d->correo;
                }
               }
            }else{
                if($correoE) {
                    if(!in_array($correoE->correo,$correos)){ 
                        $correos[]=$correoE->correo;
                    }
                }
            }
        }
    }
    //espacion para notificacion
    $titulo = "Estado solicitud en Sistema de Solicitudes UPES";
    $mensaje = "Buen dia <br><br> Se ha actualizado el estado de su solicitud.
    <br><br>
    <ul>
        Solicitante: <b>".$nombre."</b> <br>
        Nuevo Estado: <b>".$accion."</b> <br>
        Comentario: <b>".$comentario."</b> <br><br>            
    </ul>
    Este es un mensaje Automatico, por favor no trate de contestarlo.";   
    $mail = enviar_mail($correos, $titulo, $mensaje);
}
