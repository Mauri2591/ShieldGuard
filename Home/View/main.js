

$(document).ready(function () {

    tabla = $("#table_vulns_cve").DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lenghtChange: false,
        colReorder: true,
        buttons: [ //Edito los botones
            // {
            //     extend: 'copyHtml5',
            //     className: 'btn btn-secondary btn-xs'
            // },
            // {
            //     extend: 'excelHtml5',
            //     className: 'btn btn-secondary btn-xs'
            // },
            // {
            //     extend: 'csvHtml5',
            //     className: 'btn btn-secondary btn-xs'
            // },
            // {
            //     extend: 'pdfHtml5',
            //     className: 'btn btn-secondary btn-xs'
            // }
        ],
        "ajax": {
            url: "../Controller/ctrApiCvd.php?op_api=get_vulnerability_total",
            type: "post",
            dataType: "json",
            data: {
                // est: 1
            },
            error: function (e) {
                console.log(e.responseText);
            },
            success: function (data) {
                if (data) {
                    document.getElementById("snipper_table_vulns_cve").style.display = "none";
                } else {
                    document.getElementById("snipper_table_vulns_cve").style.display = "flex";
                }
                // Asigno los datos recibidos a la tabla DataTable
                tabla.clear().rows.add(data.aaData).draw();
            }
        },
        // "order": [[0, "desc"]], //Ordenar descendentemente
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 7, //cantidad de tuplas o filas a mostrar
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

function get_datos_cve(){
    $("#last_modif_cve").html("");
    $("#descrip_cve").html("");
    $("#lista_referencias_cve").html("");
    $("#last_modif_cve").html("")
}



function convertirFecha(fechaOriginal) {
    var fecha = new Date(fechaOriginal);
    var dia = fecha.getDate();
    var mes = fecha.getMonth() + 1; 
    var anio = fecha.getFullYear();
    var fechaFormateada = dia + '-' + mes + '-' + anio;
    return fechaFormateada;
}


function ver_cve(id) {
    get_datos_cve();

    $("#mdl_ver_cve_detalle").modal("show");
    document.getElementById("titulo_cve").innerText = id;
    document.getElementById("snipper_mdl_vulns_cve").style.display = "flex";

    var timeout = 20000;

    var timer = setTimeout(function () {
        showAlert();
    }, timeout);

    $.post("../Controller/ctrApiCvd.php?op_api=get_vulnerability_details", { id: id },
        function (data, textStatus, jqXHR) {
            clearTimeout(timer); // Limpiar el temporizador

            if (textStatus !== "success" || !data) {
                document.getElementById("snipper_mdl_vulns_cve").style.display = "none";
                console.log("Error en la solicitud");
                showAlert();
            } else {
                let htmlUl='';
                let data_ref=data.vulnerabilities[0].cve.references;
                data_ref.forEach(elem => {
                    htmlUl+=`
                    <li class="list-group-item p-0">
                        <a style="font-size: .8em; id="referencias_cve" href="${elem.url}" target="_blank" rel="noopener noreferrer">${elem.url}</a>
                    </li>`;
                    return htmlUl;
                }
            );
            document.getElementById("lista_referencias_cve").innerHTML=htmlUl;

                document.getElementById("snipper_mdl_vulns_cve").style.display = "none"; 
                console.log(data);   
                document.getElementById("last_modif_cve").innerText=convertirFecha(data.vulnerabilities[0].cve.lastModified);
                document.getElementById("descrip_cve").innerText=data.vulnerabilities[0].cve.descriptions[0].value;
            }
        },
        "json"
    );
}

function showAlert() {
    Swal.fire({
        icon: "warning",
        title: "Error!",
        text: "Se agoto el tiempo de espera",
        showCancerButton: false,
        showConfirmButton: true
    }).then((result)=>{
        if(result.isConfirmed){
            $("#mdl_ver_cve_detalle").modal("hide");
            $("#titulo_cve").html("");
        }
    })
}



$(document).ready(function () {
    $.post("../Controller/ctrApiCvd.php?op_api=get_vulnerability_details_pruebas",
        function (data, textStatus, jqXHR) {
            console.log(data);
        },
        "json"
    );
});