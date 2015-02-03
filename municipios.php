<?php

    // Conectar la base de datos
    include ('conexion.php');

    // Ejecutamos la consulta en el orden correcto  
    //(value,text)
    $query = "SELECT clave, nombre FROM municipios";
    $result = mysql_query($query);
    $items = array();
    if($result && 
       mysql_num_rows($result)>0) {
        while($row = mysql_fetch_array($result)) {
            $option = array("id" => $row[0], "value" => htmlentities($row[1]));
            $items[] = $option; 
        }        
    }
    mysql_close();
    $data = json_encode($items); 
    // Convertimos en formato JSON, luego imprimimos la data
    $response = isset($_GET['callback'])?$_GET['callback']."(".$data.")":$data; 
    echo($response); 