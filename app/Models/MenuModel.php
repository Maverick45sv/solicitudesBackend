<?php

namespace App\Models;

use CodeIgniter\Model;

class menuModel extends Model {
   
    protected $table = 'menu';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false; 
    protected $allowedFields = ['nombre', 'enlace', 'descripcion', 'padre']; 
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
  
    function buscarOrdenMenu(){
        $array='';
        $sql1="SELECT * FROM menu where padre IS NULL ORDER BY padre;";
        $query = $this->db->query($sql1)->getResult();
        if($query){
            $array=$array."<ul>";
            foreach($query as $data){               
                $array = $array  ."<li>" . $data->nombre . "</li>";
                $sql2="SELECT * FROM menu where padre = $data->id";
                $query2 = $this->db->query($sql2)->getResult();
                if($query2){
                    $array = $array  ."<ul>";
                    foreach($query2 as $data2){
                        $array = $array  . "<li>" . $data2->nombre . "</li>";
                        $sql3="SELECT * FROM menu where padre = $data2->id";
                        $query3 = $this->db->query($sql3)->getResult();
                        if($query3){
                            $array = $array  ."<ul>";
                            foreach($query3 as $data3){
                                $array = $array  . "<li>" .$data3->nombre . "</li>";
                            }
                            $array = $array  ."</ul>";
                        }                        
                    }
                    $array = $array  ."</ul>";
                }
            }
            $array = $array  ."</ul>";
        }
             

        return $array;  
   }

   function buscarCompleto(){
    $sql1="SELECT m.id, m.nombre, m.descripcion, n.nombre as padre 
    FROM menu m JOIN menu n on m.padre=n.id ";
    return $this->db->query($sql1)->getResult();
   }
}