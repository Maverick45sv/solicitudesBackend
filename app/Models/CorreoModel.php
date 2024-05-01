<?php

namespace App\Models;

use CodeIgniter\Model;

class CorreoModel extends Model {
   
    protected $table = 'correo';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['correo', 'id_persona', 'id_tipo']; 
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
  
   function buscarTodos($id_persona){
        $sql="SELECT correo.*,  tipo.nombre as tipo
        FROM correo JOIN persona on correo.id_persona=persona.id 
        JOIN tipo on correo.id_tipo=tipo.id
        WHERE persona.id = " . $id_persona;
        $query = $this->db->query($sql);
        return $query->getResult();   
   }

  
}