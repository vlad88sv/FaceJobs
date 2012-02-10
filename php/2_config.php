<?
class web
{
    // http://www.webcheatsheet.com/PHP/get_current_page_url.php
    // Obtiene la URL actual, $stripArgs determina si eliminar la parte dinamica de la URL
    public static function URLactual($stripArgs=false,$friendly=false) {
        $pageURL = '';
        if (!$friendly)
        {
           $pageURL = 'http';
           if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
           $pageURL .= "://";
        }
        
        if ($_SERVER["SERVER_PORT"] != "80") {
           $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
           $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        
        if ($stripArgs) {$pageURL = preg_replace("/\?.*/", "",$pageURL);}
        
        if ($friendly)
        {
            $pageURL = preg_replace('/www\./', '',$pageURL);
            $pageURL = "www.$pageURL";
        }
        
        return $pageURL;
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
define('PROY_URL',preg_replace(array("/\/?$/","/www./"),"","http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']))."/");
define('PROY_URL_AMIGABLE',"www.".preg_replace(array("/\/?$/","/www./"),"",$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']))."/");
define('PROY_URL_ACTUAL_DINAMICA',web::URLactual(false));
define('PROY_URL_ACTUAL',web::URLactual(true));
define('PROY_URL_ACTUAL_AMIGABLE',web::URLactual(true,true));
define('FACEBOX_APP_URL','http://apps.facebook.com/facejobs_org/');

?>