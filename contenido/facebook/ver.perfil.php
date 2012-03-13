<?php
general::requerirModulo(array('plantilla','cv'));
?>

<div id="caja_controles" class="contenedor_grupo">
<p>Enlace a este perfil: <a href="<?php echo PROY_URL.$_GET[2]; ?>"><?php echo PROY_URL.$_GET[2]; ?></a> | <a href="#">No mostrar este perfil en mis futuras búsquedas</a></p>
<div id="categorias_perfil"></div>
Nueva categoria: <input type="text" id="nueva_categoria" value="Ej. cajeros" /> <input type="button" id="crear_categoria" value="Agregar" />
</div>
<?php
pln::procesar('ver.perfil',$_GET[2]);
echo pln::$pln;
?>
<script type="text/javascript">
    function cargarCategoriasPerfil()
    {
        $("#categorias_perfil").load('ajax.categorias',{perfil:'<?php echo $_GET[2]; ?>'}, function(){
            $('span.categoria input[type="checkbox"]').unbind().click(function(){
                $("#categorias_perfil").load('ajax.categorias',{perfil:'<?php echo $_GET[2]; ?>', categoria:$(this).val(), estado:($(this).is(':checked') ? 'agregar' : 'eliminar')});
            });
        });

    }
    
    $(function(){
        plnJS_iniciar();
        
        cargarCategoriasPerfil();
        
        $('#crear_categoria').unbind('click').click(function(){
            $("#categorias_perfil").load('ajax.categorias',{perfil:'<?php echo $_GET[2]; ?>', crearCategoria:$('#nueva_categoria').val()}, function(){
                $('#nueva_categoria').val('');
            });
        });
    });
</script>
