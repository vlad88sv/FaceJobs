<?php
// control de envío de correos electronicos
/*
 Funciones:
 + Wrapper para envio de todos los correos
  
 Limites:
 + No maneja plantillas de correo
  
 Datos:
 + Fecha de creación: 5 de Septiembre de 2011
 + Creado por: http://code.google.com/a/apache-extras.org/p/phpmailer/ , Vladimir Hidalgo
 + Diseño: http://code.google.com/a/apache-extras.org/p/phpmailer/ , Vladimir Hidalgo
 + Mantemiento:  http://code.google.com/a/apache-extras.org/p/phpmailer/ , Vladimir Hidalgo
*/
function correo($para, $asunto, $mensaje,$html=true)
{
    require_once(_BASE.'extra/PHPMailer/class.phpmailer.php');
    $Mail               = new PHPMailer();
    $Mail->IsHTML       ($html) ;
    $Mail->SetLanguage  ("es", _BASE.'PHP/language/');
    $Mail->PluginDir	= _BASE.'PHP/';
    $Mail->Mailer	= 'smtp';
    $Mail->SMTPSecure    = "ssl";
    $Mail->SMTPAuth	= true;
    $Mail->CharSet	= "utf-8";
    $Mail->Encoding	= "quoted-printable";
    $Mail->Subject	= $asunto;
    $Mail->Body		= $mensaje;
    
    $Mail->Host		= $_config['smtp_host'];
    $Mail->Port		= $_config["smtp_port"];
    $Mail->Username	= $_config["smtp_usuario"];
    $Mail->Password	= $_config["smtp_clave"];
    $mail->From         = $_config["smtp_correo"];
    $mail->FromName     = $_config["smtp_nombre"];    
    
    $correos = preg_split('/,/',$para);
    foreach($correos as $correo)
        $Mail->AddAddress ($correo);

    return  $Mail->Send();
   
}
?>