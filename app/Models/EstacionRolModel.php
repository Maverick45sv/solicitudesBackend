<?php

namespace App\Models;

use CodeIgniter\Model;

class EstacionRolModel extends Model {
   
    protected $table = 'estacion_rol';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['id_estacion','id_rol']; 
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
  
    function todosLosDatos(){
        $sql="SELECT er.id as idEstacionRol, e.id as idEstacion, r.id as idRol,
	            e.nombre as Estacion, r.nombre as Rol
                FROM  estacion_rol er
                INNER JOIN estacion e ON er.id_estacion = e.id
                INNER JOIN rol r ON er.id_rol = r.id
         ";
         $query = $this->db->query($sql);
         return $query->getResult();   
    }

    function estacionesXrol($id){
        $sql="SELECT er.id as idEstacionRol, e.id as idEstacion, e.nombre as Estacion
                FROM  estacion_rol er
                INNER JOIN estacion e ON er.id_estacion = e.id
                INNER JOIN rol r ON er.id_rol = r.id
                WHERE r.id = '$id'
         ";
         $query = $this->db->query($sql);
         return $query->getResult();   
    }
   
}