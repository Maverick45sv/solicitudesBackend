<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use \App\Models\PeriodoModel;

class Periodo extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $periodoModel = model(PeriodoModel::class);
        $datos = array(
            "todos" => $periodoModel->buscarTodos(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/periodo/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $periodoModel = model(PeriodoModel::class); 
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
        );       
        return view('academico/periodo/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $periodoModel = model(PeriodoModel::class);
        $data = array(
            'codigo' => $this->request->getPost('codigo'),
            'anio' => $this->request->getPost('anio'),
            'inicio' => $this->request->getPost('inicio'),
            'fin' => $this->request->getPost('fin'),
            'id_usuario' => $session->get('idusuario')        
        ); 
        $periodoModel->insert($data);
        return redirect()->to('academico/periodo/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $periodoModel = model(PeriodoModel::class);       
        $datos = array(
            "periodo" => $periodoModel->find($id),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/periodo/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $periodoModel = model(PeriodoModel::class);
        $data = array(
            'codigo' => $this->request->getPost('codigo'),
            'anio' => $this->request->getPost('anio'),
            'inicio' => $this->request->getPost('inicio'),
            'fin' => $this->request->getPost('fin')       
        ); 
        $id = $this->request->getPost('id');
        $periodoModel->update($id, $data);
        return redirect()->to('academico/periodo/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $periodoModel = model(PeriodoModel::class);  
        $periodoModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
