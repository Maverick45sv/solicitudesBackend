<?php

namespace App\Controllers\administracion;

use App\Controllers\BaseController;
use \App\Models\PersonaFacultadModel;
use \App\Models\FacultadModel;
use \App\Models\UsuarioModel;
use \App\Models\PersonaModel;

class PersonaFacultad extends BaseController
{
    public function inicio($id)
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $personaFacultadModel = model(PersonaFacultadModel::class);
        $facultadModel = model(FacultadModel::class);      
        $personaModel = model(PersonaModel::class);
               
       
        $datos = array(
            "todos" => $personaFacultadModel->buscarTodos($id),     
            "persona" => $personaModel->find($id),  
            "facultades" => $facultadModel->findAll(),    
            "menu" => menu($session->get('idusuario')),
        );
        return view('administracion/personaFacultad/index', $datos);
    }

  
    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $personaFacultadModel = model(PersonaFacultadModel::class);
       
        $data = array(
            'id_persona' => $this->request->getPost('id_persona'),
            'id_facultad' => $this->request->getPost('id_facultad'),
        ); 
        if ($personaFacultadModel->save($data) === false) {
           
            $facultadModel = model(FacultadModel::class);      
            $personaModel = model(PersonaModel::class);
            $datos = array(   
                "persona" => $personaModel->find($id),  
                "facultades" => $facultadModel->findAll(),   
                "todos" => $personaFacultadModel->buscarTodos($id),   
                "menu" => menu($session->get('idusuario')),
                'errors' => $usuarioFacultadModel->errors(),   
            );   
            return view('administracion/personaFacultad/index', $datos);    
        }
        return redirect()->to('admin/persona/facultad/'.$this->request->getPost('id_persona'));          
    }

   
    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $personaFacultadModel = model(PersonaFacultadModel::class);  
        $personaFacultadModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
