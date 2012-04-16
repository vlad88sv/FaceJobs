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
  
  if (isset($_POST['VistaLazo']) && isset($_POST['serial']))
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

    // ToDo: validación de datos, denegar guardar la tabla si algún campo no cumple los requisitos.
    // Guardemos
    foreach ($op AS $tabla => $DATOS)
    {
        $DATOS['ID_cuenta'] = usuario::$info['ID_cuenta'];
        db::reemplazar($tabla, $DATOS);
    }
    // Guardemos //**************
  }

  if (isset($_POST['VistaLazo']) && isset($_POST['borrar']) && isset($_POST['lazo']))
  {
    $c = 'DELETE FROM '.db::codex($_POST['lazo']).' WHERE ID_cuenta="'.usuario::$info['ID_cuenta'].'" AND ID_'.db::codex($_POST['lazo']).'="'.db::codex($_POST['borrar']).'" LIMIT 1';
    $r = db::consultar($c);
    // No retornar, que pase a if (isset($_POST['VistaLazo'])) para mandar el contenido actualizado
  }

  if (isset($_POST['VistaLazo']) && isset($_POST['editar']))
  {
    $c = 'SELECT * FROM '.db::codex($_POST['VistaLazo']).' WHERE ID_cuenta="'.usuario::$info['ID_cuenta'].'" AND ID_'.db::codex($_POST['VistaLazo']).'="'.db::codex($_POST['editar']).'" LIMIT 1';
    $r = db::consultar($c);
    $f = mysql_fetch_assoc($r);
    unset($f['ID_cuenta'],$f['actualizacion']);
    echo json_encode($f);
    return;
    // retonar, no neecesitamos actualizar la vista aun.
  }  

  if (isset($_POST['VistaLazo']))
  {
    echo CargarVistaLazo($_POST['VistaLazo']);
  }
  
  function CargarVistaLazo($lazo,$virtual=false,$clave_Padre='',$ID_padre=0)
  {
    general::requerirModulo(array('plantilla.campos','campos.busqueda','campos','cv'));
    
    if (!is_array(campos::$deflazo[$lazo]['campos']) || !is_array((campos::$deflazo[$lazo]['vista'])) || (!$virtual && isset(campos::$deflazo[$lazo]['vistaVirtual'])) )
      return;
    
    $retorno = '';
    
    $ID_table = 2;
    foreach(campos::$deflazo[$lazo]['campos'] as $campo)
    {
	if (!isset(campos::$defcampos[$campo]))
	    continue;
	
	if (!preg_match('/(.*)\.(.*)/',$campo,$partes))
	    continue;  
	    
	$campos[] = $partes[2];
	
	if (campos::$defcampos[$campo]['tipo'] == uiForm::$comboboxPaises)
	{ 
	    campos::$defcampos[$campo]['datos']['tabla'] = 'datos_pais';
	    campos::$defcampos[$campo]['datos']['clave'] = 'ID_pais';
	    campos::$defcampos[$campo]['datos']['valor'] = 'pais';
	}
	
	if(isset(campos::$defcampos[$campo]['datos']) && is_array(campos::$defcampos[$campo]['datos']) && isset(campos::$defcampos[$campo]['datos']['tabla']) && isset(campos::$defcampos[$campo]['datos']['clave']) && isset(campos::$defcampos[$campo]['datos']['valor']))
	{
	    $filtros = '';
	    if (@is_array(campos::$defcampos[$campo]['datos']['filtros']))
	    {
		if (in_array('mios', campos::$defcampos[$campo]['datos']['filtros']))
		{
			$filtros = 'AND ID_cuenta='.usuario::$info['ID_cuenta'];
		}
	    }
	    $campos[] = '(SELECT '.campos::$defcampos[$campo]['datos']['valor'].' FROM '.campos::$defcampos[$campo]['datos']['tabla'].' AS t'.$ID_table.' WHERE t'.$ID_table.'.'.campos::$defcampos[$campo]['datos']['clave'].' = t1.'.$partes[2].' '.$filtros.') AS '.$partes[2].'_valor';			
	    $ID_table++;
	}
	
	if(isset(campos::$defcampos[$campo]['valores']))
	{
	    $tmpCampo = '(CASE '.$partes[2];
	    
	    foreach (campos::$defcampos[$campo]['valores'] as $key => $value) {
		    $tmpCampo .= ' WHEN "'.$key.'" THEN "'.$value.'"';
	    }
	    
	    $campos[] = $tmpCampo.' END) AS '.$partes[2].'_valor';
	}
    }

    if (is_array(@campos::$deflazo[$lazo]['vistaCamposExtra']))
    {
      foreach(campos::$deflazo[$lazo]['vistaCamposExtra'] as $campo)
      {
	  $campos[] = $campo;	
      }
    }
    
    $tabla = isset(campos::$deflazo[$lazo]['paraTabla'])  ? campos::$deflazo[$lazo]['paraTabla'] : $lazo;
    $c = 'SELECT ID_'.$tabla.', '.implode(',',$campos).' FROM '.$tabla .' AS t1 WHERE ID_cuenta="'.usuario::$info['ID_cuenta'].'"'.($virtual && $clave_Padre && $ID_padre ? " AND $clave_Padre='$ID_padre'" : '');
    
    $r = db::consultar($c);
    while ($f = mysql_fetch_assoc($r) )
    {
      $retorno .= '<div class="'.($virtual ? 'lazoVistaVirtual' : 'lazoVista').' '.@campos::$deflazo[$lazo]['vista']['class'].'">';
      if (!$virtual) $retorno .= '<span class="lazoVistaBolita">•</span>';
      $retorno .= '<span class="lazoVistaControles"><a rel="'.$f['ID_'.$_POST['VistaLazo']].'" class="lazoVistaControlesEditar" href="#"><img src="img/boton_editar.gif" /></a><br /><a rel="'.$f['ID_'.$_POST['VistaLazo']].'" class="lazoVistaControlesEliminar" href="#"><img src="img/boton_borrar.gif" /></a></span>';
      $retorno .= '<table><tr>';
      if (isset(campos::$deflazo[$lazo]['vista']))
      {
	foreach(campos::$deflazo[$lazo]['vista'] as $columna => $filas)
	{
	  if (!is_array($filas))
	    continue;
	  $retorno .= '<td><table>';
	    foreach ($filas as $fila => $contenido) {
	      foreach ($f as $campo => $valor) {
		$contenido = preg_replace('/\$\$'.$campo.'\$\$/', $valor, $contenido);
	      }
	      $retorno .= '<tr><td>'.$contenido.'</td></tr>';
	    }
	  $retorno .= '</table></td>';
	}
      }
      $retorno .= '</tr></table>';
      
      if (is_array(@campos::$deflazo[$lazo]['vistaUniones']))
      {
	  $retorno .= '<br />';
	  foreach (campos::$deflazo[$lazo]['vistaUniones'] as $Vista) {
	    $retorno .= '<div class="contenedorLazoVista" id="vista_'.$Vista.'" rel="'.$Vista.'">';
	    $retorno .= CargarVistaLazo($Vista,true,'ID_'.$tabla,$f['ID_'.$tabla]);
	    $retorno .= '</div>';
	  }
      }
      $retorno .= '</div>';
    }
    $retorno .= '<br style="clear:both;" />';
    
    return $retorno;
  }
?>