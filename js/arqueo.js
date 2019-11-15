$(document).ready(function(){
	
	$('#form_arqueo').on('submit', guardarArqueo);
	
	
	$('.cantidad').on('keyup', sumarArqueo);
	$('.cantidad').on('focus', function selectOnFocus(event) {$(this).select()});
	
});

function guardarArqueo(event){
	console.log("guardarRegistro")
	event.preventDefault();
	let form = $(this);
	let boton = form.find(':submit');
	let icono = boton.find('.fa');
	let datos = form.serializeArray();
	datos.push({"name": "id_usuarios", "value": $("#id_usuarios").val()})
	// datos.push({"name": "id_administrador", "value": $("#sesion_id_administrador").val()})
	let importe_desglose = $('#importe_desglose').val();
	console.log("importe_desglose", importe_desglose);
	console.log("datos", datos);
	if(importe_desglose != ""){
		
		boton.prop('disabled',true);
		icono.toggleClass('fa-save fa-spinner fa-pulse ');
		
		$.ajax({
			url: 'funciones/fila_insert.php',
			method: 'POST',
			dataType: 'JSON',
			data:{
				tabla: 'arqueo',
				valores: datos
			}
			}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
				// alertify.success('Se ha agregado correctamente');
				// $('#modal_arqueo').modal('hide');
				imprimirArqueo(respuesta.nuevo_id);
			}
			else{
				alertify.error('Ocurrio un error');
			}
			}).always(function(){ 
			boton.prop('disabled',false);
			icono.toggleClass('fa-save fa-spinner fa-pulse');
		});
	}
	else{
		alertify.error("Ingrese alguna cantidad");
		
		
	}
}




function sumarArqueo(){
	console.log("sumarArqueo()");
	
	let importe_total = 0;
	let $fila = $(this).closest("tr");
	let denominacion = Number($fila.find(".cantidad").data('denomi'));
	let cantidad = Number($fila.find(".cantidad").val());
	let importe = cantidad * denominacion;
	$fila.find('.importe').val(importe);
	console.log(importe);
	
	$(".importe").each( function sumarImportes(index, item){
		importe_total += Number($(item).val());
	});
	let subtotal = importe_total.toFixed(2);
	console.log(importe_total);
	$("#importe_total").val(subtotal);
}
//============TOTAL DE DOCUMENTO DE BOLETOS=================



function imprimirArqueo(nuevo_id){
	console.log("imprimirArqueo()");
	
	$("#resumen").removeClass("visible-print");
	$("#resumen").addClass("hidden-print");
	

	$.ajax({
		url: "impresion/imprimir_arqueo.php",
		data:{
			id_registro : nuevo_id
		}
		}).done(function (respuesta){
		
		$("#arqueo").html(respuesta);
		window.print();
		}).always(function(){
		
		
	});
}	