<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of perfilDao
 *
 * @author salazarwalter
 */
class PerfilDao {
    
    public function guardarPerfil($vector) {
//            print_r($vector);
//            die();
        $vector["xpais_id"]=(int)$vector["pais_id"];
        if(!$vector["xpais_id"]){
            $this->message = "Pais NO Hallado";
            return FALSE;
        }
        $u = new Xusuario();
        $usu = $u->find_by_id(Auth::get("id"));
        if(!$usu) die("Obj Usuario no hallado");
        $usu->begin();
        $usu->xpais_id = $vector["xpais_id"];
        if(!$usu->save()){
            $usu->rollback();
            return FALSE;
        }
        
        $pub = new Xpublicar($vector);
        $pub->xusuario_id    = $usu->id;
        $pub->id             = Auth::get("xpublicar_id");
        if(!$pub->save()){
            $usu->rollback();
            return FALSE;
        }
        
        $per = new Xpersonal($vector);
        $per->xusuario_id    = $usu->id;
        $per->id             = Auth::get("xpersonal_id");
        if(!$per->save()){
            $usu->rollback();
            return FALSE;
        }
        $usu->commit();
        return TRUE;        
    }
    
    public function cambiarFoto() {
        if( $_FILES["file"]["error"]==0){
//            print_r($_FILES);
//            die();
        if($_FILES["file"]["name"]== Auth::get("foto_nombre")) {
            return TRUE;
        }
        else{
            $archivo = Upload::factory('file', 'image'); 
            $archivo->setExtensions(array('jpg', 'png', 'gif','jpeg'));//le asignamos las extensiones a permitir
//            $pathPerfil=dirname($_SERVER['SCRIPT_FILENAME']) . '/img/perfiles';

            $archivo->addPath("/perfiles");//path hacia la carpeta de perfiles de usuario

            if ($archivo->isUploaded()) {
                $name= microtime(true);
                $dec= explode(".", $name);
                $name= "".date("Y-m-d-H-i-s")."-".$dec[1];
//                var_dump("$name");
                $name=$archivo->save($name);
                if ($name) {
                    $u=new Xfoto();
                    $u->id = Auth::get("xfoto_id");
                    $u->foto_nombre = $name; 
                    if(!$u->save()) {
                        return FALSE;
                    }
                    return TRUE;
                }
            }else{
                    $this->message = 'No se ha Podido Subir la imagen...!!!';
                    return FALSE;
            }
           }
        }else {
             $this->message = 'No se enviada la imagen...!!!';
             return FALSE;
        }
        
    }
    
}
