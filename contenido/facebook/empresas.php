<?php
general::requerirModulo(array('plantilla','campos','plantilla-general'));

general::registrarEstiloCSS('FaceBox','facebox');

ob_start();
?>
<h1><img src="img/empresas/edificio.gif" /> Empresas</h1>
<?php
$plantilla = new pln();
$plantilla->procesar('empresas');
echo $plantilla->pln;
$buffer = ob_get_clean();

CrearPlantillaGeneral($buffer);
?>