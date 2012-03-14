<?php
class errores
{
    public static $advertencia = 'advertencia';
    public static $error = 'error';
    public static $critico = 'critico';
    
}
class depurar
{
    private static function parse_backtrace()
    {
        $raw = debug_backtrace();
        $output="";
    
        foreach($raw as $entry)
        {
            $output.="Archivo: ".$entry['file']." (#".$entry['line'].")\n";
            $output.="Función: ".$entry['function']."\n";
        }
    
        return $output;
    }

    public static function registrar($titulo, $detalleDeError, $categoriaError)
    {
        $datos['titulo']        = $titulo;
        $datos['error']         = $detalleDeError;
        $datos['categoria']     = $categoriaError;
        $datos['trace']         = self::parse_backtrace();
        
        if (class_exists('db'))
            db::insertar('depurar', $datos);
        
        error_log(print_r($datos,true));
    }
}
?>