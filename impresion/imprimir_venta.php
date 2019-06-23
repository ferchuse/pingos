<?php
	
	include('../conexi.php');
	include('../funciones/numero_a_letras.php');
	
	$link = Conectarse();
	$consulta = "SELECT * FROM ventas
	LEFT JOIN ventas_detalle USING (id_ventas)
	LEFT JOIN usuarios USING (id_usuarios)
	WHERE id_ventas={$_GET["id_ventas"]}";
	
	$result = mysqli_query($link, $consulta);
	
	while ($fila = mysqli_fetch_assoc($result)) {
    $fila_venta[] = $fila;
	}
	
?>


<!-- Ticket -->
<section style="margin-top: 25px; margin-bottom: 3px;" class="container ticket">
	
	<!-- Encabezado Ticket-->
	<section>
		
		<!-- Datos Empresa -->
		<div class="row">
			<p class="font-14-5 col-xs-12 text-center"><strong>DULCERÍA PINGOS</strong></p>
		</div>
		
		<!-- Datos Venta -->
		<div class=" font-12-5 row justify-content-start">
			<div class="pad-10 mar-0 col-xs-12">
				<div style="margin: 0px;" class="mar-0 row justify-content-between">
					<span class="font col-xs-5"><strong>Folio:</strong></span>
					<div class="col-xs-6 " class=""><?php echo $fila_venta[0]["id_ventas"] ?></div>
				</div>
				<div style="margin: 0px;" class="mar-0 row justify-content-between">
					<span class="col-xs-5"><strong>Fecha:</strong></span>
					<div class="col-xs-7 " class="" id="fecha" name="fecha">
						<?php echo date("d/m/Y", strtotime($fila_venta[0]["fecha_ventas"])); ?>
					</div>
				</div>
				<div style="margin: 0px;" class="mar-0 row justify-content-between">
					<span class=" col-xs-5"><strong>Hora:</strong></span>
					<div class="col-xs-7 " id="hora" name="hora">
						<?php echo date("H:i", strtotime($fila_venta[0]["hora_ventas"])); ?>
					</div>
				</div>
				<div style="margin: 0px;" class="mar-0 row justify-content-between">
					<span class="col-xs-5"><strong>Usuario:</strong></span>
					<div class="col-xs-7 " id="usuario" name="usuario">
						<?php echo $fila_venta[0]["nombre_usuarios"]; ?>
					</div>
				</div>
				<div hidden class="mar-0 row justify-content-between">
					<span class=" col-xs-5">Cliente:</span>
					<div class="col-xs-7 " class="">
						<?php echo $fila_venta[0]["nombre_cliente"] ?>
					</div>
				</div>
			</div>
		</div>
		
	</section>
	
	<!-- Cuerpo Ticket -->
	<table style="border:none; margin-top: 10px;" class="font-12-5 table">
		
		<!-- Encabezados -->
		<thead style="margin-top: 0px; padding:0px;">
			<tr style="border:none; margin: 0px; padding:0px;" class=" ">
				<td style="border:none; " class="text-center "></td>
				<td style="border:none; margin: 0px; padding:0px;" class="text-left  " colspan="3">DESCRIPCIÓN DEL PRODUCTO</td>
			</tr>
			<tr style="margin: 0px; padding:0px;" class="font-13 b-bot-1">
				<td style="border:none;" class="text-center  c-wid-50"><strong>Cant.</strong></td>
				<td style="border:none;" class="text-center c-wid-5"></td>
				<td style="border:none;" class="text-left "><strong>Precio Unitario</strong></td>
				<td style="border:none;" class="text-right "><strong>Importe</strong></td>
			</tr>
		</thead>
		
		<!-- Productos -->
		<tbody style="border:none; line-height: 12px; padding:0px" class=" ">
			<?php foreach ($fila_venta as $i => $producto) { ?>
				
				<tr style="margin: 0px; padding:0px;" class="">
					<td style="border:none; line-height: 12px; margin: 0px; padding:0px;" class="text-center"><?php echo $producto["cantidad"]; ?></td>
					<td style="border:none; line-height: 12px; margin: 0px; padding:0px;" class="" colspan="2"><?php echo $producto["descripcion"]; ?></td>
					<td style="border:none; line-height: 12px;"></td>
					<td style="border:none; line-height: 12px;"></td>
				</tr>
				<tr style="margin: 0px; padding:0px;" class="">
					<td style="border:none; line-height: 12px;"></td>
					<td style="border:none; line-height: 12px;"></td>
					<td style="border:none; line-height: 12px;"><?php echo "$" . $producto["precio"]; ?></td>
					<td style="border:none; line-height: 12px;" class="text-right"><?php echo "$" . $producto["importe"]; ?></td>
				</tr>
				
			<?php } ?>
		</tbody>
		
		<!-- Total -->
		<tfoot class="font-13" style="margin-bottom: 3px;">
			<tr>
				<td class=" text-right" colspan="3"><strong>TOTAL:</strong></td>
				<td class=" text-right"><?php echo "$" . $producto["total_ventas"] ?></td>
			</tr>
		</tfoot>
		
	</table>
	
	<!-- Pie Ticket -->
	<section style="margin-top: 3px;">
		<p class="font-12-5 text-center">
			<?php echo NumeroALetras::convertir($producto["total_ventas"], "pesos", "centavos") ?>
		</p>
		<p class="font-14 text-center"><strong>GRACIAS POR SU COMPRA</strong></p>
	</section>
	
</section>