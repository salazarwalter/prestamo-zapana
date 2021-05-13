<?php
/**
 * @see Controller nuevo controller
 */
require_once CORE_PATH . 'kumbia/controller.php';

/**
 * Controlador principal que heredan los controladores
 *
 * Todos las controladores heredan de esta clase en un nivel superior
 * por lo tanto los métodos aquií definidos estan disponibles para
 * cualquier controlador.
 *
 * @category Kumbia
 * @package Controller
 */
abstract class AppController extends Controller
{

    final protected function initialize()
    {
        if(Auth::is_valid()) //esta autenticado?
        {
            $con = $this->controller_name;
            $act = $this->action_name;
            if(!Usuario::tieneAcceso($con,$act))
            {
                die("No tiene acceso $con $act");
            }
            Usuario::obtenerFotoPerfil();
            $menu = new Menu() ;
            
        }else{
            if($this->controller_name == "index"       && $this->action_name   == "index"                       ||
               $this->controller_name == "sysingreso"  && $this->action_name   == "registro"                    ||
               $this->controller_name == "sysusuario"  && $this->action_name   == "confirmacionSatisfactoria"   ||
               $this->controller_name == "sysusuario"  && $this->action_name   == "confirmacionFallida"         ||
               $this->controller_name == "sysingreso"  && $this->action_name   == "ingresar"    ){
               }
               else{
                   Redirect::to("../../");
                   die();
               }
        }
    }

    final protected function finalize()
    {
        
    }

}
