<?php
 
 namespace App\Libraries;
 
class Csvimport {  
 
    function parse_file($p_Filepath) {
        $linea=0;
        $file = fopen($p_Filepath, 'r');
        while (!feof($file)){
            if(!$linea){
                $linea = fgets($file);
                $keys = explode(';', $linea);
                $i = 1;                      
            }else{
                $linea = fgets($file);
                $values = explode(';', $linea);
                for ($j = 0; $j < count($keys); $j++) {
                    if ($keys[$j] != "" and isset($values[$j])) {                       
                        $arr[trim($keys[$j])] = $values[$j];
                    }
                }
                $content[$i] = $arr;
                $i++;
            }            
        }      
        fclose($file);
        return $content;
    }
 
    function escape_string($data) {
        $result = array();
        foreach ($data as $row) {
            $result[] = str_replace('"', '', $row);
        }
        return $result;
    }
}