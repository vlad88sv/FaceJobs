<?php
require_once('arranque.php');
sesion::iniciar_sesion();

if ( !sesion::iniciado() || empty($_POST['perfil']) || !is_numeric($_POST['perfil']) )
    return;

$ID_CUENTA_PERFIL = $_POST['perfil'];
   

if (!empty($_POST['crearCategoria']))
{
    unset($datos);
    $datos['ID_cuenta'] = usuario::$info['ID_cuenta'];
    $datos['categoria'] = $_POST['crearCategoria'];
    $ID_empresa_categoria = db::insertar('empresa_categorias', $datos);
    
    unset($datos);
    
    $datos['ID_perfil'] = $ID_CUENTA_PERFIL;
    $datos['ID_empresa_categoria'] = $ID_empresa_categoria;
    db::insertar('empresa_categorias_perfil', $datos);
    unset($datos);
}

$consulta = sprintf('SELECT t1.`ID_empresa_categoria`, t1.`categoria`, (SELECT COUNT(*) FROM `empresa_categorias_perfil` AS t2 WHERE `ID_perfil`=%s AND t1.`ID_empresa_categoria` = t2.`ID_empresa_categoria`) AS "existe" FROM `empresa_categorias` AS t1 WHERE ID_cuenta=%s ORDER BY t1.`categoria` ASC', $ID_CUENTA_PERFIL, usuario::$info['ID_cuenta']);
$resultado = db::consultar($consulta);

while ($resultado && $registro = mysql_fetch_assoc($resultado))
{
    echo sprintf('<span class="categoria"><input type="checkbox" %s value="%s" name="categoria" id="categoria_%s" /><label for="categoria_%s">%s</label></span>',($registro['existe'] == '1' ? 'checked="checked"' : ''),$registro['ID_empresa_categoria'],$registro['ID_empresa_categoria'],$registro['ID_empresa_categoria'],$registro['categoria']);
}
?>