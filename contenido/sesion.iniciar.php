<?php
general::requerirModulo(array('ui'));
general::registrarEstiloCSS('facebook.sesion.iniciar','facebook.sesion.iniciar');
?>
<table id="contenedor_intro_parte_1">
  <tr>
    <td id="intro_parte_1a">
      <img src="<?php echo PROY_URL; ?>img/gente_exitosa.jpg" />
    </td>
    
    <td id="intro_parte_1b">
      <p><strong style="color:#000;">Facejobs</strong>, es tu acceso a un mejor futuro, el trabajo de tus sueños esta a clicks de distancia.</p>
      <p>Las empresas no podrán ver tu perfil de facebook ni tus fotos, solo tu curriculum; se comunicarán contigo únicamente a traves de los medios que tu especifiques.</p>
      <p>Entrevistas en línea, cuestionarios personalizados, video resumenes y miles de empresas te esperan.</p>
      
      <a href="javascript:return false" class="registrate" onClick="top.location = 'https://www.facebook.com/dialog/oauth?client_id=<?php echo general::$config['appId']; ?>&redirect_uri=<?php echo PROY_URL; ?>gotofacebook&scope=email,user_location'"><img src="<?php echo PROY_URL; ?>img/boton_normal.jpg" />&nbsp;<?php echo _('INGRESAR CURRICULUM'); ?></a>
    </td>
  </tr>
</table>

  
<div id="beneficios">
<ul>
  <li>Ser parte de la bolsa de trabajo con mayor presencia.</li>
  <li>Las mejoras empresas de prestigio en búsca de tu talento.</li>
  <li>Recibirás los puestos vacantes de trabajo mas convenientes</li>
  <li>Estadísticas diarias de las empresas que te han tomado en cuenta</li>
  <li>Las empresas interesadas te podrán realizar video entrevistas</li>
  <li>Las empresas podrán contactarte por el metodo que prefieras</li>
  <li>Opción de que agregues video curriculums</li>
  <li>Aplicar a puestos vacantes que te convengan</li>
</ul>
</div>