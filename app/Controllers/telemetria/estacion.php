<?php

namespace App\Controllers\telemetria;

use App\Controllers\BaseController;
use \App\Models\EstacionModel;

class Estacion extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $estacionModel = model(EstacionModel::class);
        $datos = array(
            "todos" => $estacionModel->findAll(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('telemetria/estacion/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $estacionModel = model(EstacionModel::class); 
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
        );       
        return view('telemetria/estacion/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $estacionModel = model(EstacionModel::class);
        $data = array('nombre' => $this->request->getPost('nombre')); 
        $estacionModel->insert($data);
        return redirect()->to('telemetria/estacion/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $estacionModel = model(EstacionModel::class);        
        $datos = array(
            "estacion" => $estacionModel->find($id),
            "menu" => menu($session->get('idusuario')),
        );
        return view('telemetria/estacion/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $estacionModel = model(EstacionModel::class);
        $data = array('nombre' => $this->request->getPost('nombre')); 
        $id = $this->request->getPost('id');
        $estacionModel->update($id, $data);
        return redirect()->to('telemetria/estacion/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $estacionModel = model(EstacionModel::class);  
        $estacionModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
