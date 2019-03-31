
<!DOCTYPE html>
<html lang="en">


    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Final Marzo 2017</title>

        <!-- Bootstrap Core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

<?php
//session_start();
//si la variable de sesion esta vacia, no debe poder entrar al panel
//redirecciono al logueo
//if (empty($_SESSION['USUARIO_ID'])) {
  //  header('Location: buscador.php');
    //exit;
//}
//incluyo el script con la funcion de conexion
require_once 'funciones/funciones_conexion.inc.php';
//incluyo el script con las funciones referidas a los Libros
require_once 'funciones/funciones_productos.inc.php';
require_once 'buscador.php';
//$ListadoDeProductos = array();

//si pulso el boton de buscar,
//if (!empty($_POST['btnBuscarLibros'])) {
        //limpio de espacios los filtros ingresados
//function Ingreso(){
    echo "entro a la pagina y presiono el boton";
    $_POST['PatronNombre'] = trim($_POST['PatronNombre']);
    $_POST['PatronCateg'] = trim($_POST['PatronCateg']);

    //valido q algun filtro al menos tenga valor. Si ambos filtros van vacios, pido el filtro
    if (empty($_POST['PatronNombre']) && empty($_POST['PatronCateg'])) {
        $_SESSION['MensajeError'] = 'Debes ingresar algun filtro para buscar.';
        echo "error no hay mensaje";
        
    } else {
        $ListadoDeProductos = Buscar_Productos_Avanzado($_POST['PatronNombre'], $_POST['PatronCateg']);
        if (!empty($ListadoDeProductos)) {
            $_SESSION['MensajeOk'] = 'Se encontraron ' . count($ListadoDeProductos) . ' registros con ese filtro de b&uacute;squeda.';
        } else {
            $_SESSION['MensajeError'] = 'Esta b&uacute;squeda no arroja resultados.';
        }
    }
//}

?>
</html>