<?php
	
	include("../conexi.php");
	$link = Conectarse();
	
	if(isset($_GET["redirect_url"])){
		
		$redirect_url =$_GET["redirect_url"]; 
	} 
	else{
		$redirect_url = "";
		
	}
	
	
?>
<!DOCTYPE html>
<html lang="es">
	
	<head>
    <title>Iniciar Sesión</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		
		
		
		<link href="../css/bootstrap.min.css" rel="stylesheet" media="all">
		<link href="../css/alertify.min.css" rel="stylesheet" media="all"/>
		<link href="../css/all.min.css" rel="stylesheet" >
		<link href="login.css" rel="stylesheet" >
	
	</head>
	
	<body>
    <div class="container">
			<div class="row" id="pwd-container">
				<div class="col-md-4"></div>
				
				<div class="col-md-4">
					<section class="login-form">
						<form name="form_login" id="form_login" action="" role="login" method="post">
							
							<div id="login_logo">
								
								
								<img class=" img-responsive" src="logo_login.png">
							</div>
							
							<?php 
								if(isset($count) && $count != 1){
								?>
								<div class="alert alert-danger">Usuario y/o Contraseña inválidos</div>
								<?php
								}
							?>
							<hr>
							<div class="form-group">
								
								<select id="id_usuarios" name="id_usuarios" required class="form-control">
									<option value="">Elige un usuario</option>
									<?php
										
										$q_select="SELECT * FROM usuarios ORDER BY nombre_usuarios ";
										$result_select= mysqli_query($link, $q_select)or die("Error en:$q_select".mysqli_error($link));
										
										while($row= mysqli_fetch_assoc($result_select)){
											$id= $row["id_usuarios"];
											$value = $row["nombre_usuarios"];
										?>
										<option value="<?php echo $id;?>">
											<?php echo $value;?>
										</option>
										<?php
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<input type="password" name="password" class="form-control " id="password"
								placeholder="Contraseña" required="" />
							</div>
							<div class="form-group">
								<label for="password">Ultimo Turno:</label>
								<input type="number" readonly name="turno" class="form-control col-sm-6" id="turno" placeholder="" required="" />
								<input class="form-control col-sm-6" readonly id="cerrado" name="cerrado">
							</div>
							<div class="form-group">
								<label for="password">Efectivo Inicial:</label>
								<input type="number" value="0" step="0.01" name="efectivo_inicial" class="form-control " id="efectivo_inicial" placeholder="Efectivo inicial" required="" />
							</div>
							
							
							<button type="submit" id="btn_login" name="iniciar" class="btn btn-lg btn-primary btn-block">
								<i class="fas fa-sign-in"></i> Iniciar Sesión <i id="spinner"
								class="fa fa-spin fa-spinner hide"></i>
							</button>
						</form>
						
					</section>
					
				</div>
			</div>
		</div>
		
			
		<?php include("../scripts_carpetas.php")?>
    <script type="text/javascript" src="login.js?v=<?= date("d-m-Y-H-i-s")?>"></script>
		
	</body>
	
</html>