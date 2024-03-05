<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use \App\Models\ArchivoModel;

class Archivo extends BaseController 
{

    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $ArchivoModel = model(ArchivoModel::class);
        $datos = array(
            "todos" => $ArchivoModel->findAll(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/archivo/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $archivoModel = model(ArchivoModel::class);

        $datos = array(           
            "menu" => menu($session->get('idusuario')),
            "todos" => $archivoModel-> findAll(),
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
        $data = array(
            'nombre' => $this->request->getPost('nombre'),
            'peso' => $this->request->getPost('peso'),
            'creado' => date('Y-m-d H:i:s'),
            'url' => $this->request->getPost('url'),      
        ); 
        $archivoModel->insert($data);
        return redirect()->to('academico/archivo/');          
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