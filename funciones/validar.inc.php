<?php
function ControlesValidos(){
    $MensajeError='';
   
    $_POST['Email']=trim($_POST['Email']); //limpio espacios al Email
    if (strlen($_POST['Email'])<10){
        //la longitud del Email es menor a 10 caracteres
        $MensajeError.='La longitud del mail debe ser mayor a 10 caracteres <br />';
    }
  
    return $MensajeError;
}

function ControlarUsuarioRepetido($Email) {
    //require_once 'funciones/funciones_conexion.inc.php';
//esta funcion toma un parametro, llamado $Email
//le es brindado desde la llamada de la funcion en el script principal con el $_POST['Email']
     $MensajeError = '';
    //me conecto
    $linkConexion = ConexionBD();
    //la consulta debe traer un registro si ese mail ya fue cargado
    $SQL = "SELECT Id FROM usuarios WHERE Email = '{$Email}'  ";
    $rs = mysqli_query($linkConexion, $SQL);
    $data = mysqli_fetch_array($rs);
    //si el conjunto de registros contiene valores, ese mail ya se registro
    if ($data != false) {
        $MensajeError = 'Este correo ya ha sido registrado. <br />';  
    }
    //$MensajeError = Activacion($Email);
    //devuelvo el mensaje, cargado o vacio segun encuentre o no ese mail
    return $MensajeError;
}

function Activacion($Email) {
    //aseguro el dato q voy a actualizar en la tabla: q sea 0 o 1.   && !mysqli_query($MiConexion, $sSQL)
        $MensajeError = 'Este correo ya ha sido registrado 2. <br />';
        $anio = date(Y);
        $hoy = date("Y-m-d H:i:s"); 
        $SQL = "UPDATE usuarios SET Activo = 1, Clave= MD5('{$anio}'), FechaActivacion = '{$hoy}' WHERE Email= '{$Email}'"; 
        //$SQL = "INSERT INTO logs (FechaLog,Id_Evento,Email) VALUES ('{$hoy}', 1,'{$Email}')"; 
        $MiConexion = ConexionBD();
        if (!mysqli_query($MiConexion, $SQL)) {
            return false;
        } else {
            return true;
        }
}

function Insertar_logs($Email){
    $hoy = date("Y-m-d H:i:s"); 
    $SQL = "INSERT INTO logs (FechaLog,Id_Evento,Email) VALUES ('{$hoy}', 1,'{$Email}')";
             
    $linkConexion=ConexionBD();
    if (!mysqli_query($linkConexion, $SQL)){
        return false;
    }else {
        return true;
    }
}

function Insertar_logs2($Email){
    $hoy = date("Y-m-d H:i:s"); 
    $SQL = "INSERT INTO logs (FechaLog,Id_Evento,Email) VALUES ('{$hoy}', 2,'{$Email}')";
             
    $linkConexion=ConexionBD();
    if (!mysqli_query($linkConexion, $SQL)){
        return false;
    }else {
        return true;
    }
}

function DatosUsuarioCorrecto($User, $Pass) {
    $MensajeError='';
    //genero la consulta sql con los parametros enviados
    //entre comillas simples cada parametro por ser cadenas
    //si fueran numeros no haria falta q lleven comillas simples
    $SQL = "SELECT Id FROM usuarios WHERE Email='$User' AND Clave = '$Pass' AND Activo = 1";
    //genero la conexion
    $linkConexion = ConexionBD();
    $rs = mysqli_query($linkConexion, $SQL);
    //por ser un solo registro el q debo traer, no aplico while
    $data = mysqli_fetch_array($rs);
    //si $data trajo algo, entonces cargo mis valores
    if ($data != false) {
        return true;
    }else{
        $MensajeError='Usuario incorrecto';
        return false;
    }
}
function Insertar_logs3($Email){
    $hoy = date("Y-m-d H:i:s"); 
    $SQL = "INSERT INTO logs (FechaLog,Id_Evento,Email) VALUES ('{$hoy}', 3,'{$Email}')";
             
    $linkConexion=ConexionBD();
    $MensajeError='Datos incorrectos';
    if (!mysqli_query($linkConexion, $SQL)){
        return false;
    }else {
        return true;
    }
}

function ErrorLogs($Email){
    $hoy = date("Y-m-d H:i:s"); 
    $SQL = "INSERT INTO logs (FechaLog,Id_Evento,Email) VALUES ('{$hoy}', 4,'{$Email}')";
             
    $linkConexion=ConexionBD();
    if (!mysqli_query($linkConexion, $SQL)){
        return false;
    }else {
        return true;
    }
}


?>