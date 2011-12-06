<?php
$pasos[1]['titulo'] = 'Datos personales';
$pasos[1]['porcentaje'] = 0;
$pasos[2]['titulo'] = 'Educación';
$pasos[2]['porcentaje'] = 25;
$pasos[3]['titulo'] = 'Experencia laboral';
$pasos[3]['porcentaje'] = 50;
$pasos[4]['titulo'] = 'Expectativa laboral';
$pasos[4]['porcentaje'] = 75;
$pasos[5]['titulo'] = 'Referencias';
$pasos[5]['porcentaje'] = 100;
$pasos[6]['titulo'] = 'Categorias adicionales';
$pasos[6]['porcentaje'] = 0;
$pasos[7]['titulo'] = 'Video Curriculum';
$pasos[7]['porcentaje'] = 0;
$pasos[8]['titulo'] = 'Privacidad';
$pasos[8]['porcentaje'] = 0;
$pasos[9]['titulo'] = 'Visualización';
$pasos[9]['porcentaje'] = 0;

$p = @$_GET['p'];
if (!is_numeric($p) || $p < 1 || $p > 9)
    $p = 1;
?>
<div id="pasos">
    <?php
    foreach($pasos as $paso => $datos)
    {
        echo '<div class="paso">';
        
            echo '<div class="titulo">';
            echo 'PASO';
            echo '</div>';
            
            echo '<div class="numero '.($paso == $p ? 'resaltado' : '').'">';
                echo '<a href="'.PROY_URL.'paso.html?p='.$paso.'">'.$paso.'</a>';
            echo '</div>';
            
            echo '<div class="texto">';
            echo $datos['titulo'];
            echo '</div>';
            
            echo '<div class="porcentaje">';
                echo '<div class="barra" style="width:'.ceil($datos['porcentaje'] / 2).'px !important;">';
                    echo '<div class="valor">';
                        echo $datos['porcentaje'].'%';
                    echo '</div>';        
                echo '</div>';
            echo '</div>';
        
        echo '</div>';
    }    
    ?>
</div>