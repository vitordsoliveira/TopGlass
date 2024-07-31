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
                // Limpa o formulário
                $("#formOrcamento")[0].reset();
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
