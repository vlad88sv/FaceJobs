<?php
// control de pasos para completar perfil
/*
 Datos:
 + Fecha de creación: 2 de Septiembre de 2011
 + Creado por: Alejandro Molina, Vladimir Hidalgo
 + Diseño: Alejandro Molina
 + Mantemiento:  Vladimir Hidalgo
*/

$paso = @$_GET['p'];

general::requerirModulo(array('plantilla','cv'));

pln::procesar('perfil.candidato.d/'.$paso);

body::agregarContenidoAlContenido(pln::$pln);
?>
<script>
    $(function(){
        plnJS_iniciar();
    });
</script>