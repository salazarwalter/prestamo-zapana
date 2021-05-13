<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class SysmoduloController extends AppController
{

    public function index()
    {
    	//View::template("default_1");
            $this->titulo = "MODULOS - LISTADO";
            $mod = new Modulo();
            $this->lista = $mod->find();
            $this->link_add  = PUBLIC_PATH."../../sysmodulo/add/";
            $this->link_edit = PUBLIC_PATH."../../sysmodulo/edit/";
            $this->link_del  = PUBLIC_PATH."../../sysmodulo/del/";
    }
    
    public function add() {
        if(Input::hasPost("a"))
        {
            $obj = new Modulo();
            $vec = Input::post("a");
            if($obj->agregar($vec))
            {
                Redirect::to("../../sysmodulo/");
            }
        }
        $this->titulo = "MODULOS - AGREGAR";
        $this->link_volver = PUBLIC_PATH."../../sysmodulo/";
    }
    public function edit($x_modulo_id=0) {
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
        $modulo_id = (int)Crypto::d($x_modulo_id);
        
        $modulo = new Modulo();
        $this->a = $modulo->hallar($modulo_id);
        $this->a->id = $x_modulo_id;
        
        $this->titulo = "MODULO - EDITAR";
        $this->link_volver = PUBLIC_PATH."../../sysmodulo/";
    }
    public function del($x_modulo_id=0) {
        if(Input::hasPost("a"))
        {
            $obj = new Modulo();
            $vec = Input::post("a");
            $x_modulo_id=$vec["id"];
            $vec["id"]=(int) Crypto::d($vec["id"]);
            if($obj->borrar($vec))
            {
                Redirect::to("../../sysmodulo/");
            }
        }
        $modulo_id = (int)Crypto::d($x_modulo_id);
        
        $modulo = new Modulo();
        $this->a = $modulo->hallar($modulo_id);
        $this->a->id = $x_modulo_id;
        
        $this->titulo = "MODULO - BORRAR";
        $this->link_volver = PUBLIC_PATH."../../sysmodulo/";
    }
}
