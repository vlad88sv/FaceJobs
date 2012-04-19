<?php
general::requerirModulo(array('plantilla','cv','plantilla-general'));

general::registrarEstiloCSS('FaceBox','facebox');

general::registrarScriptJS('fileuploader','fileuploader');
general::registrarScriptJS('FaceBox','jquery.facebox');

pln::procesar('perfil.candidato');

echo pln::$pln;
?>
<script type="text/javascript">
    $(function(){
    	 $('.editarPaso').facebox();
         $(document).bind('afterClose.facebox', function() { window.location.href=window.location.href; });
	 $('.cerrar_facebox').live('click',function () {$(document).trigger('close.facebox');});
         plnJS_iniciar();
    });
</script>
