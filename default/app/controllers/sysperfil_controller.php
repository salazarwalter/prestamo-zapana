<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class SysperfilController extends AppController
{

    public function index($x_modulo_id=0)
    {
    	//View::template("default_1");
            $this->titulo = "PERFILES - LISTADO";
            $mod = new Modulo();
            if(!$x_modulo_id) 
                $this->x = $mod->find_first();
            else {
                $modulo_id = Crypto::d($x_modulo_id);
                $this->x = $mod->find_by_id($modulo_id);
            }
            $this->x->modulo_id = Crypto::e($this->x->id);
            $this->link_add  = PUBLIC_PATH."../../sysperfil/add/";
    }
    
    public function add($x_modulo_id=0) {
        if(Input::hasPost("a"))
        {
            $obj = new Perfil();
            $vec = Input::post("a");
            $x_modulo_id      =  $vec["modulo_id"];
            $vec["modulo_id"] = Crypto::d($vec["modulo_id"]);
            if($obj->agregar($vec))
            {
                Redirect::to("../../sysperfil/index/$x_modulo_id");
            }
        }
        $modulo_id = (int)Crypto::d($x_modulo_id);
        $mod = new Modulo();
        $this->a = $mod->hallar($modulo_id);
        $this->a->modulo_id = $x_modulo_id;

        $this->titulo = "PERFIL - AGREGAR";
        $this->link_volver = PUBLIC_PATH."../../sysperfil/index/$x_modulo_id";
    }
    
    public function edit($x_perfil_id=0) {
        if(Input::hasPost("a"))
        {
            $obj = new Perfil();
            $vec = Input::post("a");
            $x_perfil_id = $vec["id"];
            $x_modulo_id      = $vec["modulo_id"];
            $vec["id"]        = Crypto::d($vec["id"]);
            $vec["modulo_id"] = Crypto::d($vec["modulo_id"]);
            if($obj->modificar($vec))
            {
                Redirect::to("../../sysperfil/index/$x_modulo_id");
            }
        }
        $controlador_id = (int)Crypto::d($x_perfil_id);
        
        $modulo = new Perfil();
        $this->a = $modulo->hallar($controlador_id);
        $this->a->id = $x_perfil_id;
        $this->a->modulo_id = Crypto::e($this->a->modulo_id);
        
        $this->titulo = "PERFIL - EDITAR";
        $this->link_volver = PUBLIC_PATH."../../sysperfil/";
    }
    
    public function del($x_perfil_id=0) {
        if(Input::hasPost("a"))
        {
            $obj = new Perfil();
            $vec = Input::post("a");
            $x_perfil_id = $vec["id"];
            $x_modulo_id      = $vec["modulo_id"];
            $vec["id"]        = Crypto::d($vec["id"]);
            if($obj->borrar($vec))
            {
                Redirect::to("../../sysperfil/index/$x_modulo_id");
            }
        }
        $controlador_id = (int)Crypto::d($x_perfil_id);
        
        $controlador = new Perfil();
        $this->a = $controlador->hallar($controlador_id);
        $this->a->id = $x_perfil_id;
        $this->a->modulo_id = Crypto::e($this->a->modulo_id);
        
        $this->titulo = "PERFIL - BORRAR";
        $this->link_volver = PUBLIC_PATH."../../sysperfil/";
    }
    
    public function ajax_lista() {
        View::template(NULL);
        $this->lista = NULL;
        if(Input::hasPost("modulo_id"))
        {
            $modulo_id = Crypto::d(Input::post("modulo_id"));
            $con =new Perfil();
            $this->lista =   $con->find("modulo_id=$modulo_id");
        }
            $this->link_edit = PUBLIC_PATH."../../sysperfil/edit/";
            $this->link_del  = PUBLIC_PATH."../../sysperfil/del/";
        
    }
    
    public function ajax_combo() {
        View::template(NULL);
        $this->lista = NULL;
        if(Input::hasPost("modulo_id"))
        {
            $modulo_id        = Crypto::d(Input::post("modulo_id"));
            $this->perfil_id = Input::post("perfil_id");
            
            $con =  new Perfil();
            $this->lista =   $con->find("modulo_id = $modulo_id");
        }
    }
    
    public function ajax_perfiles_contratados() {
        View::template(NULL);
        $this->lista = FALSE;
        if(Input::hasPost("mod_id"))
        {
            $mod_id = (int)Crypto::d(trim(Input::post("mod_id")));
            $perfil = new Perfil();
            $this->lista = $perfil->ajax_perfiles_contratados($mod_id);
        }
    }
    public function ajax_modulo_del() {
        View::template(NULL);
        if(Input::post("modulo_id")){
            $modulo_id = (int)Crypto::d(Input::post("modulo_id"));
            
            $perfil = new Perfil();
            $perfil->desactivarPerfil($modulo_id);
            
        }
        die();
    }
    
    public function ajax_modulo_add() {
        View::template(NULL);
        $vector=array("error"=>"N");
        if(Input::post("modulo_id")){
            $modulo_id = Crypto::d(Input::post("modulo_id"));
            
            $perfil = new Perfil();
            
            $res=$perfil->adquirirModulo($modulo_id);
            if(!$res){
                $vector=array("error"=>"S","titulo"=>$perfil->mensaje);
            }
        }
        die(json_encode($vector,JSON_OBJECT_AS_ARRAY));
    }
    
}
