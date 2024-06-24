<?php

namespace App\Controllers\telemetria;

use App\Controllers\BaseController;
use \App\Models\ProcesoNotificacionModel;
use \App\Models\ProcesoModel;
use \App\Models\ProcesoEstacionModel;
use \App\Models\RolModel;

class ProcesoNotificacion extends BaseController
{
    public function inicio($id)
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $procesoNotificacionModel = model(ProcesoNotificacionModel::class);
        $procesoEstacionModel = model(ProcesoEstacionModel::class);
        $procesoModel = model(ProcesoModel::class);
        $rolModel = model(RolModel::class);     
        $procesoE=$procesoEstacionModel->find($id);
        $proceso=$procesoModel->find($procesoE->id_proceso);
        $datos = array(
            "todos" => $procesoNotificacionModel->buscarTodos($id),
            "roles" => $rolModel->findAll(),
            "proceso" => $proceso,
            "procesoE" => $procesoE,
            "menu" => menu($session->get('idusuario')),
        );
        return view('telemetria/procesoNotificacion/index', $datos);
    }

  

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoNotificacionModel = model(ProcesoNotificacionModel::class);
       
        $data = array(
            'id_proceso_estacion' => $this->request->getPost('id_proceso_estacion'),
            'id_rol' => $this->request->getPost('id_rol'),
        ); 
        if ($procesoNotificacionModel->save($data) === false) {
            $procesoNotificacionModel = model(ProcesoNotificacionModel::class);
            $procesoEstacionModel = model(ProcesoEstacionModel::class);
            $procesoModel = model(ProcesoModel::class);
            $rolModel = model(RolModel::class);     
            $procesoE=$procesoEstacionModel->find($id);
            $proceso=$procesoModel->find($procesoE->id_proceso);
            $datos = array(
                "todos" => $procesoNotificacionModel->buscarTodos($id),
                "roles" => $rolModel->findAll(),
                "proceso" => $proceso,
                "procesoE" => $procesoE,
                "menu" => menu($session->get('idusuario')),
                'errors' => $procesoNotificacionModel->errors(), 
            );          
            return view('telemetria/procesoNotificacion/index', $datos);    
        }
        return redirect()->to('telemetria/proceso/notificacion/'.$this->request->getPost('id_proceso_estacion'));          
    }

  

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $procesoNotificacionModel = model(ProcesoNotificacionModel::class);  
        $procesoNotificacionModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
