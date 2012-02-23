<?php
general::requerirModulo(array('plantilla','cv','plantilla-general'));

general::registrarEstiloCSS('FaceBox','facebox');

general::registrarScriptJS('fileuploader','fileuploader');
general::registrarScriptJS('FaceBox','jquery.facebox');

$plantilla = new pln();
$plantilla->procesar('perfil.candidato');
echo $plantilla->pln;
?>
<script type="text/javascript">
    $(function(){
        $('.editarPaso').facebox();
         $(document).bind('afterClose.facebox', function() { window.location.reload(); });         
    });
</script>
