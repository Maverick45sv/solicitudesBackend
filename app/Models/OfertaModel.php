<?php

namespace App\Models;

use CodeIgniter\Model;

class OfertaModel extends Model {
   
    protected $table = 'oferta';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['id_periodo','id_asignatura','aula','horario','seccion']; 
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
        $sql="SELECT oferta.*, asignatura.nombre as asignatura, periodo.codigo as ciclo, periodo.anio as anio 
        FROM oferta 
        JOIN asignatura on oferta.id_asignatura=asignatura.id 
        JOIN periodo on oferta.id_periodo=periodo.id";
        $query = $this->db->query($sql);
        return $query->getResult();
   
   }

   function buscarXid($id){
    $sql="SELECT oferta.*, asignatura.nombre as asignatura, periodo.codigo as ciclo, periodo.anio as anio 
    FROM oferta 
    JOIN asignatura on oferta.id_asignatura=asignatura.id 
    JOIN periodo on oferta.id_periodo=periodo.id
    WHERE oferta.id=$id ";
    $query = $this->db->query($sql);
    return $query->getRow();

}
}