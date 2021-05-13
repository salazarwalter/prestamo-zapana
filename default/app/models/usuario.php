<?php 

/**
 * 
 */
class Usuario extends ActiveRecord
{
        public static $FOTO_NOMBRE="avatar300.png";
        public static $FOTO="";
        public static $NOMBRE="";

        public static $LINK_CONFIRMAR="http://localhost/sbase2/sysingreso/confirmar";
        
        public static function obtenerFotoPerfil() {
            $u = new Usuario();
            $usu = $u->find_by_id(Auth::get("id"));
            $FOTO_RUTA= PUBLIC_PATH."img/upload/";
            if($usu->foto)
            {
                Usuario::$FOTO = $FOTO_RUTA.$usu->foto;
            }else{
                Usuario::$FOTO = $FOTO_RUTA.Usuario::$FOTO_NOMBRE;
            }
            $p=new Persona();
            $x = $p->hallarXUsuario(Auth::get("id"));
            Usuario::$NOMBRE=$x->ape." ".$x->nom;
            
        }
      
        public static function tieneAcceso($controlador,$accion)
        {
            $sql = "SELECT acceso.permitido 
                    FROM rol INNER JOIN perfil      ON rol.perfil_id          = perfil.id
                             INNER JOIN acceso      ON perfil.id              = acceso.perfil_id
                             INNER JOIN accion      ON acceso.accion_id       = accion.id
                             INNER JOIN controlador ON accion.controlador_id  = controlador.id

                    WHERE rol.usuario_id           = ".Auth::get("id")." 
                      AND acceso.permitido         = 'S'
                      AND accion.accion            = '$accion'
                      AND controlador.controlador  = '$controlador'
                    ";
            $u = new Usuario();
            $lista = $u->find_all_by_sql($sql);
            if(count($lista)<1){
                return FALSE;
            }
            return TRUE;
        }
	public function initialize()
	{
		$this->validates_length_of("nombre", "minumum: 15", "too_short: El nombre debe tener al menos 15 caracteres");
 	    $this->validates_length_of("nombre", "maximum: 40", "too_long: El nombre debe tener maximo 40 caracteres");
		$this->validates_length_of("nombre", "in: 15:40",
		      "too_short: El nombre debe tener al menos 15 caracteres",
		      "too_long: El nombre debe tener maximo 40 caracteres"
		   );
	}
        
        
        public function login() {
            $usu = trim(Input::post("usu"));
            $cla = trim(Input::post("cla"));
            
            $usu = base64_encode($usu);
            $cla = base64_encode($cla);
            $auth = new Auth("model", "class: usuario", "usu: $usu", "cla: $cla");
                    
                if ($auth->authenticate())
                {
                    return TRUE;
                } 
                else 
                {
                    return FALSE;
                }            
        }
        
        public function cambiarClave($clave1,$clave2,$clave3) {
            if(strlen($clave1)<9||strlen($clave2)<9||strlen($clave3)<9)
            {
                Flash::error("Las Claves No Pueden tener Menos de 9 Caracteres");
                return FALSE;
            }
            $clave1 = base64_encode($clave1);
            if($clave1!=Auth::get("cla"))
            {
                Flash::error("Las Claves Actual No Coincide con el usuario actual");
                return FALSE;
            }
            if($clave2!=$clave3)
            {
                Flash::error("Las Nuevas Claves Deben Ser Iguales");
                return FALSE;
            }
            $clave2 = base64_encode($clave2);
            $u=new Usuario();
            $usu=$u->find_by_id(Auth::get("id"));
            $usu->cla=$clave2;
            if(!$usu->update())
            {
                Flash::error("No se pudo Cambiar la clave. Intentelo Mas tarde");
                return FALSE;
            }
            return true;
        }
        
        public function cambiarFotoPerfil() {
            if($_FILES["seleccionar"]["error"]>0)
            {
                Flash::warning("La imagen Tiene errores");
                return FALSE;
            }
                
            //Usamos el adapter 'image'
            $file = Upload::factory("seleccionar", 'image');
            //le asignamos las extensiones a permitir
            $file->setExtensions(array('jpg', 'png', 'gif', 'jpeg','bmp'));
            //Intenta subir el archivo
            if (!$file->isUploaded()) 
            {
                Flash::warning("No se pudo subir la imagen");
                return FALSE;
            }
            $now = DateTime::createFromFormat("U.u", microtime(true));
            $azar= "p".$now->format("Y-m-d-H-i-s_u");            
            
            $foto_azar= $file->save($azar);
            if (!$foto_azar) 
            {
                Flash::warning("No se pudo subir la imagen con nombre azaroso ($azar)");
                return FALSE;
            }
            $u = $this->find_by_id(Auth::get("id")); 
            $u->foto = $foto_azar;
            if(!$u->update())
            {
                Flash::warning("No se pudo actualizar la foto en la DB");
                return FALSE;
            }
            return TRUE;
        }

        public function quitarFotoPerfil() {
            $sql = "UPDATE usuario SET foto =NULL WHERE id = ".Auth::get("id"); 
            if(!$this->sql($sql))
            {
                Flash::warning("Quitar la Foto. Prueba Mas tarde, por favor");
                return FALSE;
            }
            return TRUE;
        }
}
 ?>