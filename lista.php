<?php
    if (isset($_POST['ingresar']))
    {
        $grupo = '';
        $subgrupo = '';
        foreach (preg_split("/((\r?\n)|(\r\n?))/", $_POST['lista']) as $line_num => $line) {
                if ($line[0] == "=")
                {
                    $grupo = str_replace('=', '', $line);
                    continue;
                }
                if ($line[0] == "[")
                {
                    $subgrupo = substr($line, 1, -1);
                    continue;
                }
                
                $line = str_replace('* ', '', $line);
            
            if (1) 
                echo "<pre>INSERT INTO datos_puesto (grupo, subgrupo, puesto) VALUES ('". $grupo ."','". $subgrupo ."','". $line ."');</pre>\n";
            
            if (0)
                echo "<pre>INSERT INTO datos_tag_estudio (grupo, subgrupo, estudio) VALUES ('". $grupo ."','". $subgrupo ."','". $line ."');</pre>\n";
            
            if (0)
                echo "<pre>INSERT INTO datos_oficio (grupo, subgrupo, oficio) VALUES ('". $grupo ."','". $subgrupo ."','". $line ."');</pre>\n";
        }
    }
?>
<form action="./lista.php" method="post">
<textarea style="width:100%;" name="lista"></textarea>
<div><input type="submit" name="ingresar" value="Procesar" /></div>
</form>