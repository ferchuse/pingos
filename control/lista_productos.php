<?php 
include('../conexi.php');
$link = Conectarse();
?>
<table class="table table-hover" id="tabla_productos">
	<thead class="bg-primary">
		<tr>
			<th class="text-center">Descripcion</th>
			<th class="text-center">Departamento</th>
			<th class="text-center">Costo de Compra</th>
			<th class="text-center">Ganancia</th>
			<th class="text-center">Precio Venta</th>
			<th class="text-center">Precio Mayoreo</th>
			<th class="text-center">Mínimo</th>
			<th class="text-center">Existencia</th>
			<th class="text-center">Acciones</th>
		</tr>  
		<tr>
			<th class="text-center"><input type="text" class="form-control buscar_descripcion" data-indice="0" placeholder="Buscar descripcion"></th>
			<th class="text-center"></th>
			<th class="text-center"></th>
			<th class="text-center"></th>
			<th class="text-center"></th>
			<th class="text-center"></th>
			<th class="text-center"></th>
			<th class="text-center"></th>
			<th class="text-center"></th>
		</tr>
	</thead>
	<tbody>
	<?php
		$consulta = "SELECT * FROM productos LEFT JOIN departamentos USING (id_departamentos) WHERE 1";
		
		if($_GET["id_departamentos"] != ''){
			
			$consulta.= " AND  id_departamentos = '{$_GET["id_departamentos"]}'";
		}
		if($_GET["existencia"] != ''){
			
			$consulta.= " AND existencia_productos < min_productos";
		}
		
		$result = mysqli_query($link,$consulta);
		if(!$result){
				die("Error en $consulta" . mysqli_error($link) );
		}else{
			$num_rows = mysqli_num_rows($result);
			if($num_rows != 0){
				while($row = mysqli_fetch_assoc($result)){
					extract($row);
					
		?>
			<tr <?php if($existencia_productos < $min_productos){ echo "class='bg-danger'" ; }?>>
				<td class="text-center"><?php echo $descripcion_productos; ?></td>
				<td class="text-center"><?php echo $nombre_departamentos; ?></td>
				<td class="text-center"><?php echo '$'.$costo_proveedor; ?></td>
				<td class="text-center"><?php echo number_format($ganancia_menudeo_porc, 0)."%"; ?></td>
				<td class="text-center"><?php echo '$'.$precio_menudeo; ?></td>
				<td class="text-center"><?php echo '$'.$precio_mayoreo;?></td>
				<td class="text-center"><?php echo $min_productos; ?></td>
				<td class="text-center"><?php echo "$existencia_productos-$unidad_productos(S)"; ?></td>
				<td class="text-center">
					<button class="btn btn-warning btn_editar" data-id_producto="<?php echo $id_productos;?>">
						<i class="fa fa-edit"></i>
					</button>
					<button class="btn btn-danger btn_eliminar" data-id_producto="<?php echo $id_productos;?>">
						<i class="fa fa-trash"></i>
					</button>
					<button class="btn btn-success btn_existencia" data-id_productos="<?php echo $id_productos;?>">
						<i class="fa fa-cart-plus"></i>
					</button>
				</td>
			</tr>
		<?php
				}
			}else{
		?>
		<tr>
				<td class="text-center" colspan="7">
					<h2 class="text-center">No hay articulos en existencia.</h2>
				</td>
			</tr>
		<?php
			}
		}
		?>
	</tbody>
</table>