<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model {
   
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['nombre', 'clave', 'correo', 'id_persona']; 
    protected bool $allowEmptyInserts = false;

    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    //protected $createdField  = 'creado';
    //protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nombre'     => 'required|max_length[30]|alpha_numeric_space|min_length[3]|is_unique[usuario.nombre]',
        'correo'        => 'required|max_length[254]|valid_email|is_unique[usuario.correo]',        
    ];
    protected $validationMessages   = [
        'nombre' => [
            'is_unique' => 'Ya existe un usuario con ese nombre. Por favor digite otro.',
        ],
        'correo' => [
            'is_unique' => 'Ya existe un usuario con ese correo. Por favor seleccione otro.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    /* Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = []; */
  
    
    function construirMenu($id_rol, $padre = NULL){
        $menu = '';
        if($padre){
            $sql = "SELECT * FROM menu WHERE padre = $padre";                 
        }else{
            $sql = "SELECT * FROM menu WHERE padre IS NULL";   
        }
        $query = $this->db->query($sql);         
        $opciones = $query->getResult();
        foreach($opciones as $data){
            $menu .= '<li><a href="'.$data->enlace.'">'.$data->nombre.'</a>';  

            $sql_b = "SELECT * FROM menu WHERE padre = $data->id";
            $query = $this->db->query($sql_b);         
            $opcion = $query->getResult();            
            if(\count($opcion) > 0){
                $menu .= '<ul class="dl-submenu">'.$this->construirMenu($id_rol, $data->id)."</ul>";
            }else{
                $menu .= '</li>';
            }      

        }
                
       
    return $menu;    
 }
   
}