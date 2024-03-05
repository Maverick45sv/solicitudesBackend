<?php

namespace App\Controllers\telemetria;

use App\Controllers\BaseController;
use \App\Models\ProcesoAtributoModel;
use \App\Models\ProcesoModel;
use \App\Models\AtributoModel;

class ProcesoAtributo extends BaseController
{
    public function inicio($id)
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $procesoAtributoModel = model(ProcesoAtributoModel::class);
        $procesoModel = model(ProcesoModel::class);
        $proceso = $procesoModel->find($id);
        $datos = array(
            "todos" => $procesoAtributoModel->buscarTodosXProceso($id),
            "proceso" => $proceso,
            "menu" => menu($session->get('idusuario')),
        );
        return view('telemetria/procesoAtributo/index', $datos);
    }

    public function nuevo($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoModel = model(ProcesoModel::class);
        $proceso = $procesoModel->find($id);
        $AtributoModel = model(AtributoModel::class); 
        $datos = array(   
            "proceso" => $proceso,    
            "atributo" => $AtributoModel->findAll(),   
            "menu" => menu($session->get('idusuario')),
        );       
        return view('telemetria/procesoAtributo/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoAtributoModel = model(ProcesoAtributoModel::class);
       
        $data = array(
            'id_proceso' => $this->request->getPost('id_proceso'),
            'id_atributo' => $this->request->getPost('id_atributo'),
            'ruta' => $this->request->getPost('ruta'),
        ); 
        if ($procesoAtributoModel->save($data) === false) {
            $procesoModel = model(ProcesoModel::class);
            $proceso = $procesoModel->find($this->request->getPost('id_proceso'));
            $AtributoModel = model(AtributoModel::class); 
            $datos = array(   
                "proceso" => $proceso,    
                "atributo" => $AtributoModel->findAll(),   
                "menu" => menu($session->get('idusuario')),
                'errors' => $procesoAtributoModel->errors(),   
            );   
            return view('telemetria/procesoAtributo/nuevo', $datos);    
        }
        return redirect()->to('telemetria/proceso/atributo/'.$this->request->getPost('id_proceso'));          
    }

  
    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $procesoAtributoModel = model(ProcesoAtributoModel::class);  
        $procesoAtributoModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
