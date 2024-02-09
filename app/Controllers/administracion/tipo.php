<?php

namespace App\Controllers\administracion;

use App\Controllers\BaseController;
use \App\Models\TipoModel;

class Tipo extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $tipoModel = model(TipoModel::class);
        $datos = array(
            "todos" => $tipoModel->findAll(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('administracion/tipo/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $tipoModel = model(TipoModel::class); 
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
        );       
        return view('administracion/tipo/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $tipoModel = model(TipoModel::class);
        $data = array('nombre' => $this->request->getPost('nombre')); 
        $tipoModel->insert($data);
        return redirect()->to('admin/tipo/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $tipoModel = model(TipoModel::class);        
        $datos = array(
            "tipo" => $tipoModel->find($id),
            "menu" => menu($session->get('idusuario')),
        );
        return view('administracion/tipo/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $tipoModel = model(TipoModel::class);
        $data = array('nombre' => $this->request->getPost('nombre')); 
        $id = $this->request->getPost('id');
        $tipoModel->update($id, $data);
        return redirect()->to('admin/tipo/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $tipoModel = model(TipoModel::class);  
        $tipoModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
