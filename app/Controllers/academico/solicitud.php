<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use App\Models\SolicitudModel;
use App\Models\PeriodoModel;
use App\Models\ProcesoModel;
use App\Models\ProcesoEstacionAccionModel;
use App\Models\AccionModel;
use App\Models\UsuarioRolModel;
use App\Models\BitacoraModel; 
use App\Models\OfertaModel;
use App\Models\solicitudProcesoAtributoModel;
use App\Models\solicitudDocumentoArchivoModel;

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
        $usuariorolModel = model(UsuarioRolModel::class);
        $PeriodoModel = model(PeriodoModel::class);
        $ProcesoModel = model(ProcesoModel::class);
        $rol='';
        $roles = $usuariorolModel->buscarRoles($session->get('idusuario'));
        foreach($roles as $data){
            if($rol){
                $rol = $rol . ",";
            }
            $rol = $rol . $data->id_rol;
        }
       
        $datos = array(
            "todos" => $SolicitudModel->buscarTodos($rol),
            "todosPeriodo" => $PeriodoModel->findAll(),
            "todosProceso" => $ProcesoModel->BuscarXrol($rol),
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
        $AccionModel = model(AccionModel::class);
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
        if($this->request->getPost('comentario')){
            $comentario =$this->request->getPost('comentario');
        }else{
            $accion=$AccionModel->find($pea->id_accion);
            $comentario = "Solicitud actualizada al estado: " . $accion->nombre;
        }
        $data=array(
            'id_proceso_estacion_accion' => $this->request->getPost('idestados'),
            'activa' => 1,
            'comentario' => $comentario,
            'id_solicitud' => $id,
            'id_usuario' => $session->get('idusuario')
        );
       $bitacoraModel->insert($data);
        $AccionModel = model(AccionModel::class);
        $accion = $AccionModel->find($pea->id_accion);
        Notificaciones($pea->id_proceso_estacion_destino, $id, $accion->nombre,$comentario );
       
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

        $usuariorolModel = model(UsuarioRolModel::class);
        $rol='';
        $roles = $usuariorolModel->buscarRoles($session->get('idusuario'));
        foreach($roles as $data){
            if($rol){
                $rol = $rol . ",";
            }
            $rol = $rol . $data->id_rol;
        }

        $solicitudModel = model(SolicitudModel::class);
        $request = \Config\Services::request();
        $proceso = intval($request->getGet('proceso'));
        $periodo = intval($request->getGet('periodo'));
        $accion = intval($request->getGet('accion'));

        $datosFiltrados = $solicitudModel->obtenerDatosFiltrados($proceso, $periodo, $accion, $rol);

        // Devolver los datos filtrados en formato JSON
        return $this->response->setJSON(['filtro' => $datosFiltrados]);
    }

    public function TodoslosDatos()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }

        $usuariorolModel = model(UsuarioRolModel::class);
        $rol='';
        $roles = $usuariorolModel->buscarRoles($session->get('idusuario'));
        foreach($roles as $data){
            if($rol){
                $rol = $rol . ",";
            }
            $rol = $rol . $data->id_rol;
        }

        $solicitudModel = model(SolicitudModel::class);

        $datos = $solicitudModel->buscarTodos($rol);

        // Devolver los datos en formato JSON
        return $this->response->setJSON(['todos' => $datos]);
    }

    public function solicitudDocumentoArchivo($id)
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }

        $solicitudModel = model(SolicitudModel::class);
        $solicitudDocumentoArchivoModel = model(SolicitudDocumentoArchivoModel::class);

        $datos = array( 
            "todos" => $solicitudDocumentoArchivoModel->buscarTodos($id),
            "solicitud" => $solicitudModel->find($id),
            "menu" => menu($session->get('idusuario'))
        );

        return view('academico/solicitud/soliDocumento', $datos);  
    }

    public function solicitudProcesoAtributo($id)
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }
        $asig=array();
        $solicitudModel = model(SolicitudModel::class);
        $ProcesoModel = model(ProcesoModel::class);
        $OfertaModel = model(OfertaModel::class);
        $solicitud = $solicitudModel->find($id);
        $proceso = $ProcesoModel->find($solicitud->id_proceso);       
        $solicitudProcesoAtributoModel = model(SolicitudProcesoAtributoModel::class);
        if($proceso->verificar_cupo){              
            $grupo =  $solicitudProcesoAtributoModel->buscarXatributo($solicitud->id, "Grupo_Destino");
            $asig = $OfertaModel->buscarXid($grupo->valor);
        }
        $datos = array(
            "todos" => $solicitudProcesoAtributoModel->buscarTodos($id),
            "cupo"=>$proceso->verificar_cupo,
            "asig"=>$asig,
            "menu" => menu($session->get('idusuario'))
        );

        return view('academico/solicitud/soliProcesoAtributo', $datos);  
    }
}
