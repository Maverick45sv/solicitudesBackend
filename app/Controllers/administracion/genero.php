<?php

namespace App\Controllers\administracion;

use App\Controllers\BaseController;
use \App\Models\GeneroModel;

class Genero extends BaseController
{
    public function inicio()
    {        
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }            
        $generoModel = model(GeneroModel::class);
        $datos = array(
            "todos" => $generoModel->findAll(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('administracion/genero/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }     
        $generoModel = model(GeneroModel::class);  
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
        );        
        return view('administracion/genero/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $generoModel = model(GeneroModel::class);
        $data = array('nombre' => $this->request->getPost('nombre')); 
        $generoModel->insert($data);
        return redirect()->to('admin/genero/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $generoModel = model(GeneroModel::class);        
        $datos = array(
            "genero" => $generoModel->find($id),
            "menu" => menu($session->get('idusuario')),
        );
        return view('administracion/genero/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $generoModel = model(GeneroModel::class);
        $data = array('nombre' => $this->request->getPost('nombre')); 
        $id = $this->request->getPost('id');
        $generoModel->update($id, $data);
        return redirect()->to('admin/genero/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }         
        $generoModel = model(GeneroModel::class);  
        $generoModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
