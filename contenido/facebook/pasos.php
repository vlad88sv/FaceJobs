<?php
general::requerirModulo(array('plantilla','campos','plantilla-general'));

general::registrarEstiloCSS('pasos','pasos');
general::registrarEstiloCSS('FaceBox','facebox');

ob_start();

$paso = @$_GET['p'];

if (!is_numeric($paso) || $paso < 1 || $paso > 9)
    $paso = 1;

general::requerirModulo(array('plantilla','cv'));

general::registrarEstiloCSS('FaceBox','facebox');

general::registrarScriptJS('fileuploader','fileuploader');
general::registrarScriptJS('FaceBox','jquery.facebox');

$plantilla = new pln();

$plantilla->procesar('pasos/paso_'.$paso);

echo $plantilla->pln;

$buffer = ob_get_clean();

CrearPlantillaGeneral($buffer);
?>