<?php
	session_start();
	include("conexion.php");
	if(!isset($_SESSION["id"])){
		die(header("Location:index"));
	}	
	$rol=$_SESSION["rol"];	
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
		<div class="content">
			<form id="searchform" action="buscar" method="post">
				<select name="tipoConsulta">
				  <option value="">SELECCIONA TIPO DE CONSULTA</option>
				  <option value="placa">Por placa</option>
				  <option value="idInfraccion">Por folio</option>
				  <option value="numLicencia">Por número de licencia</option>
				</select>
				<div class="espacio"></div>
					<input type="text" class="buscar" id="buscar" name="buscar" placeholder="ingrese dato" onblur="this.value=this.value.toUpperCase();"/>
					<button type="submit">Buscar</button>
				<div class="espacio"></div>
			
			</form>
			<center>
				<?php
					include("action_buscar.php");
				?>
			</center>
		</div>
	</div>

</body>
</html>