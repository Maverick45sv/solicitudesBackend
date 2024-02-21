<?php

namespace App\Controllers\telemetria;

use App\Controllers\BaseController;
use \App\Models\ProcesoEstacionModel;
use \App\Models\ProcesoModel;
use \App\Models\EstacionModel;

class ProcesoEstacion extends BaseController
{
    public function inicio($id)
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $procesoEstacionModel = model(ProcesoEstacionModel::class);
        $procesoModel = model(ProcesoModel::class);
        $proceso = $procesoModel->find($id);
        $datos = array(
            "todos" => $procesoEstacionModel->buscarTodosXProceso($id),
            "proceso" => $proceso,
            "menu" => menu($session->get('idusuario')),
        );
        return view('telemetria/procesoEstacion/index', $datos);
    }

    public function nuevo($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoModel = model(ProcesoModel::class);
        $proceso = $procesoModel->find($id);
        $EstacionModel = model(EstacionModel::class); 
        $datos = array(   
            "proceso" => $proceso,    
            "estacion" => $EstacionModel->findAll(),   
            "menu" => menu($session->get('idusuario')),
        );       
        return view('telemetria/procesoEstacion/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoEstacionModel = model(ProcesoEstacionModel::class);
       
        $data = array(
            'id_proceso' => $this->request->getPost('id_proceso'),
            'id_estacion' => $this->request->getPost('id_estacion'),
            'ruta' => $this->request->getPost('ruta'),
        ); 
        if ($procesoEstacionModel->save($data) === false) {
            $procesoModel = model(ProcesoModel::class);
            $proceso = $procesoModel->find($this->request->getPost('id_proceso'));
            $EstacionModel = model(EstacionModel::class); 
            $datos = array(   
                "proceso" => $proceso,    
                "estacion" => $EstacionModel->findAll(),   
                "menu" => menu($session->get('idusuario')),
                'errors' => $procesoEstacionModel->errors(),   
            );   
            return view('telemetria/procesoEstacion/nuevo', $datos);    
        }
        return redirect()->to('telemetria/proceso/estacion/'.$this->request->getPost('id_proceso'));          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $EstacionModel = model(EstacionModel::class); 
        $procesoEstacionModel = model(ProcesoEstacionModel::class);  

        $datos = array(
            "procesoEstacion" => $procesoEstacionModel->find($id),
            "estacion" => $EstacionModel->findAll(), 
            "menu" => menu($session->get('idusuario')),
        );
        return view('telemetria/procesoEstacion/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoEstacionModel = model(ProcesoEstacionModel::class);
        $cupo=0;
        if($this->request->getPost('cupo')){
            $cupo=1;
        }
        $data = array(
            'id_proceso' => $this->request->getPost('id_proceso'),
            'id_estacion' => $this->request->getPost('id_estacion'),
            'ruta' => $this->request->getPost('ruta'),
        ); 
        $id = $this->request->getPost('id');
        $procesoEstacionModel->update($id, $data);
        return redirect()->to('telemetria/proceso/estacion/'.$this->request->getPost('id_proceso'));          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $procesoEstacionModel = model(ProcesoEstacionModel::class);  
        $procesoEstacionModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
