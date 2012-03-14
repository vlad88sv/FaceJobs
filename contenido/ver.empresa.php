<?php
general::requerirModulo(array('plantilla','campos','plantilla-general'));
$f = db::obtenerPorIndice('empresa_registro','ID_empresa_registro',array($_GET[2]));
ob_start();

echo '<h1>'.$f['nombre_legal'].'</h1>';

echo '<img style="border:1px #CCC solid;height:100px;" src="'.ui::ObtenerImagen($f['foto_hash'],800,100,false).'" />';

echo '<p style="text-align:center;color: #CCC;">Página web: '.$f['pagina_web'].'</p>';

echo '<p style="text-align:center;color: #CCC;">Página web: '.$f['pagina_web'].'</p>';
$plantilla = new pln();
$plantilla->procesar('ver.empresa');
echo $plantilla->pln;

echo '<pre>';
print_r($_GET);
echo '</pre>';

echo '<p>**Lista de trabajos de esta empresa**</p>';
$buffer = ob_get_clean();

CrearPlantillaGeneral($buffer);
?>
