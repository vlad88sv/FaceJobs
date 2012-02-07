<?php
function CrearPlantillaGeneral($contenido)
{
    general::requerirModulo(array('ui'));
    $paso1_general = db::obtenerPorIndice('paso1_personal','ID_cuenta',array(usuario::$info['ID_cuenta']));
    echo '<table id="PlantillaGeneral">';
    echo '<tr>';
    echo '<td id="PlantillaGeneralMenu">';
    echo '<img src="'.ui::ObtenerImagen($paso1_general['foto_hash'],110,110,true).'" />';
    echo '<ul>';
    echo '<li>Curriculum</li>';
    echo '<ul>';
    echo '<li><a href="/pasos.html?p=9">Visualización</a></li>';
    echo '<li><a href="/pasos.html?p=1">Datos personales</a></li>';
    echo '<li><a href="/pasos.html?p=2">Educación</a></li>';
    echo '<li><a href="/pasos.html?p=3">Experiencia laboral</a></li>';
    echo '<li><a href="/pasos.html?p=5">Referencias</a></li>';
    echo '<li><a href="/pasos.html?p=6">Categorías adicionales</a></li>';
    echo '<li><a href="/pasos.html?p=7">Video Curriculum</a></li>';
    echo '<li><a href="/pasos.html?p=8">Privacidad</a></li>';
    echo '</ul>';
    echo '<li>Curriculum Premium</li>';
    echo '<li>Invitar a un amigo</li>';
    echo '</ul>';
    echo '<br /><div style="width:80%;border-radius:5px;background-color:#e0dddd;font-size:11px;text-align:center;">Puestos patrocinados</div>';
    echo '</td>';
    echo '<td id="PlantillaGeneralContenido">';
    echo $contenido;
    echo '</td>';
    echo '</tr>';
    echo '</table>';
}
?>