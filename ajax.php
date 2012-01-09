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

  if (isset($_POST['VistaLazo']) && isset($_POST['borrar']))
  {
  	$c = 'DELETE FROM '.$_POST['VistaLazo'].' WHERE ID_cuenta="'.usuario::$info['ID_cuenta'].'" AND ID_'.$_POST['VistaLazo'].'="'.$_POST['borrar'].'"';
	$r = db::consultar($c);
  	// No retornar, que pase a if (isset($_POST['VistaLazo'])) para mandar el contenido actualizado
  }

  if (isset($_POST['VistaLazo']) && isset($_POST['editar']))
  {
  	$c = 'SELECT * FROM '.$_POST['VistaLazo'].' WHERE ID_cuenta="'.usuario::$info['ID_cuenta'].'" AND ID_'.$_POST['VistaLazo'].'="'.$_POST['editar'].'" LIMIT 1';
	$r = db::consultar($c);
        $f = mysql_fetch_assoc($r);
        echo json_encode($f);
        return;
  	// retonar, no neecesitamos actualizar la vista aun.
  }  

  if (isset($_POST['VistaLazo']))
  {
  	CargarVistaLazo(false);
  }
  
  function CargarVistaLazo($virtual=false)
  {
  	general::requerirModulo(array('ui','cv'));
	
	if (!is_array(cv::$deflazo[$_POST['VistaLazo']]['campos']) || !is_array((cv::$deflazo[$_POST['VistaLazo']]['vista'])) || (!$virtual && isset(cv::$deflazo[$_POST['VistaLazo']]['vistaVirtual'])) )
		return;
	
	$ID_table = 2;
	foreach(cv::$deflazo[$_POST['VistaLazo']]['campos'] as $campo)
	{
            if (!isset(cv::$defcv[$campo]))
                continue;
            
            if (!preg_match('/(.*)\.(.*)/',$campo,$partes))
                continue;  
		
            $campos[] = $partes[2];
            
            if (cv::$defcv[$campo]['tipo'] == uiForm::$comboboxPaises)
            { 
                cv::$defcv[$campo]['datos']['tabla'] = 'datos_pais';
                cv::$defcv[$campo]['datos']['clave'] = 'ID_pais';
                cv::$defcv[$campo]['datos']['valor'] = 'pais';
            }
            
            if(isset(cv::$defcv[$campo]['datos']) && is_array(cv::$defcv[$campo]['datos']) && isset(cv::$defcv[$campo]['datos']['tabla']) && isset(cv::$defcv[$campo]['datos']['clave']) && isset(cv::$defcv[$campo]['datos']['valor']))
            {
                $filtros = '';
                if (@is_array(cv::$defcv[$campo]['datos']['filtros']))
                {
                    if (in_array('mios', cv::$defcv[$campo]['datos']['filtros']))
                    {
                            $filtros = 'AND ID_cuenta='.usuario::$info['ID_cuenta'];
                    }
                }
                $campos[] = '(SELECT '.cv::$defcv[$campo]['datos']['valor'].' FROM '.cv::$defcv[$campo]['datos']['tabla'].' AS t'.$ID_table.' WHERE t'.$ID_table.'.'.cv::$defcv[$campo]['datos']['clave'].' = t1.'.$partes[2].' '.$filtros.') AS '.$partes[2].'_valor';			
                $ID_table++;
            }
            
            if(isset(cv::$defcv[$campo]['valores']))
            {
                $tmpCampo = '(CASE '.$partes[2];
                
                foreach (cv::$defcv[$campo]['valores'] as $key => $value) {
                        $tmpCampo .= ' WHEN "'.$key.'" THEN "'.$value.'"';
                }
                
                $campos[] = $tmpCampo.' END) AS '.$partes[2].'_valor';
            }
	}

	if (is_array(@cv::$deflazo[$_POST['VistaLazo']]['vistaCamposExtra']))
	{
            foreach(cv::$deflazo[$_POST['VistaLazo']]['vistaCamposExtra'] as $campo)
            {
                $campos[] = $campo;	
            }
	}
	
  	$c = 'SELECT ID_'.$_POST['VistaLazo'].', '.implode(',',$campos).' FROM '.$_POST['VistaLazo'] .' AS t1';
	
	//echo "<pre>$c</pre>";
  	$r = db::consultar($c);
  	while ($f = mysql_fetch_assoc($r) )
	{
		echo '<div class="'.($virtual ? 'lazoVistaVirtual' : 'lazoVista').' '.@cv::$deflazo[$_POST['VistaLazo']]['vista']['class'].'">';
		if (!$virtual) echo '<span class="lazoVistaBolita">•</span>';
		echo '<span class="lazoVistaControles"><a rel="'.$f['ID_'.$_POST['VistaLazo']].'" class="lazoVistaControlesEditar" href="#"><img src="img/boton_editar.gif" /></a><a rel="'.$f['ID_'.$_POST['VistaLazo']].'" class="lazoVistaControlesEliminar" href="#"><img src="img/boton_borrar.gif" /></a></span>';
		echo '<table><tr>';
		if (isset(cv::$deflazo[$_POST['VistaLazo']]['vista']))
		{
                    foreach(cv::$deflazo[$_POST['VistaLazo']]['vista'] as $columna => $filas)
                    {
                        echo '<td><table>';
                            foreach ($filas as $fila => $contenido) {
                                foreach ($f as $campo => $valor) {
                                        $contenido = preg_replace('/\$\$'.$campo.'\$\$/', $valor, $contenido);
                                }
                                echo '<tr><td>'.$contenido.'</td></tr>';
                            }
                        echo '</table></td>';
                    }
		}
		echo '</tr></table>';
		
		if (is_array(@cv::$deflazo[$_POST['VistaLazo']]['vistaUniones']))
		{
                    echo '<br />';
                    foreach (cv::$deflazo[$_POST['VistaLazo']]['vistaUniones'] as $Vista) {
                        $_POST['VistaLazo'] = $Vista;
                        CargarVistaLazo(true);
                    }
		}
		echo '</div>';
	}
	echo '<br style="clear:both;" />';
  }
?>