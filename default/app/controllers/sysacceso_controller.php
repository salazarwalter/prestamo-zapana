<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class SysaccesoController extends AppController
{

    public function select() {
        $this->titulo = "ELIJA PERFIL";
        $this->link_sig= PUBLIC_PATH."../../sysacceso/index/";
    }
    
    public function index($x_perfil_id=0)
    {
        if(Input::hasPost("x"))
        {
            $accion = new Accion();
            $vec = Input::post("x");
            $x_controlador_id  = $vec["controlador_id"];
            $x_modulo_id      = $vec["modulo_id"];
            $vec["controlador_id"] = Crypto::d($vec["controlador_id"]);
            if($accion->agregar($vec))
            {
                Redirect::to("../../sysacceso/index/$x_modulo_id/$x_controlador_id/");
            }
            
        }
            $this->titulo = "ACCESOS - LISTADO";
            $mod = new Perfil();
            $perfil_id = Crypto::d($x_perfil_id);
            $this->x   = $mod->hallar($perfil_id);
            $this->link_add         = PUBLIC_PATH."../../sysacceso/add/$x_perfil_id";
            $this->link_permitir    = PUBLIC_PATH."../../sysacceso/permitir/";
            $this->link_nopermitir  = PUBLIC_PATH."../../sysacceso/nopermitir/";
            $this->link_del         = PUBLIC_PATH."../../sysacceso/del/";
            $this->link_volver  = PUBLIC_PATH."../../sysacceso/select/";
            
            $a = new Acceso();
            $this->lista = $a->lista_accesosXperfil($perfil_id);
    }
    
    public function add($x_perfil_id=0) {
        if(Input::hasPost("a"))
        {
            $obj = new Acceso();
            $vec = Input::post("a");
            $x_perfil_id           =  $vec["perfil_id"];
            //$x_modulo_id      =  $vec["modulo_id"];
            $vec["perfil_id"]      = Crypto::d($vec["perfil_id"]);
            $vec["controlador_id"] = Crypto::d($vec["controlador_id"]);
            $vec["accion_id"]      = Crypto::d($vec["accion_id"]);
//            die($vec["perfil_id"]);
            if($obj->agregar($vec))
            {
                Redirect::to("../../sysacceso/index/$x_perfil_id");
            }
            
        }
        $perfil_id = (int)Crypto::d($x_perfil_id);
        $mod = new Perfil();
        $this->a     = $mod->hallar($perfil_id);
        $this->a->perfil_idx = $this->a->perfil_id;
        $this->a->perfil_id = $x_perfil_id;
        
        //$this->a->modulo_id = $x_modulo_id;

        $this->titulo = "ACCESO - AGREGAR";
        $this->link_volver = PUBLIC_PATH."../../sysacceso/index/$x_perfil_id";
    }
    
    public function nopermitir($x_accesi_id=0) {
        $acceso_id           = Crypto::d($x_accesi_id);
        
        $accion              = new Acceso();
        $obj                   = $accion->hallar($acceso_id);
        //die("$acceso_id");
        $obj->permitido        = "N";
        $obj->update();
        $obj->perfil_id        = Crypto::e($obj->perfil_id);
        Redirect::to("../../sysacceso/index/{$obj->perfil_id}/");
    }
    
    public function permitir($x_acceso_id=0) {
        $acceso_id           = Crypto::d($x_acceso_id);
        
        $accion              = new Acceso();
        $obj                   = $accion->hallar($acceso_id);
        //die("$acceso_id");
        $obj->permitido        = "S";
        $obj->update();
        $obj->perfil_id        = Crypto::e($obj->perfil_id);
        Redirect::to("../../sysacceso/index/{$obj->perfil_id}/");
    }
    
    public function del($x_acceso_id=0) {
        if(Input::hasPost("a"))
        {
            $obj = new Acceso();
            $vec = Input::post("a");
            $x_acceso_id = $vec["id"];
            //$x_modulo_id      = $vec["modulo_id"];
            $x_controlador_id      = $vec["controlador_id"];
            
            $vec["id"]        = Crypto::d($vec["id"]);
            $vec["controlador_id"] = Crypto::d($vec["controlador_id"]);
            if($obj->borrar($vec))
            {
                Redirect::to("../../sysacceso/index/{$vec["perfil_id"]}/");
            }
        }
        $accion_id = (int)Crypto::d($x_acceso_id);
        
        $acceso = new Acceso();
        $this->a = $acceso->hallar($accion_id);
        
        $this->a->idx        = $this->a->id;
        $this->a->id         = $x_acceso_id;
        $this->a->perfil_idx = $this->a->perfil_id ;
        $this->a->perfil_id  = Crypto::e($this->a->perfil_id);
        $this->a->controlador_idx = $this->a->controlador_id ;
        $this->a->controlador_id = Crypto::e($this->a->controlador_id);
        
        $this->titulo = "ACCESO - BORRAR";
        $this->link_volver = PUBLIC_PATH."../../sysacceso/index/{$this->a->perfil_id}/";
    }
    
    public function ajax_lista() {
        View::template(NULL);
        $this->lista = NULL;
        if(Input::hasPost("control_id"))
        {
            $control_id = Crypto::d(Input::post("control_id"));
            $con =new Accion();
            $this->lista =   $con->find("controlador_id=$control_id");
        }
            $this->link_edit = PUBLIC_PATH."../../sysacceso/edit/";
            $this->link_del  = PUBLIC_PATH."../../sysacceso/del/";
        
    }
        
    public function ajax_combo() {
        View::template(NULL);
        $this->lista = NULL;
        if(Input::hasPost("control_id"))
        {
            $control_id        = Crypto::d(Input::post("control_id"));
            $this->accion_id = Input::post("accion_id");
            
            $con =  new Accion();
            $this->lista =   $con->find("controlador_id = $control_id");
        }
    }
        
    public function ajax_combo_norepeat() {
        View::template(NULL);
        $this->lista = NULL;
        if(Input::hasPost("control_id"))
        {
            $control_id        = Crypto::d(Input::post("control_id"));
            $this->accion_id = Input::post("accion_id");
            
            $con =  new Accion();
            $this->lista =   $con->combo_norepeat($control_id);
        }
    }

}
