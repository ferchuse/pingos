<?php
 if(isset($_GET["redirect_url"])){
	 
	 $redirect_url =$_GET["redirect_url"]; 
 } 
 else{
	 $redirect_url = "";
	 
 }
 
 
 include("../conexi.php");
 $link = Conectarse();
 
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Iniciar Sesión</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.10.0/css/alertify.min.css" />

    <link rel="stylesheet" type="text/css" href="login.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../lib/alertify.min.js"></script>
    <script type="text/javascript" src="login.js"></script>

</head>

<body>
    <div class="container">
        <div class="row" id="pwd-container">
            <div class="col-md-4"></div>

            <div class="col-md-4">
                <section class="login-form">
                    <form name="form_login" id="form_login" action="" role="login" method="post">

                        <div id="login_logo">


                            <img class=" img-responsive" src="../img/logo.jpg">
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
                        <input type="password" name="password" class="form-control " id="password"
                            placeholder="Contraseña" required="" />


                        <div class="pwstrength_viewport_progress"></div>


                        <button type="submit" id="btn_login" name="iniciar" class="btn btn-lg btn-primary btn-block">
                            <i class="fa fa-sign-in"></i> Iniciar Sesión <i id="spinner"
                                class="fa fa-spin fa-spinner hide"></i>
                        </button>
                    </form>

                </section>

            </div>
        </div>
    </div>
</body>

</html>