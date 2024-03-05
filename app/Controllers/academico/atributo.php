<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use \App\Models\AtributoModel;

class Atributo extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $atributoModel = model(AtributoModel::class);
        $datos = array(
            "todos" => $atributoModel->findAll(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/atributo/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $atributoModel = model(AtributoModel::class); 
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
        );       
        return view('academico/atributo/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $atributoModel = model(AtributoModel::class);
        $data = array(
            'nombre' => $this->request->getPost('nombre'),
            'tipo' => $this->request->getPost('tipo'),        
        ); 
        $atributoModel->insert($data);
        return redirect()->to('academico/atributo/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $atributoModel = model(AtributoModel::class);        
        $datos = array(
            "atributo" => $atributoModel->find($id),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/atributo/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $atributoModel = model(AtributoModel::class);
        $data = array(
            'nombre' => $this->request->getPost('nombre'),
            'tipo' => $this->request->getPost('tipo'),          
        ); 
        $id = $this->request->getPost('id');
        $atributoModel->update($id, $data);
        return redirect()->to('academico/atributo/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $atributoModel = model(AtributoModel::class);  
        $atributoModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}