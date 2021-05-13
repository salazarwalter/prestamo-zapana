<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class MismoduloController extends AppController
{

    public function disponibles()
    {
    	//View::template("default_1");
            $this->titulo = "MODULOS DISPONIBLES";
            $mod = new Modulo();
            $this->lista = $mod->disponibles();
            $this->link_contratar  = PUBLIC_PATH."../../mismodulo/contratar/";
            $this->link_edit = PUBLIC_PATH."../../sysmodulo/edit/";
            $this->link_del  = PUBLIC_PATH."../../sysmodulo/del/";
        $this->titulo = "MODULO DISPONIBLES (".count($this->lista).")";
    }
    
    public function contratar() {
            $this->titulo = "MODULOS DISPONIBLES";
        
    }
    
    public function contratados() {
        $this->titulo = "MODULOS - CONTRATADOS";
        $mod = new Modulo();
        $this->lista = $mod->contratados();
        $this->link_contratar = PUBLIC_PATH."../../mismodulo/disponibles/";
        
        $this->titulo = "MODULOS CONTRATADOS (".count($this->lista).")";
    }
    
    public function principal($x_modulo_id=0) {
        if(Input::hasPost("a"))
        {
            $obj = new Modulo();
            $vec = Input::post("a");
            $x_modulo_id=$vec["id"];
            $vec["id"]=(int) Crypto::d($vec["id"]);
            if($obj->modificar($vec))
            {
                Redirect::to("../../sysmodulo/");
            }
        }
//        $modulo_id = (int)Crypto::d($x_modulo_id);
//        
//        $modulo = new Modulo();
//        $this->a = $modulo->hallar($modulo_id);
//        $this->a->id = $x_modulo_id;
        
        $this->titulo = "MIS MÓDULOS";
        $this->link_volver = PUBLIC_PATH."../../sysmodulo/";
        
    }
    
}
