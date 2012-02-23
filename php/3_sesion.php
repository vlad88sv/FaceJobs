<?php
class usuario
{
    public static $tipoVisitante = 'visitante';
    public static $tipoCandidato = 'candidato';
    public static $tipoEmpresa = 'empresa';
    public static $tipoAdministrador = 'administrador';
    
    public static $info = array('tipo' => 'visitante');

    public static function guardar()
    {
        self::$info['fecha_actividad'] = date('Y-m-d H:i:s');
        db::reemplazar('cuentas',self::$info);
    }
    
    public static function cargar($ID)
    {
        self::$info = db::obtenerPorIndice('cuentas','ID',array($ID),1);
    }
    
    public static function recargar()
    {
        self::cargar(self::$info['ID_cuenta']);
    }

}

general::requerirModulo(array('sesion_facebook'));

?>