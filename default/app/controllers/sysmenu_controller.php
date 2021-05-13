<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class SysmenuController extends AppController
{

    public function select() {
        $this->titulo = "ELIJA PERFIL";
        $this->link_sig= PUBLIC_PATH."../../sysmenu/index/";
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
                Redirect::to("../../sysmenu/index/$x_modulo_id/$x_controlador_id/");
            }
        }
            $this->titulo = "MENUES - LISTADO";
            $mod = new Perfil();
            $perfil_id = Crypto::d($x_perfil_id);
            $this->x   = $mod->hallar($perfil_id);
            $this->link_add   = PUBLIC_PATH."../../sysmenu/add/$x_perfil_id";
            $this->link_edit  = PUBLIC_PATH."../../sysmenu/edit/";
            $this->link_del  = PUBLIC_PATH."../../sysmenu/del/";
            $this->link_volver  = PUBLIC_PATH."../../sysmenu/select/";
            
            $a = new Menu();
            $this->lista = $a->lista($perfil_id);
//            $this->lista = $a->lista($perfil_id);
    }
    
    public function add($x_perfil_id=0) {
        if(Input::hasPost("a"))
        {
            $obj = new Menu();
            $vec = Input::post("a");
            $x_perfil_id           =  $vec["perfil_id"];
            //$x_modulo_id      =  $vec["modulo_id"];
            $vec["perfil_id"]      = Crypto::d($vec["perfil_id"]);
            $vec["accion_id"]      = Crypto::d($vec["accion_id"]);
            if($obj->agregar($vec))
            {
                Redirect::to("../../sysmenu/index/$x_perfil_id");
            }
            
        }
        $perfil_id = (int)Crypto::d($x_perfil_id);
        $mod = new Perfil();
        $this->a     = $mod->hallar($perfil_id);
        $this->a->perfil_idx = $this->a->perfil_id;
        $this->a->perfil_id = $x_perfil_id;
        
        //$this->a->modulo_id = $x_modulo_id;

        $this->titulo = "MENU - AGREGAR";
        $this->link_volver = PUBLIC_PATH."../../sysmenu/index/$x_perfil_id";
    }
    
    public function edit($x_menu_id=0) {
        if(Input::hasPost("a"))
        {
            $obj = new Menu();
            $vec = Input::post("a");
            $x_menu_id = $vec["id"];
            $x_perfil_id      = $vec["perfil_id"];
            $x_controlador_id      = $vec["controlador_id"];
            
            $vec["id"]             = Crypto::d($vec["id"]);
            $vec["perfil_id"]      = Crypto::d($vec["perfil_id"]);
            $vec["accion_id"]      = Crypto::d($vec["accion_id"]);
            if($obj->modificar($vec))
            {
                Redirect::to("../../sysmenu/index/{$x_perfil_id}/");
            }
        }
        $menu_id = (int)Crypto::d($x_menu_id);
        
        $accion = new Menu();
        $this->a = $accion->hallar($menu_id);
        
        $this->a->idx        = $this->a->id;
        $this->a->id         = $x_menu_id;
        $this->a->perfil_idx = $this->a->perfil_id ;
        $this->a->perfil_id  = Crypto::e($this->a->perfil_id);
        $this->a->modulo_idx = $this->a->modulo_id ;
        $this->a->modulo_id  = Crypto::e($this->a->modulo_id);
        $this->a->controlador_idx = $this->a->controlador_id ;
        $this->a->controlador_id = Crypto::e($this->a->controlador_id);
        $this->a->accion_idx = $this->a->accion_id ;
        $this->a->accion_id  = Crypto::e($this->a->accion_id);
        
        $this->titulo = "MENU - EDITAR";
        $this->link_volver = PUBLIC_PATH."../../sysmenu/index/{$this->a->perfil_id}/";
    }
    
    public function del($x_menu_id=0) {
        if(Input::hasPost("a"))
        {
            $obj = new Menu();
            $vec = Input::post("a");
            $x_menu_id         = $vec["id"];
            $x_perfil_id       = $vec["perfil_id"];
            
            $vec["id"]         = Crypto::d($vec["id"]);
            if($obj->borrar($vec))
            {
                Redirect::to("../../sysmenu/index/{$x_perfil_id}/");
            }
        }
        $menu_id = (int)Crypto::d($x_menu_id);
        
        $accion = new Menu();
        $this->a = $accion->hallar($menu_id);
        
        $this->a->idx        = $this->a->id;
        $this->a->id         = $x_menu_id;
        $this->a->perfil_idx = $this->a->perfil_id ;
        $this->a->perfil_id  = Crypto::e($this->a->perfil_id);
        $this->a->modulo_idx = $this->a->modulo_id ;
        $this->a->modulo_id  = Crypto::e($this->a->modulo_id);
        $this->a->controlador_idx = $this->a->controlador_id ;
        $this->a->controlador_id = Crypto::e($this->a->controlador_id);
        $this->a->accion_idx = $this->a->accion_id ;
        $this->a->accion_id  = Crypto::e($this->a->accion_id);
        
        $this->titulo = "MENU - BORRAR";
        $this->link_volver = PUBLIC_PATH."../../sysmenu/index/{$this->a->perfil_id}/";
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
            $this->link_edit = PUBLIC_PATH."../../sysmenu/edit/";
            $this->link_del  = PUBLIC_PATH."../../sysmenu/del/";
        
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

    public function ajax_opcion_menu(){
        if(Input::hasGet("uno")){
            $uno = Input::get("uno");
            $dos = Input::get("dos");
            Session::set("uno",$uno);
            Session::set("dos",$dos);
        }
        die("ok");
    }
}
