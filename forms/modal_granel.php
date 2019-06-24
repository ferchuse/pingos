<form id="form_granel" autocomplete="off">
	<div id="modal_granel" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Venta a Granel</h4>
				</div>
				<div class="modal-body">
					
					<div class="form-group hidden">
						<label for="">100 gramos:</label> $<span id="ciengramos"></span><br>
						<label for="">1/4 Kilo:</label> $<span id="cuartogramos"></span><br>
						<label for="">1/2 Kilo:</label> $<span id="mediogramos"></span>
					</div>
					<div class="form-group col-sm-12">
						<label for="precio">1 Kg:</label>
						<input class="form-control" name="precio" id="precio">
					</div>
					<div class="form-group col-sm-6">
						<label for="unidad_granel">Peso:</label>
						<input  type="number" value="1"  step="0.001" class="form-control" name="cantidad" id="cantidad">
					</div>
					<div class="form-group col-sm-6">
						<label for="costo_granel">Importe:</label>
						<input  type="number" step=".01" class="form-control" name="importe" id="importe">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
					<button type="submit" class="btn btn-success" id="agregar_granel"><i class="fa fa-check"></i> Aceptar</button>
				</div>
			</div>
			
		</div>
	</div>
</form>