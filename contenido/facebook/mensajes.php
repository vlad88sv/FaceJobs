<?php
general::requerirModulo(array('plantilla','campos','plantilla-general'));

general::registrarEstiloCSS('pasos','pasos');
general::registrarEstiloCSS('FaceBox','facebox');

ob_start();
?>
<h1><img src="img/mensajes/mensaje.gif" /> Mensajes</h1>
<?php
$plantilla = new pln();
$plantilla->procesar('mensajes');
echo $plantilla->pln;
$buffer = ob_get_clean();

CrearPlantillaGeneral($buffer);
?>