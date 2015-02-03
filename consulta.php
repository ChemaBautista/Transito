<?php
	session_start();
	require_once 'conexion.php';
	include 'conexion2.php';
	if(!isset($_SESSION["id"])){
		die(header("Location:index"));
	}	
	$rol=$_SESSION["rol"];

	$tipoConsulta=$_REQUEST['tipoConsulta'];
	echo $tipoConsulta;
	$result = "";
	$result2="";
    $row = null;
    if (isset($_GET['id'])) {
		$id=$_GET['id'];

		$sql="select * from infraccion i join vehiculo v  on i.vehiculo=v.numero_placa join ubicacion u on i.id_lugar=u.id_lugar join infractor inf on i.id_infractor=inf.id_infractor join licencia l on inf.licencia=l.numero_licencia join detalle_infraccion di on i.id_infraccion=di.id_infraccion join concepto c on c.id_concepto=di.id_concepto "; //left join detalle_traslado dt on i.id_infraccion=dt.id_infraccion ";
		$sql2="select * from infraccion i join vehiculo v  on i.vehiculo=v.numero_placa join ubicacion u on i.id_lugar=u.id_lugar join infractor inf on i.id_infractor=inf.id_infractor join licencia l on inf.licencia=l.numero_licencia join detalle_infraccion di on i.id_infraccion=di.id_infraccion join concepto c on c.id_concepto=di.id_concepto "; //left join detalle_traslado dt on i.id_infraccion=dt.id_infraccion ";
		$sql3="select * from infraccion i join vehiculo v  on i.vehiculo=v.numero_placa join ubicacion u on i.id_lugar=u.id_lugar join infractor inf on i.id_infractor=inf.id_infractor join licencia l on inf.licencia=l.numero_licencia join detalle_infraccion di on i.id_infraccion=di.id_infraccion join concepto c on c.id_concepto=di.id_concepto left join detalle_traslado dt on i.id_infraccion=dt.id_infraccion left join traslado t on t.id_grua=dt.id_grua left join encierro e on e.id_encierro=dt.id_encierro ";
		$sql4="select sum(importe_concepto) as importe_total from detalle_infraccion di join infraccion i on di.id_infraccion = i.id_infraccion ";
		if($tipoConsulta == "placa"){
			$sql .= " where i.vehiculo='$id'";
			$sql2 .= " where i.vehiculo='$id'";
			$sql3 .= " where i.vehiculo='$id'";
			$sql4 .= " where i.vehiculo='$id'";
		}
		else if($tipoConsulta == "idInfraccion"){
			$sql .= " where i.id_infraccion='$id'";
			$sql2 .= " where i.id_infraccion='$id'";
			$sql3 .= " where i.id_infraccion='$id'";
			$sql4 .= " where i.id_infraccion='$id'";
		}
		else if($tipoConsulta == "numLicencia") {
			$sql .= " where i.numero_licencia='$id'";
			$sql2 .= " where i.numero_licencia='$id'";
			$sql3 .= " where i.numero_licencia='$id'";
			$sql4 .= " where i.numero_licencia='$id'";
		}

		//consulta por id_infraccion
 		$result=mysql_query($sql);
        $result3=mysql_query($sql3);
        
        $result4=mysql_query($sql4);
		$row4 = mysql_fetch_array($result4);

/*
echo "<br />"; 
echo $sql . "<br />"; 
echo $sql2 . "<br />"; 
echo $sql3 . "<br />"; 
echo $sql4 . "<br />"; 
*/
    }
	else
		header('location:buscar');
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, user-scalable=no"/>

	<!-- Page Title -->
	<link href="images/logo.ico" type="image/x-icon" rel="shortcut icon"/>
	<title>Secretaría de Seguridad pública</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox-1.3.4.css" media="screen" />
	<link href="themes/2/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="themes/2/js-image-slider.js" type="text/javascript"></script>
    <link href="generic.css" rel="stylesheet" type="text/css" />
	
	<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/jquery.bxslider.js"></script>
	<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="js/jquery.selectik.js"></script>
	<script type="text/javascript" src="js/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="js/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="js/jquery.countdown.js"></script>
	<script type="text/javascript" src="js/jquery.checkbox.js"></script>
	<script type="text/javascript" src="js/js.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script> 
	<script type="text/javascript" src="js/jquery.form.js"></script> 


	<script>
			$('.ocultos').hide();
			$('.ocultos2').hide();
			//oculta elementos
			$(document).ready(function(){ 
			   $('#traslado_si').on('click',function(){
			  	$('.ocultos').show()
//			   	$('#traslado_no').toggle();
			      
			;   });
			});

			$(document).ready(function(){ 
			   $('#traslado_no').on('click',function(){
			      $('.ocultos').hide();
			   });
			});
			///////////////////////////////////////////////////
			$(document).ready(function(){ 
			   $('#deposito_si').on('click',function(){
			  	$('.ocultos2').show()
//			   	$('#deposito_no').toggle();
			      
			;   });
			});

			$(document).ready(function(){ 
			   $('#deposito_no').on('click',function(){
			      $('.ocultos2').hide();
			   });
			});
	</script>

	<script>
		function myFunction(str)
		{
			loadDoc("q="+str,"proc.php",function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
				}
			});
		}
		function myFunction1(str)
		{
			loadDoc("q="+str,"proc2.php",function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("myDiv1").innerHTML=xmlhttp.responseText;
				}
			});
		}
	</script>	
</head>
<body class="page">
	<!--BEGIN HEADER-->
	<div id="header">
		<center>
			<img src="images/header.png" />	
		</center>					
		<div class="bg_navigation">
			<div class="navigation_wrapper">
				<div id="navigation">
					<ul>
						<?php if (!empty($_SESSION["id"])){ ?>							
							<li><a href='infraccion'>Infracción</a></li>
							<li class="current"><a href="buscar">Consultar</a></li>
							<?php if ($rol=="DIRECTIVO"){?>
							<li><a href="reportes">Reportes infracción</a></li>
							<li><a href="configuracion">Configuraciones</a></li>
							<?php } ?>
							<li><a href="#">Bienvenido [ <?php echo $rol;?> ]</a></li>
							<li><a href="logout">Salir</a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--EOF HEADER-->
	<!--BEGIN CONTENT-->
	<div id="content">
		<div class="espacio"></div>
		<div class="espacio1"></div>
		<div class="content">
	
			<center>
				<?php
					$result=mysql_query($sql);
					if ($row = mysql_fetch_array($result)){ 

						$sqlmun="SELECT nombre FROM localidad WHERE id_localidad = " . $row['municipio_ubicacion'];
 						$resultmun=mysql_query($sqlmun);
 						if(is_resource($resultmun) && $rowmun = mysql_fetch_array($resultmun))
 							$localidad = $rowmun[0];
 						else
 							$localidad = "";

						$sqlpob="SELECT nombre FROM municipios WHERE clave = " . $row['poblacion_infractor'];
 						$resultpob=mysql_query($sqlpob);
 						if(is_resource($resultpob) && $rowpob = mysql_fetch_array($resultpob))
 							$municipio = $rowpob[0];
 						else
 							$municipio = "";
				?>

				<form action="EditarEliminar" method="post" id="formulario_infraccion">
					<input type="hidden" name="id_extra" value="<?php echo $id;?>" readonly />
					<table>
						<tr>
							<td width="800px">FOLIO DE INFRACCIÓN<td>
						</tr>
						<tr>
							<td width="800px"><input type="text" name="id_infraccion" id="id_infraccion" placeholder="" value="<?php echo $row[0];?>" readonly/></td>
						</tr>
					</table>


					<table>
						<tr>
							<td width="800px">Curp<td>
						</tr>
						<tr>
							<td width="800px"><input type="text" name="curp" id="curp" placeholder="" value="<?php echo $row['curp'];?>" readonly/></td>
						</tr>
					</table>

					
					<div class="espacio_tablas"></div>
					<table>
						<tr>
							<td colspan="2">FECHA Y HORA DE LA INFRACCIÓN</td>
						</tr>
						<tr>
							<td>Hora</td>
							<td>Fecha</td>
						</tr>
						<tr>
							<td><input type="time" id="hora_infraccion" name="hora_infraccion" placeholder="Hora de la infracción" value="<?php echo $row['hora'];?>" style="width:400px;"/></td>
							<td><input type="date" id="fecha_infraccion" name="fecha_infraccion" placeholder="fecha de la infracción" value="<?php echo $row['fecha'];?>" style="width:400px;"/></td>
						</tr>
					</table>
					<div class="espacio_tablas"></div>
					<table>
						<tr>
							<td colspan="2">UBICACIÓN DE LA INFRACCIÓN</td>
						</tr>
						<tr>
							<td>Calle o Tramo Carretero</td>
							<td>Colonia</td>
						</tr>
						<tr>
							<td><input type="text" id="calle_infraccion" name="calle_infraccion" placeholder="Calle o tramo carretero" value="<?php echo $row['calle_ubicacion'];?>" style="width:400px;" onblur="this.value=this.value.toUpperCase()" readonly/></td>
							<td><input type="text" id="colonia_infraccion" name="colonia_infraccion" placeholder="Colonia" value="<?php echo $row['colonia_ubicacion'];?>" style="width:400px;" readonly /></td>
						</tr>
						<tr>
							<td>Agencia o Municipio</td>
							<td>Entidad</td>
						</tr>
						<tr>
							<td><input type="text" id="agencia_infraccion" name="agencia_infraccion" placeholder="Agencia o Municipio" value="<?php echo $localidad;?>" style="width:400px;" onblur="this.value=this.value.toUpperCase()" readonly/></td>
							<td><input type="text" id="entidad_infraccion" name="entidad_infraccion" placeholder="Entidad" value="<?php echo $row['entidad_ubicacion'];?>" style="width:400px;" onblur="this.value=this.value.toUpperCase()" readonly/></td>
						</tr>
					</table>
					<div class="espacio_tablas"></div>
					<table>
						<tr>
							<td colspan="2">DATOS DEL INFRACTOR</td>
						</tr>
						<tr>
							<td>Apellido Paterno</td>
							<td>Apellido Materno</td>
							<td>Nombre(s)</td>
						</tr>
						<tr>
							<td><input type="text" id="ap_paterno" name="ap_paterno" placeholder="Apellido paterno" value="<?php echo $row['apellido_paterno'];?>" style="width:270px;" onblur="this.value=this.value.toUpperCase()" /></td>
							<td><input type="text" id="ap_materno" name="ap_materno" placeholder="Apellido materno" value="<?php echo $row['apellido_materno'];?>" style="width:270px;" onblur="this.value=this.value.toUpperCase()" /></td>
							<td><input type="text" id="nombres" name="nombres" placeholder="Nombre del infractor" value="<?php echo $row['nombre_infractor'];?>" style="width:270px;" onblur="this.value=this.value.toUpperCase()" /></td>
						</tr>
						<tr>
							<td>DOMICILIO</td>
						</tr>
						<tr>
							<td>Calle</td>
							<td>Número</td>
							<td>Colonia</td>
							<td>Población</td>
						</tr>
						<tr>
							<td><input type="text" id="calle_infractor" name="calle_infractor" placeholder="Calle" value="<?php echo $row['calle_infractor'];?>" style="width:200px;" onblur="this.value=this.value.toUpperCase()"/></td>
							<td><input type="text" id="numero_infractor" name="numero_infractor" placeholder="Numero" value="<?php echo $row['numero_infractor'];?>" style="width:200px;" onblur="this.value=this.value.toUpperCase()"/></td>
							<td><input type="text" id="colonia_infractor" name="colonia_infractor" placeholder="Colonia" value="<?php echo $row['colonia_infractor'];?>" style="width:200px;" onblur="this.value=this.value.toUpperCase()"/></td>
							<td><input type="text" id="poblacion_infractor" name="poblacion_infractor" placeholder="Poblacion" value="<?php echo $municipio;?>" style="width:200px;" onblur="this.value=this.value.toUpperCase()"/></td>
						</tr>
						<tr>
							<td>LICENCIA</td>
						</tr>
						<tr>
							<td>Clasificación</td>
							<td>Número</td>
							<td>Entidad</td>
							<td>Vigencia</td>
						</tr>
						<tr>
							<td><input type="text" id="clasificacion_licencia" name="clasificacion_licencia" placeholder="Clasificacion" value="<?php echo $row['clasificacion'];?>" style="width:200px;"/></td>
							<td><input type="text" id="numero_licencia" name="numero_licencia" placeholder="Numero de licencia" value="<?php echo $row['numero_licencia'];?>" style="width:200px;"/></td>
							<td><input type="text" id="entidad_licencia" name="entidad_licencia" placeholder="Entidad de la licencia" value="<?php echo $row['entidad_licencia'];?>" style="width:200px;"/></td>
							<td><input type="date" id="vigencia_licencia" name="vigencia_licencia" placeholder="Vigencia de la licencia" value="<?php echo $row['vigencia'];?>" style="width:200px;" readonly/></td>
						</tr>
					</table>
					<div class="espacio_tablas"></div>
					<table>
						<tr>
							<td colspan="2">CARACTERISTICAS DEL VEHICULO</td>
						</tr>
						<tr>
							<td>Marca</td>
							<td>Submarca</td>
							<td>Modelo</td>
							<td>Color</td>
						</tr>
						<tr>
							<td><input type="text" id="marca_ve" name="marca_ve" placeholder="Marca" value="<?php echo $row['marca'];?>" style="width:200px;" onblur="this.value=this.value.toUpperCase()"/></td>
							<td><input type="text" id="submarca_ve" name="submarca_ve" placeholder="Submarca" value="<?php echo $row['submarca'];?>" style="width:200px;" onblur="this.value=this.value.toUpperCase()"/></td>
							<td><input type="text" id="modelo_ve" name="modelo_ve" placeholder="Modelo" value="<?php echo $row['modelo'];?>" style="width:200px;" onblur="this.value=this.value.toUpperCase()"/></td>
							<td><input type="text" id="color_ve" name="color_ve" placeholder="Color" value="<?php echo $row['color'];?>" style="width:200px;" onblur="this.value=this.value.toUpperCase()"/></td>
						</tr>
						<tr>
							<td>Placas</td>
							<td>Entidad</td>
							<td>Numero de motor</td>
							<td>Numero de serie</td>
						</tr>
						<tr>
							<td><input type="text" id="placas_ve" name="placas_ve" placeholder="Placas" value="<?php echo $row['numero_placa'];?>" maxlength="7" style="width:200px;" onblur="this.value=this.value.toUpperCase()"/></td>
							<td><input type="text" id="entidad_ve" name="entidad_ve" placeholder="Entidad" value="<?php echo $row['entidad_vehiculo'];?>" style="width:200px;" onblur="this.value=this.value.toUpperCase()"/></td>
							<td><input type="text" id="motor_ve" name="motor_ve" placeholder="Numero de motor" value="<?php echo $row['numero_motor'];?>" maxlength="9" style="width:200px;" onblur="this.value=this.value.toUpperCase()"/></td>
							<td><input type="text" id="serie_ve" name="serie_ve" placeholder="Numero de serie" value="<?php echo $row['numero_serie'];?>"  maxlength="17" style="width:200px;" onblur="this.value=this.value.toUpperCase()"/></td>
						</tr>
					</table>
					<div class="espacio_tablas"></div>
					<table>
						<tr>
							<td colspan="2">Clase de vehiculo</td>
						</tr>
						<tr>
							<?php if($row['clase_vehiculo']=="") { ?>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Automovil"/>AUTOMOVIL</td>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Motocicleta"/>MOTOCICLETA</td>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Camioneta"/>CAMIONETA</td>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="TractoCamion"/>TRACTOCAMIÓ</td>
							<?php } ?>
								<?php if($row['clase_vehiculo']=="Automovil") { ?>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Automovil" checked/>AUTOMOVIL</td>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Motocicleta"/>MOTOCICLETA</td>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Camioneta"/>CAMIONETA</td>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="TractoCamion"/>TRACTOCAMIÓN</td>
							<?php } ?>
								<?php if($row['clase_vehiculo']=="Motocicleta") { ?>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Automovil"/>AUTOMOVIL</td>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Motocicleta"checked/>MOTOCICLETA</td>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Camioneta"/>CAMIONETA</td>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="TractoCamion"/>TRACTOCAMIÓN</td>
							<?php } ?>
							<?php if($row['clase_vehiculo']=="Camioneta") { ?>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Automovil"/>AUTOMOVIL</td>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Motocicleta"/>MOTOCICLETA</td>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Camioneta"checked />CAMIONETA</td>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="TractoCamion"/>TRACTOCAMIÓN</td>
							<?php } ?>
							<?php if($row['clase_vehiculo']=="TractoCamion") { ?>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Automovil"/>AUTOMOVIL</td>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Motocicleta"/>MOTOCICLETA</td>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Camioneta"/>CAMIONETA</td>
								<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="TractoCamion" checked/>TRACTOCAMIÓN</td>
							<?php } ?>
						</tr>
						<tr>
							<td height="15px" colspan="2"></td>
						</tr>
						<tr>
							<td colspan="2">Tipo Servicio</td>
						</tr>
						<tr>
							<?php if($row['tipo_servicio']=="") { ?>
								<td width="200px"><input type="radio" id="tipo_servicio" name="tipo_servicio" value="Particular"/>PARTICULAR</td>
								<td width="200px"><input type="radio" id="tipo_servicio" name="tipo_servicio" value="Publico"/>PUBLICO</td>
							<?php } ?>
							<?php if($row['tipo_servicio']=="Particular") { ?>
								<td width="200px"><input type="radio" id="tipo_servicio" name="tipo_servicio" value="Particular" checked />PARTICULAR</td>
								<td width="200px"><input type="radio" id="tipo_servicio" name="tipo_servicio" value="Publico"/>PUBLICO</td>
							<?php } ?>
							<?php if($row['tipo_servicio']=="Publico") { ?>
								<td width="200px"><input type="radio" id="tipo_servicio" name="tipo_servicio" value="Particular"/>PARTICULAR</td>
								<td width="200px"><input type="radio" id="tipo_servicio" name="tipo_servicio" value="Publico" checked />PUBLICO</td>
							<?php } ?>
						</tr>
					</table>
					<div class="espacio_tablas"></div>
								
					<table>
						<tr>
							<td colspan="2">Motivo de la detencion del vehiculo</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="embriaguez" name="descripcion[]" value="A1" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="A1"){ echo 'checked="checked"'; } } ?>/>Estado de Embriaguez</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="falta_placas" name="descripcion[]" value="A4" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="A4"){ echo 'checked="checked"'; } } ?>/>Falta de placas, las lleve ocultas o se encuentren alteradas</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="falta_tarjeta" name="descripcion[]" value="A2" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="A2"){ echo 'checked="checked"'; } } ?>/>Falta Tarjeta de Circulacion</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="malas_condiciones" name="descripcion[]" value="A5" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="A5"){ echo 'checked="checked"'; } } ?>/>El vehiculo se encuentre en tan malas condiciones</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="falta_licencia" name="descripcion[]" value="A3" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="A3"){ echo 'checked="checked"'; } } ?>/>Falta Licencia de Conducir</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="servicio_publico" name="descripcion[]" value="A6" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="A6"){ echo 'checked="checked"'; } } ?>/>Realizar Servicio Publico de Pasajeros o de Carga</td>
						</tr>
						<tr>
							<td height="20px"></td>
						</tr>
						<tr>
							<td><p align="left">Observaciones</p></td>
						</tr>
						<tr>
							<td colspan="3"><input type="text" id="observaciones0" name="observaciones0" style="width:100%" placeholder="observaciones" value="<?php echo $row['observaciones'];?>"/></td>
						</tr> 
					</table>
					<div class="espacio_tablas"></div>
					<table>
						<tr>
							<td colspan="2">Motivo de la infraccion grupo 1</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="ascenso_descenso" name="descripcion[]" value="B1" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="B1"){ echo 'checked="checked"'; } } ?>/>Ascenso y Descenso de Pasaje(No dar tiempo suficiente)</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="pasaje_arrollo" name="descripcion[]" value="B2" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="B2"){ echo 'checked="checked"'; } } ?>/>Bajar o Subir Pasaje en el Arroyo</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="doble_fila" name="descripcion[]" value="B3" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="B3"){ echo 'checked="checked"'; } } ?>/>Doble Fila</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="exceso_velocidad" name="descripcion[]" value="B4" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="B4"){ echo 'checked="checked"'; } } ?>/>Exceso de Velocidad</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="exceso_pasaje" name="descripcion[]" value="B5" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="B5"){ echo 'checked="checked"'; } } ?>/>Exceso de Pasaje</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="sentido_contrario" name="descripcion[]" value="B6" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="B6"){ echo 'checked="checked"'; } } ?>/>Circular en Sentido Contrario</td>
						</tr>
						<!-- <tr>
							<td width="540px"><input type="checkbox" id="zona_escolar" name="descripcion[]" value="B7" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="B7"){ echo 'checked="checked"'; } } ?>/>Zona Escolar</td>							
						</tr> -->
					</table>
					<div class="espacio_tablas"></div>
					<table>
						<tr>
							<td colspan="2">Motivo de la infraccion grupo 2</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="señal_alto" name="descripcion[]" value="C1" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="C1"){ echo 'checked="checked"'; } } ?>/>No Obedecer la Señal de Alto</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="cajuela_abierta" name="descripcion[]" value="C2" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="C2"){ echo 'checked="checked"'; } } ?>/>Circular con la Cajuela Abierta</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="carril" name="descripcion[]" value="C3" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="C3"){ echo 'checked="checked"'; } } ?>/>Carril</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="falta_luces" name="descripcion[]" value="C4" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="C4"){ echo 'checked="checked"'; } } ?>/>Falta de Luces o no Encender las Reglamentarias</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="maniobras_peligrosas" name="descripcion[]" value="C5" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="C5"){ echo 'checked="checked"'; } } ?>/>Maniobras Peligrosas</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="paso_peaton" name="descripcion[]" value="C6" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="C6"){ echo 'checked="checked"'; } } ?>/>No Respetar el Derecho del paso del Peaton</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="falta_precaucion" name="descripcion[]" value="C7" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="C7"){ echo 'checked="checked"'; } } ?>/>Falta de Precaucion causando daños a terceros</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="preferencia_paso" name="descripcion[]" value="C8" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="C8"){ echo 'checked="checked"'; } } ?>/>No Respetar Preferencia del Paso</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="reversa" name="descripcion[]" value="C9" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="C9"){ echo 'checked="checked"'; } } ?>/>Reversa</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="rutas_autobuses" name="descripcion[]" value="C10" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="C10"){ echo 'checked="checked"'; } } ?>/>Rutas de autobuses</td>
						</tr>	
						<tr>
							<td width="540px"><input type="checkbox" id="sitio_taxis" name="descripcion[]" value="C11" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="C11"){ echo 'checked="checked"'; } } ?>/>Sitios de taxis</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="servicio_publico_placas" name="descripcion[]" value="C12" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="C12"){ echo 'checked="checked"'; } } ?>/>Prestar Servicio Publico con Placas de otro Estado</td>
						</tr>
						<!-- <tr>
							<td width="540px"><input type="checkbox" id="conductores_distraidos" name="descripcion[]" value="C13" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="C13"){ echo 'checked="checked"'; } } ?>/>Manejar los conductores estando distraidos o platicando, abastecer de combustible con el motor en marcha</td>
						</tr> -->
						<tr>
							<td height="20px"></td>
						</tr>
	<!-- 					<tr>
							<td><p align="left">Otros</p></td>
						</tr>
						<tr>
							<td colspan="3"><input type="text" id="dess" name="dess" style="width:100%" placeholder="Descripcion"/></td>
						</tr> -->
					</table>
					<div class="espacio_tablas"></div>
					<table>
						<tr>
							<td colspan="2" width="1120px">Motivo de la infraccion grupo 3</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="abandono_ve" name="descripcion[]" value="D1" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D1"){ echo 'checked="checked"'; } } ?>/>Abandono de Vehiculo</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="falta_aseo" name="descripcion[]" value="D2" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D2"){ echo 'checked="checked"'; } } ?>/>Falta de Aseo y Cortesia de los Operadores de Vehiculos de Servicio Publico</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="carril_g3" name="descripcion[]" value="D3" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D3"){ echo 'checked="checked"'; } } ?>/>Carril (No Toma el Correspondiente)</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="claxon" name="descripcion[]" value="D4" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D4"){ echo 'checked="checked"'; } } ?>/>Claxon (Tocarlo innecesariamente, en forma escandalosa u obsena)</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="colores_reglamentarios" name="descripcion[]" value="D5" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D5"){ echo 'checked="checked"'; } } ?>/>Colores Reglamentarios</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="distancia_reglamentaria" name="descripcion[]" value="D6" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D6"){ echo 'checked="checked"'; } } ?>/>No Guardar Distancia Reglamentaria</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="doble_fila_estaciona" name="descripcion[]" value="D7" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D7"){ echo 'checked="checked"'; } } ?>/>Estacionarse en Doble Fila</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="lugar_prohibido" name="descripcion[]" value="D8" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D8"){ echo 'checked="checked"'; } } ?>/>Estacionarse en Lugar Prohibido</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="sin_precaucion" name="descripcion[]" value="D9" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D9"){ echo 'checked="checked"'; } } ?>/>Salir Intempestivamente y Sin Precaucion del Lugar de Estacionamiento</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="fuga" name="descripcion[]" value="D10" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D10"){ echo 'checked="checked"'; } } ?>/>Darse a la Fuga Despues de Cometer Alguna Infraccion</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="no_obedecer" name="descripcion[]" value="D11" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D11"){ echo 'checked="checked"'; } } ?>/>No Obedecer las Indicaciones del Policia de Transito</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="interrupcion" name="descripcion[]" value="D12" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D12"){ echo 'checked="checked"'; } } ?>/>Interrupcion del Transito</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="mas_de_dos" name="descripcion[]" value="D13" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D13"){ echo 'checked="checked"'; } } ?>/>Viajar Mas de Dos Personas en una Motocicleta</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="mal_comportamiento" name="descripcion[]" value="D14" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D14"){ echo 'checked="checked"'; } } ?>/>Mal comportamiento del Conductor</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="falta_numero_economico" name="descripcion[]" value="D15" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D15"){ echo 'checked="checked"'; } } ?>/>Falta de Numero Economico</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="puertas_abiertas" name="descripcion[]" value="D16" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D16"){ echo 'checked="checked"'; } } ?>/>Puertas Abiertas</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="placas" name="descripcion[]" value="D17" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D17"){ echo 'checked="checked"'; } } ?>/>Placas</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="revista" name="descripcion[]" value="D18" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D18"){ echo 'checked="checked"'; } } ?>/>Falta Revista</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="falta_salpicadera" name="descripcion[]" value="D19" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D19"){ echo 'checked="checked"'; } } ?>/>Por Falta de Salpicadera o en Mal Estado</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="vuelta_prohibida" name="descripcion[]" value="D20" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D20"){ echo 'checked="checked"'; } } ?>/>Vuelta Prohibida</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="circular_zona_prohibida" name="descripcion[]" value="D21" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="D21"){ echo 'checked="checked"'; } } ?>/>Circular en Zona Prohibida</td>
						</tr>
						<tr>
							<td height="20px"></td>
						</tr>
						<!-- <tr>
							<td><p align="left">Otros</p></td>
						</tr>
						<tr>
							<td colspan="3"><input type="text" id="descripcion_g3" name="descripcion_g3" style="width:100%" placeholder="Descripcion"/></td>
						</tr> -->
					</table>
					<div class="espacio_tablas"></div>
					<table>
						<tr>
							<td colspan="2" width="1120px">Motivo de la infraccion grupo 4</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="espejo_retroscopico" name="descripcion[]" value="E1" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="E1"){ echo 'checked="checked"'; } } ?>/>Espejo Retroscopico</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="equipo" name="descripcion[]" value="E2" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="E2"){ echo 'checked="checked"'; } } ?>/>Equipo (Por no Llevar Reglamento)</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="reglamento" name="descripcion[]" value="E3" <?php $result2=mysql_query($sql2); while($row1 = mysql_fetch_array($result2)) { $concepto=$row1['id_concepto']; if($concepto=="E3"){ echo 'checked="checked"'; } } ?>/>Reglamento (No llevarlo Consigo el Conductor)</td>
						</tr>
						<tr>
							<td height="20px"></td>
						</tr>
						<!-- <tr>
							<td><p align="left">Otros</p></td>
						</tr>
						<tr>
							<td colspan="3"><input type="text" id="descripcion_g4" name="descripcion_g4" style="width:100%" placeholder="Descripcion"></td>
						</tr> -->
					</table>
					<?php } ?>
					<?php
						$result3=mysql_query($sql3);
						if ($row3 = mysql_fetch_array($result3)){ 
					?>
					<div class="espacio_tablas"></div>
					


					<table>
						<tr>
							<td colspan="2" width="1120px">Traslado de Vehiculo</td>
						</tr>
						<?php if ($row3['concesionario']=="" && $row3['tipo_grua']==""){ ?>
						<tr>
							<td width="1120px"><input type="radio" id="traslado_si" name="traslado_vehiculo" value="si" readonly />SI</td>
						</tr>
						<tr>
							<td width="1120px"><input type="radio" id="traslado_no" name="traslado_vehiculo" value="no" checked readonly />NO
							</td>
						</tr>
						<?php } ?>
						<?php if ($row3['concesionario']!="" && $row3['tipo_grua']!=""){?>
						<tr>
							<td width="1120px"><input type="radio" id="traslado_si" name="traslado_vehiculo" value="si" checked readonly />SI</td>
						</tr>
						<tr>
							<td width="1120px"><input type="radio" id="traslado_no" name="traslado_vehiculo" value="no" readonly />NO</td>
						</tr>
						<?php } ?>
						<tbody class="ocultos">
						<tr id="traslado_oculto">
							<td>TIPO DE TRASLADO
								<?php if ($row3['tipo_grua']=="OFICIAL") { ?>
									<select name="select_tipo_traslado" style="width:20%" readonly />
										<option value="OFICIAL" selected>OFICIAL</option> 
										<option value="PARTICULAR">PARTICULAR</option>
									</select>
								<?php } 
									else if ($row3['tipo_grua']=="PARTICULAR") { ?>
									<select name="select_tipo_traslado" style="width:20%" readonly />
										<option value="OFICIAL">OFICIAL</option> 
										<option value="PARTICULAR" selected>PARTICULAR</option>
									</select>
								<?php } 
									else { ?>
									<select name="select_tipo_traslado" style="width:20%" readonly />
										<option value="OFICIAL">OFICIAL</option> 
										<option value="PARTICULAR">PARTICULAR</option>
									</select>
								<?php } ?>
							</td>
						</tr>
						<tr id="traslado_ocultos">
							<td>CONCECIONARIA RESPONSABLE DEL TRASLADO
								<?php if ($row3['concesionario']=="") { ?>
									<select name="select_responsable_traslado" style="width:20%" readonly />
										<option value="SANTA TERESA">SANTA TERESA</option> 
										<option value="TRANSITO">TRANSITO</option>
									</select>
								<?php } ?>
								<?php if ($row3['concesionario']=="SANTA TERESA") { ?>
									<select name="select_responsable_traslado" style="width:20%"readonly />
										<option value="SANTA TERESA" selected>SANTA TERESA</option> 
										<option value="TRANSITO">TRANSITO</option>
									</select>
								<?php } ?>
								<?php if ($row3['concesionario']=="TRANSITO") { ?>
									<select name="select_responsable_traslado" style="width:20%" readonly />
										<option value="SANTA TERESA">SANTA TERESA</option> 
										<option value="TRANSITO" selected>TRANSITO</option>
									</select>
								<?php } ?>
							</td>
						</tr>
						</tbody>
					</table>

						<?php if ($row3['concesionario']=="" && $row3['tipo_grua']==""){ ?>
							<script>
						    	$('.ocultos').hide();
							</script>
						<?php } ?>


					<div class="espacio_tablas"></div>

					<table>
						<tr>
							<td colspan="2" width="1120px">Deposito de Vehiculo</td>
						</tr>
						<?php if ($row3['nombre_encierro']=="" && $row3['tipo_encierro']==""){ ?>
						<tr>
							<td width="1120px"><input type="radio" id="deposito_si" name="deposito_vehiculo" value="si" readonly />SI</td>
						</tr>
						<tr>
							<td width="1120px">
							<input type="radio" id="deposito_no" name="deposito_vehiculo" value="no" checked readonly />NO
							</td>
						</tr>
						<?php } ?>
						<?php if ($row3['nombre_encierro']!="" && $row3['tipo_encierro']!=""){ ?>
						<tr>
							<td width="1120px"><input type="radio" id="deposito_si" name="deposito_vehiculo" value="si" checked readonly />SI</td>
						</tr>
						<tr>
							<td width="1120px"><input type="radio" id="deposito_no" name="deposito_vehiculo" value="no" readonly />NO</td>
						</tr>
						<?php } ?>
						<tbody class='ocultos2'>
						<tr>
							<td>TIPO DE ENCIERRO
								<?php if ($row3['tipo_encierro']==""){ ?>
									<select name="select_tipo_encierro" style="width:20%" readonly />
										<option value="OFICIAL">OFICIAL</option> 
										<option value="PARTICULAR">PARTICULAR</option>
									</select>
								<?php } ?>
								<?php if ($row3['tipo_encierro']=="OFICIAL"){ ?>
									<select name="select_tipo_encierro" style="width:20%" readonly />
										<option value="OFICIAL" selected>OFICIAL</option> 
										<option value="PARTICULAR">PARTICULAR</option>
									</select>
								<?php } ?>
								<?php if ($row3['tipo_encierro']=="PARTICULAR"){ ?>
									<select name="select_tipo_encierro" style="width:20%" readonly />
										<option value="OFICIAL">OFICIAL</option> 
										<option value="PARTICULAR" selected>PARTICULAR</option>
									</select>
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td>NOMBRE DE ENCIERRO
								<?php if ($row3['nombre_encierro']==""){ ?>
									<select name="select_responsable_encierro" style="width:20%" readonly />
										<option value="SANTA CRUZ">SANTA CRUZ</option> 
										<option value="SAN SEBASTIAN">SAN SEBASTIAN</option>
										<option value="SAN BARTOLO">SAN BARTOLO</option>
										<option value="OCOTLAN">OCOTLAN</option>
									</select>
								<?php } ?>
								<?php if ($row3['nombre_encierro']=="SANTA CRUZ"){ ?>
									<select name="select_responsable_encierro" style="width:20%" readonly />
										<option value="SANTA CRUZ" selected>SANTA CRUZ</option> 
										<option value="SAN SEBASTIAN">SAN SEBASTIAN</option>
										<option value="SAN BARTOLO">SAN BARTOLO</option>
										<option value="OCOTLAN">OCOTALAN</option>
									</select>
								<?php } ?>
								<?php if ($row3['nombre_encierro']=="SAN SEBASTIAN"){ ?>
									<select name="select_responsable_encierro" style="width:20%" readonly />
										<option value="SANTA CRUZ">SANTA CRUZ</option> 
										<option value="SAN SEBASTIAN" selected>SAN SEBASTIAN</option>
										<option value="SAN BARTOLO">SAN BARTOLO</option>
										<option value="OCOTLAN">OCOTLAN</option>
									</select>
								<?php } ?>
								<?php if ($row3['nombre_encierro']=="SAN BARTOLO"){ ?>
									<select name="select_responsable_encierro" style="width:20%" readonly />
										<option value="SANTA CRUZ">SANTA CRUZ</option> 
										<option value="SAN SEBASTIAN">SAN SEBASTIAN</option>
										<option value="SAN BARTOLO" selected>SAN BARTOLO</option>
										<option value="OCOTLAN">OCOTLAN</option>
									</select>
								<?php } ?>
								<?php if ($row3['nombre_encierro']=="OCOTLAN"){ ?>
									<select name="select_responsable_encierro" style="width:20%" readonly />
										<option value="SANTA CRUZ">SANTA CRUZ</option> 
										<option value="SAN SEBASTIAN">SAN SEBASTIAN</option>
										<option value="SAN BARTOLO" >SAN BARTOLO</option>
										<option value="OCOTLAN" selected>OCOTLAN</option>
									</select>
								<?php } ?>
							</td>
						</tr>
						</tbody>
						</table>


					<?php } ?>

						<?php if ($row3['nombre_encierro']=="" && $row3['tipo_encierro']==""){ ?>
							<script>
						    	$('.ocultos2').hide();
							</script>
						<?php } ?>
					<div class="espacio_tablas"></div>
					<table>
						<tr>
							<td width="800px">IMPORTE TOTAL<td>
						</tr>
						<tr id="campo_total">
							<td bgcolor="red" width="100px"><input type="text" name="importe_total" id="importe_total" placeholder="" value="<?php echo $row4['importe_total'];?>" readonly/></td>
						</tr>
					</table>
					<div class="espacio_tablas"></div>
					<table>
						<tr>
							<td width="150px"><input type="submit" name="actualizar" id="actualizar" value="Actualizar" class="btn_log"/></td>
						</tr>
					</table>
					<div class="espacio_tablas"></div>
				</form>
				
			</center>
		</div>
	</div>
</body>
</html>