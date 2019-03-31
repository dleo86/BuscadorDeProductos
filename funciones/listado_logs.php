<?php

function Listar_logs(){
    $Listado=array();
    //me conecto
    $MiConexion=ConexionBD();
    //si todo es correcto...
    if ($MiConexion!=false){
        //le paso la consulta que necesito
        $SQL = "SELECT Id, FechaLog, Id_Evento, Email FROM logs ORDER BY FechaLog DESC";
        //genera el conjunto de registros que devuelve la consulta
        $rs = mysqli_query($MiConexion, $SQL);
        $i=0;  //armo el listado para devolverlo y usarlo en el otro script
        while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['FechaLog'] = $data['FechaLog'];
            $Listado[$i]['Id_Evento'] = $data['Id_Evento'];
            $Listado[$i]['Email'] = $data['Email'];
            $i++;
        }
    }
    return $Listado;
}
    


?>