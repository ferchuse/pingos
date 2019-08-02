$(document).ready(function(){
	$('#form_reportes').submit(listarRegistros );
	
	
	$("#descripcion_productos").autocomplete({
		serviceUrl: "../control/productos_autocomplete.php",   
		onSelect: function(eleccion){
			$("#id_productos").val(eleccion.data.id_productos);
			
		},
		autoSelectFirst	:true , 
		showNoSuggestionNotice	:true , 
		noSuggestionNotice	: "Sin Resultados"
	});
});


function listarRegistros(event){
	event.preventDefault();
	$('#contenedor_tabla').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
	var boton = $(this).find(':submit');
	var icono = boton.find('.fa');
	var formulario = $(this).serialize();
	$.ajax({
		url: 'tabla_movimientos.php',
		method: 'POST',
		dataType: 'HTML',
		data: formulario
		}).done(function(respuesta){
		$('#contenedor_tabla').html(respuesta);
		
		$(".sort").click(ordenar)
	});
}

function ordenar(){
	$("#sort").val($(this).data("campo"));
	
	$('#form_reportes').submit();
	
}