<form id="form_productos" autocomplete="off" class="is-validated">
	<div id="modal_productos" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title text-center"></h3>
				</div>
				<div class="modal-body">
					<input class="hidden" type="text" id="id_productos" name="id_productos">
					<div class="row">
						
						<div class="col-md-6">
							<div class="form-group">
								<label for="codigo_productos">Codigo de Barras:</label>
								<input  type="text" class="form-control" name="codigo_productos" id="codigo_productos" placeholder="Opcional">
							</div>
							<div class="form-group">
								<label for="">Descripción:</label>
								<input placeholder="Nombre del producto" required class="form-control" type="text" name="descripcion_productos" id="descripcion_productos">
							</div>
							<div class="form-group">
								<label required for="unidad_productos">Unidad de Medida:</label>
								<select  class="form-control" id="unidad_productos" name="unidad_productos">
									<option value="">Elije...</option>
									<option value="PZA">Pieza</option>
									<option value="KG">A Granel</option>
								</select>
							</div>
							<div class="form-group">
								<label required for="id_departamentos">Departamento:</label>
								<?php echo generar_select($link, "departamentos", "id_departamentos", "nombre_departamentos")?>
							</div>
						</div>
						
						
						<div class="col-md-6">
							<div class="form-group">
								<label for="costo_proveedor">Costo de compra:</label>
								<input placeholder="" required type="number" min="0" step=".01" class="form-control" id="costo_proveedor" name="costo_proveedor">
								
							</div>
							<div class="form-group ">
								<label for="">Porcentaje de Ganancia :</label>
								
								<input  required type="number" value="25" step=".01" class="form-control" id="ganancia_menudeo_porc" name="ganancia_menudeo_porc">
								
							</div>
							<div class="form-group ">
								<label >Precio de Venta:</label>
								
								<input placeholder="PRECIO" type="number" min="0"  step=".01" class="form-control" id="precio_menudeo" name="precio_menudeo">
								
							</div>
							<div class="form-group ">
								<label for="precio_mayoreo">Precio Mayoreo:</label>
								
								<input placeholder="" type="number" min="0.1"  step=".01" class="form-control" id="precio_mayoreo" name="precio_mayoreo">
							</div>  
							<div class="form-group ">
								<label for="existencia_productos">Existencia:</label>
								<input placeholder="Cantidad de productos en existencia" type="number" min="0" step="any" class="form-control" id="existencia_productos" name="existencia_productos">
							</div>
							<div class="form-group ">
								<label for="min_productos">Minimo:</label>
								<input placeholder="" type="number" min="0" class="form-control" id="min_productos" name="min_productos">
							</div>
							
							
						</div>
					</div>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					<div class="row hidden">
						<input placeholder="" readonly  type="number" min="0" step=".01" class="form-control" id="costo_unitario" name="costo_unitario">
						
						<h4 class="text-center">DATOS DE COMPRA CON PROVEEDOR</h4>
						<div class="col-sm-6">	
							<div class="form-group">
								<label for="">COSTO DE COMPRA POR CAJA o BULTO:</label>
								
							</div>
							
							<input readonly placeholder="Ganancia en Pesos" required type="text" step="any" class="form-control" id="ganancia_menudeo_pesos" name="ganancia_menudeo_pesos">
							
							<input placeholder=""  type="hidden" value="9" step=".01" class="form-control" id="ganancia_mayoreo_porc" name="ganancia_mayoreo_porc">
							
						</div>
					</div>
					<div class="col-sm-6 hidden">
						<div class="form-group">
							<label for="cantidad_contenedora">PIEZAS/KG POR CAJA O BULTO:</label>
							<input placeholder="¿Cuántas Piezas o KG contiene la Caja o Bulto?"  type="number" min="0" step=".01" class="form-control" id="cantidad_contenedora" name="cantidad_contenedora">
						</div>
					</div>
					
					<div class="row hidden">
						<div class="col-md-6 hidden">
							<div class="form-group">
								<label for="unidad_contenedora">SE COMPRA POR:</label>
								<select  class="form-control" id="unidad_contenedora" name="unidad_contenedora">
									<option value="">Elije...</option>
									<option value="CAJA">CAJA</option>
									<option value="BULTO">BULTO O COSTAL</option>
									<option value="PIEZA">PIEZA</option>
									<option value="KG">GRANEL</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							
						</div>
					</div>
					<div class="row hidden">
						<div class="col-md-6">
							<div class="form-group">
								<label>COSTO DE COMPRA POR PIEZA o KG:</label>
								<div class="input-group">
									<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-usd"></i></span>
									<input placeholder="" readonly  type="number" min="0" step=".01" class="form-control" id="costo_unitario" name="costo_unitario">
								</div>
							</div>
						</div>
					</div>
					
					<div class="row hidden">
						<h4 class="text-center">PRECIOS</h4>
						<div class="form-group">
							<label for="">COSTO DE COMPRA POR CAJA o BULTO:</label>
							
							
						</div>
						
						<div class="form-group col-sm-4">
							<label for="">GANANCIA MAYOREO:</label>
							<div class="input-group" >
								<span class="input-group-addon" ><i class="fa fa-usd"></i></span>
								<input readonly placeholder="Ganancia en Pesos"  type="text" step=".01" class="form-control" id="ganancia_mayoreo_pesos" name="ganancia_mayoreo_pesos">
							</div>
						</div>
						
					</div>	
					<div class="row hidden">
						
						<div class="form-group col-sm-4">
							<label >GANANCIA MENUDEO:</label>
							<div class="input-group" >
								<span class="input-group-addon" ><i class="fa fa-usd"></i></span>
								<input readonly placeholder="Ganancia en Pesos"  type="text" step="any" class="form-control" id="ganancia_menudeo_pesos" name="ganancia_menudeo_pesos">
							</div>
						</div>
						
					</div>	
					
					
					<div class="row hidden">
						<h4 class="text-center">INVENTARIO</h4>
						
						<div class="form-group col-sm-6">
							<label for="existentes_contenedores">EXISTENCIA EN CAJAS/BULTOS:</label>
							<input placeholder="CANTIDAD DE CAJAS/BULTOS" type="number" min="0" step="any" class="form-control" id="existentes_contenedores" name=	"existentes_contenedores">
						</div>
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
					<button type="submit" class="btn btn-success" id="btn_formAlta">
						<i class="fa fa-save"></i> Guardar
					</button>
				</div>
			</div>
		</div>
	</div>
</form>