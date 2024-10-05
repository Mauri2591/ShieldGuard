function init() {

}

var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1200
});

$(document).ready(function () {

    tabla = $("#table_consultar_usuarios_mi_empresa").DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lenghtChange: false,
        colReorder: true,
        buttons: [
            {
                extend: 'copyHtml5',
                className: 'btn btn-secondary btn-xs'
            },
            {
                extend: 'excelHtml5',
                className: 'btn btn-secondary btn-xs'
            },
            {
                extend: 'csvHtml5',
                className: 'btn btn-secondary btn-xs'
            },
            {
                extend: 'pdfHtml5',
                className: 'btn btn-secondary btn-xs'
            }
        ],
        "ajax": {
            url: "../../../../Controller/ctrUsuarioEmpresa.php?usuario_empresa=get_consultar_usuarios_mi_empresa",
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

    function generateSecureKey(length = 32) {
        const characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+[]{}|;:,.<>?';
        const charactersLength = characters.length;
        let secureKey = '';

        for (let i = 0; i < length; i++) {
            const randomIndex = crypto.getRandomValues(new Uint32Array(1))[0] % charactersLength;
            secureKey += characters[randomIndex];
        }
        return secureKey;
    }

    document.getElementById("btn_alta_usuario").addEventListener("click", function () {

        $("#password_usuario_empresa").val('');
        $("#email_usuario_empresa").val('');
        $("#mdlAltaUsuario").modal("show");

        const claveSegura = generateSecureKey();
        $("#password_usuario_empresa").val(claveSegura);

        $.post("../../../../Controller/ctrUsuarioEmpresa.php?usuario_empresa=get_rol_para_usuario",
            function (data, textStatus, jqXHR) {
                console.log(data);
                document.getElementById("rol_id").innerHTML = data;
            }
        );
    });


    function agregar_usuario_empresa() {

        function datos() {
            let registro = {
                rol_id: $("#rol_id").val(),
                email_usuario_empresa: $("#email_usuario_empresa").val(),
                password_usuario_empresa: $("#password_usuario_empresa").val()
            }
            return registro;
        }

        function ajax_agregar_usuario_empresa() {
            $.ajax({
                type: "POST",
                url: "../../../../Controller/ctrUsuarioEmpresa.php?usuario_empresa=crear_usuario_empresa",
                data: registro,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                }, error: function (e) {
                    console.log(e);
                }
            });
        }

        let registro = datos();
        if (registro.email_usuario_empresa == '') {
            Swal.fire({
                icon: "warning",
                title: "Error",
                text: "Debe completar los campos!",
                showConfirmButton: true,
                showCancelButton: true
            })
        } else {
            ajax_agregar_usuario_empresa(registro);
            $("#mdlAltaUsuario").modal("hide");
            $("#table_consultar_usuarios_mi_empresa").DataTable().ajax.reload();
            $("#tableLogsEventosUsuarios").DataTable().ajax.reload();
            Toast.fire({
                icon: 'success',
                title: 'Usuario agregado correctamente!'
            });
        }
    }

    document.getElementById("btnAgregarUsuarioEmpresa").addEventListener("click", function () {
        console.log(agregar_usuario_empresa());
    });

    document.getElementById("btn_ver_logs_actividad_usuario").addEventListener("click", function () {
        $("#mdlLogsEventosUsuarios").modal("show")
    })

});

function btnReset_password_usuario_empresa(usuario_empresa_id) {
    $("#mdlReset_Password_Usuario_empresa").modal("show");
    $("#reset_password_usuario_empresa").val('');
    document.getElementById("btnResetPasswordUsuarioEmpresa").addEventListener("click", function () {
        if ($("#reset_password_usuario_empresa").val() == "" || $("#reset_password_usuario_empresa").val() == null) {
            Swal.fire({
                icon: "warning",
                title: "Error",
                text: "Ingrese una password nueva si desea cambiarla",
                showCancelButton: true,
                showConfirmButton: true
            })
        } else {
            $.post("../../../../Controller/ctrUsuarioEmpresa.php?usuario_empresa=setear_password_usuario_empresa", { password_usuario_empresa: $("#reset_password_usuario_empresa").val(), usuario_empresa_id: usuario_empresa_id },
                function (data, textStatus, jqXHR) {

                },
                "json"
            );
            Toast.fire({
                icon: "success",
                text: "Password cambiada correctamente"
            });
            console.log($("#reset_password_usuario_empresa").val());
            $("#mdlReset_Password_Usuario_empresa").modal("hide");
            $("#tableLogsEventosUsuarios").DataTable().ajax.reload();
        }
    })
}

function btnDesactivar_usuario_empresa(usuario_empresa_id) {
    Swal.fire({
        icon: "question",
        text: "Desea cambiar el estado del usuario a Inactivo?",
        showCancelButton: true,
        showConfirmButton: true
    }).then((resul) => {
        if (resul.isConfirmed) {
            Toast.fire({
                icon: "success",
                text: "Usuario modificado correctamente!"
            })
            $.post("../../../../Controller/ctrUsuarioEmpresa.php?usuario_empresa=desactivar_usuario_empresa", { usuario_empresa_id: usuario_empresa_id },
                function (data, textStatus, jqXHR) {

                },
                "json"
            );
            $("#table_consultar_usuarios_mi_empresa").DataTable().ajax.reload();
            $("#tableLogsEventosUsuarios").DataTable().ajax.reload();
        }
    })
}


function btnActivar_usuario_empresa(usuario_empresa_id) {
    Swal.fire({
        icon: "question",
        text: "Desea cambiar el estado del usuario a Activo?",
        showCancelButton: true,
        showConfirmButton: true
    }).then((resul) => {
        if (resul.isConfirmed) {
            $.post("../../../../Controller/ctrUsuarioEmpresa.php?usuario_empresa=activar_usuario_empresa", { usuario_empresa_id: usuario_empresa_id },
                function (data, textStatus, jqXHR) {

                },
                "json"
            );
            $("#table_consultar_usuarios_mi_empresa").DataTable().ajax.reload();
            $("#tableLogsEventosUsuarios").DataTable().ajax.reload();
            Toast.fire({
                icon: "success",
                text: "Usuario modificado correctamente!"
            })
        }
    })
}

init();