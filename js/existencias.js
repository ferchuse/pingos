$(document).ready(function(){
	
	$('#modal_existencias').on('shown.bs.modal', function() {
        $("#cantidad_entrada").focus();
				console.log("modal_existencias.shown");
	});
	
	$("#form_existencias").submit(agregarExistencia);
	
});



function agregarExistencia(event){
	event.preventDefault();
	
		$form = $(this);
		$boton = $form.find(":submit");
		$icono = $boton.find(".fa");
		$boton.prop('disabled',true);
		$icono.toggleClass('fa-save fa-spinner fa-spin ');
		
		console.log("agregarExistencia");
		console.log($form.serialize());
	
		$.ajax({
			url: 'control/guardar_existencias.php',
			method: 'POST',
			data: $form.serialize()
		}).done(function afterExistencia(respuesta){
			console.log("afterExistencia: " + respuesta);
			console.log($("#update_target"));
			$("#update_target").html(respuesta.existencia_nueva);
			$boton.prop('disabled',false);
			$icono.toggleClass('fa-save fa-spinner fa-spin ');
			$('#modal_existencias').modal("hide");
			
			window.location.reload();
		});
}

function pedirCantidad(event){
	console.log("pedirCantidad()");
	$("#form_existencias")[0].reset();
	boton = $(this);
	console.log("boton");
	console.log(boton.data("id_productos"));
	console.log(boton.data());
	var update_target = boton.closest("td").prev();
	update_target.prop("id", "update_target");
	console.log("update_target: " + update_target.html());
	console.log(update_target);
	var id_productos = boton.data('id_productos');
	var existencia_anterior = boton.data('existencia_anterior');
		
	$("#id_productos_inv").val(boton.data('id_productos'));
	$("#existentes_contenedores_inv").val(boton.data('existencia_anterior'));
	$("#cantidad_contenedora_inv").val(boton.data('cantidad_contenedora'));
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