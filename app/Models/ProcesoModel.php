<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcesoModel extends Model {
   
    protected $table = 'proceso';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['codigo','nombre','descripcion','verificar_cupo','color']; 
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
  
    function BuscarXrol($roles){
        $sql="SELECT p.*
        FROM proceso p JOIN proceso_rol pr on pr.id_proceso=p.id 
        JOIN rol r on pr.id_rol=r.id
        WHERE r.id IN ($roles) ";
        $query = $this->db->query($sql);       
        return $query->getResult();   
   }
}