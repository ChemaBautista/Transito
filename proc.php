<?php
	include 'conexion2.php';
	$q=$_POST['q'];
	$con=conexion();
	$res=mysql_query("select * from traslado where tipo_grua='$q'",$con);
?>

<select id="pais" name="select_responsable_traslado"><!--cuando seleccionan un pais se ejecuta la funcion myFunction2() ubicada en el archivo index.php-->
	<option value="">Seleccione</option>
	<?php while($fila=mysql_fetch_array($res)){ ?>
		<option value="<?php echo $fila['concesionario']; ?>"><?php echo $fila['concesionario']; ?></option>
	<?php } ?>
</select>

