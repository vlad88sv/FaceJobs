<?php
general::requerirModulo(array('plantilla','campos','plantilla-general'));

general::registrarEstiloCSS('FaceBox','facebox');

ob_start();
?>
<h1><img src="img/ofertas.trabajo/periodico.gif" /> Ofertas de trabajo</h1>
<?php
$plantilla = new pln();
$plantilla->procesar('buscar');
echo $plantilla->pln;
$buffer = ob_get_clean();

CrearPlantillaGeneral($buffer);
?>
<script>
    $(function(){
        function VisibilidadBusquedaAvanzada(valor){
            if (valor == 2)
                {$("#busqueda_avanzada").show();}
            else
                {$("#busqueda_avanzada").hide();}
        }
        
        VisibilidadBusquedaAvanzada($("[name='paso0.tipo_busqueda']:checked").val());
        
        $("[name='paso0.tipo_busqueda']").click(function() {
            VisibilidadBusquedaAvanzada($(this).val());
        });
        
    });
</script>