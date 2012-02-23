<?php ob_start(); ?>
<script>
$(function() {

$("select.auto").live("change",function() {
    $(this).after('<img class="guardando g_'+$(this).attr("id")+'" src="img/ajax.gif" />');
    $.post('ajax',{campo:$(this).attr("rel"), valor:$(this).val()},function() {$(".guardando").remove()},"html");
    $(this).removeClass("sucio");
});

$("input:text.auto").live("change",function(){$(this).addClass("sucio");})

$("input:text.auto").live("focusout",function() {
  if ($(this).hasClass("sucio"))
  {
    $(this).after('<img class="guardando g_'+$(this).attr("id")+'" src="img/ajax.gif" />');
    $.post('ajax',{campo:$(this).attr("rel"), valor:$(this).val()},function() {$(".guardando").remove()},"html");
    $(this).removeClass("sucio");
  }
});

$("input:radio.auto").live("click",function() {
    $(this).after('<img class="guardando g_'+$(this).attr("id")+'" src="img/ajax.gif" />');
    $.post('ajax',{campo:$(this).attr("rel"), valor:$(this).val()},function() {$(".guardando").remove()},"html");
    $(this).removeClass("sucio");
});

$("input:checkbox.auto").live("click",function() {
    $(this).after('<img class="guardando g_'+$(this).attr("id")+'" src="img/ajax.gif" />');
    $.post('ajax',{campo:$(this).attr("rel"), valor:($(this).attr("checked") ? "1" : "0")},function() {$(".guardando").remove()},"html");
    $(this).removeClass("sucio");
    
});

$(".autoLazo").live("click",function() {
	event.preventDefault();
	$("#lazo_"+$(this).attr("rel")+ " .lazoCampos").prepend('<div class="guardando_form" style="text-align:center;"><img src="img/ajax.gif" /> Guardando...</div>');
	$("#vista_"+$(this).attr("vista")).load('ajax',{VistaLazo: $(this).attr("vista"), serial:$("#lazo_"+$(this).attr("rel")).serialize()},$.proxy(function() {
		$(".guardando_form").remove();
	},this),"html");
	$("#lazo_"+$(this).attr("rel"))[0].reset();
        $("#"+$(this).attr("rel")+"_ID_"+$(this).attr("rel")).val("0");
});

$(".reset").live("click",function() {
	event.preventDefault();
	$("#lazo_"+$(this).attr("rel"))[0].reset();
        $("#"+$(this).attr("rel")+"_ID_"+$(this).attr("rel")).val("0");
});

$(".lazoVistaControlesEditar").live("click",function(){
    event.preventDefault();
    var ID = $(this).attr("rel");
    var Lazo = $(this).parents(".contenedorLazoVista").attr("rel");
    $("#lazo_"+Lazo+ " .lazoCampos").prepend('<div class="guardando_form" style="text-align:center;"><img src="img/ajax.gif" /> Cargando para edición...</div>');
    $.post("ajax", {VistaLazo:Lazo,editar:ID}, function(data){
        jQuery.each(data, function(i, val) {
            try {
                tag = $('#'+Lazo+'_'+i).get(0).tagName.toLowerCase();
            } catch (err) {
                return true;
            }
            switch(tag)
            {
                case 'input':
                    switch ($('#'+Lazo+'_'+i).attr('type'))
                    {
                        case 'hidden':
                        case 'text':
                            $('#'+Lazo+'_'+i).val(val);
                            break;
                        case 'radio':
                            $('#'+Lazo+'_'+i+'[value="'+val+'"]').attr("checked","checked");
                            break;
                        case 'checkbox':
                            if (val == 1) $('#'+Lazo+'_'+i).attr("checked","checked");
                            break;
                    }
                    break;
                case 'textarea':
                case 'select':
                    $('#'+Lazo+'_'+i).val(val);
                    break;
            }
            $(".guardando_form").remove();
            return true;
        });
    }, "json");
});

$(".lazoVistaControlesEliminar").live("click",function(){
    event.preventDefault();
    var EliminarID = $(this).attr("rel");
    var ActualizarLazo = $(this).parents(".contenedorLazoVista").attr("vista");
    var tabla = $(this).parents(".contenedorLazoVista").attr("rel");
    $(this).parents(".contenedorLazoVista").load("ajax", {VistaLazo:ActualizarLazo,borrar:EliminarID,lazo:tabla});
});

}); //Document.Ready()

function cargarContenedorLazoVista(id)
{
    $("#vista_"+id).load("ajax", {VistaLazo:id});
}

function plnJS_iniciar()
{
    $(".contenedorLazoVista").each(function(){
        cargarContenedorLazoVista($(this).attr("rel"));
    });
    
    $(".cargar-archivo").each(function(){
        new qq.FileUploaderBasic({
            button: $(this)[0],
        params: {ref: $("#"+$(this).attr("rel")).attr("name") },
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
}
</script>
<?php head::agregarContenido(ob_get_clean()); ?>