<?php

namespace App\Controllers\administracion;

use App\Controllers\BaseController;
use \App\Models\MenuModel;

class Menu extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $menuModel = model(MenuModel::class);
        $datos = array(
            "todos" => $menuModel->findAll(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('administracion/menu/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $menuModel = model(MenuModel::class); 
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
            "padre" => $menuModel->findAll(),
        );       
        return view('administracion/menu/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $menuModel = model(MenuModel::class);
        $data = array(
            'nombre' => $this->request->getPost('nombre'),
            'enlace' => $this->request->getPost('enlace'),
            'descripcion' => $this->request->getPost('descripcion'),
            'padre' => $this->request->getPost('padre')
        ); 
        $menuModel->insert($data);
        return redirect()->to('admin/menu/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $menuModel = model(MenuModel::class);        
        $datos = array(
            "menu" => $menuModel->find($id),
            "padre" => $menuModel->findAll(),
            "menup" => menu($session->get('idusuario')),
        );
        return view('administracion/menu/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $menuModel = model(MenuModel::class);
        $data = array(
            'nombre' => $this->request->getPost('nombre'),
            'enlace' => $this->request->getPost('enlace'),
            'descripcion' => $this->request->getPost('descripcion'),
            'padre' => $this->request->getPost('padre')
        ); 
        $id = $this->request->getPost('id');
        $menuModel->update($id, $data);
        return redirect()->to('admin/menu/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $menuModel = model(MenuModel::class);  
        $menuModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
