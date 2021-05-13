<?php 

/**
 * 
 */
class Rol extends ActiveRecord
{
	

//	public function initialize()
//	{
//	}
//        
//        
//    public function agregar($vec) {
//        $vec["perfil_id"] = (int)trim($vec["perfil_id"]);
//        $vec["accion_id"] = (int)trim($vec["accion_id"]);
//        if($vec["accion_id"] <= 0){
//            Flash::error ("Accion desconocida");
//            return TRUE;
//        }
////        $vec["accion"]         = trim($vec["accion"]);
//        
//        try{
//        if(!$this->create($vec))
//        {
//            return FALSE;
//        }
//        } catch (Exception $k)
//        {
//            if($this->db->id_connection->errno==1062){
//                Flash::error("Ya se Ingresó este acceso Para  este Perfil");
//            }else Flash::error ($k->getMessage ());
//            return FALSE;
//        }
//        return TRUE;
//    }    
//        
//    public function modificar($vec) {
//        $vec["id"]          = (int)trim($vec["id"]);
//        $vec["perfil_id"]   = (int)trim($vec["perfil_id"]);
//        $vec["accion"] = trim($vec["accion"]);
////        print_r($vec);
////        die();
//        if($vec["id"] <= 0)
//        {
//            Flash::error("ID accion No definido");
//            return false;
//        }
//        
//        try{
//            if(!$this->update($vec))
//            {
//                return FALSE;
//            }
//        } catch (Exception $k)
//        {
//            if($this->db->id_connection->errno==1062){
//                Flash::error("Ya se Ingresó esta acción");
//            }else Flash::error ($k->getMessage ());
//
//            return FALSE;
//        }
//        return TRUE;
//    }    
//        
//    
//    public function borrar($vec) {
//        $vec["id"]        = (int)trim($vec["id"]);
//        if($vec["id"] <= 0)
//        {
//            Flash::error("ID de Acceso No definido");
//            return false;
//        }
//        
//        try{
//            if(!$this->delete($vec["id"]))
//            {
//                return FALSE;
//            }
//        } catch (Exception $k)
//        {
//            
//            return FALSE;
//        }
//        return TRUE;
//    }    
//        
//    
//    public function hallar($accion_id) {
//        $accion_id =(int)$accion_id;
//        if($accion_id <= 0)
//        {
//            Flash::error("ID Accion No definido");
//            return false;
//        }
//        $sql = "SELECT 
//                    acceso.*,
//                    accion.accion, 
//                    controlador.controlador , 
//                    controlador.perfil_id , 
//                    perfil.perfil, 
//                    perfil.modulo_id, 
//                    modulo.modulo, 
//                    modulo.id as modulo_id 
//                FROM acceso  INNER JOIN accion ON acceso.accion_id = accion.id
//                             INNER JOIN controlador ON accion.controlador_id = controlador.id 
//                             INNER JOIN perfil ON controlador.perfil_id = perfil.id 
//                             INNER JOIN modulo ON perfil.modulo_id = modulo.id 
//                WHERE acceso.id = $accion_id ";
//        
//        $lista = $this->find_all_by_sql($sql);
////        print_r($lista);
////                die("<br>".$sql);
//
//        if(count($lista)<1)
//        {
//            Flash::error("Objeto Acción No Hallado");
//            return false;
//        }
//        
//        return $lista[0];
//    }
    
}
 ?>