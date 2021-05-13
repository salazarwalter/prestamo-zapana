<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class SysaccionController extends AppController
{

    public function select() {
        $this->titulo = "ELIJA PERFIL";
        $this->link_sig= PUBLIC_PATH."../../sysaccion/index/";
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
                Redirect::to("../../sysaccion/index/$x_modulo_id/$x_controlador_id/");
            }
            
        }
            $this->titulo = "ACCIONES - LISTADO";
            $mod = new Perfil();
            $perfil_id = Crypto::d($x_perfil_id);
            $this->x   = $mod->hallar($perfil_id);
            $this->link_add   = PUBLIC_PATH."../../sysaccion/add/$x_perfil_id";
            $this->link_edit  = PUBLIC_PATH."../../sysaccion/edit/";
            $this->link_del  = PUBLIC_PATH."../../sysaccion/del/";
            $this->link_volver  = PUBLIC_PATH."../../sysaccion/select/";
            
            $a = new Accion();
            $this->lista = $a->lista_controlador_accion($perfil_id);
    }
    
    public function add($x_perfil_id=0) {
        if(Input::hasPost("a"))
        {
            $obj = new Accion();
            $vec = Input::post("a");
            $x_perfil_id           =  $vec["perfil_id"];
            $vec["perfil_id"]      = Crypto::d($vec["perfil_id"]);
            $vec["controlador_id"] = Crypto::d($vec["controlador_id"]);
//            die($vec["perfil_id"]);
            if($obj->agregar($vec))
            {
                Redirect::to("../../sysaccion/index/$x_perfil_id");
            }
            
        }
        $perfil_id = (int)Crypto::d($x_perfil_id);
        $mod = new Perfil();
        $this->a     = $mod->hallar($perfil_id);
        $this->a->perfil_idx = $this->a->perfil_id;
        $this->a->perfil_id = $x_perfil_id;
        
        //$this->a->modulo_id = $x_modulo_id;

        $this->titulo = "ACCION - AGREGAR";
        $this->link_volver = PUBLIC_PATH."../../sysaccion/index/$x_perfil_id";
    }
    
    public function edit($x_accion_id=0) {
        if(Input::hasPost("a"))
        {
            $obj = new Accion();
            $vec = Input::post("a");
            $x_accion_id = $vec["id"];
            //$x_modulo_id      = $vec["modulo_id"];
            $x_controlador_id      = $vec["controlador_id"];
            
            $vec["id"]        = Crypto::d($vec["id"]);
            $vec["controlador_id"] = Crypto::d($vec["controlador_id"]);
            if($obj->modificar($vec))
            {
                Redirect::to("../../sysaccion/index/{$vec["perfil_id"]}/");
            }
        }
        $accion_id = (int)Crypto::d($x_accion_id);
        
        $accion = new Accion();
        $this->a = $accion->hallar($accion_id);
        
        $this->a->idx        = $this->a->id;
        $this->a->id         = $x_accion_id;
        $this->a->perfil_idx = $this->a->perfil_id ;
        $this->a->perfil_id  = Crypto::e($this->a->perfil_id);
        $this->a->controlador_idx = $this->a->controlador_id ;
        $this->a->controlador_id = Crypto::e($this->a->controlador_id);
        
        $this->titulo = "ACCIÓN - EDITAR";
        $this->link_volver = PUBLIC_PATH."../../sysaccion/index/{$this->a->perfil_id}/";
    }
    
    public function del($x_accion_id=0) {
        if(Input::hasPost("a"))
        {
            $obj = new Accion();
            $vec = Input::post("a");
            $x_accion_id = $vec["id"];
            //$x_modulo_id      = $vec["modulo_id"];
            $x_controlador_id      = $vec["controlador_id"];
            
            $vec["id"]        = Crypto::d($vec["id"]);
            $vec["controlador_id"] = Crypto::d($vec["controlador_id"]);
            if($obj->borrar($vec))
            {
                Redirect::to("../../sysaccion/index/{$vec["perfil_id"]}/");
            }
        }
        $accion_id = (int)Crypto::d($x_accion_id);
        
        $accion = new Accion();
        $this->a = $accion->hallar($accion_id);
        
        $this->a->idx        = $this->a->id;
        $this->a->id         = $x_accion_id;
        $this->a->perfil_idx = $this->a->perfil_id ;
        $this->a->perfil_id  = Crypto::e($this->a->perfil_id);
        $this->a->controlador_idx = $this->a->controlador_id ;
        $this->a->controlador_id = Crypto::e($this->a->controlador_id);
        
        $this->titulo = "ACCIÓN - BORRAR";
        $this->link_volver = PUBLIC_PATH."../../sysaccion/index/{$this->a->perfil_id}/";
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
            $this->link_edit = PUBLIC_PATH."../../sysaccion/edit/";
            $this->link_del  = PUBLIC_PATH."../../sysaccion/del/";
        
    }
        
    public function ajax_combo() {
        View::template(NULL);
        $this->lista = NULL;
        if(Input::hasPost("controlador_id"))
        {
            $control_id        = Crypto::d(Input::post("controlador_id"));
            $this->accion_id = Input::post("accion_id");
            
            $con =  new Accion();
            $this->lista =   $con->find("controlador_id = $control_id");
        }
    }

    public function ajax_combo_norepeat() {
        View::template(NULL);
        $this->lista = NULL;
        if(Input::hasPost("controlador_id"))
        {
            $control_id        = Crypto::d(Input::post("controlador_id"));
            $this->accion_id = Input::post("accion_id");
            
            $con =  new Accion();
            $this->lista =   $con->combo_norepeat($control_id);
        }
    }

}
