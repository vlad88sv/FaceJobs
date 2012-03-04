<?php
class plnUI
{

    public static function procesarCampo($campo,$esLazo = false)
    {
        $filtros = $retorno = "";
        if (!isset(campos::$defcampos[$campo]))
            return false;
        
        $campoEsc = preg_replace('/\./','_',$campo);
        
        if(isset(campos::$defcampos[$campo]['tipo']))
           $tipo = campos::$defcampos[$campo]['tipo'];
        else
            $tipo = uiForm::$textoSimple;
                
        if(isset(campos::$defcampos[$campo]['texto']))
            $retorno .= '<span class="tituloCampo">'.campos::$defcampos[$campo]['texto'].'</span> ';
                
        switch ($tipo)
        {
            case uiForm::$cargarImagenOWebCam:
                $retorno .= '
                        <div style="text-align:center;height:110px;"><img $$identificacion$$ src="$$reemplazar::'.$campoEsc.'$$" /></div>
                        <div rel="'.$campoEsc.'" class="cargar-archivo">Subir fotografía</div>
                        ';
                break;
            
            case uiForm::$textoSimple:
                $retorno .= '<input type="text" $$identificacion$$ maxlength="'.(isset(campos::$defcampos[$campo]['longitud']) ? campos::$defcampos[$campo]['longitud'] : '500').'" value="$$reemplazar::'.$campoEsc.'$$" />';
                break;
            
            case uiForm::$comboboxSimple;
                $options = '<option value="">Seleccione</option>';
                if(is_array(campos::$defcampos[$campo]['valores']))
                {
                    foreach (campos::$defcampos[$campo]['valores'] as $valor => $texto)
                        $options .= '<option value="'.$valor.'">'.$texto.'</option>';
                }
                $retorno .= '<select $$identificacion$$>'.$options.'</select>';
                break;
                
            case uiForm::$comboboxPaises:
                campos::$defcampos[$campo]['datos']['tabla'] = 'datos_pais';
                campos::$defcampos[$campo]['datos']['clave'] = 'ID_pais';
                campos::$defcampos[$campo]['datos']['valor'] = 'pais';
                
            case uiForm::$comboboxComplejo:
                $options = '<option value="">Seleccione</option>';
                if(is_array(campos::$defcampos[$campo]['datos']) && isset(campos::$defcampos[$campo]['datos']['tabla']) && isset(campos::$defcampos[$campo]['datos']['clave']) && isset(campos::$defcampos[$campo]['datos']['valor']))
                {
                    if (isset(campos::$defcampos[$campo]['datos']['filtros']) && in_array('mios', campos::$defcampos[$campo]['datos']['filtros']))
                    {
                        $filtros = 'AND ID_cuenta='.usuario::$info['ID_cuenta'];
                    }
                    $c = 'SELECT '.campos::$defcampos[$campo]['datos']['clave'].' AS "clave", '.campos::$defcampos[$campo]['datos']['valor'].' AS "valor" FROM '.campos::$defcampos[$campo]['datos']['tabla'].' WHERE 1 ' . $filtros;
                    $r = db::consultar($c);
                    while ($f = mysql_fetch_assoc($r))
                        $options .= '<option value="'.$f['clave'].'">'.$f['valor'].'</option>';
                }
                $retorno .= '<select $$identificacion$$>'.$options.'</select>';
                break;
            
            case uiForm::$fecha:
                if (!isset(campos::$defcampos[$campo]['flags']))
                    campos::$defcampos[$campo]['flags'] = 'DMY';
                
                for($i=1; $i < 32; $i++)
                {
                    $dia[$i] = $i;
                }
                
                $mes[1] = 'Enero';
                $mes[2] = 'Febrero';
                $mes[3] = 'Marzo';
                $mes[4] = 'Abril';
                $mes[5] = 'Mayo';
                $mes[6] = 'Junio';
                $mes[7] = 'Julio';
                $mes[8] = 'Agosto';
                $mes[9] = 'Septiembre';
                $mes[10] = 'Octubre';
                $mes[11] = 'Noviembre';
                $mes[12] = 'Diciembre';
                
                for($i=(isset ($defcv[$campo]['anoLimite']) ? $defcv[$campo]['anoLimite'] : 2012) ; $i >1950 ; $i--)
                {
                    $ano[$i] = $i;
                }
                switch (campos::$defcampos[$campo]['flags'])
                {
                    
                    case 'DMY':
                        campos::$defcampos[$campo.'Dia']['tipo'] = uiForm::$comboboxSimple;
                        campos::$defcampos[$campo.'Dia']['valores'] = $dia;
                        campos::$defcampos[$campo.'Dia']['enLinea'] = true;                        
                        $retorno .= self::procesarCampo($campo.'Dia',$esLazo);
                        
                        campos::$defcampos[$campo.'Mes']['tipo'] = uiForm::$comboboxSimple;
                        campos::$defcampos[$campo.'Mes']['valores'] = $mes;
                        campos::$defcampos[$campo.'Mes']['enLinea'] = true;
                        $retorno .= self::procesarCampo($campo.'Mes',$esLazo);
                        
                        campos::$defcampos[$campo.'Ano']['tipo'] = uiForm::$comboboxSimple;
                        campos::$defcampos[$campo.'Ano']['valores'] = $ano;
                        campos::$defcampos[$campo.'Ano']['enLinea'] = true;
                        $retorno .= self::procesarCampo($campo.'Ano',$esLazo);
                    break;
                
                    case 'MY':
                        campos::$defcampos[$campo.'Mes']['tipo'] = uiForm::$comboboxSimple;
                        campos::$defcampos[$campo.'Mes']['valores'] = $mes;
                        campos::$defcampos[$campo.'Mes']['enLinea'] = true;
                        $retorno .= self::procesarCampo($campo.'Mes',$esLazo);
                        
                        campos::$defcampos[$campo.'Ano']['tipo'] = uiForm::$comboboxSimple;
                        campos::$defcampos[$campo.'Ano']['valores'] = $ano;
                        campos::$defcampos[$campo.'Ano']['enLinea'] = true;
                        $retorno .= self::procesarCampo($campo.'Ano',$esLazo);
                    break;
                
                    case 'Y':
                        campos::$defcampos[$campo]['tipo'] = uiForm::$comboboxSimple;
                        campos::$defcampos[$campo]['valores'] = $ano;
                        campos::$defcampos[$campo]['enLinea'] = true;
                        return self::procesarCampo($campo,$esLazo);
                    break;
                }
                break;

            case uiForm::$telefono:
                $retorno .= '<input type="text" $$identificacion$$ value="$$reemplazar::'.$campoEsc.'$$" />';
                break;
                
            case uiForm::$correo:
                $retorno .= '<input type="text" $$identificacion$$ value="$$reemplazar::'.$campoEsc.'$$" />';
                break;

            case uiForm::$sino:
                $retorno .= '<input type="radio" name="'.$campo.'" id="'.$campoEsc.'_si" value="1" /> <label for="'.$campoEsc.'_si">Si</label> <input type="radio" name="'.$campo.'" id="'.$campoEsc.'_no" value="0" />  <label for="'.$campoEsc.'_no">No</label> ';
                break;
            
            case uiForm::$cheque:
                $retorno .= '<input type="checkbox" $$identificacion$$ value="1" />';
                break;
            
            case uiForm::$radio:
                $options = '';
                if(is_array(campos::$defcampos[$campo]['valores']))
                {
                    foreach (campos::$defcampos[$campo]['valores'] as $valor => $texto)
                        $retorno .= '<input type="radio" name="'.$campo.'" id="'.$campoEsc.'_'.$valor.'" value="'.$valor.'"/> <label for="'.$campoEsc.'_'.$valor.'">' . $texto . '</label>';
                }
                break;

            case uiForm::$memo:
                $retorno .= '<br /><textarea $$identificacion$$>$$reemplazar::'.$campoEsc.'$$</textarea>';
                break;
            
            default:
                return false;
                break;
        }

        $retorno = preg_replace('/\$\$identificacion\$\$/',($esLazo ? '' : 'class="auto" ').'rel="'.$campo.'" name="'.$campo.'" id="'.$campoEsc.'"',$retorno);
        
        if(isset(campos::$defcampos[$campo]['subtexto']))
            $retorno .= '<br /><span class="subtituloCampo">'.campos::$defcampos[$campo]['subtexto'].'</span>';
        
        if(!isset(campos::$defcampos[$campo]['enLinea']))
            $retorno .= '<br />'."\n";
            
        
        $partes = null;
    
        if (!$esLazo && preg_match('/(.*)\.(.*)/',$campo,$partes))
        {
            pln::$campos[$partes[1]][]= $partes[2];
        }

        return $retorno;
    }    

    public static function procesarVisual($campo,$esLazo = false)
    {
        $retorno = "";
        if (!isset(campos::$defcampos[$campo]))
            return false;
        
        $campoEsc = preg_replace('/\./','_',$campo);
        
        if(isset(campos::$defcampos[$campo]['tipo']))
           $tipo = campos::$defcampos[$campo]['tipo'];
        else
            $tipo = uiForm::$textoSimple;
                
        if(isset(campos::$defcampos[$campo]['texto']))
            $retorno .= '<span class="tituloCampo">'.campos::$defcampos[$campo]['texto'].'</span> ';
                
        switch ($tipo)
        {
            case uiForm::$cargarImagenOWebCam:
                $retorno .= '<img src="$$reemplazar::'.$campoEsc.'$$" />';
                break;
            
            case uiForm::$textoSimple:
                $retorno .= '<span class="visualTexto">$$reemplazar::'.$campoEsc.'$$</span>';
                break;
            
            case uiForm::$comboboxSimple;
                $options = '<option value="">Seleccione</option>';
                if(is_array(campos::$defcampos[$campo]['valores']))
                {
                    foreach (campos::$defcampos[$campo]['valores'] as $valor => $texto)
                        $options .= '<option value="'.$valor.'">'.$texto.'</option>';
                }
                $retorno .= '<select class="plnUI_extraer" disabled="disabled" $$identificacion$$>'.$options.'</select>';
                break;
                
            case uiForm::$comboboxPaises:
                campos::$defcampos[$campo]['datos']['tabla'] = 'datos_pais';
                campos::$defcampos[$campo]['datos']['clave'] = 'ID_pais';
                campos::$defcampos[$campo]['datos']['valor'] = 'pais';
                
            case uiForm::$comboboxComplejo:
                $filtros = '';
                $options = '<option value="">Seleccione</option>';
                if(is_array(campos::$defcampos[$campo]['datos']) && isset(campos::$defcampos[$campo]['datos']['tabla']) && isset(campos::$defcampos[$campo]['datos']['clave']) && isset(campos::$defcampos[$campo]['datos']['valor']))
                {
                    if (isset(campos::$defcampos[$campo]['datos']['filtros']) && in_array('mios', campos::$defcampos[$campo]['datos']['filtros']))
                    {
                        $filtros = 'AND ID_cuenta='.usuario::$info['ID_cuenta'];
                    }
                    $c = 'SELECT '.campos::$defcampos[$campo]['datos']['clave'].' AS "clave", '.campos::$defcampos[$campo]['datos']['valor'].' AS "valor" FROM '.campos::$defcampos[$campo]['datos']['tabla'].' WHERE 1 ' . $filtros;
                    $r = db::consultar($c);
                    while ($f = mysql_fetch_assoc($r))
                        $options .= '<option value="'.$f['clave'].'">'.$f['valor'].'</option>';
                }
                $retorno .= '<select class="plnUI_extraer" disabled="disabled" $$identificacion$$>'.$options.'</select>';
                break;
            
            case uiForm::$fecha:
                if (!isset(campos::$defcampos[$campo]['flags']))
                campos::$defcampos[$campo]['flags'] = 'DMY';
                
                for($i=1; $i < 32; $i++)
                {
                    $dia[$i] = $i;
                }
                
                $mes[1] = 'Enero';
                $mes[2] = 'Febrero';
                $mes[3] = 'Marzo';
                $mes[4] = 'Abril';
                $mes[5] = 'Mayo';
                $mes[6] = 'Junio';
                $mes[7] = 'Julio';
                $mes[8] = 'Agosto';
                $mes[9] = 'Septiembre';
                $mes[10] = 'Octubre';
                $mes[11] = 'Noviembre';
                $mes[12] = 'Diciembre';
                
                for($i=(isset ($defcv[$campo]['anoLimite']) ? $defcv[$campo]['anoLimite'] : 2012) ; $i >1950 ; $i--)
                {
                    $ano[$i] = $i;
                }
                switch (campos::$defcampos[$campo]['flags'])
                {
                    
                    case 'DMY':
                        campos::$defcampos[$campo.'Dia']['tipo'] = uiForm::$comboboxSimple;
                        campos::$defcampos[$campo.'Dia']['valores'] = $dia;
                        campos::$defcampos[$campo.'Dia']['enLinea'] = true;                        
                        $retorno .= self::procesarVisual($campo.'Dia',$esLazo) . ' / ';
                        
                        campos::$defcampos[$campo.'Mes']['tipo'] = uiForm::$comboboxSimple;
                        campos::$defcampos[$campo.'Mes']['valores'] = $mes;
                        campos::$defcampos[$campo.'Mes']['enLinea'] = true;
                        $retorno .= self::procesarVisual($campo.'Mes',$esLazo) . ' / ';
                        
                        campos::$defcampos[$campo.'Ano']['tipo'] = uiForm::$comboboxSimple;
                        campos::$defcampos[$campo.'Ano']['valores'] = $ano;
                        campos::$defcampos[$campo.'Ano']['enLinea'] = true;
                        $retorno .= self::procesarVisual($campo.'Ano',$esLazo);
                    break;
                
                    case 'MY':
                        campos::$defcampos[$campo.'Mes']['tipo'] = uiForm::$comboboxSimple;
                        campos::$defcampos[$campo.'Mes']['valores'] = $mes;
                        campos::$defcampos[$campo.'Mes']['enLinea'] = true;
                        $retorno .= self::procesarVisual($campo.'Mes',$esLazo) . ' / ';
                        
                        campos::$defcampos[$campo.'Ano']['tipo'] = uiForm::$comboboxSimple;
                        campos::$defcampos[$campo.'Ano']['valores'] = $ano;
                        campos::$defcampos[$campo.'Ano']['enLinea'] = true;
                        $retorno .= self::procesarVisual($campo.'Ano',$esLazo);
                    break;
                
                    case 'Y':
                        campos::$defcampos[$campo]['tipo'] = uiForm::$comboboxSimple;
                        campos::$defcampos[$campo]['valores'] = $ano;
                        campos::$defcampos[$campo]['enLinea'] = true;
                        return self::procesarVisual($campo,$esLazo);
                    break;
                }
                break;

            case uiForm::$telefono:
                $retorno .= '<span class="visualTexto">$$reemplazar::'.$campoEsc.'$$</span>';
                break;
                
            case uiForm::$correo:
                $retorno .= '<span class="visualTexto">$$reemplazar::'.$campoEsc.'$$</span>';
                break;

            case uiForm::$sino:
                $retorno .= '<input class="plnUI_extraerRadio" disabled="disabled" type="radio" name="'.$campo.'" id="'.$campoEsc.'_si" value="1" /> <label for="'.$campoEsc.'_si">Si</label> <input class="plnUI_extraerRadio" disabled="disabled" type="radio" name="'.$campo.'" id="'.$campoEsc.'_no" value="0" />  <label for="'.$campoEsc.'_no">No</label> ';
                break;
            
            case uiForm::$cheque:
                $retorno .= '<input disabled="disabled" type="checkbox" $$identificacion$$ value="1" />';
                break;
            
            case uiForm::$radio:
                $options = '';
                if(is_array(campos::$defcampos[$campo]['valores']))
                {
                    $i = 0;
                    foreach (campos::$defcampos[$campo]['valores'] as $valor => $texto)
                    {
                        $retorno .= '<input class="plnUI_extraerRadio" disabled="disabled" type="radio" name="'.$campo.'" id="'.$campoEsc.'_'.$valor.'" value="'.$valor.'"/> <label for="'.$campoEsc.'_'.$valor.'">' . $texto . '</label>';
                        $i++;
                    }
                }
                break;

            case uiForm::$memo:
                $retorno .= '<br /><div class="textarea" $$identificacion$$>$$reemplazar::'.$campoEsc.'$$</div>';
                break;
        }
        
        $retorno = preg_replace('/\$\$identificacion\$\$/','name="'.$campo.'" id="'.$campoEsc.'"',$retorno);

        
        if(isset(campos::$defcampos[$campo]['subtexto']))
            $retorno .= '<br /><span class="subtituloCampo">'.campos::$defcampos[$campo]['subtexto'].'</span>';
        
        if(!isset(campos::$defcampos[$campo]['enLinea']))
            $retorno .= '<br />'."\n";
        
        $partes = null;
        
        if (!$esLazo && preg_match('/(.*)\.(.*)/',$campo,$partes))
        {
            pln::$campos[$partes[1]][]= $partes[2];
        }
        
        return $retorno;
    }
    
}
?>
