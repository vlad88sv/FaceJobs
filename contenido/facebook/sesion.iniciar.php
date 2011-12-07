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
      <p>O si lo que deseas es encontrar a la persona ideal para ese puesto tan exigente entonces tienes acceso a la biblioteca mas gran de CVs en línea, donde podrás encontrar candidatos perfectos en cuestión de minutos o publicar tus ofertas de empleos y que estas lleguen a las personas mas indicadas.</p>
      <p>Entrevistas en línea, cuestionarios personalizados, video resumenes y millones de aspirantes y empresas te esperan.</p>
    </td>
  </tr>
  
  <tr class="registros">
    <td>
      <a href="javascript:return false" class="registrate" onClick="top.location = 'https://www.facebook.com/dialog/oauth?client_id=<?php echo general::$config['appId']; ?>&redirect_uri=<?php echo PROY_URL; ?>gotofacebook&scope=email,user_about_me'"><img src="<?php echo PROY_URL; ?>img/boton_normal.jpg" />&nbsp;<?php echo _('INGRESAR CURRICULUM'); ?></a>
    </td>
    <td>
      <a href="javascript:return false" class="registrate" onClick="top.location = 'https://www.facebook.com/dialog/oauth?client_id=<?php echo general::$config['appId']; ?>&redirect_uri=<?php echo PROY_URL; ?>gotofacebook&scope=email,user_about_me'"><img src="<?php echo PROY_URL; ?>img/boton_normal.jpg" />&nbsp;<?php echo _('BUSCAR CANDIDATOS'); ?></a>
    </td>
  </tr>
  </table>
  
  <table id="contenedor_intro_parte_2">
  <tr>
    <td id="beneficios">
      <h1>Beneficios de publicar tu curriculum en FaceJobs</h1>
      <div>
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
      
      <a href="">+ MAS INFORMACION</a>
      </div>
    </td>
    
    <td id="FAQ">
      <h1>Preguntas mas frecuentes</h1>
      <div>
      <ul>
        <li>¿Las empresas podrán ver mi información de Facebook?</li>
        <p>R/ No, de ninguna manera, ninguna de tus fotografías o información en Facebook será visible para ninguna empresa.</p>
        <p>Al momento de crear tu curriculum podras ingresar una fotografía formal para que forme parte de tu hoja de vida.</p>
      </ul>
      
      <a href="">+ VER TODAS</a>
      </div>
  </tr>
</table>
</div>