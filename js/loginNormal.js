$(document).ready(function () {
    function fajax(URL, parametros, metodo) {
        $.ajax({
            url: URL,
            data: parametros,
            type: 'post',
            cache: false,
            dataType: 'html', success: function (ZZx) {
                metodo(ZZx);
            },
            error: function (xhr, status) {
                alert("Existe un problema");
            }
        });
    }

    function envio() {
         alert("entra1");
        var url = "pieYcabeza.php";
        var parameto = "ejemplo";
        var metodo = function (ssw) {
           // $("#cabezara").html(ssw);
            $("#pie").html(ssw);
            
        };
        fajax(url, parameto, metodo);
    }
    alert("entra");
 envio();
});