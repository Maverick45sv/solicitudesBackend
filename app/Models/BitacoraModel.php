<?php

namespace App\Models;

use CodeIgniter\Model;

class BitacorsModel extends Model {
   
    protected $table = 'bitacora';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['comentario', 'id_usuario','id_proceso_estacion_accion','id_solicitud','activa']; 
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
  
   
    function buscarBitacoraSolicitud($idSolicitud){
        $sql="SELECT b.*, es.nombre as estacion, accion.nombre as accion, u.nombre as usuario
        FROM bitacora b
        JOIN proceso_estacion_accion pea on b.id_proceso_estacion_accion=pea.id 
        JOIN proceso_estacion pes on pea.id_proceso_estacion_origen=pes.id 
        JOIN proceso_estacion pest on pea.id_proceso_estacion_destino=pest.id 
        JOIN estacion es on pes.id_estacion=es.id 
        JOIN estacion est on pest.id_estacion=est.id
        JOIN accion on pea.id_accion=accion.id
        JOIN solicitud s on b.id_solicitud=s.id 
        JOIN usuario u on b.id_usuario=u.id
        WHERE s.id=$idSolicitud 
        ";
        $query = $this->db->query($sql);
        return $query->getResult();   
   }

   function buscarBitacoraActivaSolicitud($idSolicitud){
        $sql="SELECT b.*, es.nombre as estacion, accion.nombre as accion, pest.id as origen, u.nombre as usuario 
        FROM bitacora b
        JOIN proceso_estacion_accion pea on b.id_proceso_estacion_accion=pea.id 
        JOIN proceso_estacion pes on pea.id_proceso_estacion_origen=pes.id 
        JOIN proceso_estacion pest on pea.id_proceso_estacion_destino=pest.id 
        JOIN estacion es on pes.id_estacion=es.id 
        JOIN estacion est on pest.id_estacion=est.id
        JOIN accion on pea.id_accion=accion.id
        JOIN solicitud s on b.id_solicitud=s.id 
        JOIN usuario u on b.id_usuario=u.id
        WHERE s.id=$idSolicitud and b.activa=1
        ";
        $query = $this->db->query($sql);
        return $query->getRow();   
    }
}