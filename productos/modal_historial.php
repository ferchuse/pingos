<?php
	
	include('../conexi.php');
	$link = Conectarse();
	
	
	$consulta_movimientos = "SELECT
	id_productos,
	codigo_productos,
	descripcion_productos,
	nombre_departamentos,
	COALESCE (entradas, 0) AS entradas,
	COALESCE (salidas, 0) AS salidas
	FROM
	productos
	LEFT JOIN departamentos USING(id_departamentos)
	LEFT JOIN (
	SELECT
	id_productos,
	SUM(cantidad) AS entradas
	FROM
	almacen_movimientos 
	
	WHERE fecha_movimiento BETWEEN DATE_ADD(CURDATE(), INTERVAL -30 DAY) 
	AND  CURDATE()
	AND tipo_movimiento = 'ENTRADA'
	GROUP BY id_productos
	) AS t_entradas USING (id_productos)
	LEFT JOIN (
	SELECT
	id_productos,
	SUM(cantidad) AS salidas
	FROM
	almacen_movimientos
	
	WHERE fecha_movimiento BETWEEN DATE_ADD(CURDATE(), INTERVAL -30 DAY) 
	AND  CURDATE()
	AND tipo_movimiento = 'SALIDA'
	GROUP BY id_productos
	) AS t_salidas USING (id_productos)
	WHERE 1";
	
	// if($_POST['id_departamentos'] != ''){
		// $consulta_movimientos .= "
		// AND
		// id_departamentos = '{$_POST['id_departamentos']}'";
	// }
	if($_GET['id_productos'] != ''){
		$consulta_movimientos .= "
		AND
		id_productos ='{$_GET['id_productos']}'";
	}
	
	// $consulta_movimientos .= " ORDER BY
	// {$_POST['sort']} DESC";
	
	
	$result_movimientos = mysqli_query($link,$consulta_movimientos) or die ("<pre>Error en $consulta_movimientos". mysqli_error($link). "</pre>");
	
	while($fila = mysqli_fetch_assoc($result_movimientos)){
		
		$lista_movimientos = $fila;
		
	}
	
	
?>

<form class="was-validated " id="form_arqueo">
	<!-- The Modal -->
	<div id="modal_historial" class="modal fade" >
		<div class="modal-dialog ">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Historial de Movimientos</h4>
				</div>
				
				<div class="modal-body">
					
					<legend>
						Movimientos de los ultimos 30 dias
						<?= $lista_movimientos["descripcion_productos"]?>
					</legend>
					
				
					<table class="table table-bordered ">
						<thead>
							<tr>
								<th>Entradas</th>
								<th>Salidas</th>
								
							</tr>
							
						</thead>
						<tbody>
							
							<tr>
								<td><?= $lista_movimientos["entradas"]?></td>
								<td><?= $lista_movimientos["salidas"]?></td>
							
								<td></td>
							</tr>
							
							
						</tbody>
					</table>
					
					
					
					
				</div>
				
				<!-- Modal footer -->
				<div class="modal-footer hidden-print">
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						<i class="fa fa-times"></i> Cancelar
					</button>
					<button type="submit" class="btn btn-info">
						<i class="fa fa-print"></i> Imprimir
					</button>
				</div>
			</div>
		</div>
	</div>
</form>								