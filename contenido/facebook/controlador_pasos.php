<?php
// control de pasos para completar perfil
/*
 Funciones:
 + Cada perfil debe llenar 9 pasos para poder considerarse 100% completo
   esta clase se asegura de coordinar la secuencia de dichos pasos.
  
 Limites:
 + Alcance = gestión de pasos.
  
 Datos:
 + Fecha de creación: 2 de Septiembre de 2011
 + Creado por: Alejandro Molina, Vladimir Hidalgo
 + Diseño: Alejandro Molina
 + Mantemiento:  Vladimir Hidalgo
*/

$paso = @$_GET['p'];

if (!is_numeric($paso) || $paso < 1 || $paso > 9)
{
    $paso = 1;
}

body::agregarAlContenido('ver.pasos',true);

general::requerirModulo(array('plantilla','cv'));

general::registrarEstiloCSS('FaceBox','facebox');

general::registrarScriptJS('fileuploader','fileuploader');
general::registrarScriptJS('FaceBox','jquery.facebox');

$plantilla = new pln();

$plantilla->procesar('pasos/paso_'.$paso);

body::agregarContenidoAlContenido($plantilla->pln);
body::agregarContenidoAlContenido('<div id="controlador_pasos">');
if ($paso > 1)
    body::agregarContenidoAlContenido('<div id="paso_anterior"><a href="'.PROY_URL.'paso.html?p='.(max(($paso-1),1)).'"><img src="img/paso_anterior.png" />Anterior</a></div>');
if ($paso < 9)
    body::agregarContenidoAlContenido('<div id="paso_siguiente"><a href="'.PROY_URL.'paso.html?p='.(min(($paso+1),9)).'">Siguiente<img src="img/paso_siguiente.png"  /></a></div>');
body::agregarContenidoAlContenido('</div>');
?>