<?php
class usuario
{
    public static $tipoVisitante = 0;
    public static $info = array('tipo' => 0);

    public static function guardar()
    {
        self::$info['fecha_actividad'] = date('Y-m-d H:i:s');
        db::reemplazar('cuentas',self::$info);
    }
    
    public static function cargar($ID)
    {
        self::$info = db::obtenerPorIndice('cuentas','ID',array($ID),1);
    }

}

general::requerirModulo(array('sesion_facebook'));

?>