<!DOCTYPE html>
<html lang="en">


    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Final Marzo <?php echo date("Y");?></title>

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
session_start();
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
//require_once 'Buscador_productos.php';

$ListadoDeProductos = array();

//si pulso el boton de buscar,
if (!empty($_POST['btnBuscarLibros'])) {
  //function Ingreso1(){
        //limpio de espacios los filtros ingresados
    
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
}

$ListadoCateg = Listar_Categ();
$cntCateg = count($ListadoCateg);


//incluyo el script con el encabezado del archivo principal
//require_once 'includes/header.inc.php';
?>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Final <?php echo date("d") . "/" . date("m") . "/" . date("Y");?></a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">


                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> NOMBRE DEL ALUMNO</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="cerrar.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">

                            <li>
                                <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Inicio</a>
                            </li>
                            <li>
                                <a href="buscador.php"><i class="fa fa-dashboard fa-fw"></i> Buscar Productos</a>
                            </li>

                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Buscador de productos</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->


                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                          <form method="post">
                            <div class="form-group">
                                <label>Ingresa el nombre del producto</label>
                                <input class="form-control" name="PatronNombre" placeholder="proporciona algun nombre" value="<?php echo!empty($_POST['PatronNombre']) ? $_POST['PatronNombre'] : ''; ?>" />
                            </div>
                            <div class="form-group">
                                <label>Selecciona alguna categoria</label>
                                <select class="form-control" name="PatronCateg">
                                    <option value="">Selecciona un genero...</option>
                                    <?php
                                       for ($i = 0; $i < $cntCateg; $i++) {
                                            $seleccionado = !empty($_POST['PatronCateg']) && $_POST['PatronCateg'] == $ListadoCateg[$i]['ID'] ? 'selected' : '';
                                    ?>
                                       <option  value="<?php echo $ListadoCateg[$i]['ID'] ?>"  <?php echo $seleccionado; ?> >
                                          <?php echo $ListadoCateg[$i]['DESCRIP'];/* linea dudosa*/?>
                                       </option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                                
                            
                            
                            <button  type="submit" name="btnBuscarLibros" value="btnBuscarLibros" class="btn btn-default" >Buscar!</button>
                         </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    
                                <?php 

                                $cantProductos = 0;
                                if (!empty($ListadoDeProductos)) { ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Categor&iacute;a</th>
                                            <th>Descripci&oacute;n</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $cantProductos = count($ListadoDeProductos);
                                        for ($i = 0; $i < $cantProductos; $i++) {
                                         //repito los Renglones <tr> por cada Elemento de mi array
                                         /*
                                           * recordar q en las tablas: 
                                           * Renglon --> <tr>
                                           * Dato en celda --> <td>
                                          */
                                    ?>
                                    <tbody>
                                    	<?php
                                    	   if ($ListadoDeProductos[$i]['stock'] > 100) {
                                    	?>
                                        <tr class="success">
                                            <td><?php echo $ListadoDeProductos[$i]['nombre']; ?></td>
                                            <td>$ <?php echo $ListadoDeProductos[$i]['precio']; ?></td>
                                            <td><?php if ($ListadoDeProductos[$i]['id_categ'] == 1){
                                                           echo "Electro";
                                                         } else if ($ListadoDeProductos[$i]['id_categ'] == 2){
                                                          echo "Hogar";
                                                         }
                                                           //; ?></td>
                                            <td><?php echo $ListadoDeProductos[$i]['descrip']."En verde cuando el stock es mayor a 100"; ?> </td>
                                        </tr>
                                        <?php
                                           }elseif ($ListadoDeProductos[$i]['stock'] > 40 && $ListadoDeProductos[$i]['stock'] < 100) {
                                           	 ?>
                                            <tr class="warning ">
                                              <td><?php echo $ListadoDeProductos[$i]['nombre']; ?></td>
                                              <td>$ <?php echo $ListadoDeProductos[$i]['precio']; ?></td>
                                              <td><?php if ($ListadoDeProductos[$i]['id_categ'] == 1){
                                                           echo "Electro";
                                                         } else if ($ListadoDeProductos[$i]['id_categ'] == 2){
                                                          echo "Hogar";
                                                         } ?></td>
                                              <td><?php echo $ListadoDeProductos[$i]['descrip']."En amarillo cuando el stock es mayor a 40 y menor o igual a 100"; ?> </td>
                                            </tr> 
                                        <?php
                                             } else{                                            
                                         ?>
                                           <tr class="danger ">
                                              <td><?php echo $ListadoDeProductos[$i]['nombre']; ?></td>
                                              <td>$ <?php echo $ListadoDeProductos[$i]['precio']; ?></td>
                                              <td><?php if ($ListadoDeProductos[$i]['id_categ'] == 1){
                                                           echo "Electro";
                                                         } else if ($ListadoDeProductos[$i]['id_categ'] == 2){
                                                          echo "Hogar";
                                                         } ?></td>
                                              <td><?php echo $ListadoDeProductos[$i]['descrip']."En bordo cuando el stock es menor a 40"; ?> </td>
                                            </tr> 
                                             <?php
                                                 } 
                                              ?>
                                    </tbody>
                                     <?php
                                          } //fin del for
                                           } //fin del if    
                                      ?>
                                      <div class="panel panel-default">
                                       <div class="panel-heading">
                                           Resultados de la b&uacute;squeda de Productos
                                       </div>
                                        <!-- /.panel-heading -->
                                       <div class="panel-body">
                                        <?php
                                      	   if ($cantProductos > 0) { 
                                         ?>
                                        <div class="alert alert-info">
                                         Se encontraron <strong><?php echo $cantProductos ?></strong> registros.
                                         </div>
                                          <?php
                                             } else{
                                          ?>
                                         <div class="alert alert-danger">
                                           No se encontraron registros.
                                           </div>
                                            <?php
                                             }
                                           ?>
                                             <div class="table-responsive">
                                       </table>                              
                                    
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="dist/js/sb-admin-2.js"></script>

    </body>

</html>
