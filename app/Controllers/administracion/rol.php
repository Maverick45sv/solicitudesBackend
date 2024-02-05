<?php

namespace App\Controllers\administracion;

use App\Controllers\BaseController;
use \App\Models\RolModel;

class Rol extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $rolModel = model(RolModel::class);
        $datos = array(
            "todos" => $rolModel->findAll(),
            "menu" => menu(),
        );
        return view('administracion/rol/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $rolModel = model(RolModel::class); 
        $datos = array(           
            "menu" => menu(),
        );       
        return view('administracion/rol/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $rolModel = model(RolModel::class);
        $data = array('nombre' => $this->request->getPost('nombre')); 
        $rolModel->insert($data);
        return redirect()->to('admin/rol/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $rolModel = model(RolModel::class);        
        $datos = array(
            "rol" => $rolModel->find($id),
            "menu" => menu(),
        );
        return view('administracion/rol/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $rolModel = model(RolModel::class);
        $data = array('nombre' => $this->request->getPost('nombre')); 
        $id = $this->request->getPost('id');
        $rolModel->update($id, $data);
        return redirect()->to('admin/rol/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $rolModel = model(RolModel::class);  
        $rolModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
