<?php
general::requerirModulo(array('plantilla.campos','plantilla.UI','plantilla.JS','ui'));
general::registrarEstiloCSS('pln','pln');
class pln
{
    public $pln;
    public $campos = array();
    private $debug = false;
    public function procesar($plantilla)
    {
        /* Plan:
          * Las plantillas son cacheables, pues no se ubican aca los valores
          * personales, por lo que primero hay que verificar si la plantilla
          * esta en memcache.
         */
        
        // MemCache
        // if ($mc = memcached('plantillas',$plantilla.'.pln')) {$this->pln = $mc; return;}
        
        $this->pln= file_get_contents(_BASE_plantilla.$plantilla.'.pln');
    
        $this->procesarTituloGeneral();
        if ($this->debug) error_log ('procesarTituloGeneral'.' :: ' . strlen($this->pln));
        $this->procesarGrupos();
        if ($this->debug) error_log ('procesarGrupos'.' :: ' . strlen($this->pln));
        $this->procesarSubTitulos();
        if ($this->debug) error_log ('procesarSubTitulos'.' :: ' . strlen($this->pln));
        $this->procesarTitulos();
        if ($this->debug) error_log ('procesarTitulos'.' :: ' . strlen($this->pln));
        $this->procesarLazos();
        if ($this->debug) error_log ('procesarLazos'.' :: ' . strlen($this->pln));
        $this->procesarVistaLazos();
        if ($this->debug) error_log ('procesarVistaLazos'.' :: ' . strlen($this->pln));
        $this->procesarCampos();
        if ($this->debug) error_log ('procesarCampos'.' :: ' . strlen($this->pln));
        $this->procesarVisuales();
        if ($this->debug) error_log ('procesarVisuales'.' :: ' . strlen($this->pln));
        
        // Finalmente reemplazamos los valores con los del usuario
        $this->reemplazarValores();
        if ($this->debug) error_log ('reemplazarValores'.' :: ' . strlen($this->pln));
    }
    
    // ==0:ABC==
    private function procesarTituloGeneral()
    {
        $this->pln = preg_replace('/==([0-9]*?)\:(.*)==(.*)/s','<div id="TituloGeneral"><span class="numeroGeneral">Paso $1</span> $2</div>'."\n".'<div id="contenido">'."\n".'$3'."\n".'</div> <!-- Contenido !-->'."\n",$this->pln);
        $this->pln = preg_replace('/==(.*)==(.*)/s','<div id="TituloGeneral">$1</div>'."\n".'<div id="contenido">'."\n".'$2'."\n".'</div> <!-- Contenido !-->'."\n",$this->pln);
    }
    
    private function procesarGrupos()
    {
        $this->pln = preg_replace(array('/\[grupo\:(.*?)\]/','/\[\/grupo\]/'),array('<div class="grupo" id="grupo_$1">','</div>'),$this->pln);
    }
    
    private function procesarTitulos()
    {
        $this->pln = preg_replace('/\[titulo\:([0-9]*?)](.*?)\[\/titulo\]/s','<div class="titulo"><span class="numeroTitulo">$1</span> $2</div>',$this->pln);
        $this->pln = preg_replace('/\[titulo](.*?)\[\/titulo\]/s','<div class="titulo">$1</div>',$this->pln);
    }
    
    private function procesarSubTitulos()
    {
        $this->pln = preg_replace('/\[subtitulo](.*?)\[\/subtitulo\]/s','<div class="subtitulo">$1</div>',$this->pln);
    }
    
    private function procesarLazos()
    {
        $lazos = array();
        preg_match_all('/\[lazo](.*?)\[\/lazo\]/s',$this->pln,$lazos);
        
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
            
            $this->pln = preg_replace( '/\[lazo\]'.$lazo.'\[\/lazo\]/', $retorno, $this->pln );
        }
    }
    
    private function procesarVisuales()
    {
        $campos = array();
        preg_match_all('/\[visual](.*?)\[\/visual\]/s',$this->pln,$campos);
        
        foreach($campos[1] as $campo)
        {
            if ($retorno = plnUI::procesarVisual($campo))
            {
                if (preg_match('/(.*)\.(.*)/',$campo,$partes))
                {
                    $this->campos[$partes[1]][]= $partes[2];
                }
                
                $this->pln = preg_replace( '/\[visual\]'.$campo.'\[\/visual\]/', $retorno, $this->pln );
            }
        }
    }
    
    
    private function procesarCampos()
    {
        /* Plan:
          * 1. Encontrar todos los campos de .pln y descartar los que no existan en $defcv[$campo]
          * 2. Reemplazar [campo]$campo[/campo] con el nuevo tipo inferido de $defcv[$campo]['tipo']
          * 3. Dejar un marcador de reemplazo de valor, ya que por razones de memcache no lo ubicamos aqui.
        */
        
        $campos = array();
        preg_match_all('/\[campo](.*?)\[\/campo\]/s',$this->pln,$campos);
        
        foreach($campos[1] as $campo)
        {
            if ($retorno = plnUI::procesarCampo($campo))
            {
                if(!$esLazo)
                {
                    $partes = null;
                    
                    if (preg_match('/(.*)\.(.*)/',$campo,$partes))
                    {
                        $this->campos[$partes[1]][]= $partes[2];
                    }
                }
                
                $this->pln = preg_replace( '/\[campo\]'.$campo.'\[\/campo\]/', $retorno, $this->pln );
            }
                
        }
    }
    

    
    private function reemplazarValores()
    {
        
        foreach($this->campos as $tabla => $campos)
        {
           $c = 'SELECT '.join(', ',$this->campos[$tabla]).' FROM ' . $tabla.' WHERE ID_cuenta='.usuario::$info['ID_cuenta'];
           
           if ($this->debug) error_log('reemplazarValores.Query :: ' . $c);
           
           $r = db::consultar($c);           
           if (!$r) continue;
           
           $f = mysql_fetch_assoc($r);
           if (!$f) continue;
        
           foreach($campos as $campo)
           {
            if (isset($f[$campo]))
            {
            $this->EstablecerCampo($tabla.'.'.$campo,$f[$campo]);
            if ($this->debug) error_log('reemplazarValores.EstablecerCampo :: ' . $tabla.'.'.$campo . '[ '. strlen($this->pln) . ' ]');
            }
           }
        }
        
        $this->pln = preg_replace('/\$\$reemplazar\:\:.*?\$\$/','',$this->pln);
    }    
    
    private function EstablecerCampo($campo,$valor)
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
                $this->pln = preg_replace('/\$\$reemplazar\:\:'.$campoEsc.'\$\$/',ui::ObtenerImagen($valor,110,110,true),$this->pln);
                break;

            case uiForm::$textoSimple:
            case uiForm::$correo:
            case uiForm::$memo:
            case uiForm::$fecha:
            case uiForm::$telefono:
                $this->pln = preg_replace('/\$\$reemplazar\:\:'.$campoEsc.'\$\$/',$valor,$this->pln);
                break;

            case uiForm::$comboboxSimple:
            case uiForm::$comboboxComplejo:
            case uiForm::$comboboxPaises:
                $this->pln = preg_replace('/(id="'.$campoEsc.'".*?value="'.$valor.'")/','$1 selected="selected"',$this->pln,1);
                break;
                
            case uiForm::$sino:
            case uiForm::$radio:                        
                $this->pln = preg_replace('/(id="'.$campoEsc.'".*?value="'.$valor.'")/','$1 checked="checked"',$this->pln,1);
                break;

            case uiForm::$cheque:
                if ($valor == "1")
                    $this->pln = preg_replace('/(id="'.$campoEsc.'")/','$1 checked="checked"',$this->pln,1);
                break;
        }
    }

    private function procesarVistaLazos()
    {
        $lazos = array();
        preg_match_all('/\[vistalazo](.*?)\[\/vistalazo\]/s',$this->pln,$lazos);
        
        foreach($lazos[1] as $lazo)
        {
            if (!isset(campos::$deflazo[$lazo]))
                continue;
            
            $this->pln = preg_replace( '/\[vistalazo\]'.$lazo.'\[\/vistalazo\]/', $this->VistaLazo($lazo), $this->pln );
        }
    }    
    
    function VistaLazo($lazo,$virtual=false)
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
                        $retorno .= $this->VistaLazo($Vista,true);
                    }
		}
		$retorno .= '</div>';
	}
	$retorno .= '<br style="clear:both;" />';
        
        return $retorno;
    }
}

?>