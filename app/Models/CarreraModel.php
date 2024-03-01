<?php

namespace App\Models;

use CodeIgniter\Model;

class CarreraModel extends Model {
   
    protected $table = 'carrera';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['nombre','codigo','id_facultad']; 
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
        $sql="SELECT carrera.*,  facultad.nombre as facultadn
        FROM carrera JOIN facultad on carrera.id_facultad=facultad.id" ;
        $query = $this->db->query($sql);
        return $query->getResult();
   }

   function buscarFacultad(){
    $sql1="SELECT facultad.id as idp, facultad.nombre as facultadp 
           FROM facultad
           ORDER BY facultad.id;";
    $query = $this->db->query($sql1);
    return $query ->getResult();
}
}