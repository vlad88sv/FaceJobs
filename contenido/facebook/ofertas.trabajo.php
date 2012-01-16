<?php ob_start(); ?>
<h1><img src="img/ofertas.trabajo/periodico.gif" /> Ofertas de trabajo</h1>
<?php
general::requerirModulo(array('plantilla-general'));
CrearPlantillaGeneral(ob_get_clean());
?>