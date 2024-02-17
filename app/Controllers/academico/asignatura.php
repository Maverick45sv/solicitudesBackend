<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use \App\Models\AsignaturaModel;

class Asignatura extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $asignaturaModel = model(AsignaturaModel::class);
        $datos = array(
            "todos" => $asignaturaModel->findAll(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/asignatura/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $asignaturaModel = model(AsignaturaModel::class); 
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
        );       
        return view('academico/asignatura/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $asignaturaModel = model(AsignaturaModel::class);
        $data = array('nombre' => $this->request->getPost('nombre')); 
        $asignaturaModel->insert($data);
        return redirect()->to('academico/asignatura/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $asignaturaModel = model(AsignaturaModel::class);        
        $datos = array(
            "asignatura" => $asignaturaModel->find($id),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/asignatura/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $asignaturaModel = model(AsignaturaModel::class);
        $data = array('nombre' => $this->request->getPost('nombre')); 
        $id = $this->request->getPost('id');
        $asignaturaModel->update($id, $data);
        return redirect()->to('academico/asignatura/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $asignaturaModel = model(AsignaturaModel::class);  
        $asignaturaModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
