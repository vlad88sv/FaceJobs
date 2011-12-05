<?php
// control de internalización
/*
 Funciones:
 + Hacks especificos por país, banderas, centros educativos.
  
 Limites:
 + No maneja traducciones
  
 Datos:
 + Fecha de creación: 2 de Septiembre de 2011
 + Creado por: Vladimir Hidalgo
 + Diseño: Vladimir Hidalgo
 + Mantemiento:  Vladimir Hidalgo
*/
class internacional
{
    /*
     ObtenerBandera
     Obtiene la URL de la imagen de la bandera deseada
     en el tamaño y formato espeficado
        Parametros
            $pais       = País del que se desea obtener el icono de la bandera.
            $ancho      = Ancho en pixeles de la imagen.
            $alto       = Alto en pixeles de la imagen.
            $formato    = [jpeg|png|gif]
        Resultados
            $url = URL absoluta para usarse en "SRC" de un <img>
    */
    public static function ObtenerBandera(string $pais, int $ancho, int $alto, string $formato)
    {
        $url = '<img title="nombre_del_pais" src="URL absoluta de la imagen" />';
        return $url;
    }
    
    /*
     ObtenerListadoEducacionSuperior
     Retorna una lista de coincidencias de Universidades por país
     en base a la "$pista" qe se entregue. AKA autocomplete.
        Parametros
            $pais   = País del que se desea obtener el icono de la bandera.
            $pista  = 
    */
    public static function ObtenerListadoEducacionSuperior($pais, $pista)
    {
        
    }
    
    /*
     EstablecerLocale
     Establecer local del usuario con esta logica:
     preferencia_usuario ? preferencia_usuario :
        Facebook-Language == existe ? Facebook-Language :
            Accept-Language == valido ? Accept-Language :
                MostrarSeleccionIdioma();    
        Parametros
            Ninguno
        Resultados
            Ninguno
    */
    private static function EstablecerLocale()
    {
        setlocale (LC_ALL, 'es_AR.UTF-8', 'es_ES.UTF-8','es_AR','es_MX','es_ES');
        
    }
    
    /*
     EstablecerZonaHoraria()
     Establecer timezone del usuario con esta logica:
     preferencia_usuario ? preferencia_usuario :
        Facebook-TimeZone == existe ? Facebook-TimeZone :
                MostrarSeleccionZonaHoraria();    
        Parametros
            Ninguno
        Resultados
            Ninguno
    */
    private static function EstablecerZonaHoraria()
    {
        date_default_timezone_set   ('America/El_Salvador');
    }
}
?>