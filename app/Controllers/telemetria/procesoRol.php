<?php

namespace App\Controllers\telemetria;

use App\Controllers\BaseController;
use \App\Models\ProcesoRolModel;
use \App\Models\ProcesoModel;
use \App\Models\EstacionModel;
use \App\Models\RolModel;

class ProcesoRol extends BaseController
{
    public function inicio($id)
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $procesoRolModel = model(ProcesoRolModel::class);
        $procesoModel = model(ProcesoModel::class);
        $proceso = $procesoModel->find($id);
        $datos = array(
            "todos" => $procesoRolModel->buscarTodosXProceso($id),
            "proceso" => $proceso,
            "menu" => menu($session->get('idusuario')),
        );
        return view('telemetria/procesoRol/index', $datos);
    }

    public function nuevo($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoModel = model(ProcesoModel::class);
        $proceso = $procesoModel->find($id);
        $RolModel = model(RolModel::class); 
        $datos = array(   
            "proceso" => $proceso,    
            "roles" => $RolModel->findAll(),   
            "menu" => menu($session->get('idusuario')),
        );       
        return view('telemetria/procesoRol/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoRolModel = model(ProcesoRolModel::class);
       
        $data = array(
            'id_proceso' => $this->request->getPost('id_proceso'),
            'id_rol' => $this->request->getPost('id_rol'),
        ); 
        if ($procesoRolModel->save($data) === false) {
            $procesoModel = model(ProcesoModel::class);
            $proceso = $procesoModel->find($this->request->getPost('id_proceso'));
            $RolModel = model(RolModel::class); 
            $datos = array(   
                "proceso" => $proceso,    
                "roles" => $RolModel->findAll(),   
                "menu" => menu($session->get('idusuario')),
                'errors' => $procesoRolModel->errors(),   
            );   
            return view('telemetria/procesoRol/nuevo', $datos);    
        }
        return redirect()->to('telemetria/proceso/rol/'.$this->request->getPost('id_proceso'));          
    }

   
    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $procesoRolModel = model(ProcesoRolModel::class);  
        $procesoRolModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
