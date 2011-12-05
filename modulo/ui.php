<?php
class uiForm
{
    public static $cargarImagenOWebCam = 0;
    public static $textoSimple = 1;
    public static $comboboxSimple = 2;
    public static $comboboxComplejo = 3;
    public static $comboboxPaises = 4;
    public static $fecha = 5;
    public static $telefono = 6;
    public static $correo = 7;
    public static $sino = 8;
    public static $cheque = 9;
    public static $radio = 10;
    public static $memo = 11;
}

class ui
{
    public static function ObtenerImagen($archivo)
    {
        return 'img/'.$archivo;
    }
}
?>