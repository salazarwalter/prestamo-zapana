<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of wliquidacion_controller
 *
 * @author salazarwalter
 */
class WliquidacionController extends AppController{
    
    public function generarpagos() {

        $gen = new Generacomp();
        $this->lista=$gen->find();
        
        $this->gen = $gen;
        $hoy = getdate();
        $this->gen->mesNro  = $hoy["mon"];
        $this->gen->anioNro = $hoy["year"];
        if(Input::hasPost(""))
        {
//            $gen = new Generacomp();
            if($gen->generarComprabantes($this->gen->mesNro,$this->gen->anioNro))
            {
                Redirect::to("../../wliquidacion/generarpagos");
            }
        }
        $this->titulo = "GENERAR PAGOS";
        $usu = new Usuario();
        $this->cantidad = $usu->count();
        
        
//        print_r($hoy["mon"]." ".$hoy["year"]);        
//        die();
    }
}
