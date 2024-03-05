<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use \App\Models\FacultadModel;

class Facultad extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $facultadModel = model(FacultadModel::class);
        $datos = array(
            "todos" => $facultadModel->findAll(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/facultad/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $facultadModel = model(FacultadModel::class); 
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
        );       
        return view('academico/facultad/nuevo', $datos);
   
    }  

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/'); 
        }    
        $facultadModel = model(FacultadModel::class);
        $data = array(
            'nombre' => $this->request->getPost('nombre'),        
        ); 
        $facultadModel->insert($data);
        return redirect()->to('academico/facultad/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $facultadModel = model(FacultadModel::class);        
        $datos = array(
            "facultad" => $facultadModel->find($id),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/facultad/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $facultadModel = model(FacultadModel::class);
        $data = array(
            'id' => $this->request->getPost('id'),
            'nombre' => $this->request->getPost('nombre')     
        ); 
        $id = $this->request->getPost('id');
        $facultadModel->update($id, $data);
        return redirect()->to('academico/facultad/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $facultadModel = model(FacultadModel::class);  
        $facultadModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}