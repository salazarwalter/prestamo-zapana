<?php

/**
 * 
 * Controller por defecto si no se usa el routes
 *
 */

Load::model("dao/ingresoDao");

class SysingresoController extends AppController
{

/**************************    Para Registrarse Como usuario del sistema   ********************************/ 
    public function registro(){
        View::template("default_1");
        if(Input::hasPost("a")){
            $vector = Input::post("a");
            $user = new IngresoDao();
            if ($user->registrarme($vector)) {
                Redirect::to("../../sysingreso/registroSatisfactorio");
            } else {
                Flash::error($user->message);
            }
        }
    }
    public function confirmar($parametros) {
        View::template("default_1");
        $dao = new IngresoDao();
        if($dao->registroSatisfactorio($parametros)){
            Redirect::to("../../sysingreso/confirmacionSatisfactoria");
        }else{
            Redirect::to("../../sysingreso/confirmacionFallida");
        }
            die();
    }
    
    public function registroSatisfactorio($p=0) {
        View::template("default_1");
    }    
    public function confirmacionSatisfactoria() {
        View::template("default_1");
    }    
    public function registroFallido($parametros) {
        View::template("default_1");
//        $dao = new IngresoDao();
//        if($dao->registroSatisfactorio($parametros)){
//                
//        }
//        Flash::info("Su Registro es satisfactorio. Hemos Enviado un Email a su Correo Electr&oacute;nico. Como &uacute;ltimo paso, ingrese a su  Correo y Confirme el Email");
    }    
    
/**************************    Para Ingresar Al sistema   ********************************/ 
/**************************    Para Ingresar Al sistema   ********************************/ 
/**************************    Para Ingresar Al sistema   ********************************/ 
    
    public function ingresar(){
        View::template("default_1");
        if(Input::hasPost("a")){
            
            $vector = Input::post("a");
            $user = new IngresoDao();
            if ($user->ingresar($vector)) {
                Flash::info("Bienvenida Satisfactorio. ");
                Session::set("uno", "4");
                Session::set("dos", "54");
                Redirect::to("../../mismodulo/principal");
                //$this->enrutarLogin();

            }else
                Flash::error($user->message);
        }        
    }
    
 

    
    public function salir() {
        View::template("default_1");
        Auth::destroy_identity();
        Redirect::to("../../");
    }

    
}
