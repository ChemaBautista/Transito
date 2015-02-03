<?php

$row_set = array();

$term = trim(strip_tags($_GET['term'])); //búsqueda enviada por el autocomplete

include ('conexion.php');
$result=mysql_query("SELECT numero_licencia as id, " .
	"numero_licencia as value, apellido_paterno as ap, " .
	"apellido_materno as am, nombre as nom, clasificacion as cla, " .
	"calle_licencia as cal_inf, " .
	"vigencia as vig, entidad_licencia as ent_lic, " .
	"numero_calle_licencia as num_c_lic, colonia_licencia as col_lic, " .
	"poblacion_licencia as pob_lic FROM licencia " .
	"WHERE numero_licencia LIKE '%" . $term . "%'");
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
	$row_set[] = $row;
}
echo json_encode($row_set);
