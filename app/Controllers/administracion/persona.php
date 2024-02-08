<?php

namespace App\Controllers\administracion;

use App\Controllers\BaseController;
use \App\Models\PersonaModel;
use \App\Models\SexoModel;
use \App\Models\GeneroModel;

class Persona extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $personaModel = model(PersonaModel::class);
        $datos = array(
            "todos" => $personaModel->buscarTodos(),
            "menu" => menu(),
        );
        return view('administracion/persona/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $sexoModel = model(SexoModel::class);
        $generoModel = model(GeneroModel::class); 
        $datos = array(           
            "menu" => menu(),
            "sexo" => $sexoModel->findAll(),
            "genero" => $generoModel->findAll(),
        );       
        return view('administracion/persona/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $personaModel = model(PersonaModel::class);
        $data = array(
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'dui' => $this->request->getPost('dui'),
            'id_sexo' => $this->request->getPost('sexo'),
            'id_genero' => $this->request->getPost('genero'),
        ); 
        $personaModel->insert($data);
        return redirect()->to('admin/persona/');          
    }

   
    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $personaModel = model(PersonaModel::class);  
        $sexoModel = model(SexoModel::class);
        $generoModel = model(GeneroModel::class); 
        $datos = array(           
            "menu" => menu(),
            "persona" => $personaModel->find($id),
            "sexo" => $sexoModel->findAll(),
            "genero" => $generoModel->findAll(),
        );         
       
        return view('administracion/persona/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $personaModel = model(PersonaModel::class);
        $data = array(
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'dui' => $this->request->getPost('dui'),
            'id_sexo' => $this->request->getPost('sexo'),
            'id_genero' => $this->request->getPost('genero'),
        ); 
        $id = $this->request->getPost('id');
        $personaModel->update($id, $data);
        return redirect()->to('admin/persona/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $personaModel = model(PersonaModel::class);  
        $personaModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
