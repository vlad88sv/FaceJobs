<?php
general::requerirModulo(array('plantilla.campos','plantilla.UI','plantilla.JS','ui'));
general::registrarEstiloCSS('pln','pln');
class pln
{
    public static $pln;
    public static $campos = array();
    private static $debug = false;
    public static function procesar($plantilla)
    {
        /* Plan:
          * Las plantillas son cacheables, pues no se ubican aca los valores
          * personales, por lo que primero hay que verificar si la plantilla
          * esta en memcache.
         */
        
        // MemCache
        // if ($mc = memcached('plantillas',$plantilla.'.pln')) {self::$pln = $mc; return;}
        
        if (!file_exists(_BASE_plantilla.$plantilla.'.pln'))
        {
            echo '<pre>'._BASE_plantilla.$plantilla.' ???</pre>';
            return;
        }
        
        self::$pln = file_get_contents(_BASE_plantilla.$plantilla.'.pln');
    
        self::procesarTituloGeneral();
        
        self::procesarGrupos();
        
        self::procesarSubTitulos();
        
        self::procesarTitulos();
        
        self::procesarLazos();
        
        self::procesarVistaLazos();
        
        self::procesarCampos();
        
        self::procesarVisuales();

        self::reemplazarValores();
    }
    
    // ==0:ABC==
    private static function procesarTituloGeneral()
    {
        if (self::$debug) error_log ('procesarTituloGeneral'.' :: ' . strlen(self::$pln));
        self::$pln = preg_replace('/==([0-9]*?)\:(.*)==(.*)/s','<div id="TituloGeneral"><span class="numeroGeneral">Paso $1</span> $2</div>'."\n".'<div id="contenido">'."\n".'$3'."\n".'</div> <!-- Contenido !-->'."\n",self::$pln);
        self::$pln = preg_replace('/==(.*)==(.*)/s','<div id="TituloGeneral">$1</div>'."\n".'<div id="contenido">'."\n".'$2'."\n".'</div> <!-- Contenido !-->'."\n",self::$pln);
    }
    
    private static function procesarGrupos()
    {
        if (self::$debug) error_log ('procesarGrupos'.' :: ' . strlen(self::$pln));
        self::$pln = preg_replace(array('/\[grupo\:(.*?)\]/','/\[\/grupo\]/'),array('<div class="grupo" id="grupo_$1">','</div>'),self::$pln);
    }
    
    private static function procesarTitulos()
    {
        if (self::$debug) error_log ('procesarTitulos'.' :: ' . strlen(self::$pln));
        self::$pln = preg_replace('/\[titulo\:([0-9]*?)](.*?)\[\/titulo\]/s','<div class="titulo"><span class="numeroTitulo">$1</span> $2</div>',self::$pln);
        self::$pln = preg_replace('/\[titulo](.*?)\[\/titulo\]/s','<div class="titulo">$1</div>',self::$pln);
    }
    
    private static function procesarSubTitulos()
    {
        if (self::$debug) error_log ('procesarSubTitulos'.' :: ' . strlen(self::$pln));
        self::$pln = preg_replace('/\[subtitulo](.*?)\[\/subtitulo\]/s','<div class="subtitulo">$1</div>',self::$pln);
    }
    
    private static function procesarLazos()
    {
        if (self::$debug) error_log ('procesarLazos'.' :: ' . strlen(self::$pln));
        $lazos = array();
        preg_match_all('/\[lazo](.*?)\[\/lazo\]/s',self::$pln,$lazos);
        
        foreach($lazos[1] as $lazo)
        {
            if (!isset(campos::$deflazo[$lazo]))
                continue;
            
            $retorno =  "";
            $retornoCampos = "";
            $retornoVista = "";
            
            
            
            /* Procesar los campos */
            foreach(campos::$deflazo[$lazo]['campos'] as $campo)
            {
                $retornoCampos .= plnUI::procesarCampo($campo,true);
            }
            
            $retornoCampos = '<input type="hidden" value="0" name="'.$lazo.'.ID_'.$lazo.'" id="'.$lazo.'_ID_'.$lazo.'" />'.$retornoCampos;
            
            /* Procesar la vista */
            // Acá solamente es un DIV que posteriormente interpreta controlador_pasos
            $retornoVista = !isset(campos::$deflazo[$lazo]['vistaVirtual']) ? '<div class="contenedorLazoVista" id="vista_'.$lazo.'" vista="'.((isset(campos::$deflazo[$lazo]['vistaVirtual']) && isset(campos::$deflazo[$lazo]['vistaVirtualRemota'])) ? campos::$deflazo[$lazo]['vistaVirtualRemota'] : $lazo ).'" rel="'.$lazo.'"></div>' : '';
            
            $retornoCampos = '<div class="lazoCampos">'.$retornoCampos;
            $retornoCampos .= '
            <div class="lazoControles">
	            <div class="boton"><a href="#" class="autoLazo" rel="'.$lazo.'" vista="'.((isset(campos::$deflazo[$lazo]['vistaVirtual']) && isset(campos::$deflazo[$lazo]['vistaVirtualRemota'])) ? campos::$deflazo[$lazo]['vistaVirtualRemota'] : $lazo ).'">Agregar</a></div>
	            <div class="boton"><a href="#" class="reset" rel="'.$lazo.'">Cancelar</a></div>            
            </div>
            ';
            $retornoCampos .= '</div>';
            $retorno .= '<form id="lazo_'.$lazo.'" method="post">'.$retornoVista.$retornoCampos.'</form>';
            
            self::$pln = preg_replace( '/\[lazo\]'.$lazo.'\[\/lazo\]/', $retorno, self::$pln );
        }
    }
    
    private static function procesarVisuales()
    {
        if (self::$debug) error_log ('procesarVisuales'.' :: ' . strlen(self::$pln));
        $campos = array();
        preg_match_all('/\[visual](.*?)\[\/visual\]/s',self::$pln,$campos);
        
        foreach($campos[1] as $campo)
        {
            if ($retorno = plnUI::procesarVisual($campo))
            {               
                self::$pln = preg_replace( '/\[visual\]'.$campo.'\[\/visual\]/', $retorno, self::$pln );
            }
        }
    }
    
    
    private static function procesarCampos()
    {
        /* Plan:
          * 1. Encontrar todos los campos de .pln y descartar los que no existan en $defcv[$campo]
          * 2. Reemplazar [campo]$campo[/campo] con el nuevo tipo inferido de $defcv[$campo]['tipo']
          * 3. Dejar un marcador de reemplazo de valor, ya que por razones de memcache no lo ubicamos aqui.
        */
        
        if (self::$debug) error_log ('procesarCampos'.' :: ' . strlen(self::$pln));
        $campos = array();
        preg_match_all('/\[campo](.*?)\[\/campo\]/s',self::$pln,$campos);
        
        foreach($campos[1] as $campo)
        {
            if ($retorno = plnUI::procesarCampo($campo))
            {                
                self::$pln = preg_replace( '/\[campo\]'.$campo.'\[\/campo\]/', $retorno, self::$pln );
            }
                
        }
    }
    

    
    private static function reemplazarValores()
    {
        if (self::$debug) error_log ('reemplazarValores'.' :: ' . strlen(self::$pln));
           
        foreach(self::$campos as $tabla => $campos)
        {
           $c = 'SELECT '.join(', ',self::$campos[$tabla]).' FROM ' . $tabla.' WHERE ID_cuenta='.usuario::$info['ID_cuenta'];
           
           if (self::$debug) error_log('reemplazarValores.Query :: ' . $c);
           
           $r = db::consultar($c);           
           if (!$r) continue;
           
           $f = mysql_fetch_assoc($r);
           if (!$f) continue;
        
           foreach($campos as $campo)
           {
            if (isset($f[$campo]))
            {
            self::EstablecerCampo($tabla.'.'.$campo,$f[$campo]);
            if (self::$debug) error_log('reemplazarValores.EstablecerCampo :: ' . $tabla.'.'.$campo . '[ '. strlen(self::$pln) . ' ]');
            }
           }
        }
        
        self::$pln = preg_replace('/\$\$reemplazar\:\:.*?\$\$/','',self::$pln);
    }    
    
    private static function EstablecerCampo($campo,$valor)
    {
        
        if (!isset(campos::$defcampos[$campo]))
            return false;
     
        $campoEsc = preg_replace('/\./','_',$campo);
     
        if(isset(campos::$defcampos[$campo]['tipo']))
           $tipo = campos::$defcampos[$campo]['tipo'];
        else
            $tipo = uiForm::$textoSimple;
        
        switch ($tipo)
        {
            case uiForm::$cargarImagenOWebCam:
                self::$pln = preg_replace('/\$\$reemplazar\:\:'.$campoEsc.'\$\$/',ui::ObtenerImagen($valor,110,110,true),self::$pln);
                break;

            case uiForm::$memo:
                self::$pln = preg_replace('/\$\$reemplazar\:\:'.$campoEsc.'\$\$/',preg_replace('/\n/','<br />',$valor),self::$pln);
                break;

            case uiForm::$textoSimple:
            case uiForm::$correo:
            case uiForm::$fecha:
            case uiForm::$telefono:
                self::$pln = preg_replace('/\$\$reemplazar\:\:'.$campoEsc.'\$\$/',$valor,self::$pln);
                break;

            case uiForm::$comboboxSimple:
            case uiForm::$comboboxComplejo:
            case uiForm::$comboboxPaises:
                self::$pln = preg_replace('/(name="'.$campo.'".*?value="'.$valor.'")/','$1 selected="selected"',self::$pln,1);
                break;
                
            case uiForm::$sino:
            case uiForm::$radio:                        
                self::$pln = preg_replace('/(name="'.$campo.'".*?value="'.$valor.'")/','$1 checked="checked"',self::$pln,1);
                break;

            case uiForm::$cheque:
                if ($valor == "1")
                    self::$pln = preg_replace('/(id="'.$campoEsc.'")/','$1 checked="checked"',self::$pln,1);
                break;
        }
    }

    private static function procesarVistaLazos()
    {
        if (self::$debug) error_log ('procesarVistaLazos'.' :: ' . strlen(self::$pln));
        $lazos = array();
        preg_match_all('/\[vistalazo](.*?)\[\/vistalazo\]/s',self::$pln,$lazos);
        
        foreach($lazos[1] as $lazo)
        {
            if (!isset(campos::$deflazo[$lazo]))
                continue;
            
            self::$pln = preg_replace( '/\[vistalazo\]'.$lazo.'\[\/vistalazo\]/', self::VistaLazo($lazo), self::$pln );
        }
    }    
    
    private static function VistaLazo($lazo,$virtual=false)
    {
        $retorno = '';
	
	if (!is_array(campos::$deflazo[$lazo]['campos']) || !is_array((campos::$deflazo[$lazo]['vista'])) || (!$virtual && isset(campos::$deflazo[$lazo]['vistaVirtual'])) )
		return;
	
	$ID_table = 2;
	foreach(campos::$deflazo[$lazo]['campos'] as $campo)
	{
            if (!isset(campos::$defcampos[$campo]))
                continue;
            
            if (!preg_match('/(.*)\.(.*)/',$campo,$partes))
                continue;  
		
            $campos[] = $partes[2];
            
            if (campos::$defcampos[$campo]['tipo'] == uiForm::$comboboxPaises)
            { 
                campos::$defcampos[$campo]['datos']['tabla'] = 'datos_pais';
                campos::$defcampos[$campo]['datos']['clave'] = 'ID_pais';
                campos::$defcampos[$campo]['datos']['valor'] = 'pais';
            }
            
            if(isset(campos::$defcampos[$campo]['datos']) && is_array(campos::$defcampos[$campo]['datos']) && isset(campos::$defcampos[$campo]['datos']['tabla']) && isset(campos::$defcampos[$campo]['datos']['clave']) && isset(campos::$defcampos[$campo]['datos']['valor']))
            {
                $filtros = '';
                if (@is_array(campos::$defcampos[$campo]['datos']['filtros']))
                {
                    if (in_array('mios', campos::$defcampos[$campo]['datos']['filtros']))
                    {
                            $filtros = 'AND ID_cuenta='.usuario::$info['ID_cuenta'];
                    }
                }
                $campos[] = '(SELECT '.campos::$defcampos[$campo]['datos']['valor'].' FROM '.campos::$defcampos[$campo]['datos']['tabla'].' AS t'.$ID_table.' WHERE t'.$ID_table.'.'.campos::$defcampos[$campo]['datos']['clave'].' = t1.'.$partes[2].' '.$filtros.') AS '.$partes[2].'_valor';			
                $ID_table++;
            }
            
            if(isset(campos::$defcampos[$campo]['valores']))
            {
                $tmpCampo = '(CASE '.$partes[2];
                
                foreach (campos::$defcampos[$campo]['valores'] as $key => $value) {
                        $tmpCampo .= ' WHEN "'.$key.'" THEN "'.$value.'"';
                }
                
                $campos[] = $tmpCampo.' END) AS '.$partes[2].'_valor';
            }
	}

	if (is_array(@campos::$deflazo[$lazo]['vistaCamposExtra']))
	{
            foreach(campos::$deflazo[$lazo]['vistaCamposExtra'] as $campo)
            {
                $campos[] = $campo;	
            }
	}
	
    $tabla = isset(campos::$deflazo[$lazo]['paraTabla'])  ? campos::$deflazo[$lazo]['paraTabla'] : $lazo;
  	$c = 'SELECT ID_'.$tabla.', '.implode(',',$campos).' FROM '.$tabla .' AS t1 WHERE ID_cuenta="'.usuario::$info['ID_cuenta'].'"';
	
  	$r = db::consultar($c);
  	while ($f = mysql_fetch_assoc($r) )
	{
		$retorno .= '<div class="'.($virtual ? 'lazoVistaVirtual' : 'lazoVista').' '.@campos::$deflazo[$lazo]['vista']['class'].'">';
		if (!$virtual) $retorno .= '<span class="lazoVistaBolita">•</span>';
		$retorno .= '<table><tr>';
		if (isset(campos::$deflazo[$lazo]['vista']))
		{
                    foreach(campos::$deflazo[$lazo]['vista'] as $columna => $filas)
                    {
                        if (!is_array($filas))
                            continue;
                        $retorno .= '<td><table>';
                            foreach ($filas as $fila => $contenido) {
                                foreach ($f as $campo => $valor) {
                                        $contenido = preg_replace('/\$\$'.$campo.'\$\$/', $valor, $contenido);
                                }
                                $retorno .= '<tr><td>'.$contenido.'</td></tr>';
                            }
                        $retorno .= '</table></td>';
                    }
		}
		$retorno .= '</tr></table>';
		
		if (is_array(@campos::$deflazo[$lazo]['vistaUniones']))
		{
                    $retorno .= '<br />';
                    foreach (campos::$deflazo[$lazo]['vistaUniones'] as $Vista) {
                        $retorno .= self::VistaLazo($Vista,true);
                    }
		}
		$retorno .= '</div>';
	}
	$retorno .= '<br style="clear:both;" />';
        
        return $retorno;
    }
}

?>