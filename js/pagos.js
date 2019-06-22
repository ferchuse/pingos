$(document).ready(function(){

	//--------- --------------
	$('.btn_pagar').click(function(){
		$('#form_tipo_pago')[0].reset();
			var boton = $(this);
			var icono = boton.find('.fa');
			icono.toggleClass('fa-usd fa-spinner fa-spin fa-floppy-o');
			boton.prop('disabled',true);
			var id_ventas = boton.data('id_ventas');
			console.log(id_ventas);
			$.ajax({
				url: 'control/buscar_normal.php',
				method: 'POST',
				dataType: 'JSON',
				data:{campo: 'id_ventas', tabla:'ventas', id_campo:id_ventas}
			}).done(function(respuesta){  
				if(respuesta.encontrado == 1){
					$.each(respuesta["fila"], function(name, value){	
						
							$("#"+name).val(value);
					});
					$('#modal_tipo_pago').modal('show');
					$('#modal_tipo_pago').on('shown.bs.modal', function() {
						$("#efectivos").focus();
					});
				}
				icono.toggleClass('fa-usd fa-spinner fa-spin fa-floppy-o');
				boton.prop('disabled',false);
			});
	});
	$('#efectivos').keyup(function(){
		var efectivo = Number($(this).val());
		var total_sub = Number($('#total_ventas').val());
		$('#total_pagar').val((efectivo-total_sub).toFixed(2));
	});
	//MIXTO EFECTIVO
	var totalMixto = Number($('#sub_mixto').val());
	
	$('#efectivo_mixto').keyup(function(){
		var efectivoMixto = Number($(this).val());
		
		if($('#tarjeta_mixto') != ''){
			var tarjetaMixto = Number($('#tarjeta_mixto').val());
			
		}else{
			var tarjetaMixto = 0;
		}
		if($('#vale_mixto') != ''){
			var valeMixto = Number($('#vale_mixto').val());
			
		}else{
			var valeMixto = 0;
		}
		
		var todo_mixto = $('#total_mixto').val()-(efectivoMixto + tarjetaMixto + valeMixto);
		
		
		$('#sub_mixto').val((todo_mixto).toFixed(2));
	});
	//MIXTO TARJETA
	$('#tarjeta_mixto').keyup(function(){
		var tarjetaMixto = Number($(this).val());
		
		if($('#efectivo_mixto') != ''){
			var efectivoMixto = Number($('#efectivo_mixto').val());
			
		}else{
			var efectivoMixto = 0;
		}
		if($('#vale_mixto') != ''){
			var valeMixto = Number($('#vale_mixto').val());
			
		}else{
			var valeMixto = 0;
		}
		
		var todo_mixto = $('#total_mixto').val()-(efectivoMixto + tarjetaMixto + valeMixto);
		
		$('#sub_mixto').val((todo_mixto).toFixed(2));
	});
	//MIXTO VALE
		
	$('#vale_mixto').keyup(function(){
		var valeMixto = Number($(this).val());
		
		if($('#efectivo_mixto') != ''){
			var efectivoMixto = Number($('#efectivo_mixto').val());
			
		}else{
			var efectivoMixto = 0;
		}
		if($('#tarjeta_mixto') != ''){
			var tarjetaMixto = Number($('#tarjeta_mixto').val());
			
		}else{
			var tarjetaMixto = 0;
		}
		var todo_mixto = $('#total_mixto').val()-(efectivoMixto + tarjetaMixto + valeMixto);
		
		$('#sub_mixto').val((todo_mixto).toFixed(2));
	});
	$('.btn_guardarModal').click(function(){
		var efectivo = Number($('#efectivos').val());
		var totalEfectivo = Number($('#total_ventas').val());//nuevo guardado de la bd para efectivo
		var tarjeta = Number($('#tarjetas').val());
		var pagoTarjeta = Number($('#venta_tarjetaT').val());
		// pagoTarjeta *= 1.05;
		var vales = Number($('#vale').val());
		//-------------MIXTO-------------------------
		var mixtoEfectivo = Number($('#efectivo_mixto').val());
		var mixtoTarjeta = Number($('#tarjeta_mixto').val());
		var numeroMixto = Number($('#numero_mixto').val());
		var mixtoVale = Number($('#vale_mixto').val());
		//--------------------------------------
		var cambio = Number($('#total_pagar').val());
		var activo = $('#modalPago .nav-tabs li.active').find('a').data('forma_pago');
		var id_ventas = $('#id_ventas').val();
		 switch(activo){
			case "efectivo":
			if($('#efectivos').val() != 0){
				$.ajax({
					url:'control/fila_update.php',
					method: 'POST',
					data:{
						tabla: 'ventas',
						valores:[
							{name:'estatus_ventas', value:'PAGADO'},
								{name: 'efectivo_ventas',value:efectivo},//guardar el total del efectivo
								{name: 'total_efectivo',value:totalEfectivo},
									{name:'cambio_ventas',value:cambio}
						],
						id_campo: 'id_ventas',
						id_valor: id_ventas
					}
				}).done(function(respuesta){
					if(respuesta.estatus == 'success'){
						$('#modal_tipo_pago').modal('hide');
						alertify.success("Pagado correctamente");
						location.reload();	
					}else{
						alertify.error("Error al pagar");
					}
				});
				
			}else{
				
				alertify.error("Colocar cantidad");
			}
				
			break;
			case "tarjeta":
			
			var tarjetaNumero = $('#tarjetas').val();
			
			if(tarjetaNumero != 0) {
				if(tarjetaNumero.length == 4){
					$.ajax({
						url:'control/fila_update.php',
						method: 'POST',
						data:{
							tabla: 'ventas',
							valores:[
								{name:'estatus_ventas', value:'PAGADO'},
									{name: 'pago_tarjeta',value:pagoTarjeta},
									{name: 'tarjeta_ventas',value:tarjeta}
							],
							id_campo: 'id_ventas',
							id_valor: id_ventas
						}
					}).done(function(respuesta){
						if(respuesta.estatus == 'success'){
							$('#modal_tipo_pago').modal('hide');
							alertify.success("Pagado correctamente");
							location.reload();
						}else{
							alertify.error("Error al pagar");
						}
					});
				}else{
					alertify.error("Ingresa los cuatro digitos de la tarjeta");
				}
			}else{
				alertify.error("Ingresa un numero de tarjeta");
			}
				
			break;
			case "vale":
			if($('#vale').val() != 0){
				$.ajax({
					url:'control/fila_update.php',
					method: 'POST',
					data:{
						tabla: 'ventas',
						valores:[
							{name:'estatus_ventas', value:'PAGADO'},
								{name: 'vale_ventas',value:vales}
						],
						id_campo: 'id_ventas',
						id_valor: id_ventas
					}
				}).done(function(respuesta){
					if(respuesta.estatus == 'success'){
						$('#modal_tipo_pago').modal('hide');
						alertify.success("Pagado correctamente");
						location.reload();
					}else{
						alertify.error("Error al pagar");
					}
				});
			}else{
				alertify.error("Ingresa un vale");
			}
				
			break;
			case "mixto":
			if($('#efectivo_mixto').val() != 0 && $('#tarjeta_mixto').val() != 0 && $('#vale_mixto').val() != 0){
				if($('#efectivo_mixto').val() != 0 && $('#tarjeta_mixto').val() != 0){
						$.ajax({
					url:'control/fila_update.php',
					method: 'POST',
					data:{
						tabla: 'ventas',
						valores:[
							{name:'estatus_ventas', value:'PAGADO'},
								{name: 'efectivo_ventas',value:mixtoEfectivo},
								{name: 'tarjeta_ventas',value:numeroMixto},
								{name: 'pago_tarjeta',value:mixtoTarjeta},
								{name: 'vale_ventas',value:mixtoVale}
						],
						id_campo: 'id_ventas',
						id_valor: id_ventas
					}
				}).done(function(respuesta){
					if(respuesta.estatus == 'success'){
						$('#modal_tipo_pago').modal('hide');
						alertify.success("Pagado correctamente");
						location.reload();
					}else{
						alertify.error("Error al pagar");
					}
				});
					
				}else{
					alertify.error("if dos ");
			
				}
			}else{
				alertify.error("Ingresa minimo dos formas a pagar");
				
			}
				
			break;
		}
		
	});
	//VERIFICAR NUMERO DE TARJETA
	$('#tarjetas').keyup(function(){
		var cuentaNumero = $(this).val();
		if(cuentaNumero.length <= 4){
			$('#no_tarjeta').text('');
			
		}else{
			$('#no_tarjeta').text('(Solo se aceptan 4 caracteres)');
		
		}
	});
	
	$('#numero_mixto').keyup(function(){
		var cuentaNumero = $(this).val();
		if(cuentaNumero.length <= 4){
			$('#no_tar').text('');
			
		}else{
			$('#no_tar').text('(Solo se aceptan 4 caracteres)');
		
		}
	});
	
	
});