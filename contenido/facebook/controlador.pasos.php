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

general::requerirModulo(array('plantilla','cv'));

$plantilla = new pln();
$plantilla->procesar('pasos/paso_'.$paso);

body::agregarContenidoAlContenido($plantilla->pln);
?>