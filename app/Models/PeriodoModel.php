<?php

namespace App\Models;

use CodeIgniter\Model;

class PeriodoModel extends Model {
   
    protected $table = 'periodo';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['codigo', 'anio', 'inicio', 'fin', 'id_usuario']; 
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
        $sql="SELECT periodo.*,  usuario.nombre as usuario
        FROM periodo JOIN usuario on periodo.id_usuario=usuario.id" ;
        $query = $this->db->query($sql);
        return $query->getResult();
   
   }
}