<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fecha
 *
 * @author salazarwalter
 */
class Fecha {
    public static function yymmddToddmmyy($fecha) {
        //convierte formato 2017-11-26 en 26/11/2017 
        if($fecha){
            list($a,$m,$d)= explode("-", $fecha);
            $fecha="$d/$m/$a";
        }
        return $fecha;
    }
     public static function yymmddhmsToddmmyyhms($fecha) {
        //convierte formato 2017-11-26 en 26/11/2017 
        if($fecha){
            $fecha= explode(".", $fecha);
            $fecha1= explode(" ", $fecha[0]);
            
            list($a,$m,$d)= explode("-", $fecha1[0]);
            $fecha="$d/$m/$a {$fecha1[1]}";
        }
        return $fecha;
    }
    public static function ddmmyyToyymmdd($fecha) {
        //convierte formato 26/11/2017 en 2017-11-26 
        if($fecha){
            list($d,$m,$a)= explode("/", $fecha);
            $fecha="$a-$m-$d";
        }
        return $fecha;
    }
    
    public static function isDdmmyyValido($fecha) {
        //verifica la validez de una fecha en formato 26/11/2017
            list($d,$m,$a)= explode("/", $fecha);
      return checkdate($m, $d, $a);
    }
    
    public static function hhmmssTohhmm($hora) {
        if($hora){
            list($h,$m,$s)= explode(":", $hora);
            $hora="$h:$m";
        }
        return $hora;
    }
    public static function hhmmTohhmmss($hora) {
        if($hora){
            list($h,$m)= explode(":", $hora);
            $hora="$h:$m:00";
        }
        return $hora;
    }
    public static function antiguedad($fecha){
        //calcula diferencia de fecha en 201-11-26
        $dif="0";
        if($fecha){
            $cumpleanos = new DateTime($fecha);
            $hoy = new DateTime();
            $annos = $hoy->diff($cumpleanos);
            $dif=  $annos->y;
            }
            return $dif;
        }
        
    
}
