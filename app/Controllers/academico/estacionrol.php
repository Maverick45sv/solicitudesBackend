<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use \App\Models\EstacionRolModel;
use \App\Models\EstacionModel;
use \App\Models\RolModel;

class EstacionRol extends BaseController 
{

    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $estacionRolModel = model(EstacionRolModel::class);
        $datos = array(
            "todos" => $estacionRolModel->todosLosDatos(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/estacionrol/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $estacionRolModel = model(EstacionRolModel::class);
        $estacionModel = model(EstacionModel::class);
        $rolModel = model(RolModel::class);

        $datos = array(           
            "menu" => menu($session->get('idusuario')),
            "datos" => $estacionRolModel-> findAll(),
            "datosEstacion" => $estacionModel-> findAll(),
            "datosRol" => $rolModel-> findAll(),
        );

        return view('academico/estacionrol/nuevo', $datos);
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $estacionRolModel = model(EstacionRolModel::class);
        $data = array(
            'id_estacion' => $this->request->getPost('idEstacion'),
            'id_rol' => $this->request->getPost('idRol'),     
        ); 
        $estacionRolModel->insert($data);
        return redirect()->to('academico/estacionrol/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $estacionRolModel = model(EstacionRolModel::class);
        $estacionModel = model(EstacionModel::class);
        $rolModel = model(RolModel::class);

        $datos = array(
            "todos" => $estacionRolModel->find($id),
            "menu" => menu($session->get('idusuario')),
            'rol' => $rolModel ->findAll(),
            'estacion' => $estacionModel ->findAll(),
        );
        return view('academico/estacionrol/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $estacionRolModel = model(EstacionRolModel::class);

        $data = array(
            'id_rol' => $this->request->getPost('idRol'),
            'id_estacion' => $this->request->getPost('idEstacion'),     
        );

        $id = $this->request->getPost('id');

        $carreraModel->update($id, $data);
        return redirect()->to('academico/estacionrol/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $estacionRolModel = model(EstacionRolModel::class); 
        $estacionRolModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}