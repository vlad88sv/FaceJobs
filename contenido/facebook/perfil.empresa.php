<?php
general::requerirModulo(array('plantilla','campos','plantilla-general'));

general::registrarScriptJS('fileuploader','fileuploader');
?>
<h1><img src="img/empresas/edificio.gif" /> Perfil de Empresa</h1>
<?php
$plantilla = new pln();
$plantilla->procesar('perfil.empresa');
echo $plantilla->pln;
?>