<?php

namespace App\Controllers\telemetria;

use App\Controllers\BaseController;
use \App\Models\AccionModel;

class Accion extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $accionModel = model(AccionModel::class);
        $datos = array(
            "todos" => $accionModel->findAll(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('telemetria/accion/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $accionModel = model(AccionModel::class); 
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
        );       
        return view('telemetria/accion/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $accionModel = model(AccionModel::class);
        $data = array('nombre' => $this->request->getPost('nombre')); 
        $accionModel->insert($data);
        return redirect()->to('telemetria/accion/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $accionModel = model(AccionModel::class);        
        $datos = array(
            "accion" => $accionModel->find($id),
            "menu" => menu($session->get('idusuario')),
        );
        return view('telemetria/accion/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $accionModel = model(AccionModel::class);
        $data = array('nombre' => $this->request->getPost('nombre')); 
        $id = $this->request->getPost('id');
        $accionModel->update($id, $data);
        return redirect()->to('telemetria/accion/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $accionModel = model(AccionModel::class);  
        $accionModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
