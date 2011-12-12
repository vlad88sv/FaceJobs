<?php
require_once('arranque.php');
general::requerirModulo(array('ui'));

if (isset($_GET['crop']))
	
    imagenes::crop_imagen($_GET['hash'],$_GET['ancho'].'_'.$_GET['alto'].'_'.$_GET['hash'],$_GET['ancho']);
else
    imagenes::crear_imagen($_GET['hash'],$_GET['ancho'].'_'.$_GET['alto'].'_'.$_GET['hash'],$_GET['ancho'],$_GET['alto']);

?>