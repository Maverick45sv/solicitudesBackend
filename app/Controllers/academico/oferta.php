<?php

namespace App\Controllers\academico;

use App\Controllers\BaseController;
use App\Models\OfertaModel;
use App\Models\PeriodoModel;
use App\Models\HorarioModel;
use App\Models\AsignaturaModel;
use App\Libraries\Csvimport;

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

    public function subir()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $periodoModel = model(PeriodoModel::class);
        $datos = array(    
            "periodo" => $periodoModel->findAll() 
        );  
        return view('academico/oferta/subir', $datos);
    }

    public function procesar()
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }     
        //llamo libreria propia para leer archivo  
        $this->mycsv = new Csvimport();
        $ofertaModel = model(OfertaModel::class); 
        $periodoModel = model(PeriodoModel::class);
        $asignaturaModel = model(AsignaturaModel::class);
        $periodo=$periodoModel->find($this->request->getPost('periodo'));
        $tipo=$this->request->getPost('tipo');
        helper('date');
        //ocupo la libreria de archivos 
        $file = new \CodeIgniter\Files\File($this->request->getFile('archivo'));
        //saco la extension del archivo
        $ext = $file->guessExtension();
        $size = $file->getSize();
        $nombre=date('d-m-Y(H-m-i)',now());
        //muevo el archivo a su locacion final
        $file = $file->move(WRITEPATH . "uploads/oferta/", $nombre.".".$ext);
        //ocupo libreria para transformar todo en array
        $csv_data = $this->mycsv->parse_file(WRITEPATH . "uploads/oferta/".$nombre.".".$ext);
        /*helper('filesystem');
        var_dump(get_filenames(WRITEPATH  . 'uploads/'));
        foreach($csv_data as $data){
            echo $data['ASIGNATURA'];
        }*/
        foreach($csv_data as $data){
            $where="nombre = '".\utf8_decode($data['ASIGNATURA'])."'";
            $asig=$asignaturaModel->where($where)->first();
            if(!$asig){
                $dat=array('nombre'=>$data['ASIGNATURA']);
                $asignaturaModel->insert($dat);
                $id_asignatura = $asignaturaModel->getInsertID();
            } else{
                $id_asignatura = $asig->id;
            }
            $where="id_asignatura = '" . $id_asignatura . "' and seccion = '" . $data['SECCION'] . "' and id_periodo = " . $periodo->id . " and tipo = '" . $tipo . "'";
            $valid=$ofertaModel->where($where)->first();
            if(!$valid){
                $data = array(
                    'id_asignatura' => $id_asignatura,
                    'id_periodo' => $periodo->id,                    
                    'aula' => $data['AULA'],
                    'tipo' => $tipo,
                    'seccion' => $data['SECCION'],
                    'horario' => $data['HORARIO'],
                ); 
                $ofertaModel->insert($data);
            }else{
                $data = array(  
                    'aula' => $data['AULA'],              
                    'horario' => $data['HORARIO'],
                );                
                $ofertaModel->update($valid->id, $data);
            }
           
        }
	  	
        return redirect()->to('academico/oferta/');   
    }
}
