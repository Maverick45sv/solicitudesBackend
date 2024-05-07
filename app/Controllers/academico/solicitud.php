<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use App\Models\SolicitudModel;
use App\Models\PeriodoModel;
use App\Models\ProcesoModel;
use App\Models\ProcesoEstacionAccionModel;
use App\Models\AccionModel;
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
        if($pea->notificacion){
            $AccionModel = model(AccionModel::class);
            $accion = $AccionModel->find($pea->id_accion);
            $correo = $solicitudModel->buscarRegistroAcademico($id);            
            if($correo){
                foreach($correo as $data){
                    $correos[]=$data->correo;
                    $nombre=$data->apellido . " " . $data->nombre;
                }       
                $correoE = $solicitudModel->buscarPersonaBySolicitud($id); 
                if($correoE) {
                    foreach($correoE as $data){
                        $correos[]=$data->correo;
                        $nombre=$data->apellido . " " . $data->nombre;
                    }  
                }       
                //espacion para notificacion
                $titulo = "Estado solicitud en Sistema de Solicitudes UPES";
                $mensaje = "Buen dia <br><br> Se ha actualizado el estado de su solicitud.
                <br><br>
                <ul>
                    Solicitante: <b>".$nombre."</b> <br>
                    Nuevo Estado: <b>".$accion->nombre."</b> <br>
                    Comentario: <b>".$comentario."</b> <br><br>            
                </ul>
                Este es un mensaje Automatico, por favor no trate de contestarlo.";
                $mail = enviar_mail($correos, $titulo, $mensaje);
            }
        }
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
