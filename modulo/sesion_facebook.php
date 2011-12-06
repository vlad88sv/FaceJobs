<?php
general::requerirModulo(array('facebook-sdk'));

class sesion
{

private static $iniciado = false;

private static $facebook = null;

public static function iniciar_sesion()
{
  self::$facebook = new Facebook(array(
    'appId'  => general::$config['appId'],
    'secret' => general::$config['secret']
  ));
  
  $user = self::$facebook->getUser();

  if ($user)
  {
    if (db::verificarIndice('cuentas','ID',array($user)) == 0)
    {
      $cache = self::$facebook->api('/me');
      
      $datos['ID'] = $cache['id'];
      $datos['link'] = $cache['link'];
      $datos['email'] = $cache['email'];
      $datos['fecha_registro'] = time();
      $datos['tipo'] = usuario::$tipoCandidato;
      db::insertar('cuentas', $datos);
    }
    usuario::cargar($user);
    self::$iniciado = true;
  }
}

public static function iniciado()
{
  return self::$iniciado;
}
} // Sesión
?>