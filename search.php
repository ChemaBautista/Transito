<?php

$row_set = array();

$term = trim(strip_tags($_GET['term'])); //búsqueda enviada por el autocomplete

include ('conexion.php');
$result=mysql_query("SELECT curp as id, curp as value FROM empleado WHERE curp LIKE '%" . $term . "%'");
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
	$row_set[] = $row;
}
echo json_encode($row_set);