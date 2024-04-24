<?php

namespace App\Controllers;

use \App\Models\UsuarioModel;
use \App\Models\UsuarioRolModel;
use \App\Models\SolicitudModel;
use \App\Models\PeriodoModel;

class Inicio extends BaseController
{
    public function index(): string
    {
        return view('login', ["mensaje"=>'']);
    }

    public function validar()
    {
        $usuarioModel = model(UsuarioModel::class);
        $usuariorolModel = model(UsuarioRolModel::class);
        $session = session();
        //$session->destroy();       
        $datos=array("usuario" => 0);  
        $estudi=0;
        $ciphertext = \md5($this->request->getPost('pass'));     
        $where="nombre = '".$this->request->getPost('user')."' AND clave= '" . $ciphertext . "'";
        $validar=$usuarioModel->where($where)->first(); 
        if($validar and $validar->activo){
            $roles = $usuariorolModel->buscarRoles($validar->id);
            foreach($roles as $data){
                if($data->nombre != "ROLE_ESTUDIANTE"){
                    $estudi=1;
                }
            }
            if($estudi){
                $newdata = [
                    'usuario'  => $validar->nombre,
                    'idusuario'  => $validar->id,
                    'email'     => $validar->correo
                ];
                $session->set($newdata);
                return redirect()->to('/home');
            }else{
                $mensaje="Usuario sin Permisos!!!";
                return view('login', ["mensaje"=>$mensaje]); 
            }    
        }       
        $mensaje="Usuario/Contrasena Invalida!!!";
        return view('login', ["mensaje"=>$mensaje]);      
    }

    public function inicio(){
        $usuarioModel = model(UsuarioModel::class);
        $solicitudM = model(SolicitudModel::class);
        $periodoM = model(PeriodoModel::class);

        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $vigente=$periodoM->buscarPeriodoVigente();
        $datos=array(
            "menu" => menu($session->get('idusuario')),  
            "usuario" =>  $usuarioModel->find($session->get('idusuario')), 
            "vigente" => $vigente,  
            "tabla1" => $solicitudM->TableroSolicitud($vigente->id),
            "tabla2" => $solicitudM->TableroSolicitudEstado($vigente->id),   
        );
        return view('inicio', $datos);
    }

    public function outLogin() 
    {
        $session = session();
        $session->destroy();
        
        return view('login');
    }
 
}
