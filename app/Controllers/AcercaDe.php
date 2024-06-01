<?php

namespace App\Controllers;

class AcercaDe extends BaseController
{
    public function index()
    {
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }     
        $datos=array(
            "menu" => menu($session->get('idusuario')),  
        );    
        return view('acerca_de', $datos);
    }
}
