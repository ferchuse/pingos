$(document).ready(function(){
	$('#Egresos').click(function(){
		$('#form_nuevo_egreso')[0].reset();
		$('#modal_nuevo_egreso').modal("show");
	});
	//---------------AGREGAR EGRESOS-----------
	$('#form_nuevo_egreso').submit(function(event){
		event.preventDefault();
		var formulario = $(this);
		var boton = $(this).find(":submit");
		var icono = boton.find('.fa');
		icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
		boton.prop('disabled',true);
		
		$.ajax({
			url: 'control/guardar_egreso.php',
			method: 'POST',
			dataType: 'JSON',
			data:  formulario.serialize()
		}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
				alertify.success('Se ha agregado correctamente');
				$('#modal_nuevo_egreso').modal('hide');
				location.reload();
				// window.location.reload();//cargar la paguina;
			}else{
				alertify.error('Ha ocuurido un error');
				console.log(respuesta.mensaje);
			}
		}).always(function(){
			icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
			console.log('Se envia');
			
			boton.prop('disabled',false);
		});
	});
	
});

