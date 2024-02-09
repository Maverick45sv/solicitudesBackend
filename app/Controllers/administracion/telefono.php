<?php

namespace App\Controllers\administracion;

use App\Controllers\BaseController;
use \App\Models\TelefonoModel;
use \App\Models\PersonaModel;
use \App\Models\TipoModel;

class Telefono extends BaseController
{
    public function inicio($id)
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $telefonoModel = model(TelefonoModel::class);
        $personaModel = model(PersonaModel::class);
        $datos = array(
            "todos" => $telefonoModel->buscarTodos($id),
            "persona" => $personaModel->find($id),
            "menu" => menu($session->get('idusuario')),
        );
        return view('administracion/telefono/index', $datos);
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
            "menu" => menu($session->get('idusuario')),
            "persona" => $personaModel->find($id),
            "tipo" => $tipoModel->findAll(),
        );       
        return view('administracion/telefono/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $telefonoModel = model(TelefonoModel::class);
        $data = array(
            'telefono' => $this->request->getPost('telefono'),            
            'id_persona' => $this->request->getPost('persona'),
            'id_tipo' => $this->request->getPost('tipo'),
        ); 
        $telefonoModel->insert($data);
        return redirect()->to('admin/persona/telefono/'.$this->request->getPost('persona'));
          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $telefonoModel = model(TelefonoModel::class);
        $tipoModel = model(TipoModel::class); 
        $personaModel = model(PersonaModel::class); 
        $telefono = $telefonoModel->find($id);
        
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
            "telefono" => $telefono,
            "persona" => $personaModel->find($telefono->id_persona),
            "tipo" => $tipoModel->findAll(),
        );         
       
        return view('administracion/telefono/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $telefonoModel = model(TelefonoModel::class);
        $data = array(
            'telefono' => $this->request->getPost('telefono'),           
            'id_tipo' => $this->request->getPost('tipo'),
        ); 
        $id = $this->request->getPost('id');
        $telefonoModel->update($id, $data);
        return redirect()->to('admin/persona/telefono/'.$this->request->getPost('persona'));     
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $telefonoModel = model(TelefonoModel::class);  
        $telefonoModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}