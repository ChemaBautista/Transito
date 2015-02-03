<?php 
	session_start();
	if(isset($_SESSION["id"])){
		die(header("Location:infraccion"));
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, user-scalable=no"/>

	<!-- Page Title -->
	<link href="images/logo.ico" type="image/x-icon" rel="shortcut icon"/>
	<title>LOGIN -Direccion de Transito del Estado-</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox-1.3.4.css" media="screen" />
	<link href="themes/2/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="themes/2/js-image-slider.js" type="text/javascript"></script>
    <link href="generic.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="dist/semantic.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
 	<script type="text/javascript" src="dist/semantic.js"></script> 
	
	<script type="text/javascript">
		//form validation rules
		$('document').ready(function(){

			$("#register-form").validate({
				rules: {
					user: {
						required: true
					},
					password: {
						required: true,
						minlength: 5
					}
				},
				messages: {
					password: {
						required: "Ingresa tu contraseña",
						minlength: "Debe ser mayor a 5 caracteres"
					},
					user: "Ingresa un usuario valido",
				},
				submitHandler: function(form) {
					form.submit();
				}
			})
		});
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
							<li class="current"><a href='infraccion'>Inicio</a></li>
							<li><a href="consultar">Consultar</a></li>
							<li><a href="reportes">Reportes infracción</a></li>
							<li><a href="configuracion">Configuraciones</a></li>
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
		<div style="border: 1pt solid #fbb; text-align: center;">
			<table class="centrada">
				<tr>
					<td><img src="images/logo.jpg" height="130" width="100"></td>
				</tr>
			</table>
		</div>
		<div class="content">
			<center>
				<form action="login" method="post" id="register-form">
				
					<table>
					<tr><td align="center"> 
					<div  class="ui form" id="register-form">
							  <div class="fields">
							    <div class="required field">
							      <div class="ui icon input">
							        <input type="text" name="user" placeholder="Usuario" required>
							        <i class="user icon"></i>
							      </div>
							    </div>
							   </div>
							   <div class= "fields">
							   	<div class="required field">
							      <div class="ui icon input">
							        <input type="password" name="password" placeholder="Contraseña" required>
							        <i class="lock icon"></i>
							      </div>
							    </div>

							   </div>
						<div class="espacio1"></div>
						<tr>
							<td align="center" colspan="2"><input type="submit" value="ACEPTAR" class="btn_log"/></td>
						</tr>
					</table>
				</form>
			</center>
		</div>
	</div>
	</td></tr>
	<div id="footer1">
	<div class="espacio1"></div>
	<div class="espacio"></div>
	<center>
		<div class="texto_footer"> 
			GOBIERNO DEL ESTADO DE OAXACA 2010-2016<br/><br/>
			Dirección de Tránsito del Estado <br/>
			Av. Ferrocarril Número 508 col. Cinco Señores, C.P. 68000
		</div>
	</center>
	</div>
</body>
</html>
