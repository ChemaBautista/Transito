<?php

$row_set = array();

$term = trim(strip_tags($_GET['term'])); //búsqueda enviada por el autocomplete

include ('conexion.php');
$result=mysql_query("SELECT numero_placa as id, numero_placa as value, numero_motor, numero_serie, marca, submarca,modelo, color, entidad_vehiculo, clase_vehiculo as tipo_vehiculo, tipo_servicio FROM vehiculo WHERE numero_placa LIKE '%" . $term . "%'");
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
	$row_set[] = $row;
}
echo json_encode($row_set);
