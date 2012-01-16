<?php

class general
{    
    private static $ModulosDisponibles = array();    
    private static $ModulosActivos = array();
    public static $config = array();
    public static $arrJS = array();
    public static $arrCSS = array();
    public static $extra = '';


public static function registrarScriptJS($nombreScriptJS, $nombreInclude)
{
    if (!isset(self::$arrJS[$nombreScriptJS]))
        self::$arrJS[$nombreScriptJS] = $nombreInclude;
    else
        depurar::registrar('general::registrarScriptJS','Script JS ya registrado, omitiendo', errores::$advertencia);
}

public static function registrarEstiloCSS($nombreEstiloCSS, $nombreInclude)
{
    if (!isset(self::$arrCSS[$nombreEstiloCSS]))
        self::$arrCSS[$nombreEstiloCSS] = $nombreInclude;
    else
        depurar::registrar('general::registrarEstiloCSS','Estilo CSS ya registrado, omitiendo', errores::$advertencia);
}

public static function registrarModulo($nombreModulo, $nombreInclude)
{
    if (!isset(self::$ModulosDisponibles[$nombreModulo]))
        self::$ModulosDisponibles[$nombreModulo] = $nombreInclude;
    else
        depurar::registrar('general::registrarModulo','Módulo ya registrado, omitiendo', errores::$advertencia);
}

public static function requerirModulo(array $nombreModulos)
{
    foreach ($nombreModulos as $nombreModulo)
    {
        // Existe el modulo?
        if (!isset(self::$ModulosDisponibles[$nombreModulo]))
        {
            depurar::registrar('general::requerirModulo','Módulo no registrado, compruebe ortografía', errores::$advertencia);
            return;
        }
        
        // Si no esta ya activo y si existe entre los disponibles
        if (!isset(self::$ModulosActivos[$nombreModulo]))
        {
            require_once (_BASE_modulo.self::$ModulosDisponibles[$nombreModulo]);
            self::$ModulosActivos[$nombreModulo] = true;    
        }
    }
}
}

/* Registremos todas los modulos que creamos necesarios */  
general::registrarModulo('sesion_facebook','sesion_facebook.php');
general::registrarModulo('facebook-sdk','facebook/facebook.php');
general::registrarModulo('plantilla-general','plantilla_general.php');
general::registrarModulo('ui','ui.php');
general::registrarModulo('plantilla','pln.php');
general::registrarModulo('controlador_pasos','controlador_pasos.php');
general::registrarModulo('cv','cv.php');
general::registrarModulo('phmagick','phmagick/phmagick.php');
general::registrarScriptJS('jquery','jquery-1.6.2');

?>