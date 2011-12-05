<?php
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
}
?>