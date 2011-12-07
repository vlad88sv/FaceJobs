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

general::requerirModulo(array('plantilla'));

general::registrarEstiloCSS('pasos','pasos');

$plantilla = new pln();

$plantilla->procesar('pasos/paso_'.$paso);

body::agregarContenidoAlContenido($plantilla->pln);
body::agregarContenidoAlContenido('<div id="controlador_pasos">');
if ($paso > 1)
    body::agregarContenidoAlContenido('<div id="paso_anterior"><a href="'.PROY_URL.'paso.html?p='.(max(($paso-1),1)).'"><img src="img/paso_anterior.png" />Anterior</a></div>');
if ($paso < 9)
    body::agregarContenidoAlContenido('<div id="paso_siguiente"><a href="'.PROY_URL.'paso.html?p='.(min(($paso+1),9)).'">Siguiente<img src="img/paso_siguiente.png"  /></a></div>');
body::agregarContenidoAlContenido('</div>');

head::agregarContenido(
'<script>
$(function() {

$("input:text.auto, select.auto").change(function(){$(this).addClass("sucio");})

$("input:text.auto, select.auto").focusout(function() {
  if ($(this).hasClass("sucio"))
  {
    $(this).after(\'<img class="guardando g_\'+$(this).attr("id")+\'" src="img/ajax.gif" />\');
    $.post(\'ajax\',{campo:$(this).attr("rel"), valor:$(this).val()},function() {$(".guardando").remove()},"html");
    $(this).removeClass("sucio");
  }
});

$("input:radio.auto").click(function() {
    $(this).after(\'<img class="guardando g_\'+$(this).attr("id")+\'" src="img/ajax.gif" />\');
    $.post(\'ajax\',{campo:$(this).attr("rel"), valor:$(this).val()},function() {$(".guardando").remove()},"html");
    $(this).removeClass("sucio");
});

$("input:checkbox.auto").click(function() {
    $(this).after(\'<img class="guardando g_\'+$(this).attr("id")+\'" src="img/ajax.gif" />\');
    $.post(\'ajax\',{campo:$(this).attr("rel"), valor:($(this).attr("checked") ? "1" : "0")},function() {$(".guardando").remove()},"html");
    $(this).removeClass("sucio");
    
});

});
</script>'
);
?>