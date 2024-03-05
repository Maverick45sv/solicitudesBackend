<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use \App\Models\CategoriaMotivoModel;

class CategoriaMotivo extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $categoriamotivoModel = model(CategoriaMotivoModel::class);
        $datos = array(
            "todos" => $categoriamotivoModel->findAll(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/categoriamotivo/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $categoriamotivoModel = model(CategoriaMotivoModel::class); 
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
        );       
        return view('academico/categoriamotivo/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $categoriamotivoModel = model(CategoriaMotivoModel::class);
        $data = array(
            'nombre' => $this->request->getPost('nombre'),        
        ); 
        $categoriamotivoModel->insert($data);
        return redirect()->to('academico/categoriamotivo/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $categoriamotivoModel = model(CategoriaMotivoModel::class);        
        $datos = array(
            "categoriamotivo" => $categoriamotivoModel->find($id),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/categoriamotivo/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $categoriamotivoModel = model(CategoriaMotivoModel::class);
        $data = array(
            'nombre' => $this->request->getPost('nombre'),       
        ); 
        $id = $this->request->getPost('id');
        $categoriamotivoModel->update($id, $data);
        return redirect()->to('academico/categoriamotivo/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $categoriamotivoModel = model(CategoriaMotivoModel::class);  
        $categoriamotivoModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}