function init(){
}

var url="http://127.0.0.1/shieldguard";
$(document).ready(function () {
    $.post("../../../Controller/ctrUsuarioEmpresa.php?usuario_empresa=get_total_usuarios_empresa",
        function (data, textStatus, jqXHR) {
            document.getElementById("lbl_consultar_total_usuarios").innerText=data.total;
        },
        "json"
    );

    document.getElementById("btn_mis_usuarios_empresa").addEventListener("click",function(){
        window.open(url+"/Home/View/Empresa_usuario/Mi_empresa/Mis_usuarios/");

    })
});

init();