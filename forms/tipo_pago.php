<form id="form_tipo_pago" class="form">
	<div id="modal_tipo_pago" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Tipo de pago</h4>	
				</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12" id="modalPago">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#efectivo" data-forma_pago="efectivo">Efectivo</a></li>
							<li><a data-toggle="tab" href="#tarjeta" data-forma_pago="tarjeta">Tarjeta</a></li>
							<li class="hidden"><a data-toggle="tab" href="#vale" data-forma_pago="vale">Vale</a></li>
							<li class="hidden"><a data-toggle="tab" href="#mixto" data-forma_pago="mixto">Mixto</a></li>
						</ul>
						<br/>
						<div class="tab-content">
							<div id="efectivo" class="tab-pane fade in active">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label  for="efectivo_ventas" class="text-center">Efectivo:</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-usd"></i></span>
												<input required type="number" min="0" class="form-control" name="efectivo_ventas" id="efectivos" placeholder="Coloca la cantidad a pagar">
											</div>
											<input type="text" class="form-control hidden" name="id_ventas" id="id_ventas" >
										</div>
										<div class="form-group">
											<label  for="total_ventas" class="text-center">A Pagar:</label>
											<div class="input-group">
												<span class="input-group-addon" ><i class="fa fa-usd"></i></span>
												<input disabled type="number" min="0" class="form-control" name="total_ventas" id="total_ventas">
											</div>
										</div>
										<div class="form-group">
											<label  for="total_pagar" class="text-center">Cambio:</label>
											<div class="input-group">
												<span class="input-group-addon" ><i class="fa fa-usd"></i></span>
												<input disabled type="number" min="0" class="form-control" name="total_pagar" id="total_pagar">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div id="tarjeta" class="tab-pane fade">
							  <h3>Tarjeta</h3><span id="no_tarjeta"></span>
							  <input required  type="text" class="form-control" name="tarjeta_ventas" id="tarjetas" placeholder="Ingresa los ultimos 4 digitos de la tarjeta Ej.(1234)">
							  <br>
							  <input type="text" class="form-control hidden" name="pago_tarjeta" id="venta_tarjetaT" value="<?php echo $total_ventas;?>">
							  <div class="col-md-4 ">
								<div class="form-group">
									<label for="" class="text-center">Comisión del %5</label>
									<input disabled type="text" class="form-control" name="" id="" value="22">
								</div>
								<div class="form-group">
									<?php $comicionT = $total_ventas * 1.05; ?>
									<label for="" class="text-center">Total a pagar</label>
									<input disabled type="text" class="form-control" name="" id="" value="<?php echo $comicionT;?>">
								</div>
							  </div>
							</div>
							<div id="vale" class="tab-pane fade">
							  <h3>Vale</h3>
							  <input required type="text" class="form-control" name="vale_ventas" id="vale">
							</div>
							<div id="mixto" class="tab-pane fade">
							  <h4 class="text-center">Mixto</h4>
							  <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label  for="efectivo_ventas" class="text-center">Efectivo:</label>
										<input required type="number" min="0" class="form-control" name="efectivo_ventas" id="efectivo_mixto">
									</div>
									<div class="form-group">
										<label  for="efectivo_ventas" class="text-center">Tarjeta:</label><span id="no_tar"></span>
										<div class="input-group">
											<input required type="number" min="0" class="form-control" name="tarjeta_ventas" id="tarjeta_mixto">
											<span class="input-group-addon"><i class="fa fa-credit-card-alt"></i></span>
											<input required type="number" min="0" class="form-control" name="pago_tarjeta" id="numero_mixto">
										</div>
									</div>
									<div class="form-group">
										<label  for="efectivo_ventas" class="text-center">Vale:</label>
										<input required type="number" min="0" class="form-control" name="vale_ventas" id="vale_mixto">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="sub_mixto" class="text-center"> Total:</label>
										<div class="input-group">
											<input disabled type="number" min="0" class="form-control" name="total_mixto" id="total_mixto" value="<?php echo $total_ventas;?>">
											<span class="input-group-addon"><i class="fa fa-usd"></i></span>
											<input disabled type="number" class="form-control" name="sub_mixto" id="sub_mixto" >
										</div>
									</div>
								</div>
							  </div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						<i class="fa fa-times"></i> 
						Cerrar
					</button>
						<button type="button" class="btn btn-success btn_guardarModal">
							<i class="fa fa-save"></i> 
							Guardar
						</button>
				</div>
			</div>
		</div>
	</div>
</form>