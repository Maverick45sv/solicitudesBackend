<?php

namespace App\Models;

use CodeIgniter\Model;

class SolicitudModel extends Model {
   
    protected $table = 'solicitud';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['id_proceso','id_accion','id_persona','id_periodo']; 
    protected bool $allowEmptyInserts = false;

    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime'; 
    //protected $createdField  = 'creado';
    //protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    /* Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = []; */
  
    function buscarTodos($roles, $acciones) {
        // Asegúrate de que $acciones es un array
        if (!is_array($acciones)) {
            $acciones = explode(',', $acciones);
        }
    
        $builder = $this->db->table('solicitud s');
        $builder->join('proceso p', 's.id_proceso = p.id');
        $builder->join('accion a', 's.id_accion = a.id');
        $builder->join('persona pe', 's.id_persona = pe.id');
        $builder->join('periodo per', 's.id_periodo = per.id');
        $builder->join('proceso_rol pr', 'p.id = pr.id_proceso');
        $builder->join('rol r', 'pr.id_rol = r.id');
        $builder->join('usuario', 'pe.id = usuario.id_persona');
        
        $builder->select('s.id as id, p.id as idProceso, a.id as idAccion, per.id as idPeriodo,  
                        pe.id as idPersona, p.nombre as nombreProceso, a.nombre as nombreAccion, 
                        per.codigo as periodoCodigo, pe.nombre as nombrePersona, per.anio as periodoAnio, 
                        s.creado as fecha, pe.apellido as apellidoPersona, usuario.nombre as carnet');
    
        $builder->where("a.nombre != 'FINALIZADA'");
        $builder->where('r.id', $roles);
    
        $builder->groupStart();
        foreach ($acciones as $accion) {
            $nombre = $accion['nombre']; // Acceder al nombre desde el array asociativo
            $builder->orGroupStart()
                    ->where('a.nombre', $nombre)
                    ->groupEnd();
        }
        $builder->groupEnd();
    
        $query = $builder->get();
        return $query->getResult();
    }
    

    function buscarTodosXY($roles, $facultadX, $acciones) {

        // Asegúrate de que $acciones es un array
        if (!is_array($acciones)) {
            $acciones = explode(',', $acciones);
        }
        
        $builder = $this->db->table('solicitud s');
        $builder ->join('solicitud_carrera sc', 's.id = sc.id_solicitud');
        $builder ->join('carrera c', 'sc.id_carrera = c.id');
        $builder ->join('facultad f', 'c.id_facultad = f.id');
        $builder ->join('proceso p', 's.id_proceso = p.id');
        $builder ->join('accion a', 's.id_accion = a.id');
        $builder ->join('persona pe', 's.id_persona = pe.id');
        $builder ->join('periodo per', 's.id_periodo = per.id');
        $builder ->join('proceso_rol pr', 'pr.id_proceso = p.id');
        $builder ->join('rol r', 'pr.id_rol = r.id');
        $builder->join('usuario', 'pe.id = usuario.id_persona');

        $builder ->select('s.id as id, p.id as idProceso, a.id as idAccion, per.id as idPeriodo,  
                           pe.id as idPersona, p.nombre as nombreProceso, a.nombre as nombreAccion, 
                           per.codigo as periodoCodigo, pe.nombre as nombrePersona, pe.apellido as apellidoPersona, 
                           per.anio as periodoAnio, s.creado as fecha, usuario.nombre as carnet');

        $builder ->where("a.nombre != 'FINALIZADA'");
        $builder ->where('r.id', $roles);
        $builder ->where('f.nombre', $facultadX);

        $builder->groupStart();
        foreach ($acciones as $accion) {
            $nombre = $accion['nombre']; // Acceder al nombre desde el array asociativo
            $builder->orGroupStart()
                    ->where('a.nombre', $nombre)
                    ->groupEnd();
        }
        $builder->groupEnd();
    
        $query = $builder->get();
        return $query->getResult();
    }
    

   function DatosEdit($id){
    $sql="SELECT s.id as id, p.id as idProceso, a.id as idAccion, per.id as idPeriodo, pe.id as idPersona,
    p.nombre as nombreProceso, a.nombre as nombreAccion, 
    pe.nombre as nombrePersona, per.anio as periodoAnio, s.creado as fecha
    FROM solicitud s
    JOIN proceso p on s.id_proceso = p.id 
    JOIN accion a on s.id_accion = a.id
    JOIN persona pe on s.id_persona = pe.id
    JOIN periodo per on s.id_periodo = per.id
    WHERE s.id = $id";

    $query = $this->db->query($sql);
    return $query->getRow();   
    }

    function obtenerDatosFiltrados($proceso, $periodo, $accion, $rol, $facultad, $acciones)
    {
        // Asegúrate de que $acciones es un array
        if (!is_array($acciones)) {
            $acciones = explode(',', $acciones);
        }

        $builder = $this->db->table('solicitud');
        $builder->join('proceso', 'solicitud.id_proceso = proceso.id');
        $builder->join('periodo', 'solicitud.id_periodo = periodo.id');
        $builder->join('persona', 'solicitud.id_persona = persona.id');
        $builder->join('accion', 'solicitud.id_accion = accion.id');
        $builder->join('solicitud_carrera', 'solicitud.id = solicitud_carrera.id_solicitud');
        $builder->join('carrera', 'carrera.id = solicitud_carrera.id_carrera');
        $builder->join('facultad', 'facultad.id = carrera.id_facultad');
        $builder->join('persona_facultad', 'facultad.id = persona_facultad.id_facultad');
        $builder->join('proceso_rol', 'proceso.id = proceso_rol.id_proceso');
        $builder->join('rol', 'proceso_rol.id_rol = rol.id');
        $builder->join('usuario', 'persona.id = usuario.id_persona');

        $builder->select('solicitud.id as id, proceso.id as idProceso, accion.id as idAccion, 
        periodo.id as idPeriodo, proceso.nombre as nombreProceso, accion.nombre as nombreAccion, 
        persona.nombre as nombrePersona, persona.apellido as apellidoPersona, periodo.anio as periodoAnio, 
        solicitud.creado as fecha, usuario.nombre as carnet ');

        // Aplicar filtros
        if (!empty($proceso)) {
            $builder->where('proceso.id', $proceso);
        }
        if (!empty($periodo)) {
            $builder->where('periodo.id', $periodo);
        }
        if (!empty($accion)) {
            $builder->where('accion.id', $accion);
            if ($accion != 9) {
                $builder->where('accion.id !=', 9);
            }
        } else {
            $builder->where('accion.id !=', 9);
        }

        // Filtrar por rol
        if (!empty($rol)) 
        {
                $builder->where('rol.nombre', $rol);
        }

        // Filtrar por facultad si el rol es (ROLE_DECANO)
        if ($rol == 'ROLE_DECANO' && !empty($facultad)) 
        {
            $builder->where('rol.nombre', $rol);
            $builder->where('facultad.nombre', $facultad);
        } 

        $builder->groupStart();
        foreach ($acciones as $accion) {
            $nombre = $accion['nombre']; // Acceder al nombre desde el array asociativo
            $builder->orGroupStart()
                    ->where('accion.nombre', $nombre)
                    ->groupEnd();
        }
        $builder->groupEnd();

        // Agrupar por campos únicos de solicitud
        $builder->groupBy('solicitud.id, proceso.id, accion.id, periodo.id, persona.id');

        $query = $builder->get();
        return $query->getResult();
    }

    function TableroSolicitud($periodo){
        $sql="SELECT count(s.id) as cuenta, p.nombre as nombreProceso, p.color as color
         FROM solicitud s
         JOIN proceso p on s.id_proceso = p.id 
         JOIN accion a on s.id_accion = a.id
         JOIN periodo per on s.id_periodo = per.id
         WHERE per.id = $periodo and a.nombre != 'FINALIZADA'
         GROUP BY p.nombre
         ";
 
         $query = $this->db->query($sql);
         return $query->getResult();   
    }

    function TableroSolicitudEstado($periodo){
        $sql="SELECT count(s.id) as cuenta, a.nombre as accion
         FROM solicitud s
         JOIN proceso p on s.id_proceso = p.id 
         JOIN accion a on s.id_accion = a.id
         JOIN periodo per on s.id_periodo = per.id
         WHERE per.id = $periodo and a.nombre != 'FINALIZADA'
         GROUP BY a.nombre
         ";
 
         $query = $this->db->query($sql);
         return $query->getResult();   
    }

    function buscarPersonaBySolicitud($id){
        $sql="SELECT pe.id as idPersona, pe.nombre as nombre, pe.apellido as apellido, 
        correo.correo as correo
        FROM solicitud s       
        JOIN persona pe on s.id_persona = pe.id
        JOIN correo  on correo.id_persona=pe.id 
        WHERE s.id=$id";

        $query = $this->db->query($sql);
        return $query->getRow();   
   }

   function buscarCorreosXRol($id){
        $sql="SELECT  pe.id as idPersona, pe.nombre as nombre, pe.apellido as apellido, 
        correo.correo as correo
        FROM correo JOIN persona pe on correo.id_persona=pe.id 
        JOIN usuario on usuario.id_persona=pe.id
        JOIN usuario_rol on usuario_rol.id_usuario=usuario.id
        JOIN rol on usuario_rol.id_rol=rol.id
        WHERE rol.id = $id ";
        $query = $this->db->query($sql);        
        return $query->getResult();   
    }
}