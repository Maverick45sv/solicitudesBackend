<?php

namespace App\Models;

use CodeIgniter\Model;

class RolMenuModel extends Model {
   
    protected $table = 'rol_menu';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['id_menu', 'id_rol']; 
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
  
     function buscarMenuRol($id_rol){
        $sql="SELECT menu.id 
        FROM rol_menu JOIN rol on rol_menu.id_rol=rol.id 
        JOIN menu on rol_menu.id_menu=menu.id
        WHERE rol.id = " . $id_rol;
        $query = $this->db->query($sql);
        return $query->getResultArray();   
     }

     function buscarRolesFaltantes($id_usuario){
        $sql="SELECT * FROM rol WHERE id NOT IN 
        (SELECT id_rol FROM usuario_rol WHERE id_usuario = $id_usuario)";
        $query = $this->db->query($sql);
        return $query->getResult();  
     }

     function buscarOpcionByRol($rol, $padre = NULL){
          if(!$padre){
               $sql="SELECT m.* 
               FROM rol_menu JOIN rol on rol_menu.id_rol=rol.id 
               JOIN menu m on rol_menu.id_menu=m.id
               JOIN menu pad on m.padre=pad.id
               WHERE rol.id = " . $rol . " AND pad.nombre = 'raiz' ";
               $query = $this->db->query($sql);
               return $query->getResult();
          }else{
               $sql="SELECT menu.*
               FROM rol_menu JOIN rol on rol_menu.id_rol=rol.id 
               JOIN menu on rol_menu.id_menu=menu.id
               WHERE rol.id = " . $rol . " AND menu.padre=" . $padre ." ORDER BY menu.nombre";
               $query = $this->db->query($sql);
               return $query->getResult();   
          }
       }
  
   
}