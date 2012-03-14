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
        
        $('.facebox').facebox();
    },'json');
    
}

$(function(){

    ActualizarRejilla();
    
    $("#rejilla_filtros input").click(function(){ActualizarRejilla();});
    $("#rejilla_filtros select").change(function(){ActualizarRejilla();});

});
</script>