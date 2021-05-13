<?php 

/**
 * 
 */
class Perfil extends ActiveRecord
{
    public static $ADMIN=array("N"=>"NO","S"=>"SI");

	public function initialize()
	{
//		$this->validates_length_of("nombre", "minumum: 15", "too_short: El nombre debe tener al menos 15 caracteres");
// 	    $this->validates_length_of("nombre", "maximum: 40", "too_long: El nombre debe tener maximo 40 caracteres");
//		$this->validates_length_of("nombre", "in: 15:40",
//		      "too_short: El nombre debe tener al menos 15 caracteres",
//		      "too_long: El nombre debe tener maximo 40 caracteres"
//		   );
        $this->validates_presence_of("perfil", array("message"=>"Debe Ingresar el Perfil"));
        $this->validates_presence_of("precio", array("message"=>"Debe Ingresar el Precio"));
        $this->validates_presence_of("admin", array("message"=>"Debe Indicar si es un perfil Administrador"));
	}

    public function agregar($vec) {
        $vec["modulo_id"] = (int)trim($vec["modulo_id"]);
        $vec["perfil"]    = trim($vec["perfil"]);
        $vec["admin"]    = trim($vec["admin"]);
        $vec["precio"]    = (float)trim($vec["precio"]);
        if($vec["modulo_id"]<=0){
            Flash::error("Id de Modulo Incorecto");
            return FALSE;
        }
        if($vec["precio"]<0){
            Flash::error("El precio No puede ser menor que cero");
            return FALSE;
        }
        
        try{
        if(!$this->create($vec))
        {
            return FALSE;
        }
        } catch (Exception $k)
        {
            if($this->db->id_connection->errno==1062){
                Flash::error("Ya se Ingresó este Perfil En este Módulo");
            }else                Flash::error ($k->getMessage ());
            return FALSE;
        }
        return TRUE;
    }    
        
    
    public function modificar($vec) {
        $vec["id"]          = (int)trim($vec["id"]);
        $vec["modulo_id"] = (int)trim($vec["modulo_id"]);
        $vec["perfil"]    = trim($vec["perfil"]);
        $vec["admin"]    = trim($vec["admin"]);
        $vec["precio"]    = (float)trim($vec["precio"]);
        if($vec["modulo_id"]<=0){
            Flash::error("Id de Modulo Incorecto");
            return FALSE;
        }
        if($vec["precio"]<0){
            Flash::error("El precio No puede ser menor que cero");
            return FALSE;
        }
        
        if($vec["id"] <= 0)
        {
            Flash::error("ID COntrolador No definido");
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
                Flash::error("Ya se Ingresó este Perfil En este Módulo");
            }
            return FALSE;
        }
        return TRUE;
    }    
        
    
    public function borrar($vec) {
        $vec["id"]        = (int)trim($vec["id"]);
        if($vec["id"] <= 0)
        {
            Flash::error("ID Perfil No definido");
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
        
    
    public function hallar($perfil_id) {
        $perfil_id =(int)$perfil_id;
        if($perfil_id <= 0)
        {
            Flash::error("ID Perfil No definido");
            return false;
        }
        $sql = "SELECT perfil.*, modulo.modulo,perfil.id as perfil_id "
                . "FROM perfil INNER JOIN modulo ON perfil.modulo_id = modulo.id "
                . "WHERE perfil.id = $perfil_id ";
        $lista = $this->find_all_by_sql($sql);
        if(count($lista)<1)
        {
            Flash::error("Objeto Perfil No Hallado");
            return false;
        }
        
        return $lista[0];
    }
    
    public function combo_perfilesXmodulo($param) {
        return $this->find("modulo_id={$param["modulo_id"]}");
    }
    
    public function ajax_perfiles_contratados($mod_id) {
        if(!$mod_id){
            return FALSE;
        }
//        $sql = " SELECT perfil.perfil,perfil.precio 
//                 FROM perfil INNER JOIN rol ON rol.perfil_id = perfil.id 
//                 WHERE perfil.modulo_id = $mod_id  
//                   AND rol.usuario_id   = ".Auth::get("id")." 
//                ";
        $sql = " SELECT perfil.perfil,perfil.precio 
                 FROM perfil  
                 WHERE perfil.modulo_id = $mod_id  
                ";
        //echo "\n".$sql."\n";
        return $this->find_all_by_sql($sql);
    }
    
    public function desactivarPerfil($modulo_id) {
        if($modulo_id<=0){
            Flash::error("Se desconoce el modulo");
            return FALSE;
        }
        $sql=" SELECT rol.* 
               FROM perfil INNER JOIN rol ON rol.perfil_id = perfil.id 
               WHERE perfil.modulo_id = $modulo_id 
                 AND rol.usuario_id   = ".Auth::get("id")."  
                 AND perfil.`admin`   = 'S' 
                 AND rol.activo       = 'S' 
                ";
        
        $lista = $this->find_all_by_sql($sql);
        
        if(count($lista)<1){
            Flash::error("Rol No Identificado");
            return FALSE;
        }
         
        $rol = new Rol();
        $rol->id          = $lista[0]->id;
        $rol->usuario_id  = $lista[0]->usuario_id;
        $rol->perfil_id   = $lista[0]->perfil_id;
        $rol->contrata_at = $lista[0]->contrata_at;
        $rol->activo = 'N';
        $rol->finaliza = date("Y-m-d H:i:s");
        if(!$rol->update()){
            Flash::error("No se puede Actualizar el rol. Intentelo mas tarde");
            return FALSE;
            
        }
        return TRUE;
    }
    
    public function adquirirModulo($modulo_id) {
        $sql = "SELECT COUNT(*) 
                FROM rol INNER JOIN perfil ON rol.perfil_id = perfil.id 
                WHERE perfil.modulo_id = $modulo_id 
                  AND CAST(rol.contrata_at AS DATE) = curdate() 
                  AND rol.usuario_id = ".Auth::get("id") ." 
                ";
        $cantidad = $this->count_by_sql($sql);
        if($cantidad>2){
            $this->mensaje = "No puede adquirir el mismo módulo más de 3 veces en el mismo día";
            return FALSE;
        }
        
        $sql = "SELECT perfil.* 
                FROM modulo INNER JOIN perfil ON perfil.modulo_id = modulo.id
                WHERE modulo.id = $modulo_id 
                  AND perfil.`admin` = 'S' ";
        $lista = $this->find_all_by_sql($sql);
        if(count($lista)<1){
            $this->mensaje = "Perfil No Identificado";
            return FALSE;
        }
        $perfil = $lista[0];
        $rol = new Rol();
        $rol->usuario_id = Auth::get("id");
        $rol->perfil_id  = $perfil->id;
        
        if(!$rol->create()){
            $this->mensaje = "No se puede crear el Rol";
          return FALSE;
        }
        return TRUE;
    }
    
}
 ?>