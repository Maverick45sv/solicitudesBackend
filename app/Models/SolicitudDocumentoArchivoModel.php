<?php

namespace App\Models;

use CodeIgniter\Model;

class SolicitudDocumentoArchivoModel extends Model {
   
    protected $table = 'solicitud_documento_archivo';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['id_proceso_tipo_documento','id_archivo','id_solicitud']; 
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
         $sql = "SELECT a.nombre as nombre, a.peso as peso, a.creado as creado, a.url as urlC, td.nombre as nombreTipo
                FROM solicitud_documento_archivo as sda
                JOIN solicitud as s ON sda.id_solicitud = s.id
                JOIN proceso_tipo_documento as ptd ON sda.id_proceso_tipo_documento = ptd.id
                JOIN archivo as a ON sda.id_archivo = a.id
                JOIN tipo_documento as td ON ptd.id_tipo_documento = td.id
                WHERE s.id = $idSoli";
         $query = $this->db->query($sql);
         return $query->getResult();   
    }
}