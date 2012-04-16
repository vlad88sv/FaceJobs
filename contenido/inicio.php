<?php
if (db::obtenerPorIndice('paso0','ID_cuenta',array(usuario::$info['ID_cuenta'])) != false)
{
    body::agregarAlContenido ('perfil',true);
    return;
}
?>
<table id="meterOsubir">
    <tr>
        <td>
            <p>Ingresar mi Curriculum utilizando el asistente de Curriculum Vitae de FaceJobs.</p>
            <p>Es la forma más fácil y rápida de crear tu Curriculum Vitae en línea ya que se te asistirá en el proceso de llenado a traves de un sencillo formulario.</p>
            <a href="perfil.html">Ingresar Curriculum Vitae</a>
        </td>
        <td>
            <p>Ingresar mi Curriculum cargando mi Curriculum previamente elaborado en uno de los siguientes formatos:</p>
            <ul>
                <li><b>Word (.doc o .docx)</b></li>
                <li><b>PDF (.pdf)</b></li>
                <li><b>OpenDocument (.odt)</b></li>
            </ul>
            <label for="pais_procedencia">País:</label> <input type="input" value="<?php echo general::$config['temporal']['pais']; ?>" name="pais_procedencia" id="pais_procedencia" />
            <input type="file" name="archivo_cv" accept="application/pdf, application/msword, application/vnd.oasis.opendocument.text" /> <br />
            <input type="submit" value="Cargar Curriculum" />
        </td>
    </tr>
</table>