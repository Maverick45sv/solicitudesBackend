<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioRolModel extends Model {
   
    protected $table = 'usuario_rol';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['id_usuario', 'id_rol']; 
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
  
    function buscarRoles($id_usuario){
        $sql="SELECT rol.nombre as nombre, usuario_rol.creado as creado, 
         usuario_rol.id as id
        FROM usuario_rol JOIN rol on usuario_rol.id_rol=rol.id 
        JOIN usuario on usuario_rol.id_usuario=usuario.id
        WHERE usuario.id = " . $id_usuario;
        $query = $this->db->query($sql);
        return $query->getResult();   
   }

   function buscarRolesFaltantes($id_usuario){
        $sql="SELECT * FROM rol WHERE id NOT IN 
        (SELECT id_rol FROM usuario_rol WHERE id_usuario = $id_usuario)";
        $query = $this->db->query($sql);
        return $query->getResult();  
   }
   
}