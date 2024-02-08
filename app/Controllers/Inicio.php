<?php

namespace App\Controllers;

use \App\Models\UsuarioModel;

class Inicio extends BaseController
{
    public function index(): string
    {
        return view('login');
    }

    public function inicio()
    {
        $usuarioModel = model(UsuarioModel::class);
        $session = session();
        //$session->destroy();       
        $datos=array("usuario" => 0);  
        $where="nombre = '".$this->request->getPost('user')."' AND clave= '".$this->request->getPost('pass')."'";
        $validar=$usuarioModel->where($where)->first(); 
        if($validar and $validar->activo){
            $newdata = [
                'usuario'  => $validar->nombre,
                'email'     => $validar->correo,
            ];
            $session->set($newdata);
            $datos=array(
                "menu" => menu(),
                "usuario" => $validar
            );
            return view('inicio', $datos);
        }       
        return redirect()->back();       
    }
}
