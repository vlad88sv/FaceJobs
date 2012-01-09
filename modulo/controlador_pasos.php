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

general::registrarScriptJS('fileuploader','fileuploader');

$plantilla = new pln();

$plantilla->procesar('pasos/paso_'.$paso);

body::agregarContenidoAlContenido($plantilla->pln);
body::agregarContenidoAlContenido('<div id="controlador_pasos">');
if ($paso > 1)
    body::agregarContenidoAlContenido('<div id="paso_anterior"><a href="'.PROY_URL.'paso.html?p='.(max(($paso-1),1)).'"><img src="img/paso_anterior.png" />Anterior</a></div>');
if ($paso < 9)
    body::agregarContenidoAlContenido('<div id="paso_siguiente"><a href="'.PROY_URL.'paso.html?p='.(min(($paso+1),9)).'">Siguiente<img src="img/paso_siguiente.png"  /></a></div>');
body::agregarContenidoAlContenido('</div>');
ob_start();
?>
<script>
$(function() {

$("select.auto").change(function() {
    $(this).after('<img class="guardando g_'+$(this).attr("id")+'" src="img/ajax.gif" />');
    $.post('ajax',{campo:$(this).attr("rel"), valor:$(this).val()},function() {$(".guardando").remove()},"html");
    $(this).removeClass("sucio");
});

$("input:text.auto").change(function(){$(this).addClass("sucio");})

$("input:text.auto").focusout(function() {
  if ($(this).hasClass("sucio"))
  {
    $(this).after('<img class="guardando g_'+$(this).attr("id")+'" src="img/ajax.gif" />');
    $.post('ajax',{campo:$(this).attr("rel"), valor:$(this).val()},function() {$(".guardando").remove()},"html");
    $(this).removeClass("sucio");
  }
});

$("input:radio.auto").click(function() {
    $(this).after('<img class="guardando g_'+$(this).attr("id")+'" src="img/ajax.gif" />');
    $.post('ajax',{campo:$(this).attr("rel"), valor:$(this).val()},function() {$(".guardando").remove()},"html");
    $(this).removeClass("sucio");
});

$("input:checkbox.auto").click(function() {
    $(this).after('<img class="guardando g_'+$(this).attr("id")+'" src="img/ajax.gif" />');
    $.post('ajax',{campo:$(this).attr("rel"), valor:($(this).attr("checked") ? "1" : "0")},function() {$(".guardando").remove()},"html");
    $(this).removeClass("sucio");
    
});

$(".autoLazo").click(function() {
	event.preventDefault();
	$("#lazo_"+$(this).attr("rel")+ " .lazoCampos").prepend('<div class="guardando_form" style="text-align:center;"><img src="img/ajax.gif" /> Guardando...</div>');
	$.post('ajax',{serial:$("#lazo_"+$(this).attr("rel")).serialize()},$.proxy(function() {
		$(".guardando_form").remove();
		cargarContenedorLazoVista($(this).attr("vista"));
	},this),"html");
	$("#lazo_"+$(this).attr("rel"))[0].reset();
});

$(".reset").click(function() {
	event.preventDefault();
	$("#lazo_"+$(this).attr("rel"))[0].reset();
});

function cargarContenedorLazoVista(id)
{
	$("#vista_"+id).load("ajax", {VistaLazo:id});
}

$(".contenedorLazoVista").each(function(){
	cargarContenedorLazoVista($(this).attr("rel"));
});

$(".lazoVistaControlesEditar").live("click",function(){
    event.preventDefault();
    var ID = $(this).attr("rel");
    var Lazo = $(this).parents(".contenedorLazoVista").attr("rel");
    $.post("ajax", {VistaLazo:Lazo,editar:ID}, function(data){
        jQuery.each(data, function(i, val) {
            $('#'+Lazo+'_'+i).val(val);
        });
    }, "json");
});

$(".lazoVistaControlesEliminar").live("click",function(){
    event.preventDefault();
    var EliminarID = $(this).attr("rel");
    var Lazo = $(this).parents(".contenedorLazoVista").attr("rel");
    $(this).parents(".contenedorLazoVista").load("ajax", {VistaLazo:Lazo,borrar:EliminarID});
});

$(".cargar-archivo").each(function(){
    new qq.FileUploaderBasic({
        button: $(this)[0],
        identificador: this,
        action: '<?php echo PROY_URL; ?>carga',
        showMessage: function(message){ alert(message); },
        debug: false,
        allowedExtensions: ['jpg', 'png', 'jpeg', 'gif'],
        onSubmit: function(id, fileName){$('#'+$(this.identificador).attr('rel')).attr('src','img/ajax2.gif');},
        onProgress: function(id, fileName, loaded, total){},
        onComplete: function(id, fileName, responseJSON){$('#'+$(this.identificador).attr('rel')).attr('src','crop_110_110_'+responseJSON.hash+'.jpg');}
    });

});

}); //Document.Ready()
</script>
<?php head::agregarContenido(ob_get_clean()); ?>