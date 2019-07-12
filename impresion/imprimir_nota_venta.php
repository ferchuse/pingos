<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Venta Nogui</title>

    <!----- Bootstrap & CSS ----->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../css/bootstrap_four.min.css"> -->
    <link rel="stylesheet" href="../css/imprimir_nota_venta.css">
</head>

<body>
    <div class="container w-container pr-0 pl-0 mt-3">
        <!----- "Nota De Venta" (Inabilitado) ----->
        <div class="row h-one justify-content-end">
            <div class="col w-one pr-0 pl-0 h-full border-green">
                <div class="row">
                </div>
            </div>
        </div>

        <!----- "Cliente, Vendedor & Fecha" ----->
        <div class="row h-one justify-content-between margin-top">
            <div class="col h-full w-two pr-0 pl-0 h-full border-black">
                <div class="row h-half w-full no-gutters">
                    <div class="col-3 h-full pl-1 pr-0 bg-mark">CLIENTE</div>
                    <div class="col-9 h-full pl-1 pr-0">DAVID RENDÓN SOTO</div>
                </div>
                <div class="row h-half w-full no-gutters">
                    <div class="col-3 h-full pl-1 pr-0 bg-mark">VENDEDOR</div>
                    <div class="col-9 h-full pl-1 pr-0">FERNANDO GUZMÁN AGUADO</div>
                </div>
            </div>

            <div class="col w-three pr-0 pl-0 h-full border-black">
                <div class="row text-center h-full w-full no-gutters">
                    <div class="col-12 h-half pl-0 pr-0 bg-mark">FECHA</div>

                    <div class="col-12 h-half pl-0 pr-0">
                        <div class="row h-full w-full no-gutters">
                            <div class="col-4 h-full">DÍA</div>
                            <div class="col-4 h-full">MES</div>
                            <div class="col-4 h-full">AÑO</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!----- "Tabla: Datos Del Producto" ----->
        <div class="row h-two margin-top">
            <div class="col pr-0 pl-0 h-full border-black">
                <div class="row"></div>
            </div>
        </div>

        <!----- Observaciones, Pronto Pago, Total... ----->
        <div class="row h-three mt-3">
            <div class="col pr-0 pl-0 h-full border-black">
                <div class="row"></div>
            </div>
        </div>
    </div>
</body>

</html>