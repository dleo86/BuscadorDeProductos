<?php

function Listar_Categ() {
    $Listado = array();
    $MiConexion = ConexionBD();
    if ($MiConexion != false) {
                $SQL = "SELECT P.id as IdProducto, P.nombre as NombreProducto, C.descrip AS NombreCateg,
                         C.id as Idcateg,  P.id_categ as Icateg
           /* A.Nombre AS NombreAutor, A.Apellido AS ApellidoAutor, 
            L.FechaCarga AS FechaRegistro , L.Imagen as Imagen, L.Activo as Activo*/
                FROM  categoria C, producto P
                WHERE P.id=C.id /*AND L.IdAutor=A.Id  */   ";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {
             $Listado[$i]['ID'] = $data['Idcateg'];
            //$Listado[$i]['NOMBRE'] = utf8_encode($data['NombreProducto']);
            $Listado[$i]['DESCRIP'] = utf8_encode($data['NombreCateg']);
           /* $Listado[$i]['AUTOR'] = utf8_encode($data['ApellidoAutor']) . ', ' . utf8_encode($data['NombreAutor']);
            $Listado[$i]['FECHA_REGISTRO'] = $data['FechaRegistro'];
            $Listado[$i]['IMAGEN_LIBRO'] = $data['Imagen'];
            $Listado[$i]['ACTIVO'] = $data['Activo'];*/
            $i++;
        }
    }

    return $Listado;
}


function Buscar_Productos_Avanzado($Patron_Nombre_Ingresado, $Patron_Categ_Ingresado) {
    
    //casi replica de la funcion Buscar_Libros_Basico(): aqui se agrega el filtro del Genero
    $Listado = array();
    
    
    $MiConexion = ConexionBD();
    
    if ($MiConexion != false) {
        //armo la consulta basica
       
          $SQL = "SELECT P.id as IdProducto, P.nombre as NombreProducto, P.descrip AS NombreCateg,
                         C.id as Idcateg,  P.id_categ as Icateg, P.precio as precio, P.stock as stock
                FROM  categoria C, producto P
                WHERE P.id_categ=C.id  ";
        
        //y segun el filtro que llegue, le voy concatenando los filtros
        //si llega el filtro del Nombre del ibro:
        if (!empty($Patron_Nombre_Ingresado)) {
            $SQL.="  AND P.nombre like '%$Patron_Nombre_Ingresado%' ";
        }

        if (empty($Patron_Nombre_Ingresado)) {
                 $SQL.="  AND P.id_categ = $Patron_Categ_Ingresado ";
        }
        
        //si llega el filtro del Genero del ibro:
        if (!empty($Patron_Genero_Ingresado)) {
            $SQL.="  AND C.id = $Patron_Categ_Ingresado ";
        }
        //finamente concateno el Order By
        $SQL.="  ORDER BY P.nombre  ";

        
        
        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['nombre'] = utf8_encode($data['NombreProducto']);
            $Listado[$i]['descrip'] = utf8_encode($data['NombreCateg']);
             $Listado[$i]['id_categ'] = $data['Icateg'];
              $Listado[$i]['precio'] = $data['precio'];
              $Listado[$i]['stock'] = $data['stock'];
           /* $Listado[$i]['AUTOR'] = utf8_encode($data['ApellidoAutor']) . ', ' . utf8_encode($data['NombreAutor']);
            $Listado[$i]['FECHA_REGISTRO'] = $data['FechaRegistro'];
            $Listado[$i]['IMAGEN_LIBRO'] = $data['Imagen'];
            $Listado[$i]['ACTIVO'] = $data['Activo'];*/
            $i++;
        }
    }

    return $Listado;
}



?>
