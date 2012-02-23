<?php
general::requerirModulo(array('plantilla','cv','plantilla-general'));

general::registrarScriptJS('fileuploader','fileuploader');

$plantilla = new pln();
$plantilla->procesar('perfil.candidato');
echo $plantilla->pln;
?>