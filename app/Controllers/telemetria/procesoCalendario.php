<?php

namespace App\Controllers\telemetria;

use App\Controllers\BaseController;
use \App\Models\ProcesoCalendarioModel;
use \App\Models\ProcesoModel;

class ProcesoCalendario extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }
        $procesoModel = model(ProcesoModel::class);       
        $datos = array(  
            "menu" => menu($session->get('idusuario')),
        );
        return view('telemetria/procesoCalendario/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoCalendarioModel = model(ProcesoCalendarioModel::class); 
        $procesoModel = model(ProcesoModel::class);       
        $datos = array( 
            "fecha" => $this->request->getGet('fecha'),
            "proceso" => $procesoModel->findAll(),        
            "menu" => menu($session->get('idusuario')),
        );       
        return view('telemetria/procesoCalendario/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoCalendarioModel = model(ProcesoCalendarioModel::class);
       
        $data = array(
            'inicio' => $this->request->getPost('inicio'),
            'fin' => $this->request->getPost('fin'),
            'id_proceso' => $this->request->getPost('proceso'),
            'id_usuario' => $session->get('idusuario')
        ); 
        $procesoCalendarioModel->insert($data);
        return redirect()->to('academico/calendario/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoCalendarioModel = model(ProcesoCalendarioModel::class); 
        $procesoModel = model(ProcesoModel::class);         
        $datos = array(
            "procesoCalendario" => $procesoCalendarioModel->find($id),
            "proceso" => $procesoModel->findAll(),  
            "menu" => menu($session->get('idusuario')),
        );
        return view('telemetria/procesoCalendario/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoCalendarioModel = model(ProcesoCalendarioModel::class);
        $cupo=0;
        if($this->request->getPost('cupo')){
            $cupo=1;
        }
        $data = array(
            'inicio' => $this->request->getPost('inicio'),
            'fin' => $this->request->getPost('fin'),
            'id_proceso' => $this->request->getPost('proceso'),
        ); 
        $id = $this->request->getPost('id');
        $procesoCalendarioModel->update($id, $data);
        return redirect()->to('academico/calendario/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $procesoCalendarioModel = model(ProcesoCalendarioModel::class);  
        $procesoCalendarioModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }

    public function eventos()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $procesoCalendarioModel = model(ProcesoCalendarioModel::class); 
        return $this->response->setJson($procesoCalendarioModel->cargarEventos());     
    }
}
