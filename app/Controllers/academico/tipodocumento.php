<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use \App\Models\TipoDocumentoModel;

class TipoDocumento extends BaseController 
{

    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $TipoDocumentoModel = model(TipoDocumentoModel::class);
        $datos = array(
            "todos" => $TipoDocumentoModel->findAll(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/tipodocumento/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $TipoDocumentoModel = model(TipoDocumentoModel::class);

        $datos = array(           
            "menu" => menu($session->get('idusuario')),
            "todos" => $TipoDocumentoModel-> findAll(),
        );

        return view('academico/tipodocumento/nuevo', $datos);
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $TipoDocumentoModel = model(TipoDocumentoModel::class);
        $data = array(
            'nombre' => $this->request->getPost('nombre'),      
        ); 
        $TipoDocumentoModel->insert($data);
        return redirect()->to('academico/tipodocumento/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $TipoDocumentoModel = model(TipoDocumentoModel::class);       
        $datos = array(
            "tipodocumento" => $TipoDocumentoModel->find($id),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/tipodocumento/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $TipoDocumentoModel = model(TipoDocumentoModel::class);
        $data = array(
            'nombre' => $this->request->getPost('nombre'),      
        ); 
        $id = $this->request->getPost('id');
        $TipoDocumentoModel->update($id, $data);
        return redirect()->to('academico/tipodocumento/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $TipoDocumentoModel = model(TipoDocumentoModel::class);  
        $TipoDocumentoModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}