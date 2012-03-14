<?php
general::requerirModulo(array('plantilla','campos.busqueda'));
pln::procesar('editar.categorias');
echo pln::$pln;
?>
<script>
    $(function(){
        plnJS_iniciar();
    });
</script>