<?php 

/**
 * 
 */
class Controlador extends ActiveRecord
{
	

	public function initialize()
	{
//		$this->validates_length_of("nombre", "minumum: 15", "too_short: El nombre debe tener al menos 15 caracteres");
// 	    $this->validates_length_of("nombre", "maximum: 40", "too_long: El nombre debe tener maximo 40 caracteres");
//		$this->validates_length_of("nombre", "in: 15:40",
//		      "too_short: El nombre debe tener al menos 15 caracteres",
//		      "too_long: El nombre debe tener maximo 40 caracteres"
//		   );
        $this->validates_presence_of("perfil_id", array("message"=>"Debe Seleccionar el  Perfil"));
        $this->validates_presence_of("controlador", array("message"=>"Debe Ingresar el  Controlador"));
	}

    public function agregar($vec) {
        $vec["perfil_id"] = (int)trim($vec["perfil_id"]);
        $vec["controlador"] = trim($vec["controlador"]);
        try{
        if(!$this->create($vec))
        {
            return FALSE;
        }
        } catch (Exception $k)
        {
            if($this->db->id_connection->errno==1062){
                Flash::error("Ya se Ingresó este Controlador, Para este Perfil");
            }else Flash::error ($k->getMessage ());
            return FALSE;
        }
        return TRUE;
    }    
        
    
    public function modificar($vec) {
        $vec["id"]          = (int)trim($vec["id"]);
        $vec["perfil_id"]   = (int)trim($vec["perfil_id"]);
        $vec["controlador"] = trim($vec["controlador"]);
//        print_r($vec);
//        die();
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
                Flash::error("Ya se Ingresó este Controlador, Para este Perfil");
            }else Flash::error ($k->getMessage ());

            return FALSE;
        }
        return TRUE;
    }    
        
    
    public function borrar($vec) {
        $vec["id"]        = (int)trim($vec["id"]);
        if($vec["id"] <= 0)
        {
            Flash::error("ID COntrolador No definido");
            return false;
        }
        
        try{
            if(!$this->delete($vec["id"]))
            {
                return FALSE;
            }
        } catch (Exception $k)
        {
            Flash::error ($k->getMessage ());
            
            return FALSE;
        }
        return TRUE;
    }    
        
    
    public function hallar($controlador_id) {
        $controlador_id =(int)$controlador_id;
        if($controlador_id <= 0)
        {
            Flash::error("ID COntrolador No definido");
            return false;
        }
        $sql = "SELECT controlador.*, perfil.perfil,perfil.modulo_id, modulo.modulo 
                FROM controlador INNER JOIN perfil ON controlador.perfil_id = perfil.id 
                                 INNER JOIN modulo ON perfil.modulo_id      = modulo.id 
                WHERE controlador.id = $controlador_id ";
        $lista = $this->find_all_by_sql($sql);
        if(count($lista)<1)
        {
            Flash::error("Objeto Controlador No Hallado");
            return false;
        }
        
        return $lista[0];
    }
    
    public function combo_controladorXperfil($vec) {
        return $this->find("perfil_id={$vec["perfil_id"]}");
    }
    public function combo($vec) {
//        print_r($vec);
//        die();
        return $this->find("perfil_id={$vec["perfil_id"]}");
    }
    public function controladoresXmodulo($modulo_id) {
        $sqlQuery = "SELECT 
                        controlador.*, 
                        perfil.perfil
                    FROM perfil INNER JOIN controlador ON controlador.perfil_id = perfil.id
                    WHERE perfil.modulo_id = $modulo_id ";
      return $this->find_all_by_sql($sqlQuery);              
    }
}
 ?>