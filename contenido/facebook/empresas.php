<?php
general::requerirModulo(array('plantilla','campos','plantilla-general'));

ob_start();
?>
<h1><img src="img/empresas/edificio.gif" /> Empresas</h1>
<?php
$plantilla = new pln();
$plantilla->procesar('empresas');
echo $plantilla->pln;

// Ahora cargamos las empresas que concuerden con la selección

$c = 'SELECT * FROM empresa_registro';
$r = db::consultar ($c);

while ($r && $f = mysql_fetch_assoc($r))
{
    echo '<table class="lista_empresas"><tr>';
    echo '<td class="logo"><img src="'.ui::ObtenerImagen($f['logo_hash'],40,40,true).'" /></td>';
    echo '<td class="informacion"><div class="ocre">'.$f['nombre_legal'].'</div><div class="gris"><strong>90</strong> puestos disponibles</div></td>';
    echo '<td class="accion"><div class="boton"><a href="ver.empresa!'.$f['ID_empresa_registro'].'#'.web::SEO($f['nombre_legal']).'">Ver</a></td>';
    echo '</tr></table>';
}

$buffer = ob_get_clean();

CrearPlantillaGeneral($buffer);
?>