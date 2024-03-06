<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use \App\Models\HorarioModel;

class Horario extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $horarioModel = model(HorarioModel::class);
        $datos = array(
            "todos" => $horarioModel->findAll(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/horario/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $horarioModel = model(HorarioModel::class); 
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
        );       
        return view('academico/horario/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $horarioModel = model(HorarioModel::class);
        $data = array(
            'inicio' => $this->request->getPost('inicio'),
            'fin' => $this->request->getPost('fin'),
        ); 
        $horarioModel->insert($data);
        return redirect()->to('academico/horario/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $horarioModel = model(HorarioModel::class);        
        $datos = array(
            "horario" => $horarioModel->find($id),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/horario/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $horarioModel = model(HorarioModel::class);
        $data = array(
            'inicio' => $this->request->getPost('inicio'),
            'fin' => $this->request->getPost('fin'),
        ); 
        $id = $this->request->getPost('id');
        $horarioModel->update($id, $data);
        return redirect()->to('academico/horario/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $horarioModel = model(HorarioModel::class);  
        $horarioModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
