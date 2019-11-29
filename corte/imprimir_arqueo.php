<?php 
	include('../conexi.php');
	$link = Conectarse();
	$filas = array();
	$respuesta = array();
	
	
	$denominaciones = ["1000", "500", "200", "100", "50", "20", "10", "5", "2", "1", "0.5", "0.2", "0.1"];
	$consulta = "SELECT * FROM arqueo 
	
	LEFT JOIN usuarios USING(id_usuarios)
	WHERE id_arqueo= '{$_GET['id_registro']}'";
  
	
	$result = mysqli_query($link,$consulta);
	if($result){
		
		if( mysqli_num_rows($result) == 0){
			
			die("<div class='alert alert-danger'>Registro No encontrado</div>");
			
			
		}
		
		while($fila = mysqli_fetch_assoc($result)){
			
			$filas = $fila ;
			
		}
		
	?> 
	<div >
		<legend>Arqueo</legend> 
		<div class="row mb-2">
			<div class="col-xs-4">
				<b >Fecha:</b>
			</div>	 
			<div class="col-xs-8">			
				<?php echo date("d/m/Y", strtotime($filas["fecha_arqueo"]));?>
			</div>
		</div>
		<div class="row mb-2">
			<div class="col-xs-4">
				<b >Hora:</b>
			</div>	 
			<div class="col-xs-8">			
				<?php echo $filas["hora_arqueo"];?>
			</div>
		</div>
		<div class="row mb-2">
			<div class="col-xs-4">
				<b >Usuario:</b>
			</div>	 
			<div class="col-xs-8">			
				<?php echo $filas["nombre_usuarios"]?>
			</div>
		</div>
			<div class="row mb-2">
				<div class="col-xs-4">
					<b >Denom.</b> 
				</div>	 
				<div class="col-xs-3">			
					<b >Cantidad</b> 
				</div>
				<div class="col-xs-4">			
					<b >Importe</b> 
				</div>
			</div>
		<?php foreach($denominaciones as $i => $denominacion){?>
			<div class="row mb-2">
				<div class="col-xs-4">
					<b >$<?php echo $denominacion;?>:</b> 
				</div>	 
				<div class="col-xs-3 text-right">			
					<?php echo number_format($filas[$denominacion]);?>
				</div>
				<div class="col-xs-4 text-right">			
					<?php echo number_format($filas[$denominacion] * $denominacion);?>
				</div>
			</div>
			<?php
			}
		?>
		
			<hr>
			<div class="row mb-2">
				<div class="col-xs-6">
					<b >IMPORTE TOTAL:</b> 
				</div>	 
				<div class="col-xs-5 text-right">			
					$<?php echo number_format($filas["importe"])?>
				</div>
			</div>
		</div>
		<br>
		<hr>
		<div style="page-break-after:always;"></div>
		
		
		<?php
			
			
		}
		else {
			echo "Error en ".$consulta.mysqli_Error($link);
			
		}
		
		
	?>	