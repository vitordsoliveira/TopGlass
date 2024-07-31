// Função para manipular o login do administrador
function LoginAdmin() {
    // Adiciona um ouvinte de eventos de clique ao formulário de login do administrador
    $("#formLoginAdmin").click(function () {
      var formData = $("#formLoginAdmin").serialize(); // Serializa os dados do formulário em uma string de consulta
  
      // Envia uma requisição AJAX para o servidor
      $.ajax({
        url: "./class/ClassFuncionario.php",
        method: "POST",
        data: formData,
        dataType: "json",
  
        // SUCCESS
        success: function (data) {
          // Verifica se a resposta indica sucesso
          if (data.success) {
            // Exibe uma mensagem de sucesso
            $("#msgLogin").html(
              "<div class='msgLogin'>" + data.success + "</div>"
            );
  
            var idFuncionario = data.idFuncionario; // Obtém o ID do funcionario da resposta
            window.location.href = "https://topglass.smpsistema.com.br/admin/index.php?p=dashboard";
               // Redireciona para o dashboard do administrador
          } else {
            // Exibe uma mensagem de login inválido
            $("#msgInvalido").html(
              "<div class='msgInvalido'>" + data.success + "</div>"
            );
          }
        },
        // FIM SUCCESS
  
        // ERROR
        error: function (xhr, status, error) {
          console.log(error); // Exibe o erro no console
          console.log("Resposta completa:", xhr.responseText); // Exibe a resposta completa do servidor
        }, // FIM ERROR
      });
    });
  }
  