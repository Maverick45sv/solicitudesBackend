<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use \App\Models\CarreraModel;

class Carrera extends BaseController 
{

    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $CarreraModel = model(CarreraModel::class);
        $datos = array(
            "todos" => $CarreraModel->buscarTodos(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/carrera/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $tipoModel = model(CarreraModel::class);

        $datos = array(           
            "menu" => menu($session->get('idusuario')),
            "datosf" => $tipoModel-> buscarFacultad(),
        );

        return view('academico/carrera/nuevo', $datos);
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $tipoModel = model(CarreraModel::class);
        $data = array(
            'nombre' => $this->request->getPost('nombre'),
            'codigo' => $this->request->getPost('codigo'),
            'id_facultad' => $this->request->getPost('opcionFacultad'),       
        ); 
        $tipoModel->insert($data);
        return redirect()->to('academico/carrera/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $tipoModel = model(CarreraModel::class);       
        $datos = array(
            "carrera" => $tipoModel->find($id),
            "menu" => menu($session->get('idusuario')),
            'nombre' => $this->request->getPost('nombre'),
            'codigo' => $this->request->getPost('codigo'),
            "datosf" => $tipoModel-> buscarFacultad(), 
        );
        return view('academico/carrera/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $tipoModel = model(CarreraModel::class);
        $data = array(
            'nombre' => $this->request->getPost('nombre'),
            'codigo' => $this->request->getPost('codigo'),
            'id_facultad' => $this->request->getPost('opcionFacultad'),      
        ); 
        $id = $this->request->getPost('id');
        $tipoModel->update($id, $data);
        return redirect()->to('academico/carrera/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $tipoModel = model(CarreraModel::class);  
        $tipoModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}