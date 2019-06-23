
function nuevoEgreso(){
	$("#form_nuevo_egreso")[0].reset();
	$("#modal_nuevo_egreso").modal("show");
	
}
function cambiarFecha(){
	$("#form_resumen").submit();
	
}

$(document).ready(function(){
	
	//--------CORTE DE CAJA-----
	$('#btn_egreso').click(nuevoEgreso);
	$('#fecha_ventas').change(cambiarFecha);
	
	
	$('#btn_corte').click(function(){
		var boton = $(this);
		var icono = boton.find(".fa");
		icono.toggleClass("fa-history fa-spinner fa-spin fa-floppy-o ");
		console.log($("#id_usuarios").val());
		var datos = {
			id_turnos:$("#id_turnos").val(),
			saldo_final:$("#saldo_final").val(),
			id_usuarios:$("#id_usuarios").val()
		}
		//(Titulo, Mensaje, func_ok, Func_cancelar)
		alertify.confirm('Confirmacion', 'Esta seguro de cerrar su turno?', corteCaja , function(){
			icono.toggleClass("fa-history fa-spinner fa-spin fa-floppy-o ");
		});
		//icono.toggleClass("fa-trash fa-spinner fa-spin fa-floppy-o ")
		function corteCaja(){
			// $.ajax({
			// method: 'POST',
			// dataType: 'JSON',
			// url: 'imprimir_corte.php',
			// data: {datos:datos}
			// }).done(function(respuesta){
			// console.log(respuesta);
			
			$.ajax({
				'method': 'POST',
				'dataType': 'JSON',
				'url': 'control/cerrar_turno.php',
				'data': datos
				}).done(function(respuesta){
				if(respuesta.mensaje_modicar == "success"){
					console.log(respuesta.mensaje_modicar);
					location.href = 'login/logout.php';
					}else{
					console.log(respuesta.error_modificar);
				}
				if(respuesta.mensaje_insertar == "success"){ 
					console.log(respuesta.mensaje_insertar);
					
					}else{
					console.log(respuesta.error_insertar);
				}
			});
			// });
			icono.toggleClass("fa-history fa-spinner fa-spin fa-floppy-o ");
		};
	});
	
	$('.btn_cancelar').click(function cancelar(event) {
		event.preventDefault();
		var boton = $(this);
		boton.prop('disabled', true);
		icono = boton.find(".fa");
		
		var id_registro = boton.data('id_ventas');
		var fila = boton.closest('tr');
		function cancelar(evet,value) {
			$.ajax({
				url: 'control/cancelar_ventas.php',
				method: 'POST',
				data:{ 
					"estatus_ventas": 'CANCELADO',
					"id_ventas": id_registro
					
				}
				}).done(function(respuesta){
				alertify.success("Se ha cancelado el pago"); 
				window.location.reload();
				icono.toggleClass("fa-times fa-spinner fa-spin");
				boton.prop('disabled', false);
			});
		}
		alertify.prompt('Confirmacion', '¿Deseas cancelarlo?','Escribe el motivo', cancelar, function () {
			
			boton.prop('disabled', false);
		});
		
	});
	
	/*	
		$('.btn-cancela').click(function cancela(event) {
		event.preventDefault();
		var boton = $(this);
		boton.prop('disabled', true);
		icono = boton.find(".fa");
		
		var id_egresos = boton.data('id_egresos');
		var fila = boton.closest('tr');
		function cancela(evet,value) {
		$.ajax({
		url: 'control/fila_update.php',
		method: 'POST',
		data:{
		tabla: 'egresos',
		id_campo: 'id_egresos',
		id_valor: id_egresos,
		valores: [
		{
		name: 'motivocancelacion_egresos',
		value: value
		},
		{
		name: 'estatus_egresos',
		value: 'CANCELADO'
		}
		]
		}
		}).done(function(respuesta){
		alertify.success("Se ha cancelado el egreso"); 
		window.location.reload();//cargar la paguina;
		icono.toggleClass("fa-times fa-spinner fa-spin");
		boton.prop('disabled', false);
		});
		}
		alertify.prompt('Confirmacion', '¿Deseas cancelarlo?','Escribe el motivo', cancela, function () {
		// icono.toggleClass("fa-times fa-spinner fa-spin");
		boton.prop('disabled', false);
		});
		
		});
	*/	
	
	$('#btn_resumen').click(function(){
		$("#Pago").hide();
		$("#resumen").removeClass("hidden-print");
		window.print();
	});
	
	
	//IMPRIMIR PAGO
	$('.btn_ticketPago').click( function imprimirTicket(){
		$("#resumen").hide();
		$("#resumen").addClass("hidden-print");
		
		console.log("btn_ticketPago");
		var id_ventas = $(this).data("id_ventas");
		var boton = $(this).prop("disabled",true);
		var icono = boton.find(".fa");
		icono.toggleClass("fa-print fa-spinner fa-spin");
		$.ajax({
			url: "impresion/imprimir_venta.php",
			dataType: "HTML",
			data:{ id_ventas:id_ventas}
			}).done(function(respuesta){
			$('#Pago').html(respuesta);
			var total_f = $('#total_venta').val();
			console.log("imprimir pago termina");
			boton.prop("disabled",false);
			icono.toggleClass("fa-print fa-spinner fa-spin");
			$('#total_text').text(NumeroALetras(total_f));
			window.print();
		});
		// console.log("pago");
	});
	
	$('.btn_ver').click( function verTicket(){
		
		console.log("verTicket");
		var id_ventas = $(this).data("id_ventas");
		var boton = $(this).prop("disabled",true);
		var icono = boton.find(".fa");
		icono.toggleClass("fa-eye fa-spinner fa-spin");
		
		$.ajax({
			url: "forms/modal_imprimir_venta.php",
			dataType: "HTML",
			data:{ id_ventas:id_ventas}
			}).done(function(respuesta){
			$('#ver_venta').html(respuesta);
			$('#modal_ticket').modal("show");
			
			
			
			boton.prop("disabled",false);
			icono.toggleClass("fa-print fa-spinner fa-spin");
			
		});
		// console.log("pago");
	});
	
	
});