<html>
	<head>
		<script type="text/javascript" src="js/jquery-latest.js"></script>
		<script type="text/javascript" src="js/jquery.jCombo.min.js"></script>
	</head>
	<body>

		<select id="municipio1"></select>
		<br />
		<select id="localidad1"></select>

<script type="text/javascript">
$(window).load(function() {
			$("#municipio1").jCombo({
				url: "municipios.php", 
				initial_text: "-- Seleccione --",
				onLoad: function() { 
					$("#localidad1").jCombo({ 
						url: "localidades.php", 
						input_param: "id",
						initial_text: "-- Seleccione --",
						parent: "#municipio1"
					});			
				}
			});
	});	

</script>

	</body>
</html>
