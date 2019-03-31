<?php require_once 'funciones_conexion.inc.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mysql</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>
            <?php 
   //si mi funcion devuelve algo distinto a un false, pude conectarme
            if (ConexionBD()!=false) {
                echo 'Conexion Ok desde mi funcion de ConexionBD()';
            }else {
                die('Fallo al conectarme');
            }
            ?>
            
            
        </div>            
            

    </body>
</html>
