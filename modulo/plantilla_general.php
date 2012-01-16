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
    echo '<li>Visualización</li>';
    echo '<li>Datos personales</li>';
    echo '<li>Educación</li>';
    echo '<li>Experiencia laboral</li>';
    echo '<li>Referencias</li>';
    echo '<li>Categorías adicionales</li>';
    echo '<li>Video Curriculum</li>';
    echo '<li>Privacidad</li>';
    echo '</ul>';
    echo '<li>Curriculum Premium</li>';
    echo '<li>Invitar a un amigo</li>';
    echo '</ul>';
    echo '</td>';
    echo '<td id="PlantillaGeneralContenido">';
    echo $contenido;
    echo '</td>';
    echo '</tr>';
    echo '</table>';
}
?>