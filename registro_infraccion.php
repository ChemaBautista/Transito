<?php
	session_start();
	include("conexion.php");
	
	//licencia
	$clasificacion=$_POST['clasificacion_licencia'];
	$vigencia=$_POST['vigencia_licencia'];
	$entidad_licencia=$_POST['entidad_licencia'];
	$licencia=$_POST['numero_licencia'];
	
	//tabla infractor
	$apellido_paterno=$_POST['ap_paterno'];
	$apellido_materno=$_POST['ap_materno'];
	$nombre_infractor=$_POST['nombres'];	
	$calle_infractor=$_POST['calle_infractor'];
	$numero_infractor=$_POST['numero_infractor'];
	$colonia_infractor=$_POST['colonia_infractor'];
	$poblacion_infractor=$_POST['poblacion_infractor'];
	
	//tabla vehiculo
	$numero_motor=$_POST['motor_ve'];
	$numero_serie=$_POST['serie_ve'];
	$marca=$_POST['marca_ve'];
	$submarca=$_POST['submarca_ve'];
	$color=$_POST['color_ve'];
	$entidad_vehiculo=$_POST['entidad_ve'];
	if(isset($_POST['tipo_vehiculo'])){
		$clase_vehiculo=$_POST['tipo_vehiculo'];
	}
	if(!isset($_POST['tipo_vehiculo'])){
		$clase_vehiculo="";
	}
	if(isset($_POST['tipo_servicio'])){
		$tipo_servicio=$_POST['tipo_servicio'];
	}
	if(!isset($_POST['tipo_servicio'])){
		$tipo_servicio="";
	}
	$numero_placa=$_POST['placas_ve'];
	if($_POST['modelo_ve']!=null){
		$modelo=$_POST['modelo_ve'];
	}
	if($_POST['modelo_ve']==null){
		$modelo=0;
	}
	
	//tabla ubicacion
	$calle_ubicacion=$_POST['calle_infraccion'];
	$colonia_ubicacion=$_POST['colonia_infraccion'];
	$municipio_ubicacion=$_POST['agencia_infraccion'];
	$entidad_ubicacion=$_POST['entidad_infraccion'];
	
	//tabla infraccion
	$curp=$_POST['curp'];
	$hora=$_POST['hora_infraccion'];
	$fecha=$_POST['fecha_infraccion'];
	$observaciones0=$_POST['observaciones0'];
	
	//tabla traslado
	$tipo_grua=$_POST['select_concesionario_tipo'];
	if (isset($_POST['select_responsable_traslado'])){
		$concesionario=$_POST['select_responsable_traslado'];
	}
	if (!isset($_POST['select_responsable_traslado'])){
		$concesionario="";
	}
	
	//tabla encierro
	$tipo_encierro=$_POST['select_tipo_encierro'];
	if (isset($_POST['select_responsable_encierro'])){
		$nombre_encierro=$_POST['select_responsable_encierro'];
	}
	if (!isset($_POST['select_responsable_encierro'])){
		$nombre_encierro="";
	}
	
	
	//insertar licencia
	$sql="INSERT INTO licencia (numero_licencia,clasificacion,vigencia,entidad_licencia,apellido_paterno,apellido_materno,nombre,calle_licencia,numero_calle_licencia,colonia_licencia,poblacion_licencia) VALUES('$licencia','$clasificacion','$vigencia','$entidad_licencia','$apellido_paterno','$apellido_materno','$nombre_infractor','$calle_infractor','$numero_infractor','$colonia_infractor','$poblacion_infractor')";
	$result=mysql_query($sql);
/*	
	//maximo licencia id
	$sql0="SELECT MAX(numero_licencia) AS id_lic FROM licencia;";
	$result0=mysql_query($sql0);
	if ($row = mysql_fetch_row($result0)) {
		$numero_licencia = trim($row[0]); //variable maximo id
	}
*/	
	//insertar Infractor
		$sql1="INSERT INTO infractor(licencia,apellido_paterno,apellido_materno,nombre_infractor,calle_infractor,numero_infractor,colonia_infractor,poblacion_infractor) VALUES ($licencia,'$apellido_paterno','$apellido_materno','$nombre_infractor','$calle_infractor','$numero_infractor','$colonia_infractor','$poblacion_infractor')";
		$result1=mysql_query($sql1);
	
	//Insertar vehiculo
	$sql2="INSERT INTO vehiculo (numero_placa, numero_motor,numero_serie,marca,submarca,modelo,color,entidad_vehiculo,clase_vehiculo,tipo_servicio) VALUES ('$numero_placa','$numero_motor','$numero_serie','$marca','$submarca',$modelo,'$color','$entidad_vehiculo','$clase_vehiculo','$tipo_servicio')";
	$result2=mysql_query($sql2);
	
	//maximo infractor id
	$sql3="SELECT MAX(id_infractor) AS id FROM infractor";
	$result3=mysql_query($sql3);
	if ($row = mysql_fetch_row($result3)) {
		$id_infractor_maximo = trim($row[0]); //variable maximo id
	}
	
	//insertar ubicacion
	$sql4="INSERT INTO ubicacion (direccion_ubicacion,calle_ubicacion,colonia_ubicacion,municipio_ubicacion,entidad_ubicacion) VALUES('','$calle_ubicacion','$colonia_ubicacion','$municipio_ubicacion','$entidad_ubicacion')";
	$result4=mysql_query($sql4);
	/*
	//maximo vehiculo id
	$sql5="SELECT MAX(id_vehiculo) AS id FROM vehiculo";
	$result5=mysql_query($sql5);
	if ($row = mysql_fetch_row($result5)) {
		$id_vehiculo_maximo = trim($row[0]); //variable maximo id
	}
	*/
	//maximo ubicacion id
	$sql6="SELECT MAX(id_lugar) AS id FROM ubicacion";
	$result6=mysql_query($sql6);
	if ($row = mysql_fetch_row($result6)) {
		$id_lugar_maximo = trim($row[0]); //variable maximo id
	}
	
	//insertar infraccion
	$sql7="INSERT INTO infraccion (curp, vehiculo,licencia, id_infractor, id_lugar, importe_total, fecha, hora, observaciones) VALUES ('$curp','$numero_placa','$licencia', $id_infractor_maximo,$id_lugar_maximo,0.0,'$fecha','$hora','$observaciones0')";
	$result7=mysql_query($sql7);
	
	//maximo id_infraccion 
	$sql8="select MAX(id_infraccion) as id_infraccion from infraccion";
	$result8=mysql_query($sql8);
	if ($row = mysql_fetch_row($result8)) {
		$id_maximo_mas_uno = trim($row[0]); //variable maximo id
	}
	
	
	//importe detalle_infraccion
	$salario= "SELECT * FROM salario";
	$result20=mysql_query($salario);
	if ($row = mysql_fetch_row($result20)) {
		$sal_min = trim($row[0]); //variable salario minimo
	}

	if(isset($_POST['descripcion'])){
		foreach ($_POST['descripcion'] as $descripcion){
			//insert detalle_infraccion

			$query21= "select cantidad_salarios from concepto where id_concepto = '$descripcion'";
			$result21=mysql_query($query21);
			if ($row = mysql_fetch_row($result21)) {
				$cant_sal = trim($row[0]); //variable salario minimo
			}

			$sql9="insert into detalle_infraccion (id_infraccion,id_concepto,importe_concepto,status_infraccion) values ($id_maximo_mas_uno,'$descripcion', $sal_min * $cant_sal , 0)";
			$result9=mysql_query($sql9);
			//echo $sql9;
			//echo $descripcion."<br>";
		}
	}
	
	
	//update detalle_infraccion
	//$sql21="UPDATE infraccion i join vehiculo v on i.vehiculo=v.id_vehiculo join ubicacion u on i.id_lugar=u.id_lugar join infractor inf on i.id_infractor=inf.id_infractor join licencia l on inf.licencia=l.id_licencia join detalle_infraccion di on i.id_infraccion=di.id_infraccion join concepto c on c.id_concepto=di.id_concepto join detalle_traslado dt on i.id_infraccion=dt.id_infraccion join traslado t on t.id_grua=dt.id_grua join encierro e on e.id_encierro=dt.id_encierro SET di.importe_concepto=$importe_concepto WHERE i.vehiculo=$id_vehiculo_maximo ";
	//$result21=mysql_query($sql21);
	
	//select traslado
	if($tipo_grua=="" || $concesionario==""){
		$id_traslado=0;
	}
	if($tipo_grua!="" && $concesionario!=""){
		$sql10="select id_grua from traslado where tipo_grua='$tipo_grua' and concesionario='$concesionario'";
		$result10=mysql_query($sql10);
		if ($row = mysql_fetch_row($result10)) {
			$id_traslado = trim($row[0]); //variable maximo id
		}
	}	
	
	
	//select encierro
	if($nombre_encierro=="" || $tipo_encierro==""){
		$id_encierro=0;
	}
	if($nombre_encierro!="" && $tipo_encierro!=""){
		$sql11="select id_encierro from encierro where nombre_encierro='$nombre_encierro' and tipo_encierro='$tipo_encierro'";
		$result11=mysql_query($sql11);
		if ($row = mysql_fetch_row($result11)) {
			$id_encierro = trim($row[0]); //variable maximo id
		}
	}
	
	
	//insertar detalle_traslado
	$sql13="INSERT INTO detalle_traslado (id_encierro,id_infraccion,id_grua) VALUES ($id_encierro,$id_maximo_mas_uno,$id_traslado);";
	$result13=mysql_query($sql13);
	
	
 	//CONDICIONES
 	{
		if($result7 === true){
			//echo $sql13;

			echo "<script languaje='JavaScript'> alert ('Infracción registrada'); document.location.href = 'infraccion'</script>";
			
		}
		else{

			echo "<script languaje='JavaScript'> alert ('Infracción NO registrada'); /*window.history.back();*/</script>";
			//echo "No se pudo ingresar los valores";
			
		}
	}

?>