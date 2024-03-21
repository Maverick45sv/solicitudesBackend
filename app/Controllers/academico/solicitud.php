<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use App\Models\SolicitudModel;
use App\Models\PeriodoModel;
use App\Models\HorarioModel;
use App\Models\AsignaturaModel;
use App\Libraries\Csvimport;

class Solicitud extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $SolicitudModel = model(SolicitudModel::class);
        $datos = array(
            "todos" => $SolicitudModel->buscarTodos(),
            "todosPeriodo" => $SolicitudModel->buscarPeriodo(),
            "todosProceso" => $SolicitudModel->buscarProceso(),
            "todosAccion" => $SolicitudModel->buscarAccion(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/solicitud/index', $datos);
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $SolicitudModel = model(SolicitudModel::class); 
        $datos = array(    
            "solicitud" => $SolicitudModel->DatosEdit($id),
            "menu" => menu($session->get('idusuario')),
            "estado" => $SolicitudModel->buscarAccion(),
        );  
        return view('academico/solicitud/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $SolicitudModel = model(SolicitudModel::class);
        $data = array(
            'idProceso' => $this->request->getPost('idproceso'),
            'idEstado' => $this->request->getPost('estado'),
            'idPersona' => $this->request->getPost('idpersona'),
            'iseriodo' => $this->request->getPost('idperiodo'),
        ); 

        $id = $this->request->getPost('id');
        $SolicitudModel->update($id, $data);
        return redirect()->to('academico/solicitud/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $SolicitudModel = model(SolicitudModel::class);  
        $SolicitudModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }

    public function filtrarDatos()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }

        $solicitudModel = model(SolicitudModel::class);
        $request = \Config\Services::request();
        $proceso = intval($request->getGet('proceso'));
        $periodo = intval($request->getGet('periodo'));
        $accion = intval($request->getGet('accion'));

        $datosFiltrados = $solicitudModel->obtenerDatosFiltrados($proceso, $periodo, $accion);

        // Devolver los datos filtrados en formato JSON
        return $this->response->setJSON(['filtro' => $datosFiltrados]);
    }

    public function TodoslosDatos()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }

        $solicitudModel = model(SolicitudModel::class);

        $datos = $solicitudModel->buscarTodos();

        // Devolver los datos en formato JSON
        return $this->response->setJSON(['todos' => $datos]);
    }
}
