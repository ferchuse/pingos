<?php
	include('../conexi.php');
	$link = Conectarse();
	
	$productos = $_POST['productos'];
	$subtotal = $_POST['subtotal'];
	
?>
<table class="table table-hover table-bordered table-condensed">
	<thead class="bg-success">
		<tr>
			<th class="text-center">Cantidad</th>
			<th class="text-center">Descripcion del Producto</th>
			<th class="text-center">Precio Unitario</th>
			<th class="text-center">Unidad</th>
			<th class="text-center">Importe</th>
			<th class="text-center">Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach($productos as $fila){
			?>
			<tr>
				<td class="text-center">
					<input class="cantidad form-control col-xs-3" value="<?php echo $fila['cantidad'];?>">
				</td>
				<td class="text-center"><?php echo $fila['descripcion_productos'];?></td>
				<td class="text-center"><?php echo $fila['precio'];?></td>
				<td class="text-center"><?php echo $fila['unidad_productos'];?></td>
				<td class="text-center"><?php echo $fila['importe'];?></td>
				<td class="text-center">
					<button title="Eliminar Producto" class="btn btn-danger btn_eliminar">
						<i class="fa fa-trash"></i>
					</button>
				</td>
			</tr>
			<?php 
			}
		?>
	</tbody>
</table>