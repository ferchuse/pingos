<?php

include("../conexi.php");
$link = Conectarse();

$consulta = "SELECT * FROM compras 
	LEFT JOIN compras_detalle USING (id_compras)
	LEFT JOIN proveedores USING (id_proveedores)
	WHERE id_compras={$_GET["id_compras"]}";

$result = mysqli_query($link, $consulta);

while ($fila = mysqli_fetch_assoc($result)) {
    $filas[] = $fila;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva Compra</title>

    <style>
        .tabla_totales .row {
            margin-bottom: 10px;
        }

        .tab-pane {
            display: block;
            overflow: auto;
            overflow-x: hidden;
            height: 380px;
            width: 100%;
            padding: 10px;
        }
    </style>

    <?php include("../styles_carpetas.php");

    // echo $consulta;

    ?>

</head>

<body>

    <div class="container ">

        <div class="row">

            <h4 class="text-center"><strong>ORDEN DE COMPRA</strong></h4>
            
            <br>
            <div class="tab-content">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-3"><strong>Proveedor:</strong></div>
                        <div class="col-sm-8"><?php echo $filas[0]["proveedor"] ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><strong>Fecha:</strong></div>
                        <div class="col-sm-8"><?php echo date("d/m/Y", strtotime($filas[0]["fecha_compras"])); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><strong>Hora:</strong></div>
                        <div class="col-sm-8"><?php echo date("H:i", strtotime($filas[0]["fecha_compras"])); ?></div>
                    </div>
                </div>

                <div id="venta" class="">

                    <table id="tabla_venta" class="table table-hover table-bordered table-condensed">
                        <thead class="bg-success">
                            <tr>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Descripcion del Producto</th>
                                <th class="text-center">Precio Unitario</th>
                                <th class="text-center">Importe</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($filas as $i => $producto) { ?>

                                <tr>
                                    <th class="text-center"><?php echo $producto["cantidad"] ?></th>
                                    <th class="text-center"><?php echo $producto["descripcion"] ?></th>
                                    <th class="text-center"><?php echo $producto["precio"] ?></th>
                                    <th class="text-center"><?php echo $producto["importe"] ?></th>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

    <br>

    <section class="container" id="footer">
        <div class="row">
            <div class="col-sm-1 col-md-offset-7">
                <strong>TOTAL:</strong>
            </div>
            <div class="col-sm-4">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>
                    <input readonly id="total" type="text" class="form-control text-right" 
                    value="<?php echo $filas[0]["total_compras"] ?>" name="total" size="50">
                </div>
            </div>
        </div>
    </section>

    <?php include('../scripts_carpetas.php'); ?>


</body>

</html>