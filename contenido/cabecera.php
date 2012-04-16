<table id="cabecera">
    <tr>
    <td id="logotipo">
        <a href="<?php echo PROY_URL; ?>"><img src="/img/facebook_cabecera.png" alt="Face.Jobs" /></a>
    </td>
    <td id="menu">
    <?php if (0): ?>
            <?php if (usuario::$info['tipo'] == "candidato"): ?>
            <a href="perfil.html">[Editar curriculum]</a>
            <a href="perfil.html?modo=empresa">[Ser Empresa]</a>
        <?php endif;?>
        <?php if (usuario::$info['tipo'] == "empresa"): ?>
            <a href="perfil.html">[Editar perfil de empresa]</a>
            <a href="perfil.html?modo=candidato">[Ser Candidato]</a>
        <?php endif;?>
    <?php endif;?>
    <div class="fb-like" data-href="http://facejobs.org" data-send="true" data-width="520" data-show-faces="true" data-action="recommend"></div>
    </td>
    </tr>
</table>    
