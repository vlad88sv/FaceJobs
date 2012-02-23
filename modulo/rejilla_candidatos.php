<?php
class rejilla
{
    public static function menu ()
    {
        $ret = '';
        $ret .= '<div style="text-align:left;margin:10px 0px;font-size:10px;color:grey;"><span style="font-size:14px;font-weight:bold;color:black;">3,000</span> resultados</span>, yey!. [<a href="#">Utilizar búsqueda guardada</a>] [<a href="#">Guardar búsqueda actual</a>] [<a href="#">Publicar puesto en base a esta búsqueda</a>]</div>';
        return $ret;
    }
    
    public static function filtros()
    {
        $seccion = array();
        
        $secciones[] = '<h1>▼ Carreras</h1>';
        $secciones[] = '<h1>▼ Maestrias</h1>';
        $secciones[] = '<h1>▼ Experiencia</h1>';
        $secciones[] = '<h1>▼ Idiomas</h1>';
        $secciones[] = '<h1>▼ Edad</h1><p id="valor_edad" class="ocre"></p><div id="slider_edad"></div>';
        $secciones[] = '<h1>▼ Expectativa salarial</h1><p id="valor_expectativa_salarial" class="ocre"></p><div id="slider_expectativa_salarial"></div>';
        $secciones[] = '<h1>▼ Otros</h1><input type="checkbox" value="vehiculo_propio" />Con vehiculo propio<br /><input type="checkbox" value="licencia_conducir" />Con licencia de conducir<br /><input type="checkbox" value="masculino" />Masculino<br /><input type="checkbox" value="femenino" />Femenino<br /><input type="checkbox" value="disponibilidad_viajar" />Disponibilidad de viajar<br /><input type="checkbox" value="tiempo_completo" />Tiempo completo<br />';
        $secciones[] = '<h1>▼ Lugar de domicilio</h1>';
        
        $ret = '';
        $ret .= '<table>';
        foreach ($secciones as $seccion)
        {
            $ret .= '<tr><td>'.$seccion.'</td></tr>';
        }
        $ret .= '</table>';
        
        $ret .= '
        <script>
        $(function() {
            $( "#slider_edad" ).slider({
                range: true,
                min: 18,
                max: 75,
                values: [ 21, 50 ],
                slide: function( event, ui ) {
                    $( "#valor_edad" ).html( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                }
            });
            $( "#valor_edad" ).html( $( "#slider_edad" ).slider( "values", 0 ) + " - " + $( "#slider_edad" ).slider( "values", 1 ) );   
            
            $( "#slider_expectativa_salarial" ).slider({
                range: "min",
                min: 0,
                max: 3000,
                step: 150,
                value: 750,
                slide: function( event, ui ) {
                    $( "#valor_expectativa_salarial" ).html( "$" + ui.value );
                }
            });
            $( "#valor_expectativa_salarial" ).html( "$" + $( "#slider_expectativa_salarial" ).slider( "value") );  
        });
        </script>
        ';
        return $ret;
    }
    
    public static function resultados() {}
}
?>