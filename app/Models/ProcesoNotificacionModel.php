<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcesoNotificacionModel extends Model {
   
    protected $table = 'proceso_notificacion';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['id_proceso_estacion','id_rol']; 
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
  
    function buscarTodos($id){
        $sql="SELECT proceso_notificacion.*, proceso_estacion.ruta as ruta, rol.nombre as rol 
        FROM proceso_notificacion JOIN rol on proceso_notificacion.id_rol=rol.id 
        JOIN proceso_estacion on proceso_notificacion.id_proceso_estacion=proceso_estacion.id 
        WHERE proceso_estacion.id=$id";
        $query = $this->db->query($sql);
        return $query->getResult();
   
   }


}