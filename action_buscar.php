<?php
if (isset($_POST['tipoConsulta'])){


$tipoConsulta=$_POST['tipoConsulta'];
//echo($tipoConsulta);
}
	if (isset($_POST['buscar']))
	{
		$buscar=$_POST['buscar'];

		if ($tipoConsulta == "placa" ) {
			$sql1="SELECT * FROM vehiculo v join infraccion i on v.numero_placa = i.vehiculo where numero_placa='$buscar'";
//			echo($result1);
/*
			while ($row = mysql_fetch_array($result1))
			{
				echo "<div class='CSSTableGenerator'>\n";
				echo "<table> \n"; 
				echo "<tr><td>Folio</td><td>Motor</td><td>serie</td><td>placa</td></tr> \n"; 
				do { ?>
					<div class="espacio"></div>
					<tr>
						<td align="middle" id="redireccion"><a href="consulta.php?id=<?php echo $buscar; ?>&tipoConsulta=<?php echo $tipoConsulta; ?>"><?php echo $row['id_infraccion']; ?></a></td>
						<td><?php echo $row['numero_motor']; ?></td>
						<td><?php echo $row['numero_serie']; ?></td>
						<td><?php echo $row['numero_placa']; ?></td>
					</tr>
				<?php } while ($row = mysql_fetch_array($result1)); 
				echo "</table> </div>\n";
			} 
			else { 
				echo "¡ No se ha encontrado ningún registro !"; 
			}*/
		}
		if ($tipoConsulta == "idInfraccion") {
			$sql1="select * from infraccion i join vehiculo v  on i.vehiculo=v.numero_placa join ubicacion u on i.id_lugar=u.id_lugar join infractor inf on i.id_infractor=inf.id_infractor join licencia l on inf.licencia=l.numero_licencia where i.id_infraccion='$buscar'";
/*			if ($row = mysql_fetch_array($result2))
			{
				echo "<div class='CSSTableGenerator'>\n";
				echo "<table> \n"; 
				echo "<tr><td>Infraccion</td><td>Motor</td><td>serie</td><td>placa</td></tr> \n"; 
					do { ?>
						<div class="espacio"></div>
						<tr>
							<td align="middle" id="redireccion"><a href="consulta.php?id=<?php echo $buscar; ?>&tipoConsulta=<?php echo $tipoConsulta; ?>"><?php echo $row['id_infraccion']; ?></a></td>
							<td><?php echo $row['numero_motor']; ?></td>
							<td><?php echo $row['numero_serie']; ?></td>
							<td><?php echo $row['numero_placa']; ?></td>
						</tr>
				<?php } while ($row = mysql_fetch_array($result2)); 
				echo "</table> </div>\n";
			}
			else { 
				echo "¡ No se ha encontrado ningún registro !"; 
			}*/
		}
		if ($tipoConsulta == "numLicencia") {
			# code...
			$sql1="select * from infraccion i join vehiculo v  on i.vehiculo=v.numero_placa join ubicacion u on i.id_lugar=u.id_lugar join infractor inf on i.id_infractor=inf.id_infractor join licencia l on inf.licencia=l.numero_licencia where l.numero_licencia='$buscar'";
/*			if ($row = mysql_fetch_array($result3))
			{
				echo "<div class='CSSTableGenerator'>\n";
				echo "<table> \n"; 
				echo "<tr><td>Licencia</td><td>Motor</td><td>serie</td><td>placa</td></tr> \n"; 
					do { ?>
						<div class="espacio"></div>
						<tr>
							<td align="middle" id="redireccion"><a href="consulta.php?id=<?php echo $buscar; ?>&tipoConsulta=<?php echo $tipoConsulta; ?>"><?php echo $row['numero_licencia']; ?></a></td>
							<td><?php echo $row['numero_motor']; ?></td>
							<td><?php echo $row['numero_serie']; ?></td>
							<td><?php echo $row['numero_placa']; ?></td>
						</tr>
				<?php } while ($row = mysql_fetch_array($result3)); 
				echo "</table> </div>\n";
			}
			else { 
				echo "¡ No se ha encontrado ningún registro !"; 
			}*/
		}
			
		$result1=mysql_query($sql1);
		while ($row = mysql_fetch_array($result1))
		{
			echo "<div class='CSSTableGenerator'>\n";
			echo "<table> \n"; 
			echo "<tr><td>Folio</td><td>Motor</td><td>serie</td><td>placa</td></tr> \n"; 
			do { ?>
				<div class="espacio"></div>
				<tr>
					<td align="middle" id="redireccion"><a href="consulta.php?id=<?php echo $row['id_infraccion']; ?>&tipoConsulta=idInfraccion"><?php echo $row['id_infraccion']; ?></a></td>
					<td><?php echo $row['numero_motor']; ?></td>
					<td><?php echo $row['numero_serie']; ?></td>
					<td><?php echo $row['numero_placa']; ?></td>
				</tr>
			<?php } while ($row = mysql_fetch_array($result1)); 
			echo "</table> </div>\n";
		} 

		
		//$sql_numero_licencia="SELECT * FROM transito_infracciones.licencia where numero_licencia='$buscar'";
		
		
		 
		
	}

?>