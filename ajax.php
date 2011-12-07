<?php
require_once('arranque.php');
sesion::iniciar_sesion();

if (!sesion::iniciado())
    return;

    
  /* El sistema envia via Ajax y codificados en JSON los campos a guardar.
    * nuestra tarea es asegurar que esos campos se guarden en su tabla respectiva,
    * los campos vienen adecuadamente codificados por clave y valor, donde la
    * clave es "tabla.campo" y el valor en base64.
    * Si recibimos el atributo "lazo=tabla" significa que todos los campos recibidos
    * van en una solo registro de 1 sola tabla.
    * todas las tablas sin excepcion cuentan con un ID_cuenta, que no será enviado
    * si no que será inferido de la $info de sesión. Por seguridad no grabaremos nada
    * en nombre de otro usuario que no sea el de la sesión, para evitar secuestro de
    * sesiones.
   */
  
  if (isset($_POST['campo']) && isset($_POST['valor']))
  {
    $partes = null;
            
    if (preg_match('/(.*)\.(.*)/',$_POST['campo'],$partes))
    {
        $DATOS['ID_cuenta'] = usuario::$info['ID_cuenta'];
        $DATOS[$partes[2]] = $_POST['valor'];
    
        db::insertualizar($partes[1],$DATOS);
    }
  }
?>