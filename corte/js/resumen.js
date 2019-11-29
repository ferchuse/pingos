


$(document).ready( onLoad);

function onLoad(event){
	
	$('#fecha_ventas').change(cambiarFecha);
	$('#btn_ingreso').click(nuevoIngreso);
	$('#btn_cerrar_turno').click(confirmaCerrarTurno );
	$('#btn_resumen').click( imprimirCorte);
	
	$('.btn_cancelar_egreso').click( confirmaCancelarEgreso);
	
	$('.btn_ticketPago').click(imprimirTicket );
	$('.btn_ver').click(verTicket);
	$('#panel_ventas').on("click", ".btn_cancelar",  confirmaCancelarVenta);
	$('#panel_ingresos').on("click", ".btn_cancelar",  confirmaCancelarIngreso);
	
	
}


function imprimirCorte(event){
	$("#ticket").hide();
	$("#resumen").removeClass("hidden-print");
	$("#resumen").addClass("visible-print");
	window.print();
}


function nuevoIngreso(){
	alertify.prompt("Nuevo Ingreso", "Cantidad" , 0, guardarIngreso, function(){});
	
}

function guardarIngreso(event, value){
	var fecha_ingresos = new Date().toString('yyyy-MM-dd');
	var hora_ingresos = new Date().toString('HH:mm:ss');
	
	$.ajax({
		url: '../funciones/fila_insert.php',
		method: 'POST',
		dataType: 'JSON',
		data:  {
			"tabla": "ingresos",
			"valores": [
				{"name": "cantidad_ingresos", "value": value },
				{"name": "fecha_ingresos", "value":  fecha_ingresos},
				{"name": "hora_ingresos", "value":  hora_ingresos},
				{"name": "id_turnos", "value":  $("#id_turnos").val()}
			]
		}
		}).done( function(respuesta){
		if(respuesta.estatus == 'success'){
			alertify.success('Guardado correctamente');
			window.location.reload(true);
		}
		else{
			alertify.error('Ha ocuurido un error');
			console.log(respuesta.mensaje);
		}
		}).always(function(){
		
	});
}



function cambiarFecha(){
	
	$("#id_turnos").prop("disabled", true);
	$("#form_resumen").submit();
	
}
function imprimirTicket(){
	$("#arqueo").hide();
	$("#resumen").hide();
	$("#arqueo").addClass("hidden-print");
	$("#resumen").addClass("hidden-print");
	
	console.log("btn_ticketPago");
	var id_ventas = $(this).data("id_ventas");
	var boton = $(this).prop("disabled",true);
	var icono = boton.find(".fa");
	icono.toggleClass("fa-print fa-spinner fa-spin");
	$.ajax({
		url: "../impresion/imprimir_venta.php",
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
}



function confirmaCancelarVenta(event) {
	console.log("confirmaCancelarVenta()")
	var boton = $(this);
	var id_registro = boton.data('id_ventas');
	var fila = boton.closest('tr');
	
	boton.prop('disabled', true);
	icono = boton.find(".fa");
	
	
	alertify.confirm()
  .setting({
    'reverseButtons': true,
		'labels' :{ok:"SI", cancel:'NO'},
    'title': "Confirmar" ,
    'message': "¿Deseas cancelar esta venta?" ,
    'onok':cancelarVenta
	}).show();
	
	
	function cancelarVenta(evnt,value) {
		$.ajax({
			url: 'consultas/cancelar_ventas.php',
			method: 'POST',
			data:{ 
				"estatus_ventas": 'CANCELADO',
				"id_ventas": id_registro,
				"motivo": value
				
			}
			}).done(function(respuesta){
			alertify.success("Se ha cancelado el pago"); 
			window.location.reload();
			
			}).fail(function(){
			alertify.error("Ocurrió un error");
			
			}).always(function(){
			icono.toggleClass("fa-times fa-spinner fa-spin");
			boton.prop('disabled', false);
			
		});
	}
}

function confirmaCancelarIngreso(event) {
	console.log("confirmaCancelarIngreso()")
	var boton = $(this);
	var id_registro = boton.data('id_registro');
	var fila = boton.closest('tr');
	
	boton.prop('disabled', true);
	icono = boton.find(".fa");
	
	
	alertify.confirm()
  .setting({
    'reverseButtons': true,
		'labels' :{ok:"SI", cancel:'NO'},
    'title': "Confirmar" ,
    'message': "¿Deseas cancelar esta Entrada?" ,
    'onok':cancelarIngreso,
    'oncancel': function(){
			boton.prop('disabled', false);
			
		}
	}).show();
	
	
	function cancelarIngreso(evnt,value) {
		$.ajax({
			url: 'consultas/cancelar_ingresos.php',
			method: 'POST',
			data:{ 
				"id_registro": id_registro,
				"motivo": value
				
			}
			}).done(function(respuesta){
			alertify.success("Cancelado"); 
			window.location.reload();
			
			}).fail(function(){
			alertify.error("Ocurrió un error");
			
			}).always(function(){
			icono.toggleClass("fa-times fa-spinner fa-spin");
			boton.prop('disabled', false);
			
		});
	}
}



function verTicket(){
	
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
}

function confirmaCerrarTurno(){
	
	
	alertify.confirm()
  .setting({
    'reverseButtons': true,
		'labels' :{ok:"SI", cancel:'NO'},
    'title': "Confirmar" ,
    'message': "¿Desea cerrar el turno?" ,
    'onok':cerrarTurno
	}).show();
}


function cerrarTurno(){
	
	$.ajax({
		'method': 'POST',
		'dataType': 'JSON',
		'url': 'cerrar_turno.php',
		'data': {
			id_turnos:$("#id_turnos").val(),
			saldo_final:$("#saldo_final").val(),
			id_usuarios:$("#id_usuarios").val()
		}
		}).done(function(respuesta){
		if(respuesta.cierra_turno.estatus == "success"){
			
			location.href = '../login/logout.php';
		}
		else{
			
		}
		
	}).always();
	
	
}	