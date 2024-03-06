<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use \App\Models\OfertaModel;
use \App\Models\PeriodoModel;
use \App\Models\HorarioModel;
use \App\Models\AsignaturaModel;

class Oferta extends BaseController
{
    public function inicio()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $ofertaModel = model(OfertaModel::class);
        $datos = array(
            "todos" => $ofertaModel->buscarTodos(),
            "menu" => menu($session->get('idusuario')),
        );
        return view('academico/oferta/index', $datos);
    }

    public function nuevo()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $ofertaModel = model(OfertaModel::class); 
        $periodoModel = model(PeriodoModel::class);
        $asignaturaModel = model(AsignaturaModel::class);
        $horarioModel = model(HorarioModel::class);
        $datos = array(    
            "periodo" => $periodoModel->findAll(),  
            "asignatura" => $asignaturaModel->findAll(), 
            "horas" => $horarioModel->findAll(),       
            "menu" => menu($session->get('idusuario')),
        );       
        return view('academico/oferta/nuevo', $datos);
   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $ofertaModel = model(OfertaModel::class);
        $periodoModel = model(PeriodoModel::class);
        $data = array(
            'id_asignatura' => $this->request->getPost('asignatura'),
            'id_periodo' => $this->request->getPost('periodo'),
            'inscritos' => $this->request->getPost('inscritos'),
            'aula' => $this->request->getPost('aula'),
            'seccion' => $this->request->getPost('seccion'),
            'horario' => $this->request->getPost('dia') . " / " . $this->request->getPost('hora'),
        ); 
        $ofertaModel->insert($data);
        return redirect()->to('academico/oferta/');          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $ofertaModel = model(OfertaModel::class); 
        $periodoModel = model(PeriodoModel::class);
        $asignaturaModel = model(AsignaturaModel::class);
        $horarioModel = model(HorarioModel::class);
        $datos = array(    
            "periodo" => $periodoModel->findAll(),  
            "asignatura" => $asignaturaModel->findAll(), 
            "horas" => $horarioModel->findAll(),       
            "menu" => menu($session->get('idusuario')),
            "oferta" => $ofertaModel->find($id),
        );  
        return view('academico/oferta/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $ofertaModel = model(OfertaModel::class);
        $data = array(
            'id_asignatura' => $this->request->getPost('asignatura'),
            'id_periodo' => $this->request->getPost('periodo'),
            'inscritos' => $this->request->getPost('inscritos'),
            'aula' => $this->request->getPost('aula'),
            'seccion' => $this->request->getPost('seccion'),
            'horario' => $this->request->getPost('dia') . " / " . $this->request->getPost('hora'),
        ); 
        $id = $this->request->getPost('id');
        $ofertaModel->update($id, $data);
        return redirect()->to('academico/oferta/');          
    }

    public function eliminar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $ofertaModel = model(OfertaModel::class);  
        $ofertaModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }
}
