<?php
general::registrarEstiloCSS('menu','menu');

$menu['inicio']['texto'] = 'Inicio';
$menu['inicio']['titulo'] = 'Iniciar en '.PROY_NOMBRE;
$menu['buscar']['nivel'] = array(usuario::$tipoVisitante);

$menu['inicio']['texto'] = 'Perfil';
$menu['inicio']['titulo'] = 'Mi Currilum Vitae';
$menu['inicio']['nivel'] = array(usuario::$tipoCandidato);

$menu['ofertas']['texto'] = 'Ofertas de trabajo';
$menu['ofertas']['titulo'] = 'Ver las ofertas de trabajo';
$menu['ofertas']['nivel'] = array(usuario::$tipoCandidato, usuario::$tipoAdministrador);

$menu['mensajes']['texto'] = 'Mensajes';
$menu['mensajes']['titulo'] = 'Centro de mensajes';
$menu['mensajes']['nivel'] = array(usuario::$tipoCandidato, usuario::$tipoEmpresa, usuario::$tipoAdministrador);

$menu['empresas']['texto'] = 'Empresas';
$menu['empresas']['titulo'] = 'Listado de empresas';
$menu['empresas']['nivel'] = array(usuario::$tipoCandidato, usuario::$tipoAdministrador);

$menu['estadisticas']['texto'] = 'Estadísticas';
$menu['estadisticas']['titulo'] = 'Estadísticas de '.PROY_NOMBRE;
$menu['estadisticas']['nivel'] = array(usuario::$tipoCandidato, usuario::$tipoEmpresa, usuario::$tipoAdministrador);

$menu['tds']['texto'] = 'TDS';
$menu['tds']['titulo'] = 'Terminos y condiciones';
$menu['tds']['pie'] = true;

$menu['faqs']['texto'] = "FAQ's";
$menu['faqs']['titulo'] = 'Preguntas frecuentes';
$menu['faqs']['pie'] = true;

?>
<ul id="nav" class="dropdown dropdown-horizontal">

<?php
foreach ($menu as $enlace => $datos)
{
    if (empty($datos['nivel']) || !is_array($datos['nivel']) || in_array(usuario::$info['tipo'],$datos['nivel']))
    {
        if (empty($datos['pie']))
            echo '<li'.(@$_GET['peticion'] == $enlace ? ' class="seleccionado"' : '').'><a id="menu_'.$enlace.'"  title="'._($datos['titulo']).'" href="'.PROY_URL.$enlace.'.html">'._($datos['texto']).'</a></li>';
        else
            body::agregarContenidoAlFinal('<a id="menu_'.$enlace.'"  title="'._($datos['titulo']).'" href="'.PROY_URL.$enlace.'.html">'._($datos['texto']).'</a>');
    }
}
?>
<li><a href="javascript:void(0)" onclick="FB.ui({ method: 'apprequests', message: 'La mejor bolsa de trabajo de $$PAIS$$', display:'iframe'});">Contar a los amigos</a></li>

</ul>
