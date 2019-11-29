$(document).ready(function(){
	
	$('#form_arqueo').on('submit', guardarArqueo);
	
	
	$('#btn_arqueo').click(nuevoArqueo);
	
	$('.cantidad').on('keyup', sumarArqueo);
	$('.cantidad').on('focus', function selectOnFocus(event) {$(this).select()});
	
});

function nuevoArqueo(event){
	$("#resumen").hide();
	$("#form_arqueo")[0].reset();
	$("#modal_arqueo").modal("show");
	
}

function guardarArqueo(event){
	console.log("guardarArqueo()")
	event.preventDefault();
	
	let form = $(this);
	let boton = form.find(':submit');
	let icono = boton.find('.fa');
	let datos = form.serializeArray();
	let importe_arqueo = $('#importe_desglose').val();
	
	if(importe_arqueo != "" && importe_arqueo != "0"){
		
		boton.prop('disabled',true);
		icono.toggleClass('fa-save fa-spinner fa-pulse ');
		
		$.ajax({
			url: 'consultas/guardar_arqueo.php',
			method: 'POST',
			dataType: 'JSON',
			
			data: datos
			
			}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
				
				$("#modal_arqueo").modal("hide");
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
	
	
	$(".importe").each( function sumarImportes(index, item){
		importe_total += Number($(item).val());
	});
	
	let subtotal = importe_total.toFixed(2);
	
	
	$("#importe_total").val(subtotal);
}


function imprimirArqueo(nuevo_id){
	console.log("imprimirArqueo()");
	
	$("#resumen").removeClass("visible-print");
	$("#resumen").addClass("hidden-print");
	
	
	$.ajax({
		url: "imprimir_arqueo.php",
		data:{
			id_registro : nuevo_id
		}
		}).done(function (respuesta){
		
		$("#arqueo").html(respuesta);
		window.print();
		}).always(function(){
		
		
	});
}		