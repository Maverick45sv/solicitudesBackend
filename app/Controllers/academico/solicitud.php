<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use App\Models\SolicitudModel;
use App\Models\PeriodoModel;
use App\Models\ProcesoModel;
use App\Models\AccionModel;
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
        $AccionModel = model(AccionModel::class);
        $PeriodoModel = model(PeriodoModel::class);
        $ProcesoModel = model(ProcesoModel::class);

        $datos = array(
            "todos" => $SolicitudModel->buscarTodos(),
            "todosPeriodo" => $PeriodoModel->findAll(),
            "todosProceso" => $ProcesoModel->findAll(),
            "todosAccion" => $AccionModel->findAll(),
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
        $AccionModel = model(AccionModel::class);
        
        $datos = array(    
            "solicitud" => $SolicitudModel->DatosEdit($id),
            "menu" => menu($session->get('idusuario')),
            "estado" => $AccionModel->findAll(),
        );  
        return view('academico/solicitud/editar', $datos);     
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        } 

        $solicitudModel = model(SolicitudModel::class);
        $id = $this->request->getPost('id');
        $data = array(
            'id_proceso' => $this->request->getPost('idproceso'),
            'id_accion' => $this->request->getPost('idestados'),
            'id_persona' => $this->request->getPost('idpersona'),
            'id_periodo' => $this->request->getPost('idperiodo')
            );
 
        $result = $solicitudModel->update($id, $data);
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
