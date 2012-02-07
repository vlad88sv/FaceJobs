<?php
general::requerirModulo(array('plantilla','campos','plantilla-general'));

general::registrarScriptJS('fileuploader','fileuploader');
?>
<h1><img src="img/empresas/edificio.gif" /> Registro de empresas</h1>
<?php
$plantilla = new pln();
$plantilla->procesar('registro_empresas');
echo $plantilla->pln;
?>