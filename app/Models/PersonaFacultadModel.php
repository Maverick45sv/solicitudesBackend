<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaFacultadModel extends Model {
   
    protected $table = 'persona_facultad';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['id_persona', 'id_facultad']; 
    protected bool $allowEmptyInserts = false;

    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    //protected $createdField  = 'creado';
    //protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    /* Validation
    protected $validationRules      = [
        'nombre'     => 'required|max_length[30]|min_length[3]|is_unique[usuario.nombre]',
        'correo'        => 'required|max_length[254]|valid_email',     //|is_unique[usuario.correo]   
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
  
    function buscarTodos($id){
        $sql="SELECT facultad.*, persona_facultad.id as idpefac
        FROM persona_facultad JOIN facultad on persona_facultad.id_facultad=facultad.id 
        JOIN persona on persona_facultad.id_persona=persona.id
        WHERE persona.id = " . $id;
        $query = $this->db->query($sql);
        return $query->getResult();   
   }
}