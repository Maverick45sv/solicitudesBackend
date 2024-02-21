<?php

namespace App\Controllers\telemetria;

use App\Controllers\BaseController;
use \App\Models\ProcesoModel;

class Proceso extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $procesoModel = model(ProcesoModel::class);
        $datos = array(
            "todos" => $procesoModel->findAll(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('telemetria/proceso/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoModel = model(ProcesoModel::class); 
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
        );       
        return view('telemetria/proceso/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoModel = model(ProcesoModel::class);
        $cupo=0;
        if($this->request->getPost('cupo')){
            $cupo=1;
        }
        $data = array(
            'codigo' => $this->request->getPost('codigo'),
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'verificar_cupo' => $cupo,
            'color' => $this->request->getPost('color'),
        ); 
        $procesoModel->insert($data);
        return redirect()->to('telemetria/proceso/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoModel = model(ProcesoModel::class);        
        $datos = array(
            "proceso" => $procesoModel->find($id),
            "menu" => menu($session->get('idusuario')),
        );
        return view('telemetria/proceso/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $procesoModel = model(ProcesoModel::class);
        $cupo=0;
        if($this->request->getPost('cupo')){
            $cupo=1;
        }
        $data = array(
            'codigo' => $this->request->getPost('codigo'),
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'verificar_cupo' => $cupo,
            'color' => $this->request->getPost('color'),
        ); 
        $id = $this->request->getPost('id');
        $procesoModel->update($id, $data);
        return redirect()->to('telemetria/proceso/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $procesoModel = model(ProcesoModel::class);  
        $procesoModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
