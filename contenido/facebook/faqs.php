<?php
general::registrarEstiloCSS('facebook.sesion.iniciar','facebook.sesion.iniciar');
$c = 'SELECT `topico`, `contenido`, `tipo` FROM `faqs` WHERE 1';
$r = db::consultar($c);
echo '<h1>FAQ</h1>';
while ($f = mysql_fetch_assoc($r))
{
    echo $f['topico'];
    echo $f['contenido'];
}
?>
