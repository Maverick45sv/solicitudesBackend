<?php

namespace App\Controllers\administracion;

use App\Controllers\BaseController;
use \App\Models\SexoModel;

class Sexo extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $sexoModel = model(SexoModel::class);
        $datos = array(
            "todos" => $sexoModel->findAll(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('administracion/sexo/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $sexoModel = model(SexoModel::class); 
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
        );       
        return view('administracion/sexo/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $sexoModel = model(SexoModel::class);
        $data = array('nombre' => $this->request->getPost('nombre')); 
        $sexoModel->insert($data);
        return redirect()->to('admin/sexo/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $sexoModel = model(SexoModel::class);        
        $datos = array(
            "sexo" => $sexoModel->find($id),
            "menu" => menu($session->get('idusuario')),
        );
        return view('administracion/sexo/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $sexoModel = model(SexoModel::class);
        $data = array('nombre' => $this->request->getPost('nombre')); 
        $id = $this->request->getPost('id');
        $sexoModel->update($id, $data);
        return redirect()->to('admin/sexo/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $sexoModel = model(SexoModel::class);  
        $sexoModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
