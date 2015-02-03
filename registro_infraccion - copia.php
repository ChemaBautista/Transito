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
	$poblacion_infractor=$_POST['nombre_localidad'];
	
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
	$municipio_ubicacion=$_POST['municipio_ubicacion'];
	$entidad_ubicacion=$_POST['entidad_ubicacion'];
	
	//tabla infraccion
	$curp=$_POST['curp'];
	$hora=$_POST['hora_infraccion'];
	$fecha=$_POST['fecha_infraccion'];
	
	//tabla traslado
	$tipo_grua=$_POST['select_tipo_traslado'];
	$concesionario=$_POST['select_responsable_traslado'];
	
	//tabla encierro
	$tipo_encierro=$_POST['select_tipo_encierro'];
	$nombre_encierro=$_POST['select_responsable_encierro'];
	
	
	//insertar licencia
	$sql="INSERT INTO licencia (clasificacion,vigencia,entidad_licencia,apellido_paterno,apellido_materno,nombre,calle_licencia,numero_calle_licencia,colonia_licencia,poblacion_licencia,numero_licencia) VALUES('$clasificacion','$vigencia','$entidad_licencia','$apellido_paterno','$apellido_materno','$nombre_infractor','$calle_infractor','$numero_infractor','$colonia_infractor','$poblacion_infractor','$licencia')";
	$result=mysql_query($sql);
	
	//maximo licencia id
	$sql0="SELECT MAX(id_licencia) AS id_lic FROM licencia;";
	$result0=mysql_query($sql0);
	if ($row = mysql_fetch_row($result0)) {
		$id_licencia_maximo = trim($row[0]); //variable maximo id
	}
	
	//insertar Infractor
	$sql1="INSERT INTO infractor(licencia,apellido_paterno,apellido_materno,nombre_infractor,calle_infractor,numero_infractor,colonia_infractor,poblacion_infractor,tipo_infractor) VALUES ($id_licencia_maximo,'$apellido_paterno','$apellido_materno','$nombre_infractor','$calle_infractor','$numero_infractor','$colonia_infractor','$poblacion_infractor','')";
	$result1=mysql_query($sql1);
	
	
	//Insertar vehiculo
	$sql2="INSERT INTO vehiculo (numero_motor,numero_serie,marca,submarca,modelo,color,entidad_vehiculo,clase_vehiculo,tipo_servicio,numero_placa) VALUES ('$numero_motor','$numero_serie','$marca','$submarca',$modelo,'$color','$entidad_vehiculo','$clase_vehiculo','$tipo_servicio','$numero_placa')";
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
	
	//maximo vehiculo id
	$sql5="SELECT MAX(id_vehiculo) AS id FROM vehiculo";
	$result5=mysql_query($sql5);
	if ($row = mysql_fetch_row($result5)) {
		$id_vehiculo_maximo = trim($row[0]); //variable maximo id
	}
	
	//maximo ubicacion id
	$sql6="SELECT MAX(id_lugar) AS id FROM ubicacion";
	$result6=mysql_query($sql6);
	if ($row = mysql_fetch_row($result6)) {
		$id_lugar_maximo = trim($row[0]); //variable maximo id
	}
	
	//insertar infraccion
	$sql7="INSERT INTO infraccion (curp, vehiculo, id_infractor, id_lugar, importe_total, fecha, hora, observaciones) VALUES ('$curp',$id_vehiculo_maximo,$id_infractor_maximo,$id_lugar_maximo,0.0,'$fecha','$hora','')";
	$result7=mysql_query($sql7);
	
	//maximo id_infraccion 
	$sql8="select MAX(id_infraccion) as id_infaccion from infraccion";
	$result8=mysql_query($sql8);
	if ($row = mysql_fetch_row($result8)) {
		$id_maximo_mas_uno = trim($row[0]); //variable maximo id
	}
	
	
	if(isset($_POST['descripcion'])){
		foreach ($_POST['descripcion'] as $descripcion){
			//insert detalle_infraccion
			$sql9="insert into detalle_infraccion (id_infraccion,id_concepto,importe_concepto,status_infraccion,costo_salario) values ($id_maximo_mas_uno,'$descripcion',0,0,70.10)";
			$result9=mysql_query($sql9);
			//echo $sql9;
			//echo $descripcion."<br>";
		}
	}
	
	//importe detalle_infraccion
	//$sql20="select costo_salario*cantidad_salarios as importe from infraccion i join vehiculo v  on i.vehiculo=v.id_vehiculo join ubicacion u on i.id_lugar=u.id_lugar join infractor inf on i.id_infractor=inf.id_infractor join licencia l on inf.licencia=l.id_licencia join detalle_infraccion di on i.id_infraccion=di.id_infraccion join concepto c on c.id_concepto=di.id_concepto join detalle_traslado dt on i.id_infraccion=dt.id_infraccion join traslado t on t.id_grua=dt.id_grua join encierro e on e.id_encierro=dt.id_encierro where i.vehiculo=$id_vehiculo_maximo";
	//$result20=mysql_query($sql20);
	//if ($row = mysql_fetch_row($result20)) {
		//$importe_concepto = trim($row[0]); //variable maximo id
	//}
	
	//update detalle_infraccion
	//$sql21="UPDATE infraccion i join vehiculo v on i.vehiculo=v.id_vehiculo join ubicacion u on i.id_lugar=u.id_lugar join infractor inf on i.id_infractor=inf.id_infractor join licencia l on inf.licencia=l.id_licencia join detalle_infraccion di on i.id_infraccion=di.id_infraccion join concepto c on c.id_concepto=di.id_concepto join detalle_traslado dt on i.id_infraccion=dt.id_infraccion join traslado t on t.id_grua=dt.id_grua join encierro e on e.id_encierro=dt.id_encierro SET di.importe_concepto=$importe_concepto WHERE i.vehiculo=$id_vehiculo_maximo ";
	//$result21=mysql_query($sql21);
	
	//insertar traslado
	$sql10="INSERT INTO traslado (concesionario,tipo_grua) VALUES ('$concesionario','$tipo_grua');";
	$result10=mysql_query($sql10);
	
	
	//select encierro
	$sql11="select id_encierro from encierro where nombre_encierro='$nombre_encierro' and tipo_encierro='$tipo_encierro'";
	$result11=mysql_query($sql11);
	if ($row = mysql_fetch_row($result11)) {
		$id_encierro = trim($row[0]); //variable maximo id
	}
	
	//Maximo id_grua
	$sql12="SELECT MAX(id_grua) as id from traslado";
	$result12=mysql_query($sql12);
	if ($row = mysql_fetch_row($result12)) {
		$id_grua = trim($row[0]); //variable maximo id
	}
	
	//insertar detalle_traslado
	$sql13="INSERT INTO detalle_traslado (id_encierro,id_infraccion,id_grua) VALUES ($id_encierro,$id_maximo_mas_uno,$id_grua);";
	$result13=mysql_query($sql13);
	
	
	//CONDICIONES
	if($result && $result1 && $result2 && $result4 && $result7 && $result10 && $result9){
		header("Location: infraccion");
		//echo $id_infractor_maximo;
	}
	else{
		echo "No se pudo ingresar los valores";
		echo $sql21;
	}
?>