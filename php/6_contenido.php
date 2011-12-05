<?php

class head
{
    public static $titulo;
    
    public static function obtenerScriptsJS()
    {
        $buffer = "";
        
        foreach (general::$arrJS as $script)
        {
            $src = 'js/'.$script.'.js';
            if (file_exists($src))
                $buffer .= '<script src="'.$src.'"></script>'."\n";
            else
                depurar::registrar('Imposible obtener Script JS', 'head::obtenerScriptsJS ~ '.$src, errores::$error);
        }   
        return $buffer;
    }

    public static function obtenerEstilosCSS()
    {
        $buffer = "";
        foreach (general::$arrCSS as $nombre => $archivo)
        {
            $href = 'css/'.$archivo.'.css';
            if (file_exists($href))
                $buffer .= '<link rel="stylesheet" type="text/css" name="'.$nombre.'" href="'.$href.'">'."\n";
            else
                depurar::registrar('Imposible obtener estilo CSS', 'head::obtenerEstilosCSS ~ '.$href, errores::$error);
        }   
        return $buffer;
    }

}

class body
{
    public static $inicio = "";
    public static $contenido = "";
    public static $final = "";
    
    
    /*
     cargarContenido($contenidoArchivo, $requerir)
        Parametros:
            $contenidoArchivo: [string] nombre del archivo con el contenido.
            $procesar: [bool] true=require | false=file_get_contents
    */
    private static function cargarContenido($contenidoArchivo, $procesar)
    {
        $archivo = _BASE_contenido.frontend::$frontend.'/'.$contenidoArchivo.'.php';
        if (!file_exists($archivo))
        {
            depurar::registrar('contenido::cargarContenido', 'Archivo no encontrado: '.$contenidoArchivo, errores::$critico);
            return;
        }
        
        if ($procesar)
        {
            ob_start();
            require($archivo);
            return ob_get_clean();
        }
        else
        {
            return file_get_contents($archivo);
        }
    }
    
    private static function agregar($contenidoArchivo, $donde, $procesar)
    {
        $contenido = self::cargarContenido($contenidoArchivo, $procesar)."\n";
        
        switch($donde)
        {
            case 'inicio':
                self::$inicio .= $contenido;
                break;
            case 'contenido':
                self::$contenido .= $contenido;
                break;
            case 'final':
                self::$final .= $contenido;
                break;
            default:
                depurar::registrar('contenido::agregar','Se intento agregar contenido en '.$donde, errores::$advertencia);
        }
    }
    
    public static function agregarAlInicio($contenido, $procesar)
    {
        self::agregar($contenido,'inicio', $procesar);
    }

    public static function agregarAlContenido($contenido, $procesar)
    {
        self::agregar($contenido,'contenido', $procesar);
    }

    public static function agregarContenidoAlContenido($contenido)
    {
        self::$contenido .= $contenido;
    }
    
    public static function agregarAlFinal($contenido, $procesar)
    {
        self::agregar($contenido,'final', $procesar);
    }    
}
?>