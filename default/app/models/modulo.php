<?php 

/**
 * 
 */
class Modulo extends ActiveRecord
{
    public static $PRIVADO   = array("N"=>"NO","S"=>"SI");
    public static $INICIAL   = array("N"=>"NO","S"=>"SI");
    public static $PUBLICADO = array("N"=>"NO","S"=>"SI");

    public function initialize()
	{
            $this->validates_presence_of("modulo",array("message"=>"Debe Ingresar el nombre del Módulo"));
            $this->validates_presence_of("link",array("message"=>"Debe Ingresar el Link Del Video"));
            $this->validates_presence_of("descripcion",array("message"=>"Debe Ingresar La Descripción del Módulo"));
            $this->validates_presence_of("logo",array("message"=>"Debe Ingresar la clase fa fa-xxx de font awesome"));
            $this->validates_uniqueness_of("modulo",array("message"=>"Módulo ya ingresado"));
	}
        
    public function agregar($vec) {
        $vec["modulo"] = trim($vec["modulo"]);
        $vec["descripcion"] = trim($vec["descripcion"]);
        $vec["logo"] = trim($vec["logo"]);
        $vec["link"] = trim($vec["link"]);
        $vec["inicial"] = trim($vec["inicial"]);
        $vec["publicado"] = trim($vec["publicado"]);
        $vec["privado"] = trim($vec["privado"]);
        try{
        if(!$this->create($vec))
        {
            return FALSE;
        }
        } catch (Exception $k)
        {
            if($this->db->id_connection->errno==1062){
                Flash::error("Ya se Ingresó este Módulo");
            }
            return FALSE;
        }
        return TRUE;
    }    
    
    public function modificar($vec) {
        $vec["id"] = (int)trim($vec["id"]);
        $vec["modulo"] = trim($vec["modulo"]);
        $vec["descripcion"] = trim($vec["descripcion"]);
        $vec["logo"] = trim($vec["logo"]);
        $vec["link"] = trim($vec["link"]);
        $vec["inicial"] = trim($vec["inicial"]);
        $vec["publicado"] = trim($vec["publicado"]);
        $vec["privado"] = trim($vec["privado"]);
        
        if(!$vec["id"])
        {
            Flash::error("ID Obj No Hallado");
            return false;
        }
        
        try{
            if(!$this->update($vec))
            {
                return FALSE;
            }
        } catch (Exception $k)
        {
            if($this->db->id_connection->errno==1062){
                Flash::error("Ya se Ingresó este Módulo");
            }
            return FALSE;
        }
        return TRUE;
    }    
    
    public function borrar($vec) {
        $vec["id"] = (int)trim($vec["id"]);
        
        if(!$vec["id"])
        {
            Flash::error("ID Obj No Hallado");
            return false;
        }
        
        $h= $this->hallar($vec["id"]);
        if(!$h)
        {
            Flash::error("Modulo No Hallado");
            return false;
        }
        
        
        try{
            if(!$this->delete($vec["id"]))
            {
                return FALSE;
            }
        } catch (Exception $k)
        {
            return FALSE;
        }
        return TRUE;
    }    
    
    public function hallar($modulo_id) {
        if(!$modulo_id)
        {
            Flash::error("ID Obj No Hallado");
            return false;
        }
        $mod =new Modulo();
        $h = $mod->find("id=".$modulo_id);
        if(count($h)==0)
        {
            Flash::error("Obj Modulo No Hallado");
            return false;
        }
        
        $h[0]->modulo_id = $modulo_id;
        
        return $h[0];
    }
    public function perfilesIniciales() {
        $sql = "SELECT perfil.id as perfil_id 
                FROM modulo INNER JOIN perfil ON perfil.modulo_id = modulo.id
                WHERE modulo.inicial   ='S'
                  AND modulo.publicado ='S'
                  AND perfil.`admin`   ='S'
                ";
        return $this->find_all_by_sql($sql);
    }
    
    public function disponibles() {
        $sql = "SELECT * FROM modulo 
                WHERE id NOT IN (
                                 SELECT modulo.id 
                                 FROM modulo INNER JOIN perfil ON perfil.modulo_id = modulo.id
                                             INNER JOIN rol    ON rol.perfil_id    = perfil.id
                                 WHERE rol.usuario_id = ".Auth::get("id")." 
                                   AND rol.activo     = 'S'  
                                ) 
               -- AND modulo.publicado = 'S'
               -- AND modulo.privado   ='N'
                ";
//        die($sql);
        return $this->find_all_by_sql($sql);
    }
    
    
    public function contratados() {
        $sql = " SELECT modulo.* 
                 FROM modulo INNER JOIN perfil ON perfil.modulo_id = modulo.id
                             INNER JOIN rol    ON rol.perfil_id    = perfil.id
                 WHERE rol.usuario_id = ".Auth::get("id")." 
                   AND rol.activo='S'   
                ";
        return $this->find_all_by_sql($sql);
    }
    
    
}
 ?>