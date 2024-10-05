function init() {
}
var url = "http://127.0.0.1/shieldguard";

$(document).ready(function () {

    document.getElementById("btn_consultar_partners").addEventListener("click", function () {
        window.open(url + "/Home/View/Empresa_usuario/Mis_empresas_clientes/Consultar_partners/consultar_partners.php")
    })

    $.post("../../../Controller/ctrEmpresa.php?empre=get_count_total_empresas",
        function (data, textStatus, jqXHR) {
            console.log(data);
            document.getElementById("lbl_total_consultar_partners").innerText = data.total;

        },
        "json"
    );

    $.post("../../../Controller/ctrEmpresa.php?empre=get_count_total_empresas_alta",
        function (data, textStatus, jqXHR) {
            console.log(data);
            document.getElementById("btn_consultar_altas_partners").innerText = data.total;

        },
        "json"
    );

    $.post("../../../Controller/ctrEmpresa.php?empre=get_count_total_empresas_baja",
    function (data, textStatus, jqXHR) {
        console.log(data);
        document.getElementById("btn_consultar_baja_partners").innerText = data.total;

    },
    "json"
);


});


init();