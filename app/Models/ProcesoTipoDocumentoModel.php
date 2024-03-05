<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcesoTipoDocumentoModel extends Model {
   
    protected $table = 'proceso_tipo_documento';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['id_proceso','id_tipo_documento','id_usuario']; 
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
        $sql="SELECT proceso_tipo_documento.*, tipo_documento.nombre as documento 
        FROM proceso_tipo_documento JOIN tipo_documento on proceso_tipo_documento.id_tipo_documento=tipo_documento.id 
        JOIN proceso on proceso_tipo_documento.id_proceso=proceso.id 
        WHERE proceso.id=$id";
        $query = $this->db->query($sql);
        return $query->getResult();
   
   }
   
}