<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use \App\Models\ArchivoModel;
use \App\Models\TipoDocumentoModel;
use \App\Models\SolicitudModel;
use \App\Models\SolicitudDocumentoArchivoModel;
use \App\Models\ProcesoTipoDocumentoModel;

class Archivo extends BaseController 
{

  
    public function nuevo($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
       
        $ProcesotipodocumentoModel = model(ProcesoTipoDocumentoModel::class);
        $solicitudModel = model(SolicitudModel::class);
        $solicitud = $solicitudModel->find($id);        
        $todos = $ProcesotipodocumentoModel->buscarTodosXProceso($solicitud->id_proceso);
       
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
            "todos" => $todos,
            "solicitud" => $solicitud,
            "errors" => array(),
        );

        return view('academico/archivo/nuevo', $datos);
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $archivoModel = model(ArchivoModel::class);
        $tipodocumentoModel = model(TipoDocumentoModel::class);
        $solicitudModel = model(SolicitudModel::class);
        $solicitudDocModel = model(SolicitudDocumentoArchivoModel::class);
        $ProcesotipodocumentoModel = model(ProcesoTipoDocumentoModel::class);
        $tipo = $ProcesotipodocumentoModel->find($this->request->getPost("tipoD"));
        $id = $this->request->getPost("id");
        $solicitud=$solicitudModel->find($id);
        $validationRule = [
            'archivo' => [
                'label' => 'El Archivo a cargar',
                'rules' => [
                    'uploaded[archivo]',
                    'mime_in[archivo,image/jpg,image/jpeg,image/gif,image/png,image/webp]',                    
                ],
            ],
        ];
        if (! $this->validate($validationRule)) {           
            $datos = array(           
                "menu" => menu($session->get('idusuario')),
                "todos" => $tipodocumentoModel->findAll(),
                "solicitud" => $solicitud->id,
                'errors' => $this->validator->getErrors(),
            );    
            return view('academico/archivo/nuevo', $datos);
        }

        $img = $this->request->getFile('archivo');

        if (! $img->hasMoved()) {
            $filepath = WRITEPATH . 'uploads/'. $img->store();          
        }
       // echo $filepath;
        $imgContent = file_get_contents($filepath);      
     
        $data = array(           
            'creado' => date('Y-m-d H:i:s'),
            'data' => $imgContent,      
        ); 
        $archivoModel->insert($data);
        $idarchivo=$archivoModel->getInsertID();
        $data = array(           
            'id_archivo' => $idarchivo,
            'id_proceso_tipo_documento' => $tipo->id,
            'id_solicitud' => $solicitud->id,      
        ); 
        $solicitudDocModel->insert($data);

        return redirect()->to('academico/solicitud/document/' . $id);  
      
                
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $archivoModel = model(ArchivoModel::class);       
        $datos = array(
            "archivo" => $archivoModel->find($id),
            "menu" => menu($session->get('idusuario')),
            'nombre' => $this->request->getPost('nombre'),
            'peso' => $this->request->getPost('peso'),
            'url' => $this->request->getPost('url'),
        );
        return view('academico/archivo/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $archivoModel = model(ArchivoModel::class);
        $data = array(
            'nombre' => $this->request->getPost('nombre'),
            'peso' => $this->request->getPost('peso'),
            'creado' => date('Y-m-d H:i:s'),
            'url' => $this->request->getPost('url'),      
        ); 
        $id = $this->request->getPost('id');
        $archivoModel->update($id, $data);
        return redirect()->to('academico/archivo/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $archivoModel = model(ArchivoModel::class);  
        $archivoModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}