<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of generacomp
 *
 * @author salazarwalter
 */
class Generacomp extends ActiveRecord{

    public function generarComprabantes($mes,$anio){

        $gen = new Generacomp();
        $mes=Fecha::$MES_LARGO[$mes];
//        die($mes."/".$anio);
        $h = $this->find("periodo_mes = '$mes' AND periodo_anio ='$anio' ");
        if(count($h)>0){
            Flash::info("Ya se Genero para este periodo");
        }else{
            $gen->usuario_id    = Auth::get("id");
            $gen->periodo_mes   = $mes;
            $gen->periodo_anio  = $anio;
            if(!$gen->create()){
                Flash::error("No se pudo guardar un generador de comprobantes");
                return FALSE;
            }
            $sql ="SELECT 
                        rol.usuario_id,
                        rol.id as rol_id,
                        perfil.precio
                    FROM usuario INNER JOIN rol    ON rol.usuario_id = usuario.id
                                 INNER JOIN perfil ON rol.perfil_id  = perfil.id
                    WHERE rol.activo='S' 
                    ORDER BY usuario.id
                    ";
            $user = new Usuario();
            $lista = $user->find_all_by_sql($sql);
            
            $idx="";
            foreach ($lista as $linea):
                if($idx!=$linea->usuario_id)
                {
                    $comp                = new Comprobante();
                    $comp->generacomp_id = $gen->id;
                    $comp->usuario_id    = $linea->usuario_id;
                    $idx=$linea->usuario_id;
                }
            endforeach;
            
        }
        
    }    
}
