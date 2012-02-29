<?php
require_once('arranque.php');
sesion::iniciar_sesion();

if (!sesion::iniciado())
    return;

echo '<code>';
echo str_replace("\n","<br />",print_r($_POST,true));
echo '</code>';
?>