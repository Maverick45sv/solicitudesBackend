<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use App\Models\SolicitudModel;
use App\Models\PeriodoModel;
use App\Models\ProcesoModel;
use App\Models\RolModel;
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

        // Bucar id_persona y rol del usuario
        $datosX = $usuariorolModel -> buscarDatos($session->get('idusuario'));

        // Encontrar la facultad del usuario
        $datosY = $usuariorolModel -> buscarSolicitudFacultad($datosX ->id_persona);

        //Crear variable con ROLE_DECANO
        $rolEncontrado = 'ROLE_DECANO';

        // Mostar datos si es un decano por rol y facultad
        if($rolEncontrado == $datosX->rol)
        {
            $datos = array(
                "todos" => $SolicitudModel->buscarTodosXY($rol, $datosY->facultad),
                "todosPeriodo" => $PeriodoModel->findAll(),
                "todosProceso" => $ProcesoModel->BuscarXrol($rol),
                "todosAccion" => $AccionModel->findAll(),
                "menu" => menu($session->get('idusuario')),
            );

            return view('academico/solicitud/index', $datos);

        }
        else
        {
            $datos = array(
                "todos" => $SolicitudModel->buscarTodos($rol),
                "todosPeriodo" => $PeriodoModel->findAll(),
                "todosProceso" => $ProcesoModel->BuscarXrol($rol),
                "todosAccion" => $AccionModel->findAll(),
                "menu" => menu($session->get('idusuario')),
            );

            return view('academico/solicitud/index', $datos);
        }

        //print($this->buscarRol());
    }
    
    private function buscarRol()
    {
        $session = session(); 
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $SolicitudModel = model(SolicitudModel::class);
        $usuariorolModel = model(UsuarioRolModel::class);;
        
        // Bucar id_persona y rol del usuario
        $datosX = $usuariorolModel -> buscarDatos($session->get('idusuario'));

        // Encontrar la facultad del usuario
        $datosY = $usuariorolModel -> buscarSolicitudFacultad($datosX ->id_persona);

        return $datosX->rol;
    }

    private function buscarFacultad()
    {
        $session = session(); 
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $SolicitudModel = model(SolicitudModel::class);
        $usuariorolModel = model(UsuarioRolModel::class);;
        
        // Bucar id_persona y rol del usuario
        $datosX = $usuariorolModel -> buscarDatos($session->get('idusuario'));

        // Encontrar la facultad del usuario
        $datosY = $usuariorolModel -> buscarSolicitudFacultad($datosX ->id_persona);

        return $datosY->facultad;
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
        //print($this->buscarRol());   
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
        if (!$session->get('usuario')) {
            return redirect()->route('/');
        }

        $usuariorolModel = model(UsuarioRolModel::class);
        $solicitudModel = model(SolicitudModel::class);

        $request = \Config\Services::request();
        $proceso = intval($request->getGet('proceso'));
        $periodo = intval($request->getGet('periodo'));
        $accion = intval($request->getGet('accion'));

        //Crear variable con ROLE_DECANO
        $rolEncontrado = 'ROLE_DECANO';

        $facultadCX = $this->buscarFacultad();
        $rolCX = $this->buscarRol();
        
        // Verificar si el usuario tiene el rol de decano
        if ($rolCX == $rolEncontrado) 
        {
            $datosFiltrados = $solicitudModel->obtenerDatosFiltrados($proceso, $periodo, $accion, $rolCX, $facultadCX);
        }
        else 
        {
            $datosFiltrados = $solicitudModel->obtenerDatosFiltrados($proceso, $periodo, $accion, $rolCX, null);
        }

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
        $solicitudModel = model(SolicitudModel::class);

        $rol='';
        $roles = $usuariorolModel->buscarRoles($session->get('idusuario'));
        foreach($roles as $data){
            if($rol){
                $rol = $rol . ",";
            }
            $rol = $rol . $data->id_rol;
        }

        // Bucar id_persona y rol del usuario
        $datosX = $usuariorolModel -> buscarDatos($session->get('idusuario'));

        // Encontrar la facultad del usuario
        $datosY = $usuariorolModel -> buscarSolicitudFacultad($datosX ->id_persona);

        //Crear variable con ROLE_DECANO
        $rolEncontrado = 'ROLE_DECANO';

        // Mostrar datos si es un decano por rol y facultad
        if ($rolEncontrado == $datosX->rol) 
        {
            $datos = $solicitudModel->buscarTodosXY($rol, $datosY->facultad);
        } 
        else 
        {
            $datos = $solicitudModel->buscarTodos($rol);
        }

        // Devolver todos los datos en formato JSON
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
