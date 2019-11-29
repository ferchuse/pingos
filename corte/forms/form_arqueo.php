<form class="was-validated " id="form_arqueo">

	<div id="modal_arqueo" class="modal fade hidden-print" >
		<div class="modal-dialog ">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Nuevo Arqueo</h4>
				</div>
				
				<div class="modal-body">
					
					<table class="table table-bordered ">
						<thead>
							<tr>
								<th>Denominación</th>
								<th>Cantidad</th>
								<th>Importe</th>
							</tr>
							
						</thead>
						<tbody>
							<?php
								$denominaciones =  [1000,500,200,100,50,20,10,5,2,1,.5,.2,.1];
								
								foreach($denominaciones AS $i => $denominacion){ ?>
								
								<tr>
									<td><b>$<?php echo $denominacion?></b></td>
									<td>
										<input type="number"  class="form-control cantidad" min="0" name="<?php echo $denominacion?>" data-denomi="<?php echo $denominacion?>" value="0">
									</td>
									
									<td>	
										<input tabindex="-1" type="number" min="0" class="form-control importe" value="0" readOnly>
									</td>
								</tr>
								
								<?php
								}
							?>
						</tbody>
					</table>
					
					
					
					
					<div class="form-group ">
						<label for="">Total</label>
						<input type="number" name="importe" tabindex="-1" min="0" class="form-control" id="importe_total"  value="0" readOnly>
					</div>
					
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