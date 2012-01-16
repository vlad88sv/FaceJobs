<?php ob_start(); ?>
<h1><img src="img/estadisticas/grafica.gif" /> Estadísticas</h1>
<?php
general::requerirModulo(array('plantilla-general'));
CrearPlantillaGeneral(ob_get_clean());
?>