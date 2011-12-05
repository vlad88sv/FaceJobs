<?php
error_reporting(E_STRICT | E_ALL);
require_once('frontend.php');

if (empty($_GET['frontend']))
    $_GET['frontend'] = frontendLista::$facebook;


switch ($_GET['frontend'])
{
    case frontendLista::$facebook:
        frontend::$frontend = frontendLista::$facebook;
        break;
    case frontendLista::$googleplus:
        frontend::$frontend = frontendLista::$googleplus;
        break;
    case frontendLista::$normal:
    default:
        frontend::$frontend = frontendLista::$normal;
        break;
}
require_once('arranque.php');
require(frontend::$frontend.'.php');
?>