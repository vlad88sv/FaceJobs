<?php
general::requerirModulo(array('plantilla','campos','plantilla-general'));

general::registrarScriptJS('fileuploader','fileuploader');
?>
<h1><img src="img/empresas/edificio.gif" /> Perfil de Empresa</h1>
<?php
pln::procesar('perfil.empresa');
echo pln::$pln;
?>
<script type="text/javascript">
    $(function(){
         plnJS_iniciar();
    });
</script>
