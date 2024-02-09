<?php

namespace App\Controllers\administracion;

use App\Controllers\BaseController;
use \App\Models\RolModel;
use \App\Models\MenuModel;
use \App\Models\RolMenuModel;

class Rol extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $rolModel = model(RolModel::class);
        $datos = array(
            "todos" => $rolModel->findAll(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('administracion/rol/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $rolModel = model(RolModel::class); 
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
        );       
        return view('administracion/rol/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $rolModel = model(RolModel::class);
        $data = array('nombre' => $this->request->getPost('nombre')); 
        $rolModel->insert($data);
        return redirect()->to('admin/rol/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $rolModel = model(RolModel::class);        
        $datos = array(
            "rol" => $rolModel->find($id),
            "menu" => menu($session->get('idusuario')),
        );
        return view('administracion/rol/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $rolModel = model(RolModel::class);
        $data = array('nombre' => $this->request->getPost('nombre')); 
        $id = $this->request->getPost('id');
        $rolModel->update($id, $data);
        return redirect()->to('admin/rol/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $rolModel = model(RolModel::class);  
        $rolModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }

    public function menu($id){
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $rolModel = model(RolModel::class); 
        $menuModel = model(MenuModel::class);
        $rolmenuModel = model(RolMenuModel::class);
        $datos = array(
            "rol" => $rolModel->find($id),
            "habilitados" => $rolmenuModel->buscarMenuRol($id),
            "todos" => $menuModel->buscarCompleto(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('administracion/rol/menu', $datos);   

    }

    public function asignar($id, $idrol){
        $rolmenuModel = model(RolMenuModel::class);
        $data = array('id_menu' => $id, 'id_rol'=>$idrol); 
        $rolmenuModel->insert($data);
        return $this->response->setJson(['msg'=>'ok']);     
    }

    public function quitar($id, $idrol){
        $rolmenuModel = model(RolMenuModel::class);  
        $menu = $rolmenuModel->where('id_menu='.$id." AND id_rol=".$idrol)->first();        
        $rolmenuModel->delete($menu->id);
        return $this->response->setJson(['msg'=>'ok']);     
    }

}
