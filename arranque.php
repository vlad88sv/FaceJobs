<?php
// bootstrap del sistema
/*
 Funciones:
 + Requerir los archivos mínimos necesarios para arrancar el sistema.
 + Establecer las opciones necesarias en runtime de PHP [nivel de error_info, locales, etc.]
  
 Limites:
 + No debe existir función de uso público
 + No variables de uso público
 + No constantes de uso público
 + Ser agnostico con el frontend utilizado
  
 Datos:
 + Fecha de creación: 2 de Septiembre de 2011
 + Creado por: Vladimir Hidalgo
 + Diseño: Vladimir Hidalgo
 + Mantemiento:  Vladimir Hidalgo
*/

// "ROOT" del sistema
define ('_BASE', dirname(__FILE__).'/');

// Donde esta el directorio de nuestras librerias de arranque
define ('_BASE_php', _BASE.'php/');

// Donde esta el directorio de nuestros modulos
define ('_BASE_modulo', _BASE.'modulo/');

// Donde esta el directorio de contenidos
define ('_BASE_contenido', _BASE.'contenido/');

// Donde esta el directorio de plantillas
define ('_BASE_plantilla', _BASE.'pln/');

// Donde esta el directorio de estilos (CSS) (relativo a la pagina)
define ('_REL_css', 'css/');

// Donde esta el directorio de estilos (CSS) (relativo a la pagina)
define ('_REL_JS', 'js/');

// Funciones de depuración globales (traces, logs, etc.)
require_once (_BASE_php.'0_depurar.php');

// Funciones de uso global (overrides, variables, etc.)
require_once (_BASE_php.'1_general.php');

// Configuraciones y contraseñas (MySQL, SMTP, opciones globales)
require_once (_BASE_php.'2_config.php');

// Iniciar sesión en el sistema
require_once (_BASE_php.'3_sesion.php');

// Conexión a la base de datos MySQL
require_once (_BASE_php.'4_db.php');

// Internacionalización
require_once (_BASE_php.'5_internacional.php');

// Contenido
require_once (_BASE_php.'6_contenido.php');

?>
