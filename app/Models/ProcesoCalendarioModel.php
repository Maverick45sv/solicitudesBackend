<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcesoCalendarioModel extends Model {
   
    protected $table = 'proceso_calendario';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['inicio','fin','id_proceso','id_usuario']; 
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
  
    function cargarEventos(){
        $sql="SELECT proceso_calendario.id as id, proceso_calendario.inicio as start, proceso_calendario.fin as end, proceso.nombre as title, proceso.color as color
        FROM proceso_calendario  
        JOIN proceso on proceso_calendario.id_proceso=proceso.id ";
        $query = $this->db->query($sql);
        return $query->getResult();
   
   }
}