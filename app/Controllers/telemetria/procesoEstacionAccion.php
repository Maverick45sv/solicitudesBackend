<?php

namespace App\Controllers\telemetria;

use App\Controllers\BaseController;
use \App\Models\ProcesoEstacionAccionModel;
use \App\Models\ProcesoEstacionModel;
use \App\Models\ProcesoModel;
use \App\Models\EstacionModel;
use \App\Models\AccionModel;

class ProcesoEstacionAccion extends BaseController
{
    public function inicio($id)
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $procesoEstacionAccionModel = model(ProcesoEstacionAccionModel::class);
        $procesoModel = model(ProcesoModel::class);
        $accionModel = model(AccionModel::class);
        $procesoEstacionModel = model(ProcesoEstacionModel::class);
        $procesoEstacion = $procesoEstacionModel->find($id);
        $proceso = $procesoModel->find($procesoEstacion->id_proceso);
        $datos = array(
            "todos" => $procesoEstacionAccionModel->buscarTodos($id),
            "proceso" => $proceso,
            "proceso_estacion" =>  $procesoEstacion, 
            "acciones" =>  $accionModel->findAll(), 
            "estaciones" =>   $procesoEstacionModel->buscarTodosXProceso($proceso->id),       
        );
        return view('telemetria/procesoEstacionAccion/index', $datos);
    }

  
    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoEstacionAccionModel = model(ProcesoEstacionAccionModel::class);
        $noti=0;
        $inter=0;
        if($this->request->getPost('notificacion')){
            $noti=1;
        }
        if($this->request->getPost('interno')){
            $inter=1;
        }
        $data = array(
            'id_proceso_estacion_origen' => $this->request->getPost('id_origen'),
            'id_proceso_estacion_destino' => $this->request->getPost('id_destino'),
            'id_accion' => $this->request->getPost('id_accion'),
            'notificacion' => $noti,
            'interno' => $inter,
        ); 
        $procesoEstacionAccionModel->insert($data);
        return redirect()->to('telemetria/proceso/estacion/accion/'.$this->request->getPost('id_proceso'));          
    }
   

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $procesoEstacionAccionModel = model(ProcesoEstacionAccionModel::class);  
        $procesoEstacionAccionModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
