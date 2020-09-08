
var producto_elegido ;

function beforePrint() {
	//
}
function afterPrint() {
	
	
	window.location.reload(true);
	
}

//Funciona a llamar si ha terminado de imprimir
if (window.matchMedia) {
	var mediaQueryList = window.matchMedia('print');
	mediaQueryList.addListener(function(mql) {
		if (mql.matches) {
			beforePrint();
		} 
		else {
			afterPrint();
		}
	});
}

// window.onbeforeprint = beforePrint;
//window.onafterprint = afterPrint;
function buscarDescripcion(){
	var indice = $(this).data("indice");
	var valor_filtro = $(this).val();
	
	var num_rows = buscar(valor_filtro,'tabla_productos',indice);
	
	$("#cantidad_productos").text(num_rows);
	
	if(num_rows == 0){
		$('#mensaje').html("<div class='alert alert-warning text-center'><strong>No se ha encontrado.</strong></div>");
		}else{
		$('#mensaje').html('');
	}
}

$(document).ready(function(){
	
	// Editar Compras
	if($("#id_compras").val()){
		console.log("Cargar Compra")
		$.ajax({
			url: "compras_detalle.php",
			data: {
				
				id_compras: $("#id_compras").val()
				
			}
			
			}).done(function(respuesta){
			
			$("#id_proveedores").val(respuesta.compra.id_proveedores)
			
			for(let producto of respuesta.productos ){
				
				
				
				agregarProducto(producto);
			}
			console.log("compras_detalle", respuesta)
			
		});
		
		
	}
	
	$("#piezas").keyup(modificarPrecio);
	
	
	// $('#form_granel').submit(agregarGranel);
	$('#form_agregar_producto').submit(function(event){
		
		event.preventDefault();
	});	
	
	$('#form_productos').submit(guardarProducto);
	
	$('#codigo_productos').keypress( buscarCodigo);
	
	
	$('#btn_nuevo_producto').click( nuevoProducto);
	$('#btn_nuevo_proveedor').click( loadProveedores);
	$('#cerrar_venta').click( guardarVenta);
	
	// $("#cantidad").on("keyup", calcularGranel)
	// $("#importe").on("keyup", calcularGranel);
	
	$("input").focus( function selecciona_input(){
		$(this).select();
	});
	
	$("#modal_granel").on("shown.bs.modal", function () { 
		$("#cantidad").focus();
	});
	
	$('#costo_mayoreo').keyup(modificarPrecio );
	$('#ganancia_menudeo_porc').keyup(calculaPrecioVenta );
	$('#precio_menudeo').keyup(calculaGanancia );
	
	//Autocomplete Productos https://github.com/devbridge/jQuery-Autocomplete
	$("#buscar_producto").autocomplete({
		serviceUrl: "../control/productos_autocomplete.php",   
		onSelect: function(eleccion){
			console.log("Elegiste: ",eleccion);
			
			agregarProducto(eleccion.data)
			
		},
		autoSelectFirst	:true , 
		showNoSuggestionNotice	:true , 
		noSuggestionNotice	: "Sin Resultados"
	});
	
	
});


function modificarPrecio() {
	console.log("modificarPrecio()");
	var costo_mayoreo = Number($("#costo_mayoreo").val());
	var piezas = Number($('#piezas').val());
	
	
	if (piezas != '') {
		var costo_pz = costo_mayoreo / piezas;
		console.log("Costo Pieza: " , costo_pz);
		
		$('#costo_proveedor').val(costo_pz.toFixed(2));
		
		if (costo_pz != '') {
			
			//ganancia menudeo
			var ganancia_menudeo_porc = Number($('#ganancia_menudeo_porc').val());
			var ganancia_menudeo_pesos = (ganancia_menudeo_porc * costo_pz) / 100;
			$('#ganancia_menudeo_pesos').val(ganancia_menudeo_pesos.toFixed(2));
			
			//precio mayoreo
			var precio_menudeo = costo_pz + ganancia_menudeo_pesos;
			$('#precio_menudeo').val(precio_menudeo.toFixed(2));
			
		}
	}
}
function calculaGanancia() {
	console.log("calculaGanancia()")
	var precio_menudeo = Number($(this).val());
	var costo_unitario = Number($('#costo_proveedor').val());
	
	if (costo_unitario != '') {
		var ganancia_menudeo_porc = ((precio_menudeo * 100) / costo_unitario) - 100;
		$('#ganancia_menudeo_porc').val(ganancia_menudeo_porc.toFixed(2));
		var ganancia_menudeo_pesos = precio_menudeo - costo_unitario;
		$('#ganancia_menudeo_pesos').val(ganancia_menudeo_pesos.toFixed(2));
		
	}
}

function calculaPrecioVenta() {
	console.log("calculaPrecioVenta");
	
	var ganancia_menudeo_porc = Number($(this).val());
	// var costo_unitario = Number($('#costo_unitario').val());
	var costo_unitario = Number($('#costo_proveedor').val());
	
	if (costo_unitario != '') {
		var ganancia_menudeo_pesos = (ganancia_menudeo_porc * costo_unitario) / 100;
		$('#ganancia_menudeo_pesos').val(ganancia_menudeo_pesos.toFixed(2));
		var precio_menudeo = costo_unitario + ganancia_menudeo_pesos;
		$('#precio_menudeo').val(precio_menudeo.toFixed(2));
	}
	
}



function agregarProducto(producto){
	console.log("agregarProducto()", producto);
	
	let articulos = $("#tabla_venta tbody tr").size();
	if(!producto.cantidad){
		
		producto.cantidad = 1;
	}
	
	//Buscar por id_productos, si se encuentra agregar 1 unidad sino agregar nuevo producto
	console.log("Buscando id_productos = ", producto.id_productos);
	var $existe= $(".id_productos[value='"+producto.id_productos+"']");
	console.log("existe", $existe);
	
	if($existe.length > 0){
		console.log("El producto ya existe");
		let cantidad_anterior = Number($existe.closest("tr").find(".cantidad").val());
		console.log("cantidad_anterior", cantidad_anterior)
		cantidad_nueva = cantidad_anterior+ 1;
		console.log("cantidad_nueva", cantidad_nueva)
		
		$existe.closest("tr").find(".cantidad").val(cantidad_nueva);
	}
	else{
		console.log("El producto no existe, agregarlo a la tabla");
		
		
		
		
		$fila_producto = `<tr>
		<td class="col-sm-1">
		<input hidden class="id_productos"  value="${producto['id_productos']}">
		<input hidden class="existencia_anterior"  value='${producto['existencia_productos']}'>
		<input hidden class="descripcion" value='${producto['descripcion_productos']}'>
		<input hidden class="precio_mayoreo" value='${producto['precio_mayoreo']}'>
		<input type="number"  step="any" class="cantidad form-control text-right"  value='${producto['cantidad']}'>
		</td>
		
		<td class="text-center">${producto['descripcion_productos']}</td>
		
		
		<td class="col-sm-1">
		<input  type="number" readonly class='costo_mayoreo form-control' value='${producto['costo_mayoreo']}'> 
		</td>
		<td class="col-sm-1">
		<input  type="number" readonly class='piezas form-control' value='${producto['piezas']}'> 
		</td>
		<td class="col-sm-1">
		<input  type="number" readonly class='precio form-control' value='${producto['costo_proveedor']}'> 
		</td>
		
		<td class="col-sm-1"><input readonly type="number" class='importe form-control text-right' > </td>
		<td class="col-sm-1">	
		<input class="existencia_anterior form-control" readonly  value='${producto['existencia_productos']}'> 
		</td>
		<td class="text-center">
		<button title="Editar Producto" data-id_producto="${producto['id_productos']}" class="btn btn-warning btn_editar">
		<i class="fa fa-edit"></i>
		</button>
		<button title="Eliminar Producto" class="btn btn-danger btn_eliminar">
		<i class="fa fa-trash"></i>
		</button> 
		</td>
		</tr>`;
		
		$("#tabla_venta tbody").append($fila_producto);
		
		//Asigna Callbacks de eventos
		$(".cantidad").keyup(sumarImportes);
		$(".cantidad").change(sumarImportes);
		$(".precio").on("keyup", sumarImportes);
		$(".precio").on("change", sumarImportes);
		
		$("input").focus(function(){
			$(this).select();
		});
		$(".btn_eliminar").click(eliminarProducto);
		$(".btn_editar").click(cargarRegistro);
		
		
	}
	$("#buscar_producto").val("");
	
	alertify.success("Producto Agregado")
	
	sumarImportes();
	
	
	
}

function guardarVenta(event){
	event.preventDefault();
	console.log("guardarVenta");
	
	if($("#id_proveedores").val() == ""){
		
		alertify.error("Elige un Proveedor");
		return false;
	}
	
	if($("#tabla_venta tbody tr").length != 0){
		var boton = $(this);
		var icono = boton.find('.fa');
		boton.prop('disabled',true);
		icono.toggleClass('fa fa-usd fa fa-spinner fa-pulse fa-fw');
		
		let articulos = $("#tabla_venta tbody tr").size();
		
		var productos = []; 
		
		$("#tabla_venta tbody tr").each(function(index, item){
			productos.push({
				"id_productos": $(item).find(".id_productos").val(),
				"cantidad": $(item).find(".cantidad").val(),
				"precio": $(item).find(".precio").val(),
				"descripcion": $(item).find(".descripcion").val(),
				"importe": $(item).find(".importe").val(),
				"existencia_anterior": $(item).find(".existencia_anterior").val()
				
			})
		});
		
		$.ajax({
			url: 'guardar_compras.php',
			method: 'POST',
			dataType: 'JSON',
			data:{
				id_usuarios: $('#id_usuarios').val(),
				id_turnos:$('#id_turnos').val(),
				articulos_ventas: articulos,
				productos: productos, 
				total: $("#total").val(),
				id_proveedores: $("#id_proveedores").val(),
				entrada_inventario: $("#entrada_inventario").prop("checked"),
				id_compras: $("#id_compras").val()
			}
			}).done(function(respuesta){
			if(respuesta.estatus_venta == "success"){
				alertify.success('Compra Guardada');
				window.location.href="compras_lista.php";
				
				// imprimirTicket( respuesta.id_ventas)
				
			}
			}).always(function(){
			boton.prop('disabled',false);
			icono.toggleClass('fa fa-usd fa fa-spinner fa-pulse fa-fw');
		});
	}
	else{
		alertify.error('No hay productos');
	}
	
}


function nuevoProducto() {
	$('#form_productos')[0].reset();
	$('#modal_productos').modal('show');
	
}
function loadProveedores() {
	$.ajax({
		"url": "../funciones/get_table.php",
		data:{
			"tabla": "proveedores"
		}
		
		}).done(function(respuesta){
		let proveedores =`<option value="">
		Seleccione...
		</option>`;
		
		$.each(respuesta.filas, function(index, fila){
			proveedores += `
			<option value="${fila.id_proveedores}">
			${fila.nombre_proveedores}
			</option>
			`;	
			
		})
		
		$("#id_proveedores").html(proveedores);
		
	})
}


function buscarCodigo(event){
	if(event.which == 13){
		console.log("buscarCodigo()");
		var input = $(this);
		var codigoProducto = $(this).val();
		
		input.prop('disabled',true);
		input.addClass('ui-autocomplete-loading');
		
		$.ajax({
			url: "../control/buscar_normal.php",
			dataType: "JSON",
			method: 'POST',
			data: {tabla:'productos', campo:'codigo_productos', id_campo: codigoProducto}
			}).done(function (respuesta){
			
			if(respuesta.numero_filas >= 1){
				$.each(respuesta.fila, function(name, value){
					$("#" + name).val(value);
				});
			}
			else{
				alertify.error('Código no Encontrado');
			}
			
			
			}).always(function(){
			
			// input.toggleClass('ui-autocomplete-loading');
			input.prop('disabled',false);
			$("#descripcion_productos").focus();
			input.removeClass('ui-autocomplete-loading');
		});
		
	}
}

function cargarRegistro() {
	
	$('#form_productos')[0].reset();
	
	console.log("Partida", $(".btn_editar").index(this))
	$("#partida").val($(".btn_editar").index(this));
	
	var boton = $(this);
	var icono = boton.find('.fa');
	icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
	boton.prop('disabled', true);
	var id_productos = boton.data('id_producto');
	$.ajax({
		url: '../control/buscar_normal.php',
		method: 'POST',
		dataType: 'JSON',
		data: { campo: 'id_productos', tabla: 'productos', id_campo: id_productos }
		}).done(function (respuesta) {
		if (respuesta.encontrado == 1) {
			$.each(respuesta["fila"], function (name, value) {
				
				$('#input_granel').html('');
				$.each(respuesta["fila"], function (name, value) {
					
					$("#form_productos").find("#" + name).val(value);
					$("#form_productos").find("#ultimo_" + name).val(value);
				});
				
			});
			$('h3.modal-title').text('Editar Producto');
			$('#modal_productos').modal('show');
		}
		icono.toggleClass('fa-pencil fa-spinner fa-spin');
		boton.prop('disabled', false);
	});
	
}





function eliminarProducto(){
	// var indice =$(".btn_eliminar").index($(this));
	// $('#ticket tr').eq(indice).remove();
	
	$(this).closest("tr").remove();
	
	
	
	sumarImportes(tabla_venta);
	
	
}
$("input").focus(function(){
	$(this).select();
	
});


function sumarImportes(){
	console.log("sumarImportes");
	var total = 0;
	$(".id_productos").each(function(indice, fila ){
		let cantidad = Number($(this).closest("tr").find(".cantidad").val());
		let precio = Number($(this).closest("tr").find(".precio").val());
		
		// console.log()
		importe= cantidad * precio;
		total+= importe;
		$(this).closest("tr").find(".importe").val(importe.toFixed(2))
	});
	
	$("#total").val(total.toFixed(2));
	
}



function buscar(filtro,table_id,indice) {
	// Declare variables 
	var  filter, table, tr, td, i;
	filter = filtro.toUpperCase();
	table = document.getElementById(table_id);
	tr = table.getElementsByTagName("tr");
	
	// Loop through all table rows, and hide those who don't match the search query
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[indice];
		if (td) {
			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
				} else {
				tr[i].style.display = "none";
			}
		} 
	}
	var num_rows = $(table).find('tbody tr:visible').length; 
	return num_rows;
}

function guardarProducto(event) {
	event.preventDefault();
	var boton = $(this).find(':submit');
	var icono = boton.find('.fa');
	boton.prop('disabled', true);
	icono.toggleClass('fa-save fa-spinner fa-spin');
	
	var formulario = $(this).serializeArray();
	// console.log("formulario: ", formulario)
	// console.log("formulario: ", $(this).serialize())
	$.ajax({
		url: '../productos/guardar.php',
		dataType: 'JSON',
		method: 'POST',
		data: formulario
		}).done(function (respuesta) {
		console.log(respuesta);
		if (respuesta.estatus == "success") {
			alertify.success('Se ha guardado correctamente');
			
			$('#modal_productos').modal("hide");
			
			console.log("campos: ",$("#form_productos").serializeArray())
			
			$.each(formulario, function(index, campo){
				switch(campo.name){
					
					case "existencia_productos":
					$("#tabla_venta tbody tr").eq($("#partida").val()).find(".existencia_anterior").val(campo.value);
					break;
					
					case "costo_mayoreo":
					$("#tabla_venta tbody tr").eq($("#partida").val()).find(".costo_mayoreo").val(campo.value);
					break;
					
					case "piezas":
					$("#tabla_venta tbody tr").eq($("#partida").val()).find(".piezas").val(campo.value);
					break;
					case "costo_proveedor":
					$("#tabla_venta tbody tr").eq($("#partida").val()).find(".precio").val(campo.value);
					break;
					
					
				}
				
			})
			
			sumarImportes();
			
		} 
		else {
			alertify.error('Error al guardar');
			
		}
		}).always(function () {
		boton.prop('disabled', false);
		icono.toggleClass('fa-save fa-spinner fa-spin');
	});
	
}
