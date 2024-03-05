<?php

namespace App\Controllers\telemetria;

use App\Controllers\BaseController;
use \App\Models\ProcesoTipoDocumentoModel;
use \App\Models\ProcesoModel;
use \App\Models\TipoDocumentoModel;

class ProcesoTipoDocumento extends BaseController
{
    public function inicio($id)
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $procesoTipoDocumentoModel = model(ProcesoTipoDocumentoModel::class);
        $procesoModel = model(ProcesoModel::class);
        $proceso = $procesoModel->find($id);
        $datos = array(
            "todos" => $procesoTipoDocumentoModel->buscarTodosXProceso($id),
            "proceso" => $proceso,
            "menu" => menu($session->get('idusuario')),
        );
        return view('telemetria/procesoTipoDocumento/index', $datos);
    }

    public function nuevo($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoModel = model(ProcesoModel::class);
        $proceso = $procesoModel->find($id);
        $TipoDocumentoModel = model(TipoDocumentoModel::class); 
        $datos = array(   
            "proceso" => $proceso,    
            "tipoDocumento" => $TipoDocumentoModel->findAll(),   
            "menu" => menu($session->get('idusuario')),
        );       
        return view('telemetria/procesoTipoDocumento/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoTipoDocumentoModel = model(ProcesoTipoDocumentoModel::class);
       
        $data = array(
            'id_proceso' => $this->request->getPost('id_proceso'),
            'id_tipo_documento' => $this->request->getPost('id_tipoDocumento'),
            'id_usuario' => $session->get('idusuario')           
        ); 
        if ($procesoTipoDocumentoModel->save($data) === false) {
            $procesoModel = model(ProcesoModel::class);
            $proceso = $procesoModel->find($this->request->getPost('id_proceso'));
            $TipoDocumentoModel = model(TipoDocumentoModel::class); 
            $datos = array(   
                "proceso" => $proceso,    
                "tipoDocumento" => $TipoDocumentoModel->findAll(),   
                "menu" => menu($session->get('idusuario')),
                'errors' => $procesoTipoDocumentoModel->errors(),   
            );   
            return view('telemetria/procesoTipoDocumento/nuevo', $datos);    
        }
        return redirect()->to('telemetria/proceso/tipodocumento/'.$this->request->getPost('id_proceso'));          
    }

  

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $procesoTipoDocumentoModel = model(ProcesoTipoDocumentoModel::class);  
        $procesoTipoDocumentoModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
