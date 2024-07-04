<?php

namespace App\Controllers\administracion;

use App\Controllers\BaseController;
use \App\Models\UsuarioModel;
use \App\Models\PersonaModel;
use \App\Models\CorreoModel;
use \App\Models\RolModel;
use \App\Models\UsuarioRolModel;

class Usuario extends BaseController
{
    public function inicio($id)
    {        
        $session = session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }       
        $usuarioModel = model(UsuarioModel::class);
        $usuario = $usuarioModel->where('id_persona', $id)->first();
        if($usuario){
            return $this->editar($usuario->id);
        }else{
            return $this->nuevo($id);
        }
    }

    public function nuevo($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $personaModel = model(PersonaModel::class);   
        $correoModel = model(CorreoModel::class); 
        $persona =  $personaModel->find($id);
        $array=explode(' ', $persona->nombre);
        $array1=explode(' ', $persona->apellido);          
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
            "persona" => $personaModel->find($id),  
            "usuario" => trim($array[0]).".".trim($array1[0]),
            "correos" => $correoModel->where('id_persona', $id)->findAll(),          
        );       
        return view('administracion/usuario/nuevo', $datos);   
    }

    public function guardar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }    
        $usuarioModel = model(UsuarioModel::class);
        $personaModel = model(PersonaModel::class); 
        $correoModel = model(CorreoModel::class);
        $correo = $correoModel->find($this->request->getPost('correo'));
        $clave = generarContrasenia(6);
        $data = array(
            'nombre' => $this->request->getPost('nombre'),            
            'id_persona' => $this->request->getPost('persona'),
            'correo' => $correo->correo,
            'clave' => \md5($clave),
        ); 
        if ($usuarioModel->save($data) === false) {
            $persona =  $personaModel->find($this->request->getPost('persona'));
            $array=explode(' ', $persona->nombre);
            $array1=explode(' ', $persona->apellido);   
            $datos = array(           
                "menu" => menu($session->get('idusuario')),
                "persona" => $personaModel->find($this->request->getPost('persona')),  
                "correos" => $correoModel->where('id_persona', $this->request->getPost('persona'))->findAll(), 
                "usuario" => trim($array[0]).".".trim($array1[0]),
                'errors' => $usuarioModel->errors(),         
            );   
            return view('administracion/usuario/nuevo', $datos);
        }
        
        $titulo = "Nuevo usuario Sistema de Solicitudes UPES";
        $mensaje = "Buen dia <br><br> Se ha creado su usuario 
        para el sistema de solicitudes de registro academico UPES.<br><br>
        <ul>
            Su usuario es: <b>".$this->request->getPost('nombre')."</b> <br><br>
            Su clave es: <b>".$clave."</b> <br><br>
        </ul>
        Este es un mensaje Automatico, por favor no trate de contestarlo.";
        $mail = enviar_mail([$correo->correo], $titulo, $mensaje);
        return redirect()->to('admin/persona/usuario/'.$this->request->getPost('persona'));
        //echo($mensaje);
          
    }

    public function editar($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }  
        $usuarioModel = model(UsuarioModel::class); 
        $personaModel = model(PersonaModel::class); 
        $correoModel = model(CorreoModel::class);   
        $rolModel = model(RolModel::class); 
        $urolModel = model(UsuarioRolModel::class);   
        $usuario = $usuarioModel->find($id);     
        $datos = array(           
            "menu" => menu($session->get('idusuario')),
            "usuario" => $usuario,
            "persona" => $personaModel->find($usuario->id_persona),
            "correos" => $correoModel->where('id_persona', $usuario->id_persona)->findAll(),
            "roles" => $urolModel->buscarRolesFaltantes($usuario->id),
            "usuarioroles" => $urolModel->buscarRoles($usuario->id),
        );         
       
        return view('administracion/usuario/editar', $datos);    
    }

    public function actualizar()
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }   
        $activo=0; 
        $usuarioModel = model(UsuarioModel::class);
        $urolModel = model(UsuarioRolModel::class);
        $correoModel = model(CorreoModel::class);       
        $correo = $correoModel->find($this->request->getPost('correo'));
        if($this->request->getPost('activo') == "A"){
            $activo=1;
        }
        $data = array(
            'correo' => $correo->correo,           
            'activo' => $activo,
        ); 
 
        $id = $this->request->getPost('id');
        $usuarioModel->update($id, $data);
        if($this->request->getPost('rol')){
            $data = array(                     
                'id_usuario' => $this->request->getPost('id'),
                'id_rol' => $this->request->getPost('rol'),
            ); 
            $urolModel->insert($data);
        }
        return redirect()->to('admin/persona/usuario/'.$this->request->getPost('persona'));     
    }

    public function eliminarRol($id)
    {
        $session=session();
        if (!$session->get('usuario')){
            return redirect()->route('/');
        }        
        $urolModel = model(UsuarioRolModel::class);
        $urolModel->delete($id);
        return $this->response->setJson(['msg'=>'ok']);     
    }

    public function resetea($id){
        $usuarioModel = model(UsuarioModel::class);
        $usuario = $usuarioModel->find($id);     
        $clave = generarContrasenia(6);
        $titulo = "Cambio de contrasenia Sistema de Solicitudes UPES";
        $mensaje = "Buen dia <br><br> Se ha Reestablecido su contrasenia 
        para el sistema de solicitudes de registro academico UPES.<br><br>
        Su nueva clave es: <b>".$clave."</b> <br><br>
        Este es un mensaje Automatico, por favor no trate de contestarlo.";
        $mail = enviar_mail([$usuario->correo], $titulo, $mensaje);
        return $this->response->setJson(['msg'=>$mail]);     
    }
}