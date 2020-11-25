$(document).ready(function(){
	
	$('#modal_existencias').on('shown.bs.modal', function() {
		$("#cantidad_carrito").focus();
		$("#cantidad_carrito").select();
		calcularImporte();
		console.log("modal_existencias.shown");
	});
	
	$("#form_existencias").submit(agregarCarrito);
	$("#cantidad_carrito").keyup(calcularImporte);
});



function calcularImporte(event){
	let cantidad = Number($("#cantidad_carrito").val());
	let precio = Number($("#precio_carrito").val());
	
	let importe = cantidad * precio;
	
	$("#importe_carrito").val(importe.toFixed(2))
	
}

function agregarCarrito(event){
	event.preventDefault();
	
	$form = $(this);
	$boton = $form.find(":submit");
	$icono = $boton.find(".fa");
	$boton.prop('disabled',true);
	$icono.toggleClass('fa-save fa-spinner fa-spin ');
	
	$.ajax({
		url: 'carrito/agregar_carrito.php',
		method: 'POST',
		data: $form.serialize()
		}).done(function (respuesta){
		
		$('#modal_existencias').modal("hide");
		alertify.success("Producto agregado");
		
		}).fail(function(xhr, error, ernum){
		alertify.error("Error", error);
		
		}).always(function(){
		$boton.prop('disabled',false);
		$icono.toggleClass('fa-save fa-spinner fa-spin ');
		
	});
}

function pedirCantidad(event){
	console.log("pedirCantidad()");
	$("#form_existencias")[0].reset();
	boton = $(this);
	
	$("#id_productos_carrito").val(boton.data('id_productos'));
	$("#descripcion_carrito").val(boton.data('descripcion'));
	$("#precio_carrito").val(boton.data('precio'));
	$("#unidad_carrito").val(boton.data('unidad'));
	
	$("#modal_existencias").modal("show");
	
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