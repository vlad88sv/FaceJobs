<?php
/* Frontend de Facebook. */
sesion::iniciar_sesion();
general::registrarScriptJS('jQuery','jquery-1.6.2');
general::registrarEstiloCSS('facebook','facebook');
body::agregarAlInicio('cabecera',true);
body::agregarAlInicio('global.menu',true);
if (!sesion::iniciado())
{
    body::agregarAlContenido ('sesion.iniciar',true);
} else {
    switch ($_GET['peticion'])
    {
        case 'tds':
            body::agregarAlContenido ('terminos.y.condiciones',true);
            break;
        case 'faqs':
            body::agregarAlContenido ('faqs',true);
            break;
        case 'paso':
        case 'inicio':
        case '':
            body::agregarAlContenido ('inicio',true);
            break;
        case 'error':        
        default:
            body::agregarAlContenido ('404',true);    
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <title><?php echo head::$titulo ; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Style-type" content="text/css" />
    <meta http-equiv="Content-Script-type" content="text/javascript" />
    <meta http-equiv="Content-Language" content="es" />
    <meta name="robots" content="index, follow" />
    <meta property="fb:app_id" content="<?php echo general::$config['appId']; ?>" />
    <meta property="og:image" content="<?php echo PROY_URL; ?>img/logo.png"/>
    <link href="favicon.ico" rel="icon" type="image/x-icon" />
    <?php echo head::obtenerEstilosCSS(); ?>
    <?php echo head::obtenerScriptsJS(); ?>
    <?php echo head::$extra; ?>    
    <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', '<?php echo general::$config['google-UA']; ?>']);
    _gaq.push(['_trackPageview']);
    
    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
    </script>

    <script src="http://connect.facebook.net/en_US/all.js#appId=<?php echo general::$config['appId']; ?>&xfbml=1"></script>
    <script>
        $(document).ready(function() {
            FB.init({appId: <?php echo general::$config['appId']; ?>,xfbml: true, oauth: true, cookie: true; status: true;});
            FB.Event.subscribe('auth.login', function(response) {window.location.reload();});
            FB.Event.subscribe('auth.logout', function(response) {window.location.reload();});
        });
    </script>
</head>

<body>
    <div id="fb-root"></div>
    <div id="contenedor">
    <?php echo body::$inicio; ?>
    <?php echo body::$contenido; ?>
    <?php echo body::$final; ?>
    </div>
    <script>
        FB.Canvas.setAutoGrow();
        FB.Canvas.setDoneLoading();
    </script>
</body>
</html>