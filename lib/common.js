$(document).ready(function(){
	// $(".fecha_full").datepicker({
		// changeMonth: true,
		// changeYear: true
	// });
	
	// $(".fecha_anterior").datepicker({
		// changeMonth: true,
		// changeYear: true,
		// maxDate : 0
	// });
	$("input[type=text]").blur(function(e){
		 $(this).val($(this).val().toUpperCase());
	});
	
	$("form").submit(function(e){
		$("input[type=text]").each(function(index, val){
			 $(this).val($(this).val().toUpperCase());
		});
	});
	
	
	
});

