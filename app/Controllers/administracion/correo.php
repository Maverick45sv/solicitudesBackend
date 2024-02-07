<?php

namespace App\Controllers\administracion;

use App\Controllers\BaseController;
use \App\Models\CorreoModel;
use \App\Models\PersonaModel;
use \App\Models\TipoModel;

class Correo extends BaseController
{
    public function inicio($id)
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $correoModel = model(CorreoModel::class);
        $personaModel = model(PersonaModel::class);
        $datos = array(
            "todos" => $correoModel->buscarTodos($id),
            "persona" => $personaModel->find($id),
            "menu" => menu(),
        );
        return view('administracion/correo/index', $datos);
    }

    public function nuevo($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $personaModel = model(PersonaModel::class);
        $tipoModel = model(TipoModel::class); 
        $datos = array(           
            "menu" => menu(),
            "persona" => $personaModel->find($id),
            "tipo" => $tipoModel->findAll(),
        );       
        return view('administracion/correo/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $correoModel = model(CorreoModel::class);
        $data = array(
            'correo' => $this->request->getPost('correo'),            
            'id_persona' => $this->request->getPost('persona'),
            'id_tipo' => $this->request->getPost('tipo'),
        ); 
        $correoModel->insert($data);
        return redirect()->to('admin/persona/mail/'.$this->request->getPost('persona'));       
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $correoModel = model(CorreoModel::class);
        $tipoModel = model(TipoModel::class); 
        $personaModel = model(PersonaModel::class); 
        $correo = $correoModel->find($id);
        
        $datos = array(           
            "menu" => menu(),
            "correo" => $correo,
            "persona" => $personaModel->find($correo->id_persona),
            "tipo" => $tipoModel->findAll(),
        );         
       
        return view('administracion/correo/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $correoModel = model(CorreoModel::class);
        $data = array(
            'correo' => $this->request->getPost('correo'),           
            'id_tipo' => $this->request->getPost('tipo'),
        ); 
        $id = $this->request->getPost('id');
        $correoModel->update($id, $data);
        return redirect()->to('admin/persona/mail/'.$this->request->getPost('persona'));    
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $correoModel = model(CorreoModel::class);  
        $correoModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
