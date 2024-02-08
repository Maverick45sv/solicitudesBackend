<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaModel extends Model {
   
    protected $table = 'persona';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['nombre', 'apellido', 'dui', 'id_sexo', 'id_genero']; 
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
        $sql="SELECT persona.*, sexo.nombre as sexo, genero.nombre as genero 
        FROM persona JOIN sexo on persona.id_sexo=sexo.id 
        JOIN genero on persona.id_genero=genero.id ";
        $query = $this->db->query($sql);
        return $query->getResult();
   
   }
}