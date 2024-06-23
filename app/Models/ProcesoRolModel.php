<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcesoRolModel extends Model {
   
    protected $table = 'proceso_rol';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['id_proceso','id_rol']; 
    protected bool $allowEmptyInserts = false;

    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    //protected $createdField  = 'creado';
    //protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    /* Validation
    protected $validationRules      = [
        'ruta'     => 'required',
       
    ];
    protected $validationMessages   = [
           
    ];
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
  
    function buscarTodosXProceso($id){
        $sql="SELECT proceso_rol.*, rol.nombre as rol 
        FROM proceso_rol JOIN rol on proceso_rol.id_rol=rol.id 
        JOIN proceso on proceso_rol.id_proceso=proceso.id 
        WHERE proceso.id=$id";
        $query = $this->db->query($sql);
        return $query->getResult();
   
   }


}