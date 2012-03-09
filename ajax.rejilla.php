<?php
require_once('arranque.php');
sesion::iniciar_sesion();

if (!sesion::iniciado())
    return;

if (usuario::$info['tipo'] == usuario::$tipoCandidato) {
} else {    
    if (isset ($_POST['carreras']) && is_array($_POST['carreras']))
    {
	$where[] = 'paso2_educacion_superior.`ID_area_estudio` IN ('.implode(',',$_POST['carreras']).')';
    }
    
    if (isset ($_POST['bachillerato']) && is_array($_POST['bachillerato']))
    {
	$where[] = 'paso2_educacion_secundaria.`ID_area_estudio` IN ('.implode(',',$_POST['bachillerato']).')';
    }
    
    if (isset ($_POST['domicilios']) && is_array($_POST['domicilios']))
    {
	$where[] = 'paso1_personal.`ciudad_de_domicilio` IN ("'.implode('","',$_POST['domicilios']).'")';
    }
    
    if (isset ($_POST['edad_min']) && is_numeric($_POST['edad_min']))
    {
	$where[] = 'paso1_personal.`fecha_nacimientoAno` <= (YEAR(NOW())-'.$_POST['edad_min'].')';
    }

    if (isset ($_POST['edad_max']) && is_numeric($_POST['edad_max']))
    {
	$where[] = 'paso1_personal.`fecha_nacimientoAno` >= (YEAR(NOW())-'.$_POST['edad_max'].')';
    }

    if (isset ($_POST['edad_max']) && is_numeric($_POST['edad_max']))
    {
	$where[] = 'paso1_personal.`fecha_nacimientoAno` >= (YEAR(NOW())-'.$_POST['edad_max'].')';
    }

    if (isset ($_POST['oficios']) && is_array($_POST['oficios']))
    {
	$where[] = 'paso6_oficios.`ID_oficio` IN ("'.implode('","',$_POST['oficios']).'")';
    }    
    
    if (isset($_POST['expectativa_salarial']) && is_numeric($_POST['expectativa_salarial']))
    {
	switch ($_POST['expectativa_salarial'])
	{
	    case $_POST['expectativa_salarial'] <= '250':
		$expectativa_salarial = 0;
		break;
	    case $_POST['expectativa_salarial'] <= '500':
		$expectativa_salarial = 1;
		break;
	    case $_POST['expectativa_salarial'] <= '750':
		$expectativa_salarial = 2;
		break;
	    case $_POST['expectativa_salarial'] <= '1000':
		$expectativa_salarial = 3;
		break;
	    case $_POST['expectativa_salarial'] <= '1500':
		$expectativa_salarial = 4;
		break;
	    case $_POST['expectativa_salarial'] <= '2000':
		$expectativa_salarial = 5;
		break;
	    case $_POST['expectativa_salarial'] <= '3000':
		$expectativa_salarial = 6;
		break;
	}
	
	$where[] = 'paso0.`ID_expectativa_salarial` IN ('.($expectativa_salarial-2).','.($expectativa_salarial-1).','.($expectativa_salarial).','.($expectativa_salarial+1).')';
    }

    if (isset ($_POST['otros']))
    {
	if (!(in_array('masculino',$_POST['otros']) && in_array('femenino',$_POST['otros'])))
	{	
	    if (in_array('masculino',$_POST['otros']))
	    {
		$where[] = 'paso1_personal.`sexo` = "masculino"';
	    }
	    
	    if (in_array('femenino',$_POST['otros']))
	    {
		$where[] = 'paso1_personal.`sexo` = "femenino"';
	    }
	}
	
	if (in_array('licencia_conducir',$_POST['otros']))
	    $where[] = 'paso1_personal.`licencia_conducir` = "1"';

	if (in_array('vehiculo_propio',$_POST['otros']))
	    $where[] = 'paso1_personal.`vehiculo` = "1"';

    	if (in_array('disponibilidad_viajar',$_POST['otros']))
	    $where[] = 'paso1_personal.`disponibilidad_viajar` = "1"';
	    
	if (in_array('tiempo_completo',$_POST['otros']))
	    $where[] = 'paso1_personal.`solo_medio_tiempo` = "0"';
    }

    if (isset ($_POST['puestos']) && is_array($_POST['puestos']))
    {
	$where[] = 'paso3_cargos.`ID_puesto_desempenado` IN ("'.implode('","',$_POST['puestos']).'") OR paso4_expectativa_laboral.ID_area_interes IN ("'.implode('","',$_POST['puestos']).'")';
    }    

    if (isset ($_POST['actividadesEconomicas']) && is_array($_POST['actividadesEconomicas']))
    {
	$where[] = 'paso3_empresa.`ID_actividad_economica` IN ("'.implode('","',$_POST['actividadesEconomicas']).'")';
    }    

}

$w = implode(' AND ', $where);

$consulta = "SELECT ID_cuenta, nombres, apellidos, foto_hash, (YEAR(NOW()) - paso1_personal.`fecha_nacimientoAno`) AS edad, ID_expectativa_salarial FROM cuentas LEFT JOIN paso0 USING (ID_cuenta) LEFT JOIN paso1_personal USING(ID_cuenta) LEFT JOIN paso2_educacion_superior USING (ID_cuenta) LEFT JOIN paso2_educacion_secundaria USING (ID_cuenta) LEFT JOIN paso3_empresa USING(ID_cuenta) LEFT JOIN paso3_cargos USING (ID_cuenta) LEFT JOIN paso4_expectativa_laboral USING(ID_cuenta) LEFT JOIN paso6_oficios USING(ID_cuenta) WHERE 0 OR $w GROUP BY ID_cuenta";
echo '<code>';
//echo str_replace("\n","<br />",print_r($_POST,true));
//echo $consulta;
echo '</code>';

$resultado = db::consultar($consulta);

general::requerirModulo(array('ui'));

while ($registro = mysql_fetch_assoc($resultado))
{
    $ExpSalarial = array(0 => 'USD $100 - USD $250','USD $250 - USD $500','USD $500 - USD $750','USD $750 - USD $1000','USD $1000 - USD $1500','USD $1500 - USD $2000','USD $2000 - USD $3000','> USD $3000');
    echo '<hr class="ocre"/>';
    echo '<div class="resultado_candidato">';
    echo '<div class="resultado_candidato_img"><img src="'.ui::ObtenerImagen($registro['foto_hash'],70,90,true).'" /></div>';
    echo '<div class="resultado_candidato_col1">'.$registro['edad'].' años</div>';
    echo '<div class="resultado_candidato_divisor"></div>';    
    echo '<div class="resultado_candidato_col2">Aspiración salarial: '.$ExpSalarial[$registro['ID_expectativa_salarial']].'</div>';
    echo '<div class="resultado_candidato_pie"><a href="ver.perfil!'.$registro['ID_cuenta'].'#'.web::SEO($registro['apellidos'].','.$registro['nombres']).'" class="gris">Ver curriculum</a></div>';
    echo '</div>';
}

?>