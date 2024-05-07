<?php

namespace App\Models;

use CodeIgniter\Model;

class SolicitudProcesoAtributoModel extends Model {
   
    protected $table = 'solicitud_proceso_atributo';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object'; 
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['id_solicitud','id_proceso_atributo','valor']; 
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
  
    function buscarTodos($idSoli)
    {
         $sql ="SELECT spa.valor as valor, a.nombre as nombre, a.tipo as tipo
                from solicitud_proceso_atributo as spa
                join solicitud as s ON spa.id_solicitud = s.id
                join proceso_atributo as pa ON spa.id_proceso_atributo = pa.id
                join atributo as a ON pa.id_atributo = a.id
                where s.id= $idSoli";

         $query = $this->db->query($sql);
         return $query->getResult();    
    }

    function buscarXatributo($idSoli, $atributo)
    {
         $sql ="SELECT spa.valor as valor, a.nombre as nombre, a.tipo as tipo
                from solicitud_proceso_atributo as spa
                join solicitud as s ON spa.id_solicitud = s.id
                join proceso_atributo as pa ON spa.id_proceso_atributo = pa.id
                join atributo as a ON pa.id_atributo = a.id
                where s.id= $idSoli AND a.nombre='$atributo' ";
         $query = $this->db->query($sql);
         return $query->getRow();    
    }
}