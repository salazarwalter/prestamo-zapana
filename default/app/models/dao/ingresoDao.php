<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ingresoDao
 *
 * @author salazarwalter
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class IngresoDao {
    
///**********************  1er Paso de Registracion -   Registro del Usuario y Envio de EMail *******************///
    public function registrarme($vector) {
        $vector["mail"]     = trim($vector["mail"]);
        $vector["nom"]      = trim($vector["nom"]);
        $vector["ape"]      = trim($vector["ape"]);
        $vector["cla1"]     = trim($vector["cla1"]);
        $vector["cla2"]     = trim($vector["cla2"]);
        $vector["pais"]     = trim($vector["pais"]);
        $vector["cel"]      = trim($vector["cel"]);

        if(empty($vector["cel"])   ||
           empty($vector["mail"])  ||
           empty($vector["nom"])   ||
           empty($vector["ape"])   ||
           empty($vector["cla2"])  ||
           empty($vector["cla1"])  || 
           empty($vector["pais"])){
            $this->message="Faltan datos (Apellido y Nombre, Mail,Clave,Celular Son obligatorios)";
            return FALSE;
        }
        
        if (!filter_var($vector["mail"], FILTER_VALIDATE_EMAIL)) {
            $this->message="'{$vector["mail"]}' No es un E-Mail V&aacute;lido";
            return FALSE;
        }
        
        if (strlen($vector["cla1"])<8 || strlen($vector["cla2"])<8 ) {
            $this->message="Las claves debe tener al menos 8 caracteres";
            return FALSE;
        }
        
        if ($vector["cla1"]!=$vector["cla2"]) {
            $this->message="Las claves debe ser iguales";
            return FALSE;
        }
        
//        if(!$this->validarCaptcha()){
//            $this->message="El CAPTCHA No es valido (prueba del robot)";
//            return FALSE;
//        }

        $this->mailNoCode=$vector["mail"];
        $usuTemp = new Usuario();
        
        $c= $usuTemp->count("usu='{$vector["mail"]}'");
        if($c>0){
            $this->message="Este E-Mail ya esta Registrado";
            return FALSE;
        }
        $this->parametros= base64_encode(base64_encode($vector["mail"]).
                "-". base64_encode($vector["nom"]).
                "-". base64_encode($vector["ape"]).
                "-". base64_encode($vector["cla1"]).
                "-". base64_encode($vector["pais"]).
                "-". base64_encode($vector["cel"]));

        if(! $this->enviarMailConfirmacion()){
             $this->message="No se Pudo Enviar el EMail de Verificaci&oacute;n. Registro Cancelado (".$this->errorMail.")";
             //$usuTemp->rollback();
             return FALSE;
            }
//        $usuTemp->commit();    
        return TRUE;
    }
    
    public function enviarMailConfirmacion() {
        Load::lib("phpmailer/Exception");
        Load::lib("phpmailer/PHPMailer");
        Load::lib("phpmailer/SMTP");
        // Instantiation and passing `true` enables exceptions
        $this->errorMail="";
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
//            $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->Host       = 'smtp.hostinger.com.ar ';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
//            $mail->Username   = 'mi.moneda.2019@gmail.com';                     // SMTP username
            $mail->Username   = 'no_responder@itswg.com';                     // SMTP username
//            $mail->Password   = '2019.@dm1n';                               // SMTP password
            $mail->Password   = 'n0R3sp0nd3er.@pun#';                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
           // $mail->setFrom('mi.moneda.2019@gmail.com', '<No Responder>');
            $mail->setFrom('no_responder@itswg.com', '<No Responder>');
//            $mail->addAddress('salazarwalter@gmail.com', 'Walter Salazar');     // Add a recipient
            $mail->addAddress($this->mailNoCode, '');     // Add a recipient
            // Content

            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Confirmacion de Cuenta';
            $mail->Body    = $this->htmlBody();
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            return $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            $this->errorMail= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            
        }
        return FALSE;
    }
    private function htmlBody() {
        //Load::lib("crypto");

        //$text= Crypto::encriptar("{$this->id}");
        return "<div style='background-color: #b2a7f8; padding: 20px;'>
                        <h3>Confirmaci&oacute;n de Registro</h3>
                        <p>Este es el &uacute;ltimo paso para usar el sistema <span style='font-size: large; color: #00f'> My Money($$) </span></p>
                        <p>Haga Click Aqu&iacute; para Concluir <a href='".Usuario::$LINK_CONFIRMAR."/{$this->parametros}' style='font-size: larger; border-color: #007bff; background-color: #007bff'>CONFIRMAR</a></p>
                    </div>";
    }
        
public function registroSatisfactorio($parametros)    
{
//    die($parametros);
    $param = base64_decode($parametros);
//    print_r($param);
//    echo "<br>";
    list($mail, $nom, $ape, $cla, $pais, $cel) = explode('-', $param);
    $mail = base64_decode($mail);
    $nom  = base64_decode($nom);
    $ape  = base64_decode($ape);

    $pais = base64_decode($pais);
    $cel  = base64_decode($cel);
    $usu = new Usuario();
    $usu->begin();
    $usu->usu  = $mail;
    $usu->cla  = $cla;
    if(!$usu->create()){
        Flash::error("No Se pudo actualizar el usuario para Confirmar registración");
        $usu->rollback();
        return FALSE;
    }
    $per             = new Persona();
    $per->ape        = $ape;
    $per->nom        = $nom;
    $per->cel        = $cel;
    $per->pais       = $pais;
    $per->usuario_id = $usu->id;;
    if(!$per->create()){
        Flash::error("No Se pudo actualizar el usuario para Confirmar registracion");
        $usu->rollback();
        return FALSE;
    }
    $mod = new Modulo();
    $lista = $mod->perfilesIniciales();
    foreach ($lista as $value) {
        $rol = new Rol();
        $rol->usuario_id = $usu->id;
        $rol->perfil_id  = $value->perfil_id;
        if(!$rol->create()){
            Flash::error("No Se pudo actualizar los perfiles para Confirmar registracion");
            $usu->rollback();
            return FALSE;
        }
    }
    $usu->commit();
    return TRUE;
    
//    die("MAIL=$mail NOM=$nom APE=$ape CLAVE=$cla PAIS=$pais CELU=$cel");
}

///**********************  2do Paso de Registracion -   Confirmacion de Registro Via EMail *******************///
    public function confirmar($vec) {
        Load::lib("crypto");
        $usuTemp = new Xusuario();
//        echo "<table border ='1'>";
//        echo "<tr>";
//        echo "<td>";
//        $i=100;
//        $vec=array();
//        while($i<200){
//            $texto= Crypto::encriptar("{$i}");
//            echo $i." --> $texto <br>";
//            $vec[] = $texto;
//            $i++;
//        }
//        echo "</td>";
//        echo "<td>";
//        foreach ($vec as $value) {
//            echo " --> $value ".Crypto::desencriptar($value)."<br>";
//        }
//        echo "</td>";
//        echo "</tr>";
//        echo "</table>";
//        die();
         $id= Crypto::desencriptar($vec);         
//        echo $id;
//        die();
         $usu= $usuTemp->find_by_id((int)$id);
         if(!$usu){
             $this->message = "Usuario No Identificado";
             return FALSE;
         }
         if($usu->confirmado=="S" || $usu->activo=="N"){
            $this->message="Usuario Ya Registrado y Confirmado. Elija la opcion Ingresar";
             return FALSE;
//             die("ya confirmado - No Puede Ingresar");             
         }
         $usu->confirmado="S";
         if(!$usu->save()){
            $this->message="No se Pudo Confirmar la registracion del usuario";
             return FALSE;             
         }
         $this->message="Confirmaci&oacute;n Terminada. Por favor, Elija Ingresar al Sistema.";
        return TRUE;
    }

/***************************************************************************************************************/
/***************************************************************************************************************/
///**********************  INGRESO AL SISTEMA  ***************************************************///
    
    public function ingresar($vector) {
        $mail      = trim($vector["mail"]);
        $clave     = trim($vector["clave"]);
        
        if(empty($mail)||empty($clave)){
            Flash::error("Faltan datos Para Ingresar");
            return FALSE;
        }
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            Flash::error("'$mail' No es un E-Mail V&aacute;lido");
            return FALSE;
        }
        if (strlen($clave)<8) {
            Flash::error("La clave debe tener al menos 8 caracteres");
            return FALSE;
        }

        $clave   = base64_encode($clave);

        if(! $this->autentificacion($mail, $clave)){
            Flash::error("USUARIO NO RECONOCIDO POR EL SISTEMA");
            return FALSE;
        }
        return TRUE;
    }
    
    private function autentificacion($mail,$clave) {
        $auth = new Auth("model", "class: usuario", "usu: $mail", "cla: $clave");
        return $auth->authenticate();
    }
    
}
