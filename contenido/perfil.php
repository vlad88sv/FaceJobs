<?php
if( in_array(@$_GET['modo'], array('candidato','empresa')) )
{
    db::consultar('UPDATE cuentas SET tipo="'.$_GET['modo'].'" WHERE ID_cuenta =  ' . usuario::$info['ID_cuenta']);
    usuario::recargar();
    header ('Location: ' . PROY_URL);
    exit (0);
}

if (usuario::$info['tipo'] == "empresa")
{
    body::agregarAlContenido('perfil.empresa', true);
    return;
}

if (usuario::$info['tipo'] == "candidato")
{
    body::agregarAlContenido('perfil.candidato', true);
}
?>