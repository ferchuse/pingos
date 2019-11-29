<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	$empresa = 'Pingos';
	
	if($_SERVER["SERVER_NAME"] == 'localhost'){
		
		$host = 'localhost';
		$database = 'abarrotes';
		$user = 'sistemas';
		$pass = 'Glifom3dia';
	}
	else{
		$host = 'localhost';
		$database = 'microsit_abarrotes';
		$user = 'microsit_practic';
		$pass = 'UAEH@2018';
		
	}
	
	$backup_file = $empresa. "-" .date("d-m-Y-H-i-s"). ".sql";
	$dir =  "../respaldos/$backup_file";
	// $dir = dirname(__FILE__) . "/$backup_file";
	echo "<h3>Generando Respaldo to `<code>{$dir}</code>`</h3>";
	exec("mysqldump --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);
	var_dump($output);
	
	header("Content-type:application/sql");
	
	// It will be called downloaded.pdf
	header("Content-Disposition:attachment;filename=$backup_file");
	
	// The PDF source is in original.pdf
	readfile("$backup_file.sql");
	
	echo "<h3>Limpiando cache `<code>{$dir}</code>`</h3>";
	unlink($dir);
	
?>