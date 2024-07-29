function orcamentoDB(event) {
    event.preventDefault(); // Evita o comportamento padrão do formulário

    var formData = $("#formOrcamento").serialize(); // Serializa os dados do formulário

    $.ajax({
        url: "./class/ClassOrcSite.php",
        method: "POST",
        data: formData,
        dataType: "json",
        success: function (data) {
            if (data.success) {
                // Exibe uma mensagem de sucesso
                $("#msgLogin").html("<div class='msgLogin'>" + data.success + "</div>");
                
                // Limpa o formulário
                $("#formOrcamento")[0].reset();
                
                // Opcional: Exibe uma mensagem de sucesso em vez de redirecionar
                // $("#msgLogin").html("<div class='msgLogin'>Orçamento enviado com sucesso!</div>");
            } else {
                // Exibe uma mensagem de erro
                $("#msgInvalido").html("<div class='msgInvalido'>" + data.success + "</div>");
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
            console.log("Resposta completa:", xhr.responseText);
        }
    });
}

$(document).ready(function() {
    $("#formOrcamento").on("submit", orcamentoDB);
});
