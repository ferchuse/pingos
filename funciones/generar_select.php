<?php
	
	// include("../conexi.php");
	
	// $link = Conectarse();
	 
	function generar_select($link, $tabla, $llave_primaria, $campo_etiqueta ,$filtro = false, $disabled = false ,$required = false , $id_selected = 0, $data_indice = 0, $name = ""){
		$consulta = "SELECT * FROM $tabla";
		
		if($name == ""){
			$name = $llave_primaria;
		}
		
		 
		$select = "<select data-indice='$data_indice'";
		
		$select .= $required ? " required " : " ";
		$select .= $disabled ? " disabled " : " ";
		$select.= "class='form-control' name='$name' id='$llave_primaria' >";
		if($filtro){
			$select .= "<option value=''>Todos</option>";
		} 
		else{
			$select .= "<option value=''>Seleccione...</option>";
		}
		
		$result = mysqli_query($link, $consulta);
		
		while($fila = mysqli_fetch_assoc($result)){
			$select.="<option value='".$fila[$llave_primaria]."'";
			$select.=$fila[$llave_primaria] == $id_selected ? " selected" : "" ;
			$select.=" >".$fila[$campo_etiqueta] ."</option>";
			
		}
		$select.="</select>";
		
		return $select;
	}
	
?>