$(document).ready(function(){
	
	
	$('#btn_egreso').click(nuevoEgreso);
	$('#form_nuevo_egreso').submit(guardarEgreso );
	
});


function nuevoEgreso(){
	$("#form_nuevo_egreso")[0].reset();
	$("#modal_nuevo_egreso").modal("show");
	
}


function confirmaCancelarEgreso(event) {
	event.preventDefault();
	var boton = $(this);
	var id_registro = boton.data('id_egresos');
	var fila = boton.closest('tr');
	
	boton.prop('disabled', true);
	icono = boton.find(".fa");
	
	alertify.confirm()
	.setting({
		'reverseButtons': true,
		'labels': { ok: "SI", cancel: 'NO' },
		'title': "Confirmar",
		'message': "¿Deseas Cancelar éste Egreso?",
		'onok': cancelarEgreso
	}).show();
	
	
	function cancelarEgreso(evnt, value) {
		$.ajax({
			url: 'consultas/cancelar_egresos.php',
			method: 'POST',
			data: {
				"estatus_egresos": 'CANCELADO',
				"id_egresos": id_registro
			}
			}).done(function (respuesta) {
			alertify.success("Se ha Cancelado el Egreso");
			window.location.reload();
			icono.toggleClass("fa-times fa-spinner fa-spin");
			boton.prop('disabled', false);
		});
	}
}

function guardarEgreso(event){
	event.preventDefault();
	var formulario = $(this);
	var boton = $(this).find(":submit");
	var icono = boton.find('.fa');
	icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
	boton.prop('disabled',true);
	
	$.ajax({
		url: 'consultas/guardar_egreso.php',
		method: 'POST',
		dataType: 'JSON',
		data:  formulario.serialize()
		}).done(function(respuesta){
		if(respuesta.estatus == 'success'){
			alertify.success('Se ha agregado correctamente');
			$('#modal_nuevo_egreso').modal('hide');
			location.reload(true);
			}else{
			alertify.error('Ha ocuurido un error');
			console.log(respuesta.mensaje);
		}
		}).always(function(){
		icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
		console.log('Se envia');
		
		boton.prop('disabled',false);
	});
}