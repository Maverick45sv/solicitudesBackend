<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcesoEstacionAccionModel extends Model {
   
    protected $table = 'proceso_estacion_accion';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['id_proceso_estacion_origen','id_proceso_estacion_destino','id_accion','notificacion','interno']; 
    protected bool $allowEmptyInserts = false;

    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    //protected $createdField  = 'creado';
    //protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    // Validation   
    /*
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
  
    function buscarTodos($id){
        $sql="SELECT pea.*, es.nombre as origen, est.nombre as destino, accion.nombre as accion 
        FROM proceso_estacion_accion pea
        JOIN proceso_estacion pes on pea.id_proceso_estacion_origen=pes.id 
        JOIN proceso_estacion pest on pea.id_proceso_estacion_destino=pest.id 
        JOIN estacion es on pes.id_estacion=es.id 
        JOIN estacion est on pest.id_estacion=est.id
        JOIN accion on pea.id_accion=accion.id
        WHERE pes.id=$id
        ";
        $query = $this->db->query($sql);
        return $query->getResult();   
   }
 
   function BuscarAccionXorigen($id){
        $sql="SELECT pea.id as id, accion.nombre as nombre
        FROM proceso_estacion_accion pea
        JOIN proceso_estacion pest on pea.id_proceso_estacion_origen=pest.id 
        JOIN estacion est on pest.id_estacion=est.id
        JOIN accion on pea.id_accion=accion.id
        WHERE pea.id_proceso_estacion_origen=$id
        ";       
        $query = $this->db->query($sql);
        return $query->getResult();   
    }

    function accionesXestacion($estacion) {
        // Asegúrate de que $estacion es un array
        if (!is_array($estacion)) {
            $estacion = explode(',', $estacion);
        }
    
        // Construir la consulta 
        $builder = $this->db->table('proceso_estacion_accion pea');
        $builder->select('accion.nombre as nombre_accion, accion.id as id_accion');
        $builder->join('proceso_estacion pes', 'pea.id_proceso_estacion_origen = pes.id');
        $builder->join('proceso_estacion pest', 'pea.id_proceso_estacion_destino = pest.id');
        $builder->join('estacion es', 'pes.id_estacion = es.id');
        $builder->join('estacion est', 'pest.id_estacion = est.id');
        $builder->join('accion', 'pea.id_accion = accion.id');
        $builder->groupBy('accion.nombre, accion.id');

        // Agregar condiciones WHERE dinámicamente
        $builder->groupStart();
        foreach ($estacion as $nombre) {
            $builder->orGroupStart()
                    ->where('es.nombre', $nombre)
                    ->orWhere('est.nombre', $nombre)
                    ->groupEnd();
        }
        $builder->groupEnd();

        $query = $builder->get();
        return $query->getResult();
    }
}