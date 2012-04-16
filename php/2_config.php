<?
class web
{
    // http://www.webcheatsheet.com/PHP/get_current_page_url.php
    // Obtiene la URL actual, $stripArgs determina si eliminar la parte dinamica de la URL
    function URLactual($stripArgs=false,$friendly=false,$forzar_ssl=false) {
    $pageURL = '';
    if (!$friendly)
    {
       $pageURL = 'http';
    
       if ((self::ES_SSL() || $forzar_ssl) && $forzar_ssl != 'nunca') {$pageURL .= "s";}
       $pageURL .= "://";
    }
    
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    
    if ($stripArgs) {$pageURL = preg_replace("/\?.*/", "",$pageURL);}
    
    if ($friendly)
    {
        $pageURL = preg_replace('/www\./', '',$pageURL);
        $pageURL = "www.$pageURL";
    }
    
    return $pageURL;
    }
    
    function ES_SSL()
    {
        return ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443);
    }

    
    public static function SEO($URL){
        $URL = preg_replace("`\[.*\]`U","",$URL);
        $URL = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$URL);
        $URL = htmlentities($URL, ENT_COMPAT, 'utf-8');
        $URL = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i","\\1", $URL );
        $URL = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $URL);
        return strtolower(trim($URL, '-'));
    }
}

/* Configuración de Facebook */
general::$config['appId'] = '114556531980068';
general::$config['secret'] = '9d32991f88a6ef27149d8233b942d363';


/* Configuración de Google */
general::$config['google-UA'] = 'UA-27346999-1';

/* Configuración de correos */    
general::$config['smtp_host'] = 'smtp.gmail.com';
general::$config['smtp_port'] = '465';
general::$config['smtp_correo'] = '';
general::$config['smtp_nombre'] = '';
general::$config['smtp_usuario'] = '';
general::$config['smtp_clave'] = '';


/* Configuracion DB */
general::$config['db_usuario'] = 'face.jobs';
general::$config['db_clave'] = 'face.jobs';
general::$config['db_bd'] = 'face.jobs';
general::$config['db_host'] = '127.0.0.1';

/* Criptografía */
general::$config['salt'] = 'vlad88sv';

define('PROY_NOMBRE','FaceJobs');
define('FACEBOX_APP_URL','http://apps.facebook.com/facejobs_org/');


if (!empty($_GET['frontend']) && $_GET['frontend'] == 'fb')
    define('PROY_URL_NOPROTOCOL','facejobs.org/+fb/');
else
    define('PROY_URL_NOPROTOCOL','facejobs.org/');

if (web::ES_SSL())
{
    define('_B_FORZAR_SERVIDOR_IMG_NULO',true); 
    define('PROY_URL_ESTATICA','https://facejobs.org/');
    define('PROY_URL','https://'.PROY_URL_NOPROTOCOL);    
} else {
    define('PROY_URL_ESTATICA','http://facejobs.org/');
    define('PROY_URL','http://'.PROY_URL_NOPROTOCOL);    
}

define('PROY_URL_SSL','https://'.PROY_URL_NOPROTOCOL);
define('PROY_URL_NOSSL','http://'.PROY_URL_NOPROTOCOL);

define('PROY_URL_AMIGABLE','www.Flor360.com');
define('PROY_URL_ACTUAL_DINAMICA',web::URLactual());
define('PROY_URL_ACTUAL',web::URLactual(true));
define('PROY_URL_ACTUAL_NOSSL',web::URLactual(true,false,'nunca'));
define('PROY_URL_ACTUAL_AMIGABLE',web::URLactual(true,true));
define('PROY_URL_LIKE','http://www.facebook.com/floristeria.flor360');
?>