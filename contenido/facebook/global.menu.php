<?php
general::registrarEstiloCSS('menu','menu');

$menu['actividad.economica']['texto'] = 'Actividad Económica';
$menu['actividad.economica']['enlace'] = 'busqueda.html?c=actividad.economica';
$menu['actividad.economica']['titulo'] = 'Búscar por actividad economica';

$menu['area.puesto']['texto'] = 'Área de Puesto';
$menu['area.puesto']['enlace'] = 'busqueda.html?c=area.puesto';
$menu['area.puesto']['titulo'] = 'Búscar en base al área del puesto';

$menu['informatica']['texto'] = 'Informática';
$menu['informatica']['enlace'] = 'busqueda.html?c=informatica';
$menu['informatica']['titulo'] = 'Búscar candidatos en base a su sector de desempeño en la informática';

$menu['oficio']['texto'] = 'Oficio';
$menu['oficio']['enlace'] = 'busqueda.html?c=oficio';
$menu['oficio']['titulo'] = 'Búscar candidados en base a sus habilidades';


$menu['estudio']['texto'] = 'Estudio';
$menu['estudio']['enlace'] = 'busqueda.html?c=estudio';
$menu['estudio']['titulo'] = 'Búscar candidados en base a sus estudios profesionales';

// Áreas de actividad económica correspondientes a las empresas donde han trabajados los FaceJobianos
$c = 'SELECT grupo, subgrupo FROM `datos_puesto` WHERE 1 GROUP BY grupo, subgrupo';
$rMenuActividad = db::consultar($c);

// Áreas de puesto correspondientes a las puestos donde han trabajados los FaceJobianos
$c = 'SELECT grupo, subgrupo FROM `datos_puesto` WHERE 1 GROUP BY grupo, subgrupo';
$rMenuPuesto = db::consultar($c);

// Tags de estudio correspondientes a los estudios realizados por los FaceJobianos
$c = 'SELECT grupo, subgrupo FROM `datos_puesto` WHERE 1 GROUP BY grupo, subgrupo';
$rMenuEstudio = db::consultar($c);
?>
<ul id="nav" class="dropdown dropdown-horizontal">

<?php
foreach ($menu as $enlace => $datos)
{
    if (empty($datos['nivel']) || !is_array($datos['nivel']) || in_array(usuario::$info['tipo'],$datos['nivel']))
    {
        if (empty($datos['pie']))
            echo '<li'.(@$_GET['peticion'] == $enlace ? ' class="seleccionado"' : '').'><a id="menu_'.$enlace.'"  title="'._($datos['titulo']).'" href="'.PROY_URL.$datos['enlace'].'.html">'._($datos['texto']).'</a></li>';
        else
            body::agregarContenidoAlFinal('<a id="menu_'.$enlace.'"  title="'._($datos['titulo']).'" href="'.PROY_URL.$datos['enlace'].'">'._($datos['texto']).'</a>');
    }
}
?>

<li style="float:right;padding:0px;"><span>Búsqueda rápida:&nbsp;<input id="menu_busqueda_rapida" type="text" value="" /></span></li>

</ul>
