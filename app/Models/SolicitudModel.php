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
  
    function buscarTodos(){
        $sql="SELECT s.id as id, p.id as idProceso, a.id as idAccion, per.id as idPeriodo,  
       pe.id as idPersona, p.nombre as nombreProceso, a.nombre as nombreAccion, 
        pe.nombre as nombrePersona, per.anio as periodoAnio 
        FROM solicitud s
        JOIN proceso p on s.id_proceso = p.id 
        JOIN accion a on s.id_accion = a.id
        JOIN persona pe on s.id_persona = pe.id
        JOIN periodo per on s.id_periodo = per.id";

        $query = $this->db->query($sql);
        return $query->getResult();   
   }

   function DatosEdit($id){
    $sql="SELECT s.id as id, p.id as idProceso, a.id as idAccion, per.id as idPeriodo, pe.id as idPersona,
    p.nombre as nombreProceso, a.nombre as nombreAccion, 
    pe.nombre as nombrePersona, per.anio as periodoAnio 
    FROM solicitud s
    JOIN proceso p on s.id_proceso = p.id 
    JOIN accion a on s.id_accion = a.id
    JOIN persona pe on s.id_persona = pe.id
    JOIN periodo per on s.id_periodo = per.id
    WHERE s.id = $id";

    $query = $this->db->query($sql);
    return $query->getRow();   
    }

    function obtenerDatosFiltrados($proceso, $periodo, $accion)
    {
        $builder = $this-> db -> table('solicitud');
        $builder -> join('proceso', 'solicitud.id_proceso = proceso.id');
        $builder -> join('periodo', 'solicitud.id_periodo = periodo.id');
        $builder -> join('persona', 'solicitud.id_persona = persona.id');
        $builder -> join('accion', 'solicitud.id_accion = accion.id');

        $builder -> select('solicitud.id as id, proceso.id as idProceso, accion.id as idAccion, 
        periodo.id as idPeriodo, proceso.nombre as nombreProceso, accion.nombre as nombreAccion, 
        persona.nombre as nombrePersona, periodo.anio as periodoAnio');

        // Aplicar filtros
        if(!empty($proceso))
        {
            $builder->where('proceso.id', $proceso);
        }
        if(!empty($periodo))
        {
            $builder->where('periodo.id', $periodo);
        }
        if(!empty($accion))
        {
            $builder->where('accion.id', $accion);
        }
            $query = $builder->get();
            return $query->getResult();   
        }
}