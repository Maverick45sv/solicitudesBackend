<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use App\Models\SolicitudModel;
use App\Models\PeriodoModel;
use App\Models\ProcesoModel;
use App\Models\ProcesoEstacionAccionModel;
use App\Models\AccionModel;
use App\Models\BitacoraModel;

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
        $bitacoraModel = model(BitacoraModel::class); 
        $procesoaccionModel = model(ProcesoEstacionAccionModel::class);
        $bitacoraA = $bitacoraModel->buscarBitacoraActivaSolicitud($id);
        $acciones = $procesoaccionModel->BuscarAccionXorigen($bitacoraA->origen);
        
        $datos = array(    
            "solicitud" => $SolicitudModel->DatosEdit($id),
            "menu" => menu($session->get('idusuario')),
            "estado" => $acciones,
            "bitacora" => $bitacoraModel->buscarBitacoraSolicitud($id),
            "bitacoraA"=>$bitacoraA,
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
        $bitacoraModel = model(BitacoraModel::class); 
        $procesoaccionModel = model(ProcesoEstacionAccionModel::class);
        $id = $this->request->getPost('id');        
        $pea = $procesoaccionModel->find($this->request->getPost('idestados'));
        //actualizo solicitud
        $data = array(           
            'id_accion' => $pea->id_accion,           
            ); 
        $result = $solicitudModel->update($id, $data);
        //actualizo bitacora anterior
        $bit =  $bitacoraModel->buscarBitacoraActivaSolicitud($id);   
        $data= array('activa'=>0);
        $result =  $bitacoraModel->update($bit->id, $data);
        //creo nueva bitacora
        $data=array(
            'id_proceso_estacion_accion' => $this->request->getPost('idestados'),
            'activa' => 1,
            'comentario' => $this->request->getPost('comentario'),
            'id_solicitud' => $id,
            'id_usuario' => $session->get('idusuario')
        );
        $bitacoraModel->insert($data);

        return redirect()->to('academico/solicitud/edit/' . $id);
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
