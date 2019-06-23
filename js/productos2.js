

$(document).ready(function () {
    $("#form_filtros").submit(function () {
        listaProductos();
        return false;
    })

    function listaProductos() {
        let tableTemplate;
        let $boton = $("#form_filtros").find(":submit");
        let $icono = $boton.find(".fa");
        $boton.prop("disabled", true)
        $icono.toggleClass("fa-search fa-spinner fa-spin");
        $.ajax({
            url: 'productos/productos2.php',
            dataType: 'JSON',
            data: $("#form_filtros").serializeArray()
        }).done(function (respuesta) {
            $.each(respuesta, function (index, value) {
                tableTemplate += ` <tr>
                <td> class="text-center">${value.descripcion_productos} S</td>
                <td> class="text-center">${value.nombre_departamento} </td>
                <td> class="text-center">${value.costo_proveedor} </td>
                <td> class="text-center">${value.ganancia_menudeo_porc} </td>
                <td> class="text-center">${value.precio_menudeo} </td>
                <td> class="text-center">${value.precio_mayoreo} </td>
                <td> class="text-center">${value.min_productos} </td>
                <td> class="text-center">${value.existencia_productos} </td>
                
        </tr>  `;

            });

            $('#bodyProductos').html(tableTemplate)
            $("#tabla_productos").stickyTableHeaders();
            $boton.prop("disabled", false)
            $icono.toggleClass("fa-search fa-spinner fa-spin");

            //----FILTROS DE BUSCAR------
            $(".buscar_codigo").keyup(function filtro_buscar() {
                var indice = $(this).data("indice");
                var valor_filtro = $(this).val();
                var num_rows = buscar(valor_filtro, 'tabla_productos', indice);
                if (num_rows == 0) {
                    $('#mensaje').html("<div class='alert alert-warning text-center'><strong>No se ha encontrado.</strong></div>");
                } else {
                    $('#mensaje').html('');
                }
            });
            $(".buscar_descripcion").keyup(function filtro_buscar() {
                var indice = $(this).data("indice");
                var valor_filtro = $(this).val();
                var num_rows = buscar(valor_filtro, 'tabla_productos', indice);
                if (num_rows == 0) {
                    $('#mensaje').html("<div class='alert alert-warning text-center'><strong>No se ha encontrado.</strong></div>");
                } else {
                    $('#mensaje').html('');
                }
            });
            //-----ELIMINAR PRODUCTOS------
            $('.btn_eliminar').click(function () {
                var boton = $(this);
                var icono = boton.find('.fa');
                var fila = boton.closest('tr');
                boton.prop('disabled', true);
                icono.toggleClass('fa-trash fa-spinner fa-spin fa-floppy-o');
                var id_producto = boton.data('id_producto');
                function eliminarProductos() {
                    $.ajax({
                        url: 'control/eliminar_normal.php',
                        method: 'POST',
                        dataType: 'JSON',
                        data: { tabla: 'productos', campo: 'id_productos', id_campo: id_producto }
                    }).done(function (respuesta) {
                        if (respuesta.estatus == 'success') {
                            alertify.success('Se ha eliminado correctamente');
                            fila.fadeOut(2000);
                        } else {
                            alertify.error('No se ha podido eliminar');
                        }
                    }).always(function () {
                        boton.prop('disabled', false);
                        icono.toggleClass('fa-trash fa-spinner fa-spin fa-floppy-o');
                    });
                }
                alertify.confirm('Confirmacion', '¿Desea eliminarlo?', eliminarProductos, function () {
                    icono.toggleClass("fa-trash fa-spinner fa-spin fa-floppy-o");
                    boton.prop('disabled', false);
                });
            });

            //---------EDITAR PRODUCTOS --------------
            $('.btn_editar').click(function () {
                $('#form_productos')[0].reset();
                var boton = $(this);
                var icono = boton.find('.fa');
                icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
                boton.prop('disabled', true);
                var id_productos = boton.data('id_producto');
                $.ajax({
                    url: 'control/buscar_normal.php',
                    method: 'POST',
                    dataType: 'JSON',
                    data: { campo: 'id_productos', tabla: 'productos', id_campo: id_productos }
                }).done(function (respuesta) {
                    if (respuesta.encontrado == 1) {
                        $.each(respuesta["fila"], function (name, value) {

                            $('#input_granel').html('');
                            $.each(respuesta["fila"], function (name, value) {

                                $("#form_productos").find("#" + name).val(value);
                            });

                        });
                        $('h3.modal-title').text('Editar Producto');
                        $('#modal_productos').modal('show');
                    }
                    icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
                    boton.prop('disabled', false);
                });

            });

            $('.btn_existencia').click(pedirCantidad);


        });
    }


    listaProductos();

    $('#btn_alta').click(function () {
        $('#form_productos')[0].reset();
        $('h3.modal-title').text('Nuevo Producto');
        $('#modal_productos').modal('show');
    });
    //--------CHECAR DUPLICADOS------
    $('#codigo_productos').keyup(function () {
        var producto = $(this).val();
        $.ajax({
            url: 'control/checar_repetidos.php',
            method: 'POST',
            dataType: 'JSON',
            data: { producto: producto }
        }).done(function (respuesta) {
            if (respuesta.repetidos > 0) {
                $('#btn_formAlta').prop('disabled', true);
                $('#respuesta_rep').text('(Existentente)');
            } else {
                $('#btn_formAlta').prop('disabled', false);
                $('#respuesta_rep').text('');
            }
        });
    });
    //-------ALTA DE PRODUCTOS-----
    $('#form_productos').submit(function guardarProducto(event) {
        event.preventDefault();
        var boton = $(this).find(':submit');
        var icono = boton.find('.fa');
        boton.prop('disabled', true);
        icono.toggleClass('fa-save fa-spinner fa-spin');

        var formulario = $(this).serializeArray();
        console.log("formulario: ", formulario)
        $.ajax({
            url: 'control/guardar_producto.php',
            dataType: 'JSON',
            method: 'POST',
            data: formulario
        }).done(function (respuesta) {
            console.log(respuesta);
            if (respuesta.estatus == "success") {
                alertify.success('Se ha guardado correctamente');
                $('#modal_productos').modal('hide');
                listaProductos();
            } else {
                alertify.error('Error al guardar');
                //console.log(respuesta.mensaje);
            }
        }).always(function () {
            boton.prop('disabled', false);
            icono.toggleClass('fa-save fa-spinner fa-spin');
        });

    });

    //CANTIDAD CONTENEDORA
    $('#cantidad_contenedora').keyup(function () {
        var cantidad_contenedora = Number($(this).val());
        var costo_proveedor = Number($('#costo_proveedor').val());

        if (costo_proveedor != '') {
            var costo_pz = costo_proveedor / cantidad_contenedora;
            $('#costo_unitario').val(costo_pz.toFixed(2));

            if (costo_pz != '') {

                //ganancia menudeo
                var ganancia_menudeo_porc = Number($('#ganancia_menudeo_porc').val());
                var ganancia_menudeo_pesos = (ganancia_menudeo_porc * costo_pz) / 100;
                $('#ganancia_menudeo_pesos').val(ganancia_menudeo_pesos.toFixed(2));

                //precio mayoreo
                var precio_menudeo = costo_pz + ganancia_menudeo_pesos;
                $('#precio_menudeo').val(precio_menudeo.toFixed(2));

            }
        }
    });

    //COSTO PROVEEDOR
    $('#costo_proveedor').keyup(function modificarPrecio() {
        console.log("modificarPrecio");
        var costo_proveedor = Number($(this).val());
        var cantidad_contenedora = Number($('#cantidad_contenedora').val());
        var ganancia_mayoreo_porc = Number($('#ganancia_mayoreo_porc').val());

        if (ganancia_mayoreo_porc != '') {

            //ganancia mayoreo
            var ganancia_mayoreo_pesos = (ganancia_mayoreo_porc * costo_proveedor) / 100;
            $('#ganancia_mayoreo_pesos').val(ganancia_mayoreo_pesos.toFixed(2));
            // $('#precio_mayoreo').val((costo_proveedor+ganancia_mayoreo_pesos).toFixed(2));
        }

        if (cantidad_contenedora != '') {
            var costo_pz = costo_proveedor / cantidad_contenedora;
            $('#costo_unitario').val(costo_pz.toFixed(2));

            if (costo_pz != '') {

                //ganancia menudeo
                var ganancia_menudeo_porc = Number($('#ganancia_menudeo_porc').val());
                var ganancia_menudeo_pesos = (ganancia_menudeo_porc * costo_pz) / 100;
                $('#ganancia_menudeo_pesos').val(ganancia_menudeo_pesos.toFixed(2));

                //precio mayoreo
                var precio_menudeo = costo_pz + ganancia_menudeo_pesos;
                $('#precio_menudeo').val(precio_menudeo.toFixed(2));

            }
        }
    });

    //GANANCIA MAYOREO PORCENTAJE
    $('#ganancia_mayoreo_porc').keyup(function () {
        var ganancia_mayoreo_porc = Number($(this).val());
        var costo_proveedor = Number($('#costo_proveedor').val());

        if (costo_proveedor != '') {
            var ganancia_mayoreo_pesos = (ganancia_mayoreo_porc * costo_proveedor) / 100;
            $('#ganancia_mayoreo_pesos').val(ganancia_mayoreo_pesos.toFixed(2));
            var precio_mayoreo = ganancia_mayoreo_pesos + costo_proveedor;
            $('#precio_mayoreo').val(precio_mayoreo.toFixed(2));
        }

    });

    //PRECIO MAYOREO
    $('#precio_mayoreo').keyup(function () {
        var precio_mayoreo = Number($(this).val());
        var costo_proveedor = Number($('#costo_proveedor').val());

        if (costo_proveedor != '') {
            var ganancia_mayoreo_pesos = precio_mayoreo - costo_proveedor;
            $('#ganancia_mayoreo_pesos').val(ganancia_mayoreo_pesos.toFixed(2));

            var ganancia_mayoreo_porc = ((precio_mayoreo * 100) / costo_proveedor) - 100;
            $('#ganancia_mayoreo_porc').val(ganancia_mayoreo_porc.toFixed(2));
        }
    });

    //GANANCIA MENUDEO PORCENTAJE
    $('#ganancia_menudeo_porc').keyup(function () {
        console.log("calculaPrecioVenta");

        var ganancia_menudeo_porc = Number($(this).val());
        // var costo_unitario = Number($('#costo_unitario').val());
        var costo_unitario = Number($('#costo_proveedor').val());

        if (costo_unitario != '') {
            var ganancia_menudeo_pesos = (ganancia_menudeo_porc * costo_unitario) / 100;
            $('#ganancia_menudeo_pesos').val(ganancia_menudeo_pesos.toFixed(2));
            var precio_menudeo = costo_unitario + ganancia_menudeo_pesos;
            $('#precio_menudeo').val(precio_menudeo.toFixed(2));
        }

    });

    //PRECIO MENUDEO
    $('#precio_menudeo').keyup(function calculaGanancia() {
        console.log("calculaGanancia()")
        var precio_menudeo = Number($(this).val());
        var costo_unitario = Number($('#costo_proveedor').val());

        if (costo_unitario != '') {
            var ganancia_menudeo_porc = ((precio_menudeo * 100) / costo_unitario) - 100;
            $('#ganancia_menudeo_porc').val(ganancia_menudeo_porc.toFixed(2));
            var ganancia_menudeo_pesos = precio_menudeo - costo_unitario;
            $('#ganancia_menudeo_pesos').val(ganancia_menudeo_pesos.toFixed(2));

        }
    });

    //EXISTENCIA EN CAJAS/PZ
    $('#existentes_contenedores').keyup(function () {
        var existentes_contenedores = Number($(this).val());
        var cantidad_contenedora = Number($('#cantidad_contenedora').val());

        if (cantidad_contenedora != '') {
            var existencia_productos = existentes_contenedores * cantidad_contenedora;
            $('#existencia_productos').val(existencia_productos.toFixed(2));
        }
    });

    $('#existentes_contenedores_inv').keyup(function () {
        var existentes_contenedores = Number($(this).val());
        var cantidad_contenedora = Number($('#cantidad_contenedora').val());

        if (cantidad_contenedora != '') {
            var existencia_productos = existentes_contenedores * cantidad_contenedora;
            $('#existencia_productos_inv').val(existencia_productos.toFixed(2));
        }
    });

    //SELECT GRANEL
    // $('#unidad_productos').change(function(){
    // $('#input_granel').html('<h4>Cargando...</h4>');
    // var unidad = $('#unidad_productos option:selected').val();

    // if(unidad == 'KG'){
    // $.ajax({
    // url: 'control/input_granel.php',
    // dataType: 'HTML'
    // }).done(function(respuesta){
    // $('#input_granel').html(respuesta);
    // });
    // }
    // });


});


function buscar(filtro, table_id, indice) {
    // Declare variables 
    var filter, table, tr, td, i;
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