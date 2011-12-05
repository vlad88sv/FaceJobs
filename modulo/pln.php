<?php
class pln
{
    public $pln;
    public function procesar($plantilla)
    {
        /* Plan:
          * Las plantillas son cacheables, pues no se ubican aca los valores
          * personales, por lo que primero hay que verificar si la plantilla
          * esta en memcache.
         */
        
        // MemCache
        // if ($mc = memcached('plantillas',$plantilla.'.pln')) {$this->pln = $mc; return;}
        
        general::requerirModulo(array('ui','cv'));
        
        $this->pln= file_get_contents(_BASE_plantilla.$plantilla.'.pln');
    
        $this->procesarTituloGeneral();
        $this->procesarGrupos();
        $this->procesarSubTitulos();
        $this->procesarTitulos();
        $this->procesarLazos();
        $this->procesarCampos();
        
    }
    
    // ==0:ABC==
    private function procesarTituloGeneral()
    {
        $this->pln = preg_replace('/==([0-9]*?)\:(.*)==(.*)/s','<div id="TituloGeneral"><span class="numeroGeneral">Paso $1</span> $2</div>'."\n".'<div id="contenido">'."\n".'$3'."\n".'</div> <!-- Contenido !-->'."\n",$this->pln);
    }
    
    private function procesarGrupos()
    {
        $this->pln = preg_replace('/\[grupo\:(.*?)\](.*?)\[\/grupo\]/s','<div class="grupo" id="grupo_$1">$2</div>',$this->pln);
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
            if (!isset(cv::$deflazo[$lazo]))
                continue;

            $retornoCampos = "";
            $retornoVista = "";
            
            /* Procesar la vista */
            /* *falta* */
            
            /* Procesar los campos */
            $campos = array();
            foreach(cv::$deflazo[$lazo]['campos'] as $campo)
            {
                $retornoCampos .= $this->procesarCampo($campo);
            }
            
            $retornoVista = '<div class="lazoVista">'.$retornoVista.'</div>';            
            $retornoCampos = '<div class="lazoCampos">'.$retornoCampos.'</div>';
            
            $retorno .= $retornoVista.$retornoCampos;
            
            $this->pln = preg_replace( '/\[lazo\]'.$lazo.'\[\/lazo\]/', $retorno, $this->pln );
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
            if ($retorno = $this->procesarCampo($campo));
            $this->pln = preg_replace( '/\[campo\]'.$campo.'\[\/campo\]/', $retorno, $this->pln );
        }
    }
    
    private function procesarCampo($campo)
    {
        $retorno = "";
        if (!isset(cv::$defcv[$campo]))
            return false;
        
        if(isset(cv::$defcv[$campo]['tipo']))
           $tipo = cv::$defcv[$campo]['tipo'];
        else
            $tipo = uiForm::$textoSimple;
                
        if(isset(cv::$defcv[$campo]['texto']))
            $retorno .= '<span class="tituloCampo">'.cv::$defcv[$campo]['texto'].'</span> ';
                
        switch ($tipo)
        {
            case uiForm::$cargarImagenOWebCam:
                $retorno .= '<div><img src="$$reemplazar::'.$campo.'$$" /><input type="file" name="'.$campo.'" id="'.$campo.'" /></div>';
                break;
            
            case uiForm::$textoSimple:
                $retorno .= '<input type="text" name="'.$campo.'" id="'.$campo.'" value="$$reemplazar::'.$campo.'$$" />';
                break;
            
            case uiForm::$comboboxSimple;
                $retorno .= '<select name="'.$campo.'" id="'.$campo.'"></select>';
                break;
                
            case uiForm::$comboboxComplejo:
                $retorno .= '<select name="'.$campo.'" id="'.$campo.'"></select>';
                break;

            case uiForm::$comboboxPaises:
                $retorno .= '<select name="'.$campo.'" id="'.$campo.'"></select>';
                break;

            case uiForm::$fecha:
                $retorno .= '<input type="text" name="'.$campo.'" id="'.$campo.'" value="$$reemplazar::'.$campo.'$$" />';
                break;

            case uiForm::$telefono:
                $retorno .= '<input type="text" name="'.$campo.'" id="'.$campo.'" value="$$reemplazar::'.$campo.'$$" />';
                break;
                
            case uiForm::$correo:
                $retorno .= '<input type="text" name="'.$campo.'" id="'.$campo.'" value="$$reemplazar::'.$campo.'$$" />';
                break;

            case uiForm::$sino:
                $retorno .= '<input type="radio" name="'.$campo.'" id="'.$campo.'" selected="$$reemplazar::'.$campo.'$$" /> Si <input type="radio" name="'.$campo.'" id="'.$campo.'" selected="$$reemplazar::'.$campo.'$$" /> No ';
                break;
            
            case uiForm::$cheque:
                $retorno .= '<input type="checkbox" name="'.$campo.'" id="'.$campo.'" checked="$$reemplazar::'.$campo.'$$" />';
                break;
            
            case uiForm::$radio:
                $retorno .= '<input type="radio" name="'.$campo.'" id="'.$campo.'" selected="$$reemplazar::'.$campo.'$$" /> Opciones';
                break;
        }
        
        if(!isset(cv::$defcv[$campo]['enLinea']))
            $retorno .= '<br />'."\n";
        
        return $retorno;    
    }    
    
}

?>