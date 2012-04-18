<?php
class uiForm
{
    public static $cargarImagenOWebCam = 0;
    public static $textoSimple = 1;
    public static $comboboxSimple = 2;
    public static $comboboxComplejo = 3;
    public static $comboboxPaises = 4;
    public static $fecha = 5;
    public static $telefono = 6;
    public static $correo = 7;
    public static $sino = 8;
    public static $cheque = 9;
    public static $radio = 10;
    public static $memo = 11;
}

class ui
{
    public static function ObtenerImagen($archivo,$ancho,$alto,$crop)
    {
	error_log('Archivo :: ' . $archivo);
	
        $ruta = 'pool/img/'.$archivo;
        
	$prefijo = $crop ? 'crop' : 'imagen';
        
        if (empty($archivo) || !file_exists($ruta))
	    $archivo = 'sinfoto';
        
	$ruta = $prefijo.'_'.$ancho.'_'.$alto.'_'.$archivo.'.jpg';
	
        return $ruta;
    }
    
    public static function ArrayCheckbox($name,$clase, array $contenido, array $seleccionados)
    {
        $buffer = '';
        foreach($contenido as $valor => $texto)
        {
            $buffer .= sprintf('<div><input type="checkbox" name="%s[]" class="%s" value="%s" title="%s">%s</div>',$name,$clase,$valor,$texto,$texto);
        }
        return $buffer;
    }
}

class imagenes
{
    public static function crear_imagen($origen,$destino,$ancho,$alto)
    {    
        if(@($ancho*$alto) > 562500)
            die('La imagen solicitada excede el límite de este servicio');
    
        $origen = 'pool/img/'.$origen;
        $destino = 'pool/img/m/'.$destino;
        
        if (!file_exists($destino))
        {
           general::requerirModulo(array('phmagick'));
           $phMagick = new phMagick ($origen, $destino);
           $phMagick->resize($ancho,$alto,false);
        }
    
        header("Accept-Ranges: bytes",true);
        header("Content-Length: ".filesize($destino),true);
        header("Keep-Alive: timeout=15, max=100",true);
        header("Connection: Keep-Alive",true);
        header("Content-Type: image/jpeg",true);
        
        readfile($destino);
    }
  
    public static function crop_imagen($origen,$destino,$ancho,$alto)
    {    
        if(@($ancho*$alto) > 562500)
            die('La imagen solicitada excede el límite de este servicio');
    
        $origen = 'pool/img/'.$origen;
        $destino = 'pool/img/c/'.$destino;
        
        if (!file_exists($destino))
        {
           general::requerirModulo(array('phmagick'));
           $phMagick = new phMagick ($origen, $destino);
           $phMagick->resizeExactly($ancho,$alto);
        }
    
        header("Accept-Ranges: bytes",true);
        header("Content-Length: ".filesize($destino),true);
        header("Keep-Alive: timeout=15, max=100",true);
        header("Connection: Keep-Alive",true);
        header("Content-Type: image/jpeg",true);
    
        readfile($destino);
        
    }
}
?>