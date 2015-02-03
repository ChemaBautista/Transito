<?php
session_start();
include ('conexion.php');
include 'conexion2.php';
$select_concesionario=mysql_query("SELECT concesionario FROM traslado order by concesionario;");
$select_concesionario_tipo=mysql_query("SELECT tipo_grua FROM traslado group by tipo_grua;");
$select_nombre_encierro=mysql_query("SELECT nombre_encierro FROM encierro order by id_encierro;");
$select_tipo_encierro=mysql_query("SELECT tipo_encierro FROM encierro group by tipo_encierro");
$poblacion_infractor=mysql_query("SELECT clave, nombre FROM municipios");
$agencia_infraccion=mysql_query("SELECT nombre FROM localidad order BY nombre");
if(!isset($_SESSION["id"])){
	die(header("Location:index"));
}	
$rol=$_SESSION["rol"];

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, user-scalable=no"/>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />


	<!-- Page Title -->
	<link href="images/logo.ico" type="image/x-icon" rel="shortcut icon"/>
	<title>Secretaría de Seguridad pública</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox-1.3.4.css" media="screen" />
	<link href="themes/2/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="themes/2/js-image-slider.js" type="text/javascript"></script>
    <link href="generic.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
  	<style>
		.ui-autocomplete-loading {
			background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;
		}
  	</style>

	<!--<script type="text/javascript" src="js/jquery-latest.js"></script>
	<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="js/jquery-2.1.3.js"></script>
	<script type="text/javascript" src="js/js.js"></script>-->
	<script type="text/javascript" src="js/jquery-1.11.2.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/jquery.bxslider.js"></script>
	<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="js/jquery.selectik.js"></script>
	<script type="text/javascript" src="js/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="js/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="js/jquery.countdown.js"></script>
	<script type="text/javascript" src="js/jquery.checkbox.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script> 
	<script type="text/javascript" src="js/jquery.form.js"></script> 
	<script type="text/javascript" src="js/validaCampo.js"></script>
	<script type="text/javascript" src="js/jquery.jCombo.min.js"></script>

<script>
  $(function() {
    $( "#accordion" ).accordion();
  });
  </script>
<script>



$('.ocultos').hide();
$('.ocultos2').hide();
//oculta elementos
$(document).ready(function(){ 
   $('#seleccion_si').on('click',function(){
  	$('.ocultos').show()
   	$('#seleccion_no').toggle();
      
;   });
});

$(document).ready(function(){ 
   $('#seleccion_no').on('click',function(){
      $('.ocultos').hide();
   });
});
///////////////////////////////////////////////////
$(document).ready(function(){ 
   $('#deposito_si').on('click',function(){
  	$('.ocultos2').show()
   	$('#deposito_no').toggle();
      
;   });
});

$(document).ready(function(){ 
   $('#deposito_no').on('click',function(){
      $('.ocultos2').hide();
   });
});

//autocomplete para licencia 


		$(function() {
		     
		    $( "#numero_licencia" ).autocomplete({
		      source: "search_licencia.php",
		      minLength: 2,
		      select: function( event, ui ) {
		        
		          $( "#ap_paterno" )[0].value = ui.item.ap ;
			      $( "#ap_materno" )[0].value = ui.item.am ;
			      $( "#nombres" )[0].value = ui.item.nom ;

		          $( "#calle_infractor" )[0].value = ui.item.cal_inf ;
			      $( "#numero_infractor" )[0].value = ui.item.num_c_lic ;
			      $( "#colonia_infractor" )[0].value = ui.item.col_lic ;

 		          $( "#poblacion_infractor" )[0].value = ui.item.pob_lic ; //arreglar
			      $( "#clasificacion_licencia" )[0].value = ui.item.cla ;
			      $( "#entidad_licencia" )[0].value = ui.item.ent_lic ;
			      $( "#vigencia_licencia" )[0].value = ui.item.vig ;

		      }
		    });
		  });



//autocomplete para numero_placa


		$(function() {
		     
		    $( "#placas_ve" ).autocomplete({
		      source: "search_num_placa.php",
		      minLength: 2,
		      select: function( event, ui ) {
		        
		          $( "#marca_ve" )[0].value = ui.item.marca ;
			      $( "#submarca_ve" )[0].value = ui.item.submarca ;
			      $( "#modelo_ve" )[0].value = ui.item.modelo ;

		          $( "#color_ve" )[0].value = ui.item.color;
			      $( "#entidad_ve" )[0].value = ui.item.entidad_vehiculo ;
			      $( "#motor_ve" )[0].value = ui.item.numero_motor ;

 		          $( "#serie_ve" )[0].value = ui.item.numero_serie ;
 		          
 		          tipo_vehiculo = document.getElementsByName("tipo_vehiculo");
 		          for(var i = 0; i < tipo_vehiculo.length; i++){
 		          	if(tipo_vehiculo[i].value == ui.item.tipo_vehiculo)
 		          		tipo_vehiculo[i].checked = true;
 		          }

 		          tipo_servicio = document.getElementsByName("tipo_servicio");
 		          for(var i = 0; i < tipo_servicio.length; i++){
 		          	if(tipo_servicio[i].value == ui.item.tipo_servicio)
 		          		tipo_servicio[i].checked = true;
 		          }
			      //$("#tipo_vehiculo" )[0].value = ui.item.tipo_vehiculo ;//checar
			      //$( "#tipo_servicio" )[0].value = ui.item.tipo_servicio ;//checar
			      
		      }
		    });
		  });	

//autocomplete de curp
		$(function() {
		    $("#curp").autocomplete({
		      source: "search.php",
		      minLength: 2
		    });
		  });
//funcion para select anidados
		$(window).load(function() {
				$("#municipio_infraccion").jCombo({
					url: "municipios.php", 
					initial_text: "-- Seleccione --",
					onLoad: function() {
 						$("#agencia_infraccion").jCombo({ 
							url: "localidades.php", 
							input_param: "id",
							initial_text: "-- Seleccione --",
							parent: "#municipio_infraccion"
						});			
					}
				});
		});	

	</script>

	<script type="text/javascript">
		//form validation rules
		$('document').ready(function(){
			$("#formulario_infraccion").validate({
				rules: {
					curp: {
						required: true,
						minlength: 18
					},
					hora_infraccion: {
						required: true
					},
					fecha_infraccion: {
						required: true
					},
					calle_infraccion: {
						required: true
					},
					colonia_infraccion: {
						required: true
					},
					agencia_infraccion: {
						required: true
					},
					entidad_infraccion: {
						required: true
					},
					marca_ve: {
						required: true
					},
					submarca_ve: {
						required: true
					},
					color_ve: {
						required: false
					},
					entidad_ve: {
						required: true
					},
					ap_paterno: {
						required: false
					},
					ap_materno: {
						required: false
					},
					nombres: {
						required: false
					},
					calle_infractor: {
						required: false
					},
					numero_infractor: {
						required: false
					},
					colonia_infractor: {
						required: false
					},
					poblacion_infractor: {
						required: false
					},
					clasificacion_licencia: {
						required: false
					},
					numero_licencia: {
						required: false
					},
					entidad_licencia: {
						required: false
					},
					vigencia_licencia: {
						required: true
					},
					placas_ve: {
						required: false
					},
					'descripcion[]':{
						required: true
					},
					'tipo_vehiculo':{
						required: true
					},
					'tipo_servicio':{
						required: true
					},
					'traslado_vehiculo':{
						required: true
					},
					'deposito_vehiculo':{
						required: true
					}
				},
				messages: {
					placas_ve:"*",
					curp: "Ingrese CURP",
					hora_infraccion:"Ingrese Hora",
					fecha_infraccion:"Ingrese Fecha",
					calle_infraccion:"Ingrese Calle",
					colonia_infraccion:"Ingrese Colonia",
					agencia_infraccion:"Ingrese Agencia",
					entidad_infraccion:"Ingrese Entidad",
					marca_ve:"Ingrese Marca Vehiculo",
					submarca_ve:"Ingrese  Submarca Vehiculo",
					color_ve:"*",
					entidad_ve:"Ingrese Endidad Vehiculo",
					ap_paterno:"Ingrese Apellido Paterno",
					ap_materno:"Ingrese Apellido Materno",
					nombres:"Ingrese Nombre Infractor",
					calle_infractor:"Ingrese Calle ",
					numero_infractor:"Ingrese Número",
					colonia_infractor:"Ingrese Colonia",
					poblacion_infractor:"Ingrese Población",
					clasificacion_licencia:"Ingrese una Clasificación",
					numero_licencia:"Ingrese Licencia",
					entidad_licencia:"Ingrese Entidad Licencia",
					vigencia_licencia:"*",
					'descripcion[]':{
						required: "Seleccione Una Opcion",
					},
					'tipo_vehiculo':{
						required: "Ingrese Un Tipo",
					},
					'tipo_servicio':{
						required: "Seleccione un Servicio",
					},
					'traslado_vehiculo':{
						required: "Seleccione Un Traslado",
					},
					'deposito_vehiculo':{
						required: "Seleccione un Deposito",
					}
				},
			})
		});
    </script>
	<script type="text/javascript">
        $(function(){
			//Para escribir solo letras
            $('#ap_paterno').validaCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
			$('#colonia_infraccion').validaCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
			$('#agencia_infraccion').validaCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
			$('#entidad_infraccion').validaCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
			$('#ap_materno').validaCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
			$('#nombres').validaCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
			$('#calle_infractor').validaCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
			//$('#colonia_infractor').validaCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
			$('#poblacion_infractor').validaCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
			$('#clasificacion_licencia').validaCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
			$('#entidad_licencia').validaCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
			$('#color_ve').validaCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
			$('#entidad_ve').validaCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
					
            //Para escribir solo numeros    
            $('#numero_licencia').validaCampo('0123456789');
			//$('#numero_infractor').validaCampo('0123456789'); 
			$('#modelo_ve').validaCampo('0123456789');  			
        });
        </script> 
		<script src="ajax.js"></script>
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

		function borracamposlic(event){
			if(((event.which || event.keyCode) == 8) || $("#numero_licencia")[0].value == "") {
				$("#ap_paterno").val("");
				$("#ap_materno").val("");
				$("#nombres").val("");
				$("#calle_infractor").val("");
				$("#numero_infractor").val("");
				$("#colonia_infractor").val("");
				$("#poblacion_infractor")[0].selectedIndex = 0;
				$("#clasificacion_licencia").val("");
				$("#entidad_licencia").val("");
				d = new Date();
				df = d.toJSON().substr(0, 10);
				//df = d.getFullYear() + "-" + (d.getMonth() < 9 ? "0" : "") + (d.getMonth() + 1) + "-" + (d.getDate() < 10 ? "0" : "") + d.getDate();
				//alert(df);
				$("#vigencia_licencia")[0].value = df;
			}
		}
		function borracamposveh(event){
			if(((event.which || event.keyCode) == 8) || $("#numero_placa")[0].value == "") {
				$("#marca_ve").val("");
				$("#submarca_ve").val("");
				$("#modelo_ve").val("");
				$("#color_ve").val("");
				$("#entidad_ve").val("");
				$("#motor_ve").val("");
				$("#serie_ve").val("");
				$("input[name=tipo_vehiculo]").attr("checked", false);
				$("input[name=tipo_servicio]").attr("checked", false);
			}
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
						<?php 

							if (!empty($_SESSION["id"])){ ?>							
							<li class="current"><a href='infraccion'>Infracción</a></li>
							<li><a href="buscar">Consultar</a></li>
							<?php if ($rol=="DIRECTIVO"){?>
							<li><a href="reportes">Reportes infracción</a></li>
							<li><a href="configuracion">Configuraciones</a></li>
							<?php } ?>
							<li><a href="#">Bienvenido [ <?php echo $rol;?> ]</a></li>
							<li><a href="logout">Salir</a></li>
							<li><a href="ayuda/index.htm" target="_blank">Ayuda</a></li>
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
				<form action="registro_infraccion" method="post" id="formulario_infraccion">

					<table>
						<tr>
							<td width="800px">CAMPOS OBLIGATORIOS<span>*</span></td>
						</tr>
						<tr>
							<td width="800px">Curp<td>
						</tr>
						<tr>


							<td width="800px"><input type="text" name="curp" id="curp" placeholder="Ingresa tu curp" maxlength="18" /></td>
						</tr>
					</table>
	<p>================================================================================================================</p>
					<table>
						<tr>
							<td colspan="2">FECHA Y HORA DE LA INFRACCIÓN</td>
						</tr>
						<tr>
							<td>Hora</td>
							<td>Fecha</td>
						</tr>
						<tr>
							<td><input type="time" id="hora_infraccion" name="hora_infraccion" placeholder="Hora de la infracción" value="00:00:00" style="width:400px;"/></td>
							<td><input type="date" id="fecha_infraccion" name="fecha_infraccion" placeholder="Hora de la infracción" value="<?php echo date("Y-m-d");?>" onblur="if(Date.parse(this.value) > Date.parse(new Date())) { alert('Fecha NO valida'); }"  style="width:400px;"/></td>
						</tr>
					</table>
	<p>================================================================================================================</p>
					<table>
						<tr>
							<td colspan="2">UBICACIÓN DE LA INFRACCIÓN</td>
						</tr>
						<tr>
							<td>Calle o Tramo Carretero</td>
							<td>Colonia</td>
						</tr>
						<tr>
							<td><input type="text" id="calle_infraccion" name="calle_infraccion" placeholder="Calle o tramo carretero" value="" onblur="this.value=this.value.toUpperCase()" style="width:400px;"/></td>
							<td><input type="text" id="colonia_infraccion" name="colonia_infraccion" placeholder="Colonia" value="" onblur="this.value=this.value.toUpperCase()" style="width:400px;"/></td>
						</tr>
						<tr>
							<td>Entidad</td>
							<td>Municipio</td>
						</tr>
						<tr>
							<td><input type="text" id="entidad_infraccion" name="entidad_infraccion" readonly placeholder="Entidad" value="OAXACA"  onblur="this.value=this.value.toUpperCase()" style="width:400px;"/></td>
							<td><select id="municipio_infraccion"></select></td>
						</tr>
						<tr>
							<td colspan="2">Localidad</td>
						</tr>
						<tr>
							<td colspan="2"><select id="agencia_infraccion" name="agencia_infraccion"></select></td>
						</tr>
					</table>
				<p>================================================================================================================</p>
					<table>
						<tr>
							<td colspan="2">DATOS DEL INFRACTOR</td>
							
						</tr>
						<tr>
							<td>Número Licencia</td>
							<td><input type="text" id="numero_licencia" name="numero_licencia" placeholder="Numero de licencia" value="" onkeyup="borracamposlic(event)" onblur="this.value=this.value.toUpperCase()" style="width:200px;" maxlength="8" /></td>
						</tr>
						<tr>
							<td>Apellido Paterno</td>
							<td>Apellido Materno</td>
							<td>Nombre(s)</td>
						</tr>
						<tr>
							<td><input type="text" id="ap_paterno" name="ap_paterno" placeholder="Apellido paterno" value="" onblur="this.value=this.value.toUpperCase()" style="width:220px;"/></td>
							<td><input type="text" id="ap_materno" name="ap_materno" placeholder="Apellido materno" value="" onblur="this.value=this.value.toUpperCase()" style="width:220px;"/></td>
							<td><input type="text" id="nombres" name="nombres" placeholder="Nombre del infractor" value="" onblur="this.value=this.value.toUpperCase()" style="width:220px;"/></td>
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
							<td><input type="text" id="calle_infractor" name="calle_infractor" placeholder="Calle" value="" onblur="this.value=this.value.toUpperCase()" style="width:200px;"/></td>
							<td><input type="text" id="numero_infractor" name="numero_infractor" placeholder="Numero" value="" onblur="this.value=this.value.toUpperCase()" style="width:200px;"/></td>
							<td><input type="text" id="colonia_infractor" name="colonia_infractor" placeholder="Colonia" value="" onblur="this.value=this.value.toUpperCase()" style="width:200px;"/></td>
							<td><select id="poblacion_infractor" name="poblacion_infractor" style="width:80%">
								<option value="">Seleccione Opcion</option>
									<?php
										     while($row = mysql_fetch_assoc($poblacion_infractor))
										     {
										    ?>
										      <option value="<?php echo $row['clave']; ?>"><?php echo $row['nombre']; ?></option>
										    <?php
										     }
										?>
								</select>
							</td>
						</tr>
						<tr>
							<td>LICENCIA</td>
						</tr>
						<tr>
							<td>Clasificación</td>
							<td>Entidad</td>
							<td>Vigencia</td>
						</tr>
						<tr>
							<td><input type="text" id="clasificacion_licencia" name="clasificacion_licencia" placeholder="Clasificacion" value="" onblur="this.value=this.value.toUpperCase()" style="width:200px;"/></td>
							<td><input type="text" id="entidad_licencia" name="entidad_licencia" placeholder="Entidad de la licencia" value="" onblur="this.value=this.value.toUpperCase()" style="width:200px;"/></td>
							<td><input type="date" id="vigencia_licencia" name="vigencia_licencia" placeholder="Vigencia de la licencia" value="<?php echo date("Y-m-d");?>" style="width:200px;" onblur="if(Date.parse(this.value) + 86400000 < Date.parse(new Date())) { alert('Licencia vencida'); }" /></td>
						</tr>
					</table>
				<p>================================================================================================================</p>
					<table>
						<tr>
							<td colspan="2">CARACTERISTICAS DEL VEHICULO</td>
						</tr>
						<tr>
							<td>Placas</td>
							<td><input type="text" id="placas_ve" name="placas_ve" placeholder="Placas" value="" onkeyup="borracamposveh(event)" onblur="this.value=this.value.toUpperCase()" maxlength="7" style="width:200px;"/></td>

						</tr>
						<tr>
							<td>Marca</td>
							<td>Submarca</td>
							<td>Modelo</td>
							<td>Color</td>
						</tr>
						<tr>
							<td><input type="text" id="marca_ve" name="marca_ve" placeholder="Marca" value="" onblur="this.value=this.value.toUpperCase()" style="width:200px;"/></td>
							<td><input type="text" id="submarca_ve" name="submarca_ve" placeholder="Submarca" onblur="this.value=this.value.toUpperCase()" value="" style="width:200px;"/></td>
							<td><input type="text" id="modelo_ve" name="modelo_ve" placeholder="Modelo" value="" onblur="this.value=this.value.toUpperCase()" maxlength="4" style="width:200px;"/></td>
							<td><input type="text" id="color_ve" name="color_ve" placeholder="Color" value="" onblur="this.value=this.value.toUpperCase()" style="width:200px;"/></td>
						</tr>
						<tr>
							
							<td>Entidad</td>
							<td>Numero de motor</td>
							<td>Numero de serie</td>
						</tr>
						<tr>
							
							<td><input type="text" id="entidad_ve" name="entidad_ve" placeholder="Entidad" value="" onblur="this.value=this.value.toUpperCase()" style="width:200px;"/></td>
							<td><input type="text" id="motor_ve" name="motor_ve" placeholder="Numero de motor" onblur="this.value=this.value.toUpperCase()" maxlength="9" value="" style="width:200px;"/></td>
							<td><input type="text" id="serie_ve" name="serie_ve" placeholder="Numero de serie" value="" onblur="this.value=this.value.toUpperCase()" maxlength="17" style="width:200px;"/></td>
						</tr>
					</table>
					
					<table>
						<tr>
							<td colspan="2">Clase de vehiculo</td>
						</tr>
						<tr>
							<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Automovil"/>Automovil</td>
							<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Motocicleta"/>Motocicleta</td>
							<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="Camioneta"/>Camioneta</td>
							<td width="200px"><input type="radio" id="tipo_vehiculo" name="tipo_vehiculo" value="TractoCamion"/>TractoCamion</td>
						</tr>
						<tr>
							<td height="15px" colspan="2"></td>
						</tr>
						<tr>
							<td colspan="2">Tipo Servicio</td>
						</tr>
						<tr>
							<td width="200px"><input type="radio" id="tipo_servicio" name="tipo_servicio" value="Particular"/>Particular</td>
							<td width="200px"><input type="radio" id="tipo_servicio" name="tipo_servicio" value="Publico"/>Publico</td>
						</tr>

							<td><p align="left">Observaciones</p></td>
						</tr>
						<tr>
							<td colspan="3"><input type="text" id="observaciones0" name="observaciones0" style="width:100%" placeholder="observaciones" onblur="this.value=this.value.toUpperCase()"/></td>
						</tr> 
					</table>
				<p>================================================================================================================</p>
					<div id="accordion">
					<table><h3>SELECCIONE MOTIVOS PARA INFRACCIÓN</h3></table>
					<table>
					<h3>Motivo de la detencion del vehiculo</h3>
					<!-- 	<tr>
							<td colspan="2">Motivo de la detencion del vehiculo</td>
						</tr> -->
						<tr>
							<td width="540px"><input type="checkbox" id="embriaguez" name="descripcion[]" value="A1"/>Estado de Embriaguez</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="falta_placas" name="descripcion[]" value="A4"/>Falta de placas, las lleve ocultas o se encuentren alteradas</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="falta_tarjeta" name="descripcion[]" value="A2"/>Falta Tarjeta de Circulacion</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="malas_condiciones" name="descripcion[]" value="A5"/>El vehiculo se encuentre en tan malas condiciones</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="falta_licencia" name="descripcion[]" value="A3"/>Falta Licencia de Conducir</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="servicio_publico" name="descripcion[]" value="A6"/>Realizar Servicio Publico de Pasajeros o de Carga</td>
						</tr>
						<tr>
							<td height="20px"></td>
						</tr>
						
						
					</table>
					<table>
					<h3>Motivo de la infraccion grupo 1</h3>
						<!-- <tr>
							<td colspan="2">Motivo de la infraccion grupo 1</td>
						</tr> -->
						<tr>
							<td width="540px"><input type="checkbox" id="ascenso_descenso" name="descripcion[]" value="B1"/>Ascenso y Descenso de Pasaje(No dar tiempo suficiente)</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="pasaje_arrollo" name="descripcion[]" value="B2"/>Bajar o Subir Pasaje en el Arroyo</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="doble_fila" name="descripcion[]" value="B3"/>Doble Fila</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="exceso_velocidad" name="descripcion[]" value="B4"/>Exceso de Velocidad</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="exceso_pasaje" name="descripcion[]" value="B5"/>Exceso de Pasaje</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="sentido_contrario" name="descripcion[]" value="B6"/>Circular en Sentido Contrario</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="zona_escolar" name="descripcion[]" value="B7"/>Zona Escolar</td>							
						</tr>
					</table>
				
					<table>
					<h3>Motivo de la infraccion grupo 2</h3>
						<!-- <tr>
							<td colspan="2">Motivo de la infraccion grupo 2</td>
						</tr> -->
						<tr>
							<td width="540px"><input type="checkbox" id="señal_alto" name="descripcion[]" value="C1"/>No Obedecer la Señal de Alto</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="cajuela_abierta" name="descripcion[]" value="C2"/>Circular con la Cajuela Abierta</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="carril" name="descripcion[]" value="C3"/>Carril</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="falta_luces" name="descripcion[]" value="C4"/>Falta de Luces o no Encender las Reglamentarias</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="maniobras_peligrosas" name="descripcion[]" value="C5"/>Maniobras Peligrosas</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="paso_peaton" name="descripcion[]" value="C6"/>No Respetar el Derecho del paso del Peaton</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="falta_precaucion" name="descripcion[]" value="C7"/>Falta de Precaucion causando daños a terceros</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="preferencia_paso" name="descripcion[]" value="C8"/>No Respetar Preferencia del Paso</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="reversa" name="descripcion[]" value="C9"/>Reversa</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="rutas_autobuses" name="descripcion[]" value="C10"/>Rutas de autobuses</td>
						</tr>	
						<tr>
							<td width="540px"><input type="checkbox" id="sitio_taxis" name="descripcion[]" value="C11"/>Sitios de taxis</td>
							<td width="40px"></td>
							<td width="540px"><input type="checkbox" id="servicio_publico_placas" name="descripcion[]" value="C12"/>Prestar Servicio Publico con Placas de otro Estado</td>
						</tr>
						<tr>
							<td width="540px"><input type="checkbox" id="conductores_distraidos" name="descripcion[]" value="C13"/>Manejar los conductores estando distraidos o platicando, abastecer de combustible con el motor en marcha</td>
						</tr>
						<tr>
							<td height="20px"></td>
						</tr>
						<!-- <tr>
							<td><p align="left">Otros</p></td>
						</tr>
						<tr>
							<td colspan="3"><input type="text" id="dess" name="dess" style="width:100%" placeholder="Descripcion"/></td>
						</tr> -->
					</table>
									
					<table>
					
							<h3>Motivo de la infraccion grupo 3</h3>
						<!-- <tr>
							<td colspan="2" width="1120px">Motivo de la infraccion grupo 3</td>
						</tr> -->
						<tr>
							<td width="1120px"><input type="checkbox" id="abandono_ve" name="descripcion[]" value="D1"/>Abandono de Vehiculo</td>
						
							<td width="1120px"><input type="checkbox" id="falta_aseo" name="descripcion[]" value="D2"/>Falta de Aseo y Cortesia de los Operadores de Vehiculos de Servicio Publico</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="carril_g3" name="descripcion[]" value="D3"/>Carril (No Toma el Correspondiente)</td>
						
							<td width="1120px"><input type="checkbox" id="claxon" name="descripcion[]" value="D4"/>Claxon (Tocarlo innecesariamente, en forma escandalosa u obsena)</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="colores_reglamentarios" name="descripcion[]" value="D5"/>Colores Reglamentarios</td>
						
							<td width="1120px"><input type="checkbox" id="distancia_reglamentaria" name="descripcion[]" value="D6"/>No Guardar Distancia Reglamentaria</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="doble_fila_estaciona" name="descripcion[]" value="D7"/>Estacionarse en Doble Fila</td>
						
							<td width="1120px"><input type="checkbox" id="lugar_prohibido" name="descripcion[]" value="D8"/>Estacionarse en Lugar Prohibido</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="sin_precaucion" name="descripcion[]" value="D9"/>Salir Intempestivamente y Sin Precaucion del Lugar de Estacionamiento</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="fuga" name="descripcion[]" value="D10"/>Darse a la Fuga Despues de Cometer Alguna Infraccion</td>
					
							<td width="1120px"><input type="checkbox" id="no_obedecer" name="descripcion[]" value="D11"/>No Obedecer las Indicaciones del Policia de Transito</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="interrupcion" name="descripcion[]" value="D12"/>Interrupcion del Transito</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="mas_de_dos" name="descripcion[]" value="D13"/>Viajar Mas de Dos Personas en una Motocicleta</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="mal_comportamiento" name="descripcion[]" value="D14"/>Mal comportamiento del Conductor</td>
						
							<td width="1120px"><input type="checkbox" id="falta_numero_economico" name="descripcion[]" value="D15"/>Falta de Numero Economico</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="puertas_abiertas" name="descripcion[]" value="D16"/>Puertas Abiertas</td>
					
							<td width="1120px"><input type="checkbox" id="placas" name="descripcion[]" value="D17"/>Placas</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="revista" name="descripcion[]" value="D18"/>Falta Revista</td>
						
							<td width="1120px"><input type="checkbox" id="falta_salpicadera" name="descripcion[]" value="D19"/>Por Falta de Salpicadera o en Mal Estado</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="vuelta_prohibida" name="descripcion[]" value="D20"/>Vuelta Prohibida</td>
						
							<td width="1120px"><input type="checkbox" id="circular_zona_prohibida" name="descripcion[]" value="D21"/>Circular en Zona Prohibida</td>
						</tr>
						<!-- <tr>
							<td height="20px"></td>
						</tr> -->
						<!-- <tr>
							<td><p align="left">Otros</p></td>
						</tr>
						<tr>
							<td colspan="3"><input type="text" id="descripcion_g3" name="descripcion_g3" style="width:100%" placeholder="Descripcion"/></td>
						</tr> -->
						
					</table>
					
					
					<table>
					<tbody>
			
					<h3>Motivo de la infraccion grupo 4</h3>
						<!-- <tr >
							<td colspan="2" width="1120px">Motivo de la infraccion grupo 4</td>
						</tr> -->
						<tr>
							<td width="1120px"><input type="checkbox" id="espejo_retroscopico" name="descripcion[]" value="E1"/>Espejo Retroscopico</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="equipo" name="descripcion[]" value="E2"/>Equipo (Por no Llevar Reglamento)</td>
						</tr>
						<tr>
							<td width="1120px"><input type="checkbox" id="reglamento" name="descripcion[]" value="E3"/>Reglamento (No llevarlo Consigo el Conductor)</td>
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
						</tbody>
					</table>

					</div>
		<p>================================================================================================================</p>
					<table>

						<tr>
							<td colspan="2" width="1120px">Traslado de Vehiculo</td>
						</tr>
						<tr id="seleccion_si">
							<td width="1120px"><input type="radio" id="traslado_si" name="traslado_vehiculo" value="si"/>SI</td>
						</tr>
						<tr id= "seleccion_no">
							<td width="1120px"><input type="radio" id="traslado_no" name="traslado_vehiculo" value="no"/>NO</td>
						</tr>
						<TBODY class="ocultos">
						<tr id="traslado_oculto">
						<td>TIPO DE TRASLADO
							<?php
								$con=conexion();
								$res=mysql_query("select * from traslado group by tipo_grua",$con);
							?>
							<select id="cont" name="select_concesionario_tipo" onchange="myFunction(this.value)">
								<option value="">Seleccione</option>
								<?php
									while($fila=mysql_fetch_array($res)){
								?>
								<option value="<?php echo $fila['tipo_grua']; ?>"><?php echo $fila['tipo_grua']; ?></option>
								<?php } ?>
							</select>
						</td>
						</tr>
						<tr id="traslado_oculto">
						<td>
							CONCECIONARIA RESPONSABLE DEL TRASLADO<div id="myDiv"></div>
						</td>
						</tr>
						</TBODY>
					</table>
				<p>================================================================================================================</p>
					<table>
						<tr>
							<td colspan="2" width="1120px">Deposito de Vehiculo</td>
						</tr>
						<tr id="deposito_si">
							<td width="1120px"><input type="radio" id="deposito_si" name="deposito_vehiculo" value="si"/>SI</td>
						</tr>
						<tr id="deposito_no">
							<td width="1120px"><input type="radio" id="deposito_no" name="deposito_vehiculo" value="no"/>NO</td>
						</tr>
						<tbody class='ocultos2'>
						<tr>
						<td>TIPO DE ENCIERRO
							<?php
								$con=conexion();
								$res=mysql_query("select * from encierro group by tipo_encierro",$con);
							?>
							<select id="cont" name="select_tipo_encierro" onchange="myFunction1(this.value)">
								<option value="">Seleccione</option>
								<?php
									while($fila=mysql_fetch_array($res)){
								?>
								<option value="<?php echo $fila['tipo_encierro']; ?>"><?php echo $fila['tipo_encierro']; ?></option>
								<?php } ?>
							</select>
						</td>
						</tr>
						<tr>
						<td>
							NOMBRE DE ENCIERRO<div id="myDiv1"></div>
						</td>
						</tr>
						</tbody>

					</table>
					</div>
				     <div id=".espacio_tablas"></div>
					<div style="width: 330px; margin: 0 auto;">
						<table>
						<tr>
							<td width="1120px"><input type="submit" name="aceptar" id="aceptar" value="Aceptar" class="btn_log"/></td>
						</tr>
					</table>
					</div>
				</form>
			</center>
		</div>
	</body>
</html>
