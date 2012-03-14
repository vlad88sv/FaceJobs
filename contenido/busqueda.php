<?php
general::requerirModulo(array('plantilla','cv','ui'));

general::registrarEstiloCSS('blitzer','blitzer/jquery-ui-1.8.17.custom');
general::registrarEstiloCSS('FaceBox','facebox');

general::registrarScriptJS('jquery.ui','ui/jquery.ui.core.min');
general::registrarScriptJS('jquery.ui.widget','ui/jquery.ui.widget.min');
general::registrarScriptJS('jquery.ui.mouse','ui/jquery.ui.mouse.min');
general::registrarScriptJS('jquery.ui.slider','ui/jquery.ui.slider.min');
general::registrarScriptJS('FaceBox','jquery.facebox');

pln::procesar('perfil.candidato');

$rejilla = array();

if (usuario::$info['tipo'] == usuario::$tipoCandidato) {
    general::requerirModulo(array('rejilla.puestos')); // Candidato busca puestos
} else {
    general::requerirModulo(array('rejilla.candidatos')); // Empresa busca candidatos
}

// Serializaremos y enviaremos vía AJAX los filtros, mostraremos en PlantillaGeneralRejilla el resultado de rejilla::resultados();

// Modulo "rejilla_" procesa los filtros y devuelve un array que es graficado.
// El array debe contener:
/*
 * -------------[Lado Izq.]
 * $array['fotografia'] = Fotografía a desplegar (foto candidato o logotipo empresa)
 * $array['titulo] = (Nombre del candidato o nombre del puesto)
 * $array['info_slider'] = (Slider de estudios o Informacion del puesto)
 * -------------[Lado Der.]
 * $array['titulo_der] = (Aspiracion salarial o Nombre de la empresa)
 * $array['info_slider] = (Slider de experiencia laboral o Informacion de la empresa)
 */ 
 
 
echo rejilla::menu();
echo '<table id="PlantillaGeneral">';
echo '<tr>';
echo '<td id="PlantillaGeneralMenu">';
echo '<form id="rejilla_filtros">'.rejilla::filtros().'</form>';
echo '</td>';
echo '<td id="PlantillaGeneralRejilla">';
echo '</td>';
echo '</tr>';
echo '</table>';
?>
<script type="text/javascript">
var funcionando = false;
var pendientes = false;

function ObtenerResumenBusqueda() {
    ret = "";
    ret += "Expectativa salarial: Aprox. <b>$" + $("#expectativa_salarial").val() + "</b>";
    ret += ", con mínimo <b>" + $("#experiencia").val() + " años de experiencia</b>";
    ret += ", cuya edad sea <b>de " + $("#edad_min").val() + " a " + $("#edad_max").val() + " años</b>. ";
    
    if ($('input[name="otros[]"]:checked').length > 0)
    {
        ret += "Otros requisitos: ";
        var tArr = [];
        $('input[name="otros[]"]:checked').each(function(){
            tArr.push("<b>" + $('label[for="'+$(this).attr("id")+'"]').html() + "</b>");
        });
        ret += tArr.join(', ') + ". ";
    }
    
    if ($('input[name="idiomas[]"]:checked').length > 0)
    {
        ret += "Con conocimientos de los siguientes idiomas: ";
        var tArr = [];
        $('input[name="idiomas[]"]:checked').each(function(){
            tArr.push('<b>' + $(this).attr("title") + '</b>');
        });
        ret += tArr.join(', ') + ". ";
    }
    
    if ($('input[name="categorias[]"]:checked').length > 0)
    {
        ret += "En mis categorias: ";
        var tArr = [];
        $('input[name="categorias[]"]:checked').each(function(){
            tArr.push('<b>' + $(this).attr("title") + '</b>');
        });
        ret += tArr.join(', ') + ". ";
    }

    if ($('input[name="actividadesEconomicas[]"]:checked').length > 0)
    {
        ret += "Que haya trabajo en empresas dedicadas a: ";
        var tArr = [];
        $('input[name="actividadesEconomicas[]"]:checked').each(function(){
            tArr.push('<b>' + $(this).attr("title") + '</b>');
        });
        ret += tArr.join(', ') + ". ";
    }   

    if ($('input[name="puestos[]"]:checked').length > 0)
    {
        ret += "Que haya trabajado en los siguientes puestos o desee hacerlo: ";
        var tArr = [];
        $('input[name="puestos[]"]:checked').each(function(){
            tArr.push('<b>' + $(this).attr("title") + '</b>');
        });
        ret += tArr.join(', ') + ". ";
    }
    
    if ($('input[name="oficios[]"]:checked').length > 0)
    {
        ret += "Que práctique alguno de los siguientes oficios: ";
        var tArr = [];
        $('input[name="oficios[]"]:checked').each(function(){
            tArr.push('<b>' + $(this).attr("title") + '</b>');
        });
        ret += tArr.join(', ') + ". ";
    }

    if ($('input[name="carreras[]"]:checked').length > 0)
    {
        ret += "Que haya estudiado alguna de las siguientes carreras: ";
        var tArr = [];
        $('input[name="carreras[]"]:checked').each(function(){
            tArr.push('<b>' + $(this).attr("title") + '</b>');
        });
        ret += tArr.join(', ') + ". ";
    }
    
    if ($('input[name="bachillerato[]"]:checked').length > 0)
    {
        ret += "Cuyo bachillerato este en estas áreas: ";
        var tArr = [];
        $('input[name="bachillerato[]"]:checked').each(function(){
            tArr.push('<b>' + $(this).attr("title") + '</b>');
        });
        ret += tArr.join(', ') + ".";
    }

    if ($('input[name="domicilios[]"]:checked').length > 0)
    {
        ret += "Que resida en las siguientes áreas: ";
        var tArr = [];
        $('input[name="domicilios[]"]:checked').each(function(){
            tArr.push('<b>' + $(this).attr("title") + '</b>');
        });
        ret += tArr.join(', ') + ".";
    }
    
    return ret;
}
            
function ActualizarRejilla()
{
   if (funcionando) {console.log('Esperando AJAX...'); pendientes = true; return;};

   funcionando = true;
   $("#PlantillaGeneralRejilla").html('<div style="color:#882A29;font-size:14px;"><img src="img/ajax.gif" /> Realizando búsqueda...</div>');
   $.post('ajax.rejilla',$("#rejilla_filtros").serializeArray(),function(data){
        funcionando = false;
    
        if (pendientes)
        {
            pendientes = false;
            ActualizarRejilla();
            return;
        }
    
        pendientes = false;
    
        
        $("#PlantillaGeneralRejilla").html(data.html);
        $("#PlantillaGeneralRejilla #resumen_busqueda").html("Pérfil de búsqueda: " + ObtenerResumenBusqueda());
        
        $('.facebox').facebox();
    },'json');
    
}

$(function(){

    ActualizarRejilla();
    
    $("#rejilla_filtros input").click(function(){ActualizarRejilla();});
    $("#rejilla_filtros select").change(function(){ActualizarRejilla();});

});
</script>