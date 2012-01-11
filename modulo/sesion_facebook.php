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

  try {  
    $cache = self::$facebook->api('/me');
  } catch (FacebookApiException $e) {
    $cache = false;
  }
  
  if ($user && $cache)
  {
    //Create Query
    $params = array(
        'method' => 'fql.query',
        'query' => "SELECT current_location, first_name, middle_name, last_name, birthday_date FROM user WHERE uid = me()",
    );
    
    //Run Query
    $result = self::$facebook->api($params);
    
    general::$config['temporal']['pais'] = $result[0]['current_location']['country'];
    //error_log(serialize($result));
    
    if (db::verificarIndice('cuentas','ID',array($user)) == 0)
    {
      
      $datos['ID'] = $cache['id'];
      $datos['link'] = $cache['link'];
      $datos['email'] = $cache['email'];
      $datos['fecha_registro'] = time();
      $datos['tipo'] = usuario::$tipoCandidato;
      $datos['hash'] = sha1(general::$config['salt'].microtime(true));
      db::insertar('cuentas', $datos);
    }
    usuario::cargar($user);
    self::$iniciado = true;
  }  else {
    self::$iniciado = false;
  }
}

public static function iniciado()
{
  return self::$iniciado;
}
} // Sesión
?>