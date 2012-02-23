<table id="cabecera">
    <tr>
    <td id="logotipo">
        <a href="<?php echo PROY_URL; ?>"><img src="img/facebook_cabecera.png" alt="Face.Jobs" /></a>
    </td>
    <td id="menu">
            <?php if (usuario::$info['tipo'] == "candidato"): ?>
                <a href="perfil.html">[Editar curriculum]</a>
                <a href="perfil.html?modo=empresa">[Como Empresa]</a>
            <?php endif;?>
            <?php if (usuario::$info['tipo'] == "empresa"): ?>
                <a href="perfil.html">[Editar perfil de empresa]</a>
                <a href="perfil.html?modo=candidato">[Como Candidato]</a>
            <?php endif;?>
    </td>
    </tr>
</table>
