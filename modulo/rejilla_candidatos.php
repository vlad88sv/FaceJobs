<?php
class rejilla
{
    public static function menu ()
    {
        $ret = '
        <script>
            $(function(){
                $("#guardar_busqueda_actual").click(function(event){
                    event.preventDefault();
                    $.post("ajax.rejilla",{operacion:"solitoGuardar"},function(data){
                        $("#PlantillaGeneralRejilla").html(data.html);
                        $("#PlantillaGeneralRejilla #resumen_busqueda").val(ObtenerResumenBusqueda().replace(/(<([^>]+)>)/ig,""));
                    },"json");
                });
                
                $("#ejecutar_guardado_busqueda").live("click",function(event){
                    event.preventDefault();
                    ActualizarRejilla([{name:"operacion", value:"guardar"},{name:"gb_titulo", value:$("#guardarBusqueda").val()},{name:"gb_descripcion", value:$("#resumen_busqueda").val()},{name:"gb_busqueda", value:$("#rejilla_filtros").serializeArray()}]);
                });
            });
        </script>
        ';
        
        $ret .= '<div style="text-align:left;margin:10px 0px;font-size:10px;color:grey;">
        <span style="font-size:14px;font-weight:bold;color:black;">3,000</span> resultados</span>, yey!.
        [<a id="utilizar_busqueda_guardada" href="#">Utilizar búsqueda guardada</a>]
        [<a id="guardar_busqueda_actual" href="#">Guardar búsqueda actual</a>]
        [<a id="publicar_puesto_base_busqueda" href="#">Publicar puesto en base a esta búsqueda</a>]</div>';
        return $ret;
    }
    
    public static function filtros()
    {
        $seccion = array();
        $accion = !empty($_GET['2']) ? $_GET['2'] : '';

        if ( $accion == 'categorias' )
        $secciones[] = '<h1>▼ Categorias</h1>'.self::ObtenerCategorias();
        
        if ( $accion == 'actividad.economica' )
        $secciones[] = '<h1>▼ Act. económica</h1>'.self::ObtenerActEconomica();

        if ( $accion == 'estudio' )
        $secciones[] = '<h1>▼ Estudios</h1>'.self::ObtenerEstudios();

        if ( $accion == 'area.puesto' )
        $secciones[] = '<h1>▼ Puestos</h1>'.self::ObtenerAreaDePuesto();

        if ( $accion == 'oficio' )
        $secciones[] = '<h1>▼ Oficios</h1>'.self::ObtenerOficios();
        
        $secciones[] = '<h1>▼ Experiencia</h1>'.self::ObtenerExperiencia();
        $secciones[] = '<h1>▼ Idiomas</h1>'.self::ObtenerIdiomas();
        $secciones[] = '<h1>▼ Edad</h1>'.self::ObtenerEdad();
        $secciones[] = '<h1>▼ Expectativa salarial</h1>'.self::ObtenerExpectativaSalarial();
        $secciones[] = '<h1>▼ Otros</h1>'.self::ObtenerOtros();
        $secciones[] = '<h1>▼ Lugar de domicilio</h1>'.self::ObtenerDomicilio();
        
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
                    $("#edad_min").val(ui.values[ 0 ]);
                    $("#edad_max").val(ui.values[ 1 ]);                    
                    ActualizarRejilla();
                }
            });
            $( "#valor_edad" ).html( $( "#slider_edad" ).slider( "values", 0 ) + " - " + $( "#slider_edad" ).slider( "values", 1 ) );   
            $("#edad_min").val($( "#slider_edad" ).slider( "values", 0 ));
            $("#edad_max").val($( "#slider_edad" ).slider( "values", 1 ));
            
            $( "#slider_expectativa_salarial" ).slider({
                range: "min",
                min: 0,
                max: 3000,
                step: 150,
                value: 750,
                slide: function( event, ui ) {
                    $( "#valor_expectativa_salarial" ).html( "$" + ui.value );
                    $("#expectativa_salarial").val(ui.value);
                    ActualizarRejilla();
                }
            });
            $( "#valor_expectativa_salarial" ).html( "$" + $( "#slider_expectativa_salarial" ).slider( "value") );
            $("#expectativa_salarial").val($( "#slider_expectativa_salarial" ).slider( "value"));
            
            $( "#slider_experiencia" ).slider({
                range: "max",
                min: 0,
                max: 5,
                step: 1,
                value: 0,
                slide: function( event, ui ) {
                    $( "#valor_experiencia" ).html( ui.value + " años" );
                    $("#experiencia").val(ui.value);
                    ActualizarRejilla();
                }
            });
            $( "#valor_experiencia" ).html( $( "#slider_experiencia" ).slider( "value") + " años");
            $("#experiencia").val($( "#slider_experiencia" ).slider( "value"));
        });
        </script>
        ';
        return $ret;
    }
    
    
    private static function ObtenerExpectativaSalarial()
    {
        return '<input type="hidden" name="expectativa_salarial" id="expectativa_salarial" value="0" /><p id="valor_expectativa_salarial" class="ocre"></p><div id="slider_expectativa_salarial"></div>';
    }
    
    private static function ObtenerEdad()
    {
        return '<input type="hidden" name="edad_min"  id="edad_min" value="0" /><input type="hidden" name="edad_max" id="edad_max" value="0" /><p id="valor_edad" class="ocre"></p><div id="slider_edad"></div>';
    }
    
    private static function ObtenerExperiencia()
    {
        return '<input type="hidden" id="experiencia" name="experiencia" value="0" /><p id="valor_experiencia" class="ocre"></p><div id="slider_experiencia"></div>';
    }
    
    private static function ObtenerEstudios()
    {
        // Estudio superior
        $consulta = 'SELECT `ID_area_estudio`, `estudio` FROM `paso2_educacion_superior` LEFT JOIN `datos_tag_estudio_superior` ON `ID_area_estudio` = `ID_tag_estudio_superior`';
        $resultado = db::consultar($consulta);
        
        while ($resultado && $registro = mysql_fetch_assoc($resultado))
        {
            $arrCarreras[$registro['ID_area_estudio']] = $registro['estudio'];
        }

        $retorno = ui::ArrayCheckbox('carreras', '', $arrCarreras, array());
        unset($arrCarreras);
        
        $retorno .= '<hr />';
        
        // Bachillerato
        $consulta = 'SELECT `ID_area_estudio`, `estudio` FROM `paso2_educacion_secundaria` LEFT JOIN `datos_tag_estudio_bachiller` ON `ID_area_estudio` = `ID_tag_estudio_bachiller` WHERE `ID_area_estudio` >0 GROUP BY `ID_area_estudio`';
        $resultado = db::consultar($consulta);
        
        while ($resultado && $registro = mysql_fetch_assoc($resultado))
        {
            $arrCarreras[$registro['ID_area_estudio']] = $registro['estudio'];
        }
        
        $retorno .= ui::ArrayCheckbox('bachillerato', '', $arrCarreras, array());
        
        return $retorno;
    }

    private static function ObtenerAreaDePuesto()
    {
        $consulta = 'SELECT `ID_puesto`, `puesto` FROM `datos_puesto` WHERE `ID_puesto` IN (SELECT `ID_puesto_desempenado` FROM `paso3_cargos`) OR `ID_puesto` IN (SELECT `ID_area_interes` FROM `paso4_expectativa_laboral`)';
        $resultado = db::consultar($consulta);
        
        while ($resultado && $registro = mysql_fetch_assoc($resultado))
        {
            $arrCarreras[$registro['ID_puesto']] = $registro['puesto'];
        }

        return ui::ArrayCheckbox('puestos', '', $arrCarreras, array());
    }

    private static function ObtenerOficios()
    {
        $consulta = 'SELECT `ID_oficio`, `oficio` FROM `paso6_oficios` LEFT JOIN `datos_oficio` ON `ID_oficio` = `ID_puesto`';
        $resultado = db::consultar($consulta);
        
        while ($resultado && $registro = mysql_fetch_assoc($resultado))
        {
            $arrCarreras[$registro['ID_oficio']] = $registro['oficio'];
        }

        return ui::ArrayCheckbox('oficios', '', $arrCarreras, array());
    }
    
    private static function ObtenerActEconomica()
    {
        $consulta = 'SELECT `ID_actividad_economica`, `actividad_economica` FROM `paso3_empresa` LEFT JOIN `datos_actividad_economica` USING (ID_actividad_economica)';
        $resultado = db::consultar($consulta);
        
        while ($resultado && $registro = mysql_fetch_assoc($resultado))
        {
            $arrCarreras[$registro['ID_actividad_economica']] = $registro['actividad_economica'];
        }

        return ui::ArrayCheckbox('actividadesEconomicas', '', $arrCarreras, array());
    }

    private static function ObtenerDomicilio()
    {
        $consulta = 'SELECT `ciudad_de_domicilio` FROM `paso1_personal` WHERE `ciudad_de_domicilio` <> ""';
        $resultado = db::consultar($consulta);
        
        while ($resultado && $registro = mysql_fetch_assoc($resultado))
        {
            $arrCarreras[$registro['ciudad_de_domicilio']] = $registro['ciudad_de_domicilio'];
        }

        return ui::ArrayCheckbox('domicilios', '', $arrCarreras, array());
    }    

    private static function ObtenerIdiomas()
    {
        $consulta = 'SELECT `ID_idioma`, `nivel`, CONCAT(`idioma`, " - " , `nivel`) AS "idioma_nivel" FROM `paso2_idiomas` LEFT JOIN `datos_idioma` USING(ID_idioma) GROUP BY `ID_idioma`,`nivel`';
        $resultado = db::consultar($consulta);
        
        while ($resultado && $registro = mysql_fetch_assoc($resultado))
        {
            $arrCarreras[$registro['ID_idioma'].'.'.$registro['nivel']] = $registro['idioma_nivel'];
        }

        return ui::ArrayCheckbox('idiomas', '', $arrCarreras, array());
    }

    private static function ObtenerCategorias()
    {
        $consulta = 'SELECT `ID_empresa_categorias`, `categoria` FROM `empresa_categorias` WHERE ID_cuenta='.usuario::$info['ID_cuenta'].' ORDER BY `categoria` ASC';
        $resultado = db::consultar($consulta);
        
        $arrCarreras = array();
        
        while ($resultado && $registro = mysql_fetch_assoc($resultado))
        {
            $arrCarreras[$registro['ID_empresa_categorias']] = $registro['categoria'];
        }

        return ui::ArrayCheckbox('categorias', '', $arrCarreras, array()).'<br /><a href="editar.categorias.html?contenido" class="facebox">Editar categorias</a>';
    }
    
    private static function ObtenerOtros()
    {
        return '
        <input type="checkbox" name="otros[]" value="vehiculo_propio" id="otros_vehiculo_propio" /><label for="otros_vehiculo_propio">Con vehiculo propio</label><br />
        <input type="checkbox" name="otros[]" value="licencia_conducir" id="otros_licencia_conducir" /><label for="otros_licencia_conducir"> Con licencia de conducir</label><br />
        <input type="checkbox" name="otros[]" value="masculino" id="otros_masculino" /><label for="otros_masculino"> Masculino</label><br />
        <input type="checkbox" name="otros[]" value="femenino" id="otros_femenino" /><label for="otros_femenino"> Femenino</label><br />
        <input type="checkbox" name="otros[]" value="disponibilidad_viajar" id="otros_disponibilidad_viajar" /><label for="otros_disponibilidad_viajar"> Disponibilidad de viajar</label><br />
        <input type="checkbox" name="otros[]" value="tiempo_completo" id="otros_tiempo_completo" /><label for="otros_tiempo_completo"> Únicamente Tiempo completo</label><br />
        ';
    }    
        
}
?>