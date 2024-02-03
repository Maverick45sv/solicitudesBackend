<?php

namespace App\Controllers\administracion;

use App\Controllers\BaseController;
use \App\Models\SexoModel;

class Sexo extends BaseController
{
    public function inicio()
    {
       $sexoModel = model(SexoModel::class);
       $datos = array("todos" => $sexoModel->findAll());
       return view('administracion/sexo/index', $datos);
    }

    public function nuevo()
    {
        $sexoModel = model(SexoModel::class);        
        return view('administracion/sexo/nuevo');
   
    }

    public function guardar()
    {
        $sexoModel = model(SexoModel::class);
        echo $id;
        $datos = array("todos" => $sexoModel->findAll());
        return view('administracion/sexo/index', $datos);    
    }

    public function editar($id)
    {
        $sexoModel = model(SexoModel::class);
        echo $id;
        $datos = array("todos" => $sexoModel->findAll());
        return view('administracion/sexo/index', $datos);    
    }

    public function eliminar($id)
    {
        $usuarioModel = model(UsuarioModel::class);
        $session = session();
        $session->destroy();       
        $datos=array("usuario" => 0);  
        $where="nombre = '".$this->request->getPost('user')."' AND clave= '".$this->request->getPost('pass')."'";
        $validar=$usuarioModel->where($where)->first(); 
        if($validar and $validar->activo){
            $newdata = [
                'usuario'  => $validar->nombre,
                'email'     => $validar->correo,
            ];
            $session->set($newdata);
            $datos=array("usuario" => $validar);
            return view('inicio', $datos);
        }       
        return redirect()->back();       
    }
}
