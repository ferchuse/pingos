$(document).ready(function(){
	$('#form_reportes').submit(function(event){
		event.preventDefault();
		$('#contenedor_tabla').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
		var boton = $(this).find(':submit');
		var icono = boton.find('.fa');
		var formulario = $(this).serialize();
		$.ajax({
			url: 'control/reporte.php',
			method: 'POST',
			dataType: 'HTML',
			data: formulario
		}).done(function(respuesta){
			$('#contenedor_tabla').html(respuesta);
		});
	});
	
	// $('#btn_imprimirR').click(function(){
		// $.ajax({
			// url: 'imprimir_corte.php',
			// method: 'POST',
			// dataType: 'HTML',
			// data:,
		// });
	// });
	
	
	
});