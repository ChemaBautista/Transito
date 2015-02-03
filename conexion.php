<?php 
// datos para la coneccion a mysql 
define('DB_SERVER','localhost'); 
define('DB_NAME','transito_infracciones'); 
define('DB_USER','root'); 
define('DB_PASS',''); 

$con = mysql_connect(DB_SERVER,DB_USER,DB_PASS); 
mysql_select_db(DB_NAME,$con); 

if (mysqli_connect_errno()) {
    printf("Conexion Fallida a la Base de datos: %s\n", mysqli_connect_error());
    exit();
  }
mysql_query("SET NAMES UTF8");  
?>