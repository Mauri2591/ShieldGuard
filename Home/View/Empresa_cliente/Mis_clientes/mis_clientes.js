function init() { }
var tabla;
var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1300
});

$(document).ready(function () {
    tabla = $("#table_detalle_cliente").DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lenghtChange: false,
        colReorder: true,
        buttons: [ //Edito los botones
            {
                extend: 'copyHtml5',
                className: 'btn btn-light btn-xs'
            },
            {
                extend: 'excelHtml5',
                className: 'btn btn-light btn-xs'
            },
            {
                extend: 'csvHtml5',
                className: 'btn btn-light btn-xs'
            },
            {
                extend: 'pdfHtml5',
                className: 'btn btn-light btn-xs'
            }
        ],
        "ajax": {
            url: "../../../Controller/ctrCliente.php?op_cliente=get_total_cliente",
            type: "post",
            dataType: "json",
            data: {
                // est: 1
            },
            error: function (e) {
                // console.log(e.responseText);
            },
            // success: function(data) {
            //     if (data) {
            //         document.getElementById("snipper_table_vulns_cve").style.display = "none";
            //     } else {
            //         document.getElementById("snipper_table_vulns_cve").style.display = "flex";
            //     }
            //     // Asigno los datos recibidos a la tabla DataTable
            //     tabla.clear().rows.add(data.aaData).draw();
            // }
        },
        "order": [[0, "desc"]],
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 5, //cantidad de tuplas o filas a mostrar
        "autoWith": false,
        "language": {
            "sProcessing": "Procesando..",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados..",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando un total de 0 registros",
            "sInfoFiltered": "(Filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar: ",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Ùltimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ":Activar para ordenar la columna de manera ascendiente",
                "sSortDescending": ":Activar para ordenar la columna de manera descendiente"
            }
        }
    });

    $.post("../../../Controller/ctrCliente.php?op_cliente=get_total_clientes_iconos",
        function (data, textStatus, jqXHR) {
            console.log(data);
            document.getElementById("lbl_total_consultar_clientes").innerText = data.total;
            document.getElementById("lbl_clientes_activos").innerText = data.total_activos;
            document.getElementById("lbl_clientes_inactivos").innerText = data.total_inactivos;
        },
        "json"
    );

    function limpiar_modalNuevoCLiente() {
        $("#cliente_nombre").val('');
        $("#cliente_razon_social").val('');
        $("#id_tipo_cliente").val('');
        $("#cliente_cuil_cuit").val('')
    }

    document.getElementById("btn_agregar_cliente").addEventListener("click", function () {
        $.post("../../../Controller/ctrCliente.php?op_cliente=get_tipo_cliente",
            function (data, textStatus, jqXHR) {
                document.getElementById("id_tipo_cliente").innerHTML = data;
            },
            "html"
        );

        limpiar_modalNuevoCLiente();

        $("#mdlNuevoCliente").modal("show");

        $("#cliente_cuil_cuit").attr("placeholder", "Ingrese el CUIT"); // Si es '1', se asume CUIT
        $("#id_tipo_cliente").change(function () {
            var tipoCliente = $(this).val();
            if (tipoCliente === '1') {
                $("#cliente_cuil_cuit").attr("placeholder", "Ingrese el CUIT"); // Si es 1
            } else if (tipoCliente === '2') {
                $("#cliente_cuil_cuit").attr("placeholder", "Ingrese el CUIL"); // Si es 2
            }
        });
    })

    function get_datos() {
        let registro = {
            cliente_nombre: $("#cliente_nombre").val(),
            cliente_razon_social: $("#cliente_razon_social").val(),
            id_tipo_cliente: $("#id_tipo_cliente").val(),
            cliente_cuit_cuil: $("#cliente_cuil_cuit").val()
        }
        return registro;
    }

    function inser_cliente_ajax(registro) {
        $.ajax({
            type: "POST",
            url: "../../../Controller/ctrCliente.php?op_cliente=insert_nuevo_cliente",
            data: registro,
            dataType: "json",
            success: function (response) {
                // console.log(response);
            }, error: function (error) {
                // console.log(error);
            }
        });
    }

    document.getElementById("btn_insertar_cliente").addEventListener("click", function () {
        let registro = get_datos();
        if (registro.cliente_cuit_cuil == '' || registro.cliente_nombre == '' || registro.cliente_razon_social == '' || registro.id_tipo_cliente == '') {
            Swal.fire({
                icon: "warning",
                title: "Error",
                text: "Datos vacios, debe llenar todos los campos!",
                showConfirmButton: true,
                showCancelButton: false
            });
        } else {
            inser_cliente_ajax(registro);
            $("#table_detalle_cliente").DataTable().ajax.reload();
            $("#table_iconos").DataTable().ajax.reload();
            Toast.fire({
                icon: 'success',
                title: 'Agregado correctamente.'
            })
            $("#mdlNuevoCliente").modal("hide");
        }
    })
});

function dar_baja_cliente(cliente_id) {

    $.post("../../../Controller/ctrCliente.php?op_cliente=get_estado_cliente", {cliente_id:cliente_id},
        function (data, textStatus, jqXHR) {
            if(data.cliente_estado === 'Activo'){
                Swal.fire({
                    icon: "question",
                    title: "¿Desea Inactivar este cliente?",
                    text: "Se es asi recuerde que puede volver a darlo de alta cuando desee.",
                    showCancelButton: true,
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'No',
                    cancelButtonColor: '#3085d6',
                    confirmButtonColor: '#d33',
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("../../../Controller/ctrCliente.php?op_cliente=update_cliente_inactivar", {cliente_id:cliente_id},
                            function (data, textStatus, jqXHR) {
                                console.log(data);
                            },
                        );
                        Toast.fire({
                            icon: 'success',
                            title: 'Cliente dado de baja correctamente.'
                        })
                    }
                    $("#table_detalle_cliente").DataTable().ajax.reload();
                })
            }else{
                Swal.fire({
                    icon: "question",
                    title: "¿Desea Activar este cliente?",
                    text: "Se es asi volvera a estar operativo nuevamente.",
                    showCancelButton: true,
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'No',
                    cancelButtonColor: '#3085d6',
                    confirmButtonColor: '#d33',
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("../../../Controller/ctrCliente.php?op_cliente=update_cliente_activar", {cliente_id:cliente_id},
                            function (data, textStatus, jqXHR) {
                                console.log(data);
                            },
                        );
                        Toast.fire({
                            icon: 'success',
                            title: 'Cliente dado de alta correctamente.'
                        })
                    }
                    $("#table_detalle_cliente").DataTable().ajax.reload();
                })
            }
        },
        "json"
    );
    
    
}

init();