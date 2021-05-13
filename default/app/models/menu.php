<?php 

/**
 * 
 */
class Menu extends ActiveRecord
{
	public static $TITULO=array("N"=>"NO","S"=>"SI");
	public static $POSICION=array("1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5","6"=>"6","7"=>"7","8"=>"8","9"=>"9","10"=>"11",
            "12"=>"12","13"=>"13");

        public function initialize()
	{
//		$this->validates_length_of("nombre", "minumum: 15", "too_short: El nombre debe tener al menos 15 caracteres");
// 	    $this->validates_length_of("nombre", "maximum: 40", "too_long: El nombre debe tener maximo 40 caracteres");
//		$this->validates_length_of("nombre", "in: 15:40",
//		      "too_short: El nombre debe tener al menos 15 caracteres",
//		      "too_long: El nombre debe tener maximo 40 caracteres"
//		   );
        $this->validates_presence_of("texto", array("message"=>"Debe Ingresar el Texto/Títúlo"));
        $this->validates_presence_of("icono", array("message"=>"Debe Ingresar el ícono"));
        $this->validates_presence_of("color", array("message"=>"Debe Ingresar el color"));
	}

    public function agregar($vec) {
        $vec["perfil_id"] = (int)trim($vec["perfil_id"]);
        $vec["texto"]     = trim($vec["texto"]);
        $vec["icono"]     = trim($vec["icono"]);
        $vec["color"]     = trim($vec["color"]);
//        $vec["titulo"]    = trim($vec["titulo"]);
        $vec["posicion"]  = (int)trim($vec["posicion"]);
        $vec["accion_id"] = (int)$vec["accion_id"];
        try{
        if(!$this->create($vec))
        {
            return FALSE;
        }
        } catch (Exception $k)
        {
            if($this->db->id_connection->errno==1062){
                Flash::error("Ya se Ingresó este Texto o esta posicion");
            }else                Flash::error ($k->getMessage ());
            return FALSE;
        }
        return TRUE;
    }    
        
    
    public function modificar($vec) {
//        print_r($vec);
//        die();
        $vec["id"]          = (int)trim($vec["id"]);
        $vec["perfil_id"] = (int)trim($vec["perfil_id"]);
        $vec["texto"]     = trim($vec["texto"]);
        $vec["icono"]     = trim($vec["icono"]);
        $vec["color"]     = trim($vec["color"]);
        $vec["posicion"]  = (int)trim($vec["posicion"]);
        $vec["accion_id"] = (int)$vec["accion_id"];
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
                Flash::error("Ya se Ingresó este Perfil");
            }
            return FALSE;
        }
        return TRUE;
    }    
        
    
    public function borrar($vec) {
        $vec["id"]        = (int)trim($vec["id"]);
        if($vec["id"] <= 0)
        {
            Flash::error("ID Menu No definido");
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
        $sql = "SELECT 
                    menu.*,
                    accion.controlador_id,
                    perfil.modulo_id,
                    modulo.modulo,
                    perfil.perfil,
                    controlador.controlador,
                    accion.accion
                FROM menu INNER JOIN accion ON menu.accion_id = accion.id 
                          INNER JOIN controlador ON accion.controlador_id = controlador.id
                          INNER JOIN perfil ON menu.perfil_id = perfil.id
                          INNER JOIN modulo ON perfil.modulo_id = modulo.id
                WHERE menu.id =  $perfil_id ";
        $lista = $this->find_all_by_sql($sql);
        if(count($lista)<1)
        {
            Flash::error("Objeto Menu No Hallado");
            return false;
        }
        
        return $lista[0];
    }
    public function lista($perfil_id) {
        $sqlQuery = " SELECT 
                            menu.* ,
                            accion.accion,
                            controlador.controlador
                        FROM menu INNER JOIN accion ON menu.accion_id = accion.id
                                  INNER JOIN controlador ON accion.controlador_id = controlador.id
                        WHERE menu.perfil_id = $perfil_id ";
        return $this->find_all_by_sql($sqlQuery);
    }
    
    //lista de modulos y menúes de un usuario en sesion
    
    public static function listaGeneralMenus() {
        $sql = "SELECT 
                        modulo.modulo,
                        perfil.perfil,
                        perfil.modulo_id,
                        menu.texto,
                        menu.icono,
                        menu.color,
                        menu.posicion,
                        accion.accion,
                        accion.id AS accion_id,
                        controlador.controlador
                FROM rol INNER JOIN perfil      ON rol.perfil_id         = perfil.id
                         INNER JOIN modulo      ON perfil.modulo_id      = modulo.id
                         INNER JOIN menu        ON menu.perfil_id        = perfil.id
                         INNER JOIN accion      ON menu.accion_id        = accion.id
                         INNER JOIN controlador ON accion.controlador_id = controlador.id
                         INNER JOIN acceso      ON acceso.accion_id      = accion.id
                WHERE rol.usuario_id   = ".Auth::get("id")." 
                  AND rol.activo       = 'S'
                  AND acceso.permitido = 'S'

                ORDER BY modulo.modulo, perfil.perfil, menu.posicion
                ";
        $menu=new Menu();
        Menu::$LISTA_GRAL_MENUES = $menu->find_all_by_sql($sql);
        $inicio="";
        foreach (Menu::$LISTA_GRAL_MENUES as $value) {
            if($inicio!=$value->modulo)
            {
                $inicio=$value->modulo;
                Menu::$LISTA_GRAL_MODULOS[$value->modulo_id]=$inicio;
            }
        }
        return Menu::$LISTA_GRAL_MENUES;
    }
    
    public static $LISTA_GRAL_MENUES=array();
    public static $LISTA_GRAL_MODULOS=array();
}
 ?>