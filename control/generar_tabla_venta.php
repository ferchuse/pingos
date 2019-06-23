<?php 
include("../conexi.php");
$link = Conectarse();
$tabla_nota  = $_POST["tabla_nota"];
$totales  = $_POST["tabla_totales"];
$index = 0;
$arr_precios = array();

if(isset($_POST["saldo_restante"])){
	$saldo_restante = $_POST["saldo_restante"];
}
else{
	$saldo_restante = $totales["importe_total"];
}


?>
<form id="form_venta_detalle">
<table id="venta_detalle" class="table table-bordered table-condensed table-hover">
	<thead>
		<tr>
			<th>Decripcion </th>
			<th>Sustancia</th>
			<th> Linea</th>
			<th> Unidad </th>
			<th> Cantidad </th>
			<th> Precio </th>
			<th> % Desc </th>
			<th> Desc </th>
			<th> % IVA </th>
			<th> Importe  </th>
			<th> Quitar  </th>
			
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($tabla_nota as $fila){
		if($fila["es_servicio"] != 0){
			$q_doctor = "SELECT * FROM medicos 
				WHERE id_medico = ".$fila['id_medico'] ;
			$result_medico = mysqli_query( $link, $q_doctor );
			if($result_medico ){
				while($fila_med = mysqli_fetch_assoc($result_medico)) {
				
					$nombre_medico = $fila_med["nombre"];
					$tratamiento_medico	= $fila_med["sexo_medico"] == "H" ? "DR. " : "DRA. ";
				}
			}
			?>
			<tr>
					<td colspan="4">
						
						<?php echo $fila['descripcion'].", $tratamiento_medico".$nombre_medico;?>
						
					
					</td>
					<td>
						<input class="cantidad" size="3" type="number" name="cantidad[]" value="<?php echo $fila['cantidad'];?>"></td>
					<td>
						<?php echo  $fila["precio_unitario"];?>
					</td> 
					<td>
						<input class="porc_desc" size="3" type="number" step=".01" name="porc_desc[]" value="<?php echo $fila['porc_desc'];?>">
					</td>
					<td>
						<input class="desc" type="number" step=".01" name="descuento[]" value="<?php echo $fila['desc_articulo'];?>">
					</td>
					<td></td>
					<td class="celda_importe">
						<?php echo $fila["importe_articulo"];?>
					</td>
					<td>
						<button  type="button"  class="btn btn-danger btn-sm borrar_fila" >
							<i class="fa fa-times"></i> 
						</button>
						<input type="hidden" name="descripcion[]" value="<?php echo $fila["descripcion"];?>">
						<input type="hidden" name="id_articulo[]" value="<?php echo $fila['id_articulo'];?>">
						<input type="hidden" name="importe_articulo[]" value="<?php echo $fila["importe_articulo"];?>">
						<input type="hidden" name="Descripcion[]" value="<?php echo $fila["descripcion"];?>">
						<input type="hidden" name="precio_unitario[]" value="<?php echo $fila["precio_unitario"];?>">
						<input type="hidden" name="es_servicio[]" value="1">
						<input type="hidden" name="id_medico[]" value="<?php echo $fila["id_medico"];?>">
						<input type="hidden" name="id_especialidad[]" value="<?php echo $fila["id_especialidad"];?>">
						<input type="hidden" name="fecha_consulta[]" value="<?php echo $fila["fecha_consulta"];?>">
					</td>
					
						<td>
							<button  type="button"  class="btn btn-warning btn-sm editar_fila hide" >
								<i class="fa fa-pencil"></i> 
							</button>
						</td>
					
					
				</tr>
				
			<?php
		}
		else{
			$id_articulo = $fila["id_articulo"];
			$q_articulo = "SELECT * FROM medicamentos 
				LEFT JOIN CatalogoUnidades ON medicamentos.IdUnidad = CatalogoUnidades.IdUnidad 
				LEFT JOIN CatalogoIVA ON medicamentos.IdUnidad = CatalogoUnidades.IdUnidad 
				
				WHERE id_articulo ='$id_articulo'" ;
			
			if( mysqli_query( $link, $q_articulo )){

				
				$result_articulo = mysqli_query(  $link, $q_articulo );
			
				while($row = mysqli_fetch_assoc($result_articulo)) {
				
					extract($row);
				}
				
				if(isset($fila["precio_unitario"])){
					
					$precio_unitario = $fila["precio_unitario"];
				}else{
					
					$precio_unitario = $Pvp;
				} 
				?>
				
				
				<tr>
					<td>
						<?php echo $fila['descripcion'];?>
						<input type="hidden" name="descripcion[]" value="<?php echo $fila["descripcion"];?>">
					</td>
					<td><?php echo $Sustancia;?></td>
					<td><?php echo $Linea;?></td>
					<td><?php echo $Unidad;?></td>
					<td>
						<input class="cantidad" size="3" type="number" name="cantidad[]" value="<?php echo $fila['cantidad'];?>"></td>
					<td><?php echo  $fila["precio_unitario"];?></td> 
					<td>
						<input class="porc_desc" size="3" type="number" step=".01" name="porc_desc[]" value="<?php echo $fila['porc_desc'];?>">
					</td>
					<td><input class="desc" type="number" step=".01" name="descuento[]" value="<?php echo $fila['desc_articulo'];?>"></td>
					<td><?php echo $NombreIva;?></td>
					<td class="celda_importe"><?php echo $fila["importe_articulo"];?></td>
					
					<td>
						<button  type="button"  class="btn btn-danger btn-sm borrar_fila" >
							<i class="fa fa-times"></i> 
						</button>
						<input type="hidden" name="id_articulo[]" value="<?php echo $fila['id_articulo'];?>">
						
						
						<input type="hidden" name="importe_articulo[]" value="<?php echo $fila["importe_articulo"];?>">
						<input type="hidden" name="Descripcion[]" value="<?php echo $Descripcion;?>">
						<input type="hidden" name="precio_unitario[]" value="<?php echo $Pvp;?>">
						<input type="hidden" name="es_servicio[]" value="0">
					</td>
					<?php 
					if($Linea == "Servicios"){?>
						<td>
							<button  type="button"  class="btn btn-warning btn-sm editar_fila" >
								<i class="fa fa-pencil"></i> 
							</button>
						</td>
					<?php 
					}
					?>
					
				</tr>
					<?php
					
			
				} 
			else{
				die("Error al ejecutar consulta: $q_articulo".mysqli_error( $link));
			}
		}
		$index++;
		$arr_precios[] = $fila["precio_unitario"];
					
		
	}
	?>
	
	</tbody>
</table>

	<div class=" col-sm-4">
		<div class="row">
			<div class="col-sm-6"> 
				<label>ARTICULOS:  </label>  
			</div>
			<div class="col-sm-6" id="celda_articulos" > 
			<?php echo $index;?> 
			</div>
			<input type="hidden" name="total_articulos" id="total_articulos" value="<?php echo $index;?>" />

		</div>
		
		<div class="row">
			<div class="col-sm-8"> 
				<h1>POR PAGAR:  </h1>  
			</div>
			<div class="col-sm-4" > 
				<h1 id="por_pagar"> <?php echo "$".number_format($restante,2);?> </h1> 
			</div>
		</div>
	</div>
	<div class="pull-right col-sm-4 col-offset-4">
		<div class="row">
			<div class ="col-sm-6">
				<label>SUBTOTAL:  </label> 
			</div>
			<div class ="col-sm-6 text-right" id="celda_subtotal">
				<?php echo  number_format($totales["subtotal"],2);?> 
				
			</div>
			<input type="hidden" name="subtotal" id="subtotal" value="<?php echo $totales['subtotal'];?>">
		</div>
		<div class="row">
			<div class ="col-sm-6">
				<label>% DESCUENTO:  </label>  
			</div>
			<div class ="col-sm-6 text-right">
				<?php echo  number_format($totales["porc_desc"],2);?> 
			
			</div>
				<input type="hidden" name="total_desc" id="total_desc" value="<?php echo $totales['porc_desc'];?>">
		</div>
		<div class="row">
			<div class ="col-sm-6">
				<label>IVA:  </label>  
			</div>
			<div class ="col-sm-6 text-right">
				<?php echo  number_format($totales["total_iva"],2);?> 
				
			</div>
			<input type="hidden" name="total_iva" id="total_iva" value="<?php echo $totales['total_iva'];?>">
		</div>
		
		<div class="row">
			<div class ="col-sm-6">
				<label>TOTAL:  </label>   
			</div>
			<div class ="col-sm-6 text-right" id="celda_total" >
				<?php echo  number_format($totales["importe_total"],2);?> 
			</div>
			<input type="hidden" name="importe_total" id="total" value="<?php echo  number_format(array_sum($arr_precios),2);?> ">
		</div>
	</div> 
</form> 
	