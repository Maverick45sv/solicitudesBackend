<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcesoAtributoModel extends Model {
   
    protected $table = 'proceso_atributo';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['id_proceso','id_atributo']; 
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
  
    function buscarTodosXProceso($id){
        $sql="SELECT proceso_atributo.*, atributo.nombre as atributo, atributo.tipo as tipo 
        FROM proceso_atributo JOIN atributo on proceso_atributo.id_atributo=atributo.id 
        JOIN proceso on proceso_atributo.id_proceso=proceso.id 
        WHERE proceso.id=$id";
        $query = $this->db->query($sql);
        return $query->getResult();
   
   }
}