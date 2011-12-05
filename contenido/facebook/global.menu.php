<?php
general::registrarEstiloCSS('menu','menu');

$menu['inicio']['texto'] = 'Inicio';
$menu['inicio']['titulo'] = 'Iniciar en '.PROY_NOMBRE;
$menu['inicio']['nivel'] = usuario::$tipoVisitante;

$menu['buscar']['texto'] = 'Ofertas de trabajo';
$menu['buscar']['titulo'] = 'Ver las ofertas de trabajo';
$menu['buscar']['nivel'] = usuario::$tipoVisitante;

$menu['mensajes']['texto'] = 'Mensajes';
$menu['empresas']['titulo'] = 'Centro de mensajes';
$menu['empresas']['nivel'] = usuario::$tipoVisitante;

$menu['empresas']['texto'] = 'Empresas';
$menu['empresas']['titulo'] = 'Listado de empresas';
$menu['empresas']['nivel'] = usuario::$tipoVisitante;

$menu['estadisticas']['texto'] = 'Estadísticas';
$menu['estadisticas']['titulo'] = 'Estadísticas de '.PROY_NOMBRE;
$menu['estadisticas']['nivel'] = usuario::$tipoVisitante;

$menu['tds']['texto'] = 'TDS';
$menu['tds']['titulo'] = 'Terminos y condiciones';
$menu['tds']['nivel'] = usuario::$tipoVisitante;

$menu['faqs']['texto'] = "FAQ's";
$menu['faqs']['titulo'] = 'Preguntas frecuentes';
$menu['faqs']['nivel'] = usuario::$tipoVisitante;
?>
<ul id="nav" class="dropdown dropdown-horizontal">

<?php
foreach ($menu as $enlace => $datos)
{
    echo '<li'.($_GET['accion'] == $enlace ? ' class="seleccionado"' : '').'><a id="menu_'.$enlace.'"  title="'._($datos['titulo']).'" href="'.PROY_URL.$enlace.'.html">'._($datos['texto']).'</a></li>';
}
?>
<li><a href="javascript:void(0)" onclick="FB.ui({ method: 'apprequests', message: 'La mejor bolsa de trabajo de $$PAIS$$', display:'iframe'});">Contar a los amigos</a></li>

</ul>
