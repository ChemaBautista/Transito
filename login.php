<?php
	session_start();
	include("conexion.php");
	$user=mysql_real_escape_string($_POST['user']); 
	$password=mysql_real_escape_string($_POST['password']);
	$sql="Select * from usuario where usuario = '$user' and password = '$password'";

  // Ejecuta la sentencia SQL
  $result = mysql_query($sql); 
  if(!$result) 
    die("Error: no existen el usuario o contraseña");

	$count=mysql_num_rows($result);
	if($count==1)
	{
		$i=0;
		while ($i < $count) 
		{
			$_SESSION['id']=mysql_result($result,$i,"usuario");
			$_SESSION['rol']=mysql_result($result,$i,"rol");
			$i++;
		}
		
		header("location:index");
	}
	else 
	{
		echo "<script languaje='JavaScript'> alert ('Usuario y Password Incorrectos'); document.location.href = 'index';</script>";
		
	}
?>
