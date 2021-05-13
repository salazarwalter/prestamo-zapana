<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class SyscontroladorController extends AppController
{

    public function index($x_modulo_id=0)
    {
    	//View::template("default_1");
            $this->titulo = "CONTROLADORES - LISTADO";
            $mod = new Modulo();
            if(!$x_modulo_id) 
                $this->x = $mod->find_first();
            else {
                $modulo_id = Crypto::d($x_modulo_id);
                $this->x = $mod->find_by_id($modulo_id);
            }
            $this->x->modulo_id = Crypto::e($this->x->id);
            $this->link_add  = PUBLIC_PATH."../../syscontrolador/add/";
    }
    
    public function add($x_modulo_id=0) {
        if(Input::hasPost("a"))
        {
            $obj = new Controlador();
            $vec = Input::post("a");
            $x_modulo_id      =  $vec["modulo_id"];
            $vec["perfil_id"] = Crypto::d($vec["perfil_id"]);
            if($obj->agregar($vec))
            {
                Redirect::to("../../syscontrolador/index/$x_modulo_id");
            }
        }
        $modulo_id = (int)Crypto::d($x_modulo_id);
        $mod = new Modulo();
        $this->a = $mod->hallar($modulo_id);
        $this->a->modulo_id = $x_modulo_id;

        $this->titulo = "CONTROLADOR - AGREGAR";
        $this->link_volver = PUBLIC_PATH."../../syscontrolador/index/$x_modulo_id";
    }
    
    public function edit($x_controlador_id=0) {
        if(Input::hasPost("a"))
        {
            $obj = new Controlador();
            $vec = Input::post("a");
            $x_controlador_id = $vec["id"];
            $x_modulo_id      = $vec["modulo_id"];
            $vec["id"]        = Crypto::d($vec["id"]);
            $vec["perfil_id"] = Crypto::d($vec["perfil_id"]);
            if($obj->modificar($vec))
            {
                Redirect::to("../../syscontrolador/index/$x_modulo_id");
            }
        }
        $controlador_id = (int)Crypto::d($x_controlador_id);
        
        $modulo = new Controlador();
        $this->a = $modulo->hallar($controlador_id);
//        print_r($this->a);
//        die();
        $this->a->idx = $this->a->id ;
        $this->a->id  = $x_controlador_id;
        $this->a->modulo_idx = $this->a->modulo_id;
        $this->a->modulo_id  = Crypto::e($this->a->modulo_id);
        $this->a->perfil_id  = Crypto::e($this->a->perfil_id);
        
        $this->titulo = "CONTROLADOR - EDITAR";
        $this->link_volver = PUBLIC_PATH."../../syscontrolador/";
    }
    
    public function del($x_controlador_id=0) {
        if(Input::hasPost("a"))
        {
            $obj = new Controlador();
            $vec = Input::post("a");
            $x_controlador_id = $vec["id"];
            $x_modulo_id      = $vec["modulo_id"];
            $vec["id"]        = Crypto::d($vec["id"]);
            if($obj->borrar($vec))
            {
                Redirect::to("../../syscontrolador/index/$x_modulo_id");
            }
        }
        $controlador_id = (int)Crypto::d($x_controlador_id);
        
        $modulo = new Controlador();
        $this->a = $modulo->hallar($controlador_id);
        $this->a->idx = $this->a->id ;
        $this->a->id  = $x_controlador_id;
        $this->a->modulo_idx = $this->a->modulo_id;
        $this->a->modulo_id  = Crypto::e($this->a->modulo_id);
        $this->a->perfil_id  = Crypto::e($this->a->perfil_id);
        
        $this->titulo = "CONTROLADOR - BORRAR";
        $this->link_volver = PUBLIC_PATH."../../syscontrolador/";
    }
    /////////////////////////////////////////////////////////////////////////////
    
    public function ajax_lista_controladores() {
        View::template(NULL);
        $this->lista = NULL;
        if(Input::hasPost("modulo_id"))
        {
            $modulo_id = Crypto::d(Input::post("modulo_id"));
            $con =new Controlador();
            $this->lista =   $con->controladoresXmodulo($modulo_id);
        }
            $this->link_edit = PUBLIC_PATH."../../syscontrolador/edit/";
            $this->link_del  = PUBLIC_PATH."../../syscontrolador/del/";
    }
    
    public function ajax_combo() {
        View::template(NULL);
        $this->lista = NULL;
        if(Input::hasPost("modulo_id"))
        {
            $modulo_id        = Crypto::d(Input::post("modulo_id"));
            $this->control_id = Input::post("control_id");
            
            $con =  new Controlador();
//            die($modulo_id );
            $this->lista =   $con->find("modulo_id = $modulo_id");
            print_r($this->lista);
        }
    }
    
}
