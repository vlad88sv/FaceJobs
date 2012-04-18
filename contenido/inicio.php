<?php
if (db::obtenerPorIndice('paso0','ID_cuenta',array(usuario::$info['ID_cuenta'])) != false)
{
    body::agregarAlContenido ('perfil',true);
    return;
}
?>
<p>
    Bienvenido a FACEJOBS, a continuación tienes la opción de ingresar tu curriculum manualmente o cargar tu hoja de vida previamente elaborada.
</p>
<table id="meterOsubir">
    <tr>
        <td>
            <h1>OPCION 1</h1>
            <p>Ingresa tu curriculum utilizando el asistente de FaceJobs. Es la forma más rápida y fácil de ingresar tus datos para crear tu hoja de vida.</p>
            <div style="text-align: center;"><a href="perfil.html" style="margin:auto;" class="boton_importante">Ingresar Curriculum Vitae</a></div>
        </td>
        <td>
            <h1>OPCION 2</h1>
            <p>Carga aquí tu curriculum si lo tienes elaborado en cualquiera de los siguientes formatos:</p>
            <ul>
                <li><b>Word (.doc o .docx)</b></li>
                <li><b>PDF (.pdf)</b></li>
                <li><b>OpenDocument (.odt)</b></li>
            </ul>
            <table class="estandar ancha">
            <tr><td><label for="pais_procedencia">País:</label></td><td><input type="input" value="<?php echo general::$config['temporal']['pais']; ?>" name="pais_procedencia" id="pais_procedencia" /></td></tr>
            <tr><td><label for="archivo_cv">Archivo:</label></td><td><input type="file" id="archivo_cv" name="archivo_cv" accept="application/pdf, application/msword, application/vnd.oasis.opendocument.text" /></td></tr>
            </table>
            <div style="text-align: center;"><input syle="margin:auto;" type="submit" class="boton_importante" value="Cargar Curriculum" /></div>
        </td>
    </tr>
</table>