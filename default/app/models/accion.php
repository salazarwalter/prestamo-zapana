<?php 

/**
 * 
 */
class Accion extends ActiveRecord
{
	

	public function initialize()
	{
//	$this->validates_length_of("accion", "minumum: 15", "too_short: El nombre debe tener al menos 15 caracteres");
// 	    $this->validates_length_of("nombre", "maximum: 40", "too_long: El nombre debe tener maximo 40 caracteres");
//		$this->validates_length_of("nombre", "in: 15:40",
//		      "too_short: El nombre debe tener al menos 15 caracteres",
//		      "too_long: El nombre debe tener maximo 40 caracteres"
//		   );
        $this->validates_presence_of("accion", array("message"=>"Debe Ingresar la Acción"));
	}
        
    public function agregar($vec) {
        $vec["perfil_id"] = (int)trim($vec["perfil_id"]);
        $vec["accion"]         = trim($vec["accion"]);
//        print_r($vec);
//        die();
        $this->begin();
        try{
            
        if(!$this->create($vec))
        {
            $this->rollback();
            return FALSE;
        }
        $acceso = new Acceso();
        $acceso->accion_id = $this->id;
        $acceso->perfil_id = $vec["perfil_id"];
        if(!$acceso->create($vec))
        {
            $this->rollback();
            return FALSE;
        }
        $this->commit();
        } catch (Exception $k)
        {
            if($this->db->id_connection->errno==1062){
                Flash::error("Ya se Ingresó esta acción  Para  este Controlador");
                $this->rollback();
            }else Flash::error ($k->getMessage ());
            return FALSE;
        }
        return TRUE;
    }    
        
    public function modificar($vec) {
        $vec["id"]          = (int)trim($vec["id"]);
        $vec["perfil_id"]   = (int)trim($vec["perfil_id"]);
        $vec["accion"] = trim($vec["accion"]);
//        print_r($vec);
//        die();
        if($vec["id"] <= 0)
        {
            Flash::error("ID accion No definido");
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
                Flash::error("Ya se Ingresó esta acción");
            }else Flash::error ($k->getMessage ());

            return FALSE;
        }
        return TRUE;
    }    
        
    
    public function borrar($vec) {
        $vec["id"]        = (int)trim($vec["id"]);
        if($vec["id"] <= 0)
        {
            Flash::error("ID de Acción No definido");
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
        
    
    public function hallar($accion_id) {
        $accion_id =(int)$accion_id;
        if($accion_id <= 0)
        {
            Flash::error("ID Accion No definido");
            return false;
        }
        $sql = "SELECT accion.*,
                        controlador.controlador ,
                        controlador.perfil_id ,
                        perfil.perfil,
                        perfil.modulo_id,
                        modulo.modulo,
                        modulo.id as modulo_id
                 FROM controlador INNER JOIN accion  ON accion.controlador_id = controlador.id
                                  INNER JOIN perfil  ON controlador.perfil_id = perfil.id
                                  INNER JOIN modulo  ON perfil.modulo_id      = modulo.id
                 WHERE accion.id = $accion_id ";
        
//        die($sql);
        $lista = $this->find_all_by_sql($sql);
//        print_r($lista);
//                die("<br>".$sql);

        if(count($lista)<1)
        {
            Flash::error("Objeto Acción No Hallado");
            return false;
        }
        
        return $lista[0];
    }
        
   public function combo_norepeat($control_id) {
       $sql = "SELECT accion.* 
               FROM accion 
               WHERE accion.controlador_id = $control_id 
                  AND accion.id NOT IN (
                        SELECT a.id
                        FROM accion a INNER JOIN acceso b ON b.accion_id = a.id
                        WHERE a.controlador_id = $control_id 
                )
                ";
       return $this->find_all_by_sql($sql);
   }
   
   public function lista_controlador_accion($perfil_id) {
       $sqlQuery = "SELECT accion.*,controlador.controlador 
                    FROM controlador INNER JOIN accion  ON accion.controlador_id = controlador.id
                    WHERE controlador.perfil_id = $perfil_id 
                    ";
       return $this->find_all_by_sql($sqlQuery);
   }
}
 ?>