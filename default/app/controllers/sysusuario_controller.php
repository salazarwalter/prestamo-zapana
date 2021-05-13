<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class SysusuarioController extends AppController
{


//    public function login()
//    {
//    	View::template("default_1");
//        if(Input::hasPost("usu"))
//        {
//            $usu =new Usuario();
//            if ($usu->login())
//                {
//                    Redirect::to("../../sysmodulo/index");
//                    Session::set("entrada", "s");
//                } 
//                else 
//                {
//                    Flash::error("Usuario no reconocido por el sistema");
//                }            
//
//        }
//    }
//    
//    public function salir() {
//        Auth::destroy_identity();
//        Redirect::to("../../");
//        die();
//    }
    
    public function clave() {
        if(Input::hasPost("clave1"))
        {
            $clave1= trim(Input::post("clave1"));
            $clave2= trim(Input::post("clave2"));
            $clave3= trim(Input::post("clave3"));
            
            $usu = new Usuario();
            if($usu->cambiarClave($clave1,$clave2,$clave3))
            {
                //Flash::error("La Contraseña se Cambió Exitósamente.");
                Redirect::to("../../sysusuario/claveok");
            }
        }
        $this->titulo = "CAMBIAR CLAVE";
    }
    public function claveok() {
        $this->titulo = "EXITOSA";
    }
    
    public function datos() {
        if(Input::hasPost("a"))
        {
            $vec = Input::post("a");
            $vec["id"]= Crypto::d($vec["id"]);
//            print_r($vec);
//            die();
           
            $usu = new Persona();
            if($usu->modificar($vec))
            {
                //Flash::error("La Contraseña se Cambió Exitósamente.");
                Redirect::to("../../sysusuario/datosok");
            }
        }
        $a=new Persona();
        $this->a = $a->hallarXUsuario(Auth::get("id"));
        $this->a->id = Crypto::e($this->a->id);
        $this->titulo = "DATOS PERSONALES";
    }
    public function datosok() {
        $this->titulo = "EXITOSA";       
    }
    public function foto() {
        if(Input::hasPost("ok"))
        {
//            print_r($_FILES["seleccionar"]["error"]);
           
            $usu = new Usuario();
            if($usu->cambiarFotoPerfil())
            {
                Redirect::to("../../sysusuario/foto");
            }
        }
        $this->titulo = "FOTO PREFIL";
    }
    public function quitarfoto() {
        $this->titulo = "QUITAR FOTO";
        if(Input::hasPost("ok"))
        {
            $usu = new Usuario();
            if($usu->quitarFotoPerfil())
            {

                Redirect::to("../../sysusuario/quitarfotook");
            }
        }
        
    }
    
    public function quitarfotook() {
        $this->titulo = "FOTO REMOVIDA";
       
    }
    
}
