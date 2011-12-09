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
		unset($DATOS);
    }
  }
  
  if (isset($_POST['serial']))
  {
  	// jQuery.unserialize()
    $op = array();
    $pairs = explode("&", $_POST['serial']);
    foreach ($pairs as $pair) {
        list($k, $v) = array_map("urldecode", explode("=", $pair)); 
        preg_match('/(.*)\.(.*)/',$k,$partes);
        $op[$partes[1]][$partes[2]] = $v; 
    }
	// jQuery.unserialize() //**************

	// Guardemos
	foreach ($op AS $tabla => $DATOS)
	{
		$DATOS['ID_cuenta'] = usuario::$info['ID_cuenta'];
		db::reemplazar($tabla, $DATOS);
	}
	// Guardemos //**************
  }
  
  if (isset($_POST['VistaLazo']))
  {
  	general::requerirModulo(array('ui','cv'));
	
	if (!is_array(cv::$deflazo[$_POST['VistaLazo']]['campos']))
		return;
	
  	$c = 'SELECT '.implode(',',cv::$deflazo[$_POST['VistaLazo']]['campos']).' FROM '.$_POST['VistaLazo'];
  	$r = db::consultar($c);
  	while ($f = mysql_fetch_assoc($r) )
	{
		echo '<pre>';
		print_r($f);
		echo '</pre>';
	}
  }
?>