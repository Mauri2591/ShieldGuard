$(document).ready(function () {

    tabla = $("#tableLogsEventosPartners").DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lenghtChange: false,
        colReorder: true,
        buttons: [
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
            url: "../../../../Controller/ctrEmpresa.php?empre=logs_empresas_partners",
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
        "iDisplayLength": 10, //cantidad de tuplas o filas a mostrar
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
