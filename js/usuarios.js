$(document).ready(function(){
	$('#btn_usuario').click(function(){
		$('#form_nuevo_usuario')[0].reset();
		$('#modal_nuevo_usuario').modal('show');
	});
	
	var enlistaUsuarios = function(){
		$.ajax({
			url: 'control/lista_usuarios.php',
			method: 'POST',
			dataType: 'HTML',
		}).done(function(resultado){
			$('#lista_usuario').html(resultado);
			
			//--------EDITAR GRUPO----------
			$('.btn_editar').click(function(){
				$('#form_nuevo_usuario')[0].reset();
				var boton = $(this);
				var icono = boton.find('.fa');
				icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
				boton.prop('disabled',true);
				var id_usuarios = boton.data('id_usuarios');
				$.ajax({
					url: 'control/buscar_normal.php',
					method: 'POST',
					dataType: 'JSON',
					data:{campo: 'id_usuarios', tabla:'usuarios', id_campo: id_usuarios}
				}).done(function(respuesta){
					if(respuesta.encontrado == 1){
						console.log(respuesta['fila']);
						$.each(respuesta["fila"], function(name, value){
							
								
								if(name == 'id_usuarios'){
									$('#new_usuarios').val(value);
								}else{
									$("#"+name).val(value);
								}
						});
						$('#modal_nuevo_usuario').modal('show');
				}
					icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
					boton.prop('disabled',false);
				});
				
			});
			
			//ELIMINAR
			$('.btn_eliminar').click(function(){
				var boton = $(this);
				var icono = boton.find('.fa');
				boton.prop('disabled',true);
				icono.toggleClass('fa-trash fa-spinner fa-spin fa-floppy-o');
				var fila = boton.closest('tr');
				var id_usuarios = boton.data('id_usuarios');
				var eliminar = function(){
				$.ajax({
					url: 'control/eliminar_normal.php',
					method: 'POST',
					dataType: 'JSON',
					data: {campo: 'id_usuarios', tabla:'usuarios', id_campo: id_usuarios}
				}).done(function(respuesta){
						boton.prop('disabled',false);
						if(respuesta.estatus == "success"){
							fila.fadeOut(1000);
							icono.toggleClass("fa-trash fa-spinner fa-spin fa-floppy-o");
							alertify.success('Se ha eliminado');
						}else{
							console.log(respuesta.error);
						}
					});
				};
			alertify.confirm('Confirmacion', '¿Desea eliminarlo?', eliminar , function(){
						icono.toggleClass("fa-trash fa-spinner fa-spin fa-floppy-o");
						boton.prop('disabled',false);
				});
			});	
		});
	};
	enlistaUsuarios();
		//GUARDAR
	$('#form_nuevo_usuario').submit(function(event){
		event.preventDefault();
		var formulario = $(this);
		var boton = $(this).find(":submit");
		var icono = boton.find('.fa');
		icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
		boton.prop('disabled',true);
		$.ajax({
			url: 'control/guardar_normal.php',
			method: 'POST',
			datatype: 'JSON',
			data: {tabla: 'usuarios',
					   datos: formulario.serializeArray()
				}
		}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
				alertify.success('Se ha agregado correctamente');
				$('#modal_nuevo_usuario').modal('hide');
				icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
				enlistaUsuarios();
				boton.prop('disabled',false);
			}else{
				alertify.error('Ha ocuurido un error');
				console.log(respuesta.mensaje);
			}
		});
	});
});