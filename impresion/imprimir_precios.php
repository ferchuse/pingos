<?php
include("../conexi.php");
$link = Conectarse();

$str_productos = implode(",", $_GET['id_productos']);
$consulta = "SELECT * FROM productos WHERE id_productos IN ({$str_productos})";
// echo $consulta;
$result = mysqli_query($link, $consulta);
while ($fila = mysqli_fetch_assoc($result)) {
    $fila_productos[] = $fila;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tarjeta Información Producto</title>

    <!-- Bootstrap & CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <link rel="stylesheet" href="../css/imprimir_precios.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <?php foreach ($fila_productos as $index => $producto) { ?>
            
            <div class="col-6">
                <div class="row justify-content-between">
                    <div class="col-6 border border-right-0 border-danger pr-0 pl-0">
                        <img src="../img/logo_mod.jpg" alt="">
                    </div>

                    <div class="col-6 border border-left-0 border-danger pr-4 pl-4 pt-2">
                        <div class="row h-row-100 align-items-center">
                            <div class=" col-12 h-row-40">
                                <div class="etiqueta bg-pink row h-row-100 border-pink align-items-center">
                                    <div class="etiqueta align-c col-12 text-center text-uppercase font-weight-bold"><?php echo $producto["descripcion_productos"]; ?></div>
                                </div>
                            </div>

                            <div class="col-12 h-row-20">
                                <div class="row h-row-100 align-items-center text-center">
                                    <div class="col-7 h-row-55 ">
                                        <div class="row h-row-100 align-items-center">
                                            <div class="col-12 text-bold">100 GRS</div>
                                        </div>
                                    </div>
                                    <div class="col-5 w-90 h-row-55 text-center border-brown">
                                        <div class="row h-row-100 align-items-center">
                                            <div class="col-12 text-brown"><?php echo "$" . $producto["precio_menudeo"]/10; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 h-row-20">
                                <div class="row h-row-100 align-items-center text-center">
                                    <div class="col-7 h-row-55 ">
                                        <div class="row h-row-100 align-items-center">
                                            <div class="col-12 text-bold">-500 GRS</div>
                                        </div>
                                    </div>
                                    <div class="col-5 h-row-55 text-center border-brown">
                                        <div class="row h-row-100 align-items-center">
                                            <div class="col-12 text-brown"><?php echo "$" . $producto["precio_menudeo"]; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 h-row-20">
                                <div class="row h-row-100 align-items-center text-center">
                                    <div class="col-7 h-row-55 ">
                                        <div class="row h-row-100 align-items-center">
                                            <div class="col-12 text-bold">+500 GRS</div>
                                        </div>
                                    </div>
                                    <div class="col-5 h-row-55 text-center border-brown">
                                        <div class="row h-row-100 align-items-center">
                                            <div class="col-12 text-brown"><?php echo "$" . $producto["precio_mayoreo"]; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <?php } ?>
        </div>
    </div>
</body>

</html>