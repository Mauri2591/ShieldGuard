function init() {

}

var url="http://127.0.0.1/shieldguard";

var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1000
});

$(document).ready(function () {

    tabla = $("#table_consultar_partners").DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lenghtChange: false,
        colReorder: true,
        buttons: [
            {
                extend: 'copyHtml5',
                className: 'btn btn-info btn-xs'
            },
            {
                extend: 'excelHtml5',
                className: 'btn btn-info btn-xs'
            },
            {
                extend: 'csvHtml5',
                className: 'btn btn-info btn-xs'
            },
            {
                extend: 'pdfHtml5',
                className: 'btn btn-info btn-xs'
            }
        ],
        "ajax": {
            url: "../../../../Controller/ctrEmpresa.php?empre=consultar_partners",
            type: "post",
            dataType: "json",
            data: {
                // est: 1
            },
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "order": [[0, "desc"]], //Ordenar descendentemente
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

});

function limpiar_inputs_formulario_agregar_empresa() {
    $("#empresa_nombre").val('');
    $("#empresa_cuit").val('');
    $("#empresa_razon_social").val('');
}


function btn_alta_empresa() {
    document.getElementById("btn_alta_empresa").addEventListener("click", function () {
        limpiar_inputs_formulario_agregar_empresa()
        $("#mdlAltaPartner").modal("show");
    })
}
btn_alta_empresa()


function agregar_empresa() {
    function datos() {
        let registro = {
            empresa_nombre: $("#empresa_nombre").val(),
            empresa_cuit: $("#empresa_cuit").val(),
            empresa_razon_social: $("#empresa_razon_social").val()
        }
        return registro;
    }
    function ajax_agregar_empresa(registro) {
        $.ajax({
            type: "POST",
            url: "../../../../Controller/ctrEmpresa.php?empre=agregar_empresa",
            data: registro,
            dataType: "json",
            success: function (response) {
                console.log(response);
            }, error: function (e) {
                console.log(e);
            }
        });
    }

    document.getElementById("btnAgregarEmpresa").addEventListener("click", function () {
        let registro = datos();
        if (registro.empresa_cuit == '' || registro.empresa_nombre == '' || registro.empresa_razon_social == '') {
            Swal.fire({
                icon: "warning",
                title: "Error",
                text: "Todos los campos son obligatorios!",
                showConfirmButton: true,
                showCancelButton: true
            })
        } else {
            ajax_agregar_empresa(registro);
            $("#mdlAltaPartner").modal("hide");
            Swal.fire({
                icon: "success",
                title: "Bien",
                text: "Partner registrado correctamente!",
                showConfirmButton: false,
                showCancelButton: false,
                timer: 1100
            })
            $("#table_consultar_partners").DataTable().ajax.reload();
            $("#tableLogsEventosPartners").DataTable().ajax.reload();
        }
    });
}
agregar_empresa()

function btnVer_partner(empresa_id) {
    window.open(url+"/Home/View/Empresa_usuario/Mis_empresas_clientes/Consultar_partners/Detalle_partners/?empresa_id="+empresa_id);
}

function btnInactivar_partner(empresa_id) {
    Swal.fire({
        icon: "warning",
        title: "Atencion!",
        text: "Desea cambiar el estado del Partner?",
        showCancelButton: true,
        showConfirmButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            try {
                $.post("../../../../Controller/ctrEmpresa.php?empre=update_inactivar_empresa", { empresa_id: empresa_id },
                    function (data, textStatus, jqXHR) {
                    },
                    "json"
                );
                $("#table_consultar_partners").DataTable().ajax.reload();
                $("#tableLogsEventosPartners").DataTable().ajax.reload();
                Toast.fire({
                    icon: 'success',
                    title: 'Partner cambiado de estado correctamente!'
                });
            } catch (error) {
                console.log(error);
            }
        }
    })
}

function btnActivar_partner(empresa_id) {
    Swal.fire({
        icon: "warning",
        title: "Atencion!",
        text: "Desea cambiar el estado del Partner?",
        showCancelButton: true,
        showConfirmButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            try {
                $.post("../../../../Controller/ctrEmpresa.php?empre=update_activar_empresa", { empresa_id: empresa_id },
                    function (data, textStatus, jqXHR) {
                    },
                    "json"
                );
                $("#table_consultar_partners").DataTable().ajax.reload();
                $("#tableLogsEventosPartners").DataTable().ajax.reload();
                Toast.fire({
                    icon: 'success',
                    title: 'Partner cambiado de estado correctamente!'
                })
            } catch (error) {
                console.log(error);
            }
        }
    })
}

document.getElementById("btn_ver_logs_actividad_partner").addEventListener("click",function(){
    $("#mdlLogsEventosPartners").modal("show");
})

init();