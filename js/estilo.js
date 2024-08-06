$('.servicoDegradeA').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 10000,

  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 700,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }
  ]
});

$('.servicoDegradeV').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 10000,

  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 700,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }
  ]
});

$('.banners').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 3000,
  responsive: [
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 380,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

$('.marcas span').slick({
  slidesToShow: 6,
  slidesToScroll: 2,
  autoplay: true,
  autoplaySpeed: 700,
  responsive: [
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 380,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

/* WOW */
new WOW().init();

document.querySelector(".abrirMenu").onclick = function () {
  /* console.log("CHEGUEI AQUI!"); */
  document.documentElement.classList.add('menuAtivo');
}

document.querySelector(".fecharMenu").onclick = function () {
  /* console.log("CHEGUEI AQUI!"); */
  document.documentElement.classList.remove('menuAtivo');
}

window.onscroll = function () {
  let top = document.documentElement.scrollTop

  if (top > 200) {
    document.getElementById("menuFixo").classList.add("menu-fixo");
  } else {
    document.getElementById("menuFixo").classList.remove("menu-fixo");
  }
}

setTimeout(function() {
  document.querySelector('.message'). classList.add('hidden');
}, 15000);

/* function enviarOrcamento(event) {
  event.preventDefault(); // Impede o envio imediato do formulário

  // Coleta os valores dos campos do formulário
  let assuntos = "Site Vidracaria";
  let nome = 'Nome: ' + document.getElementById('nomeCliente').value;
  let num = 'Telefone: ' + document.getElementById('numeroCliente').value;
  let email = 'E-mail: ' + document.getElementById('emailCliente').value;
  let end = 'Endereço: ' + document.getElementById('enderecoCliente').value;
  let servicosV = 'Serviço de Vidro: ' + document.getElementById('idServicoVIDRO').value;
  let servicosE = 'Serviço de Esquadria: ' + document.getElementById('idServicoESPELHO').value;
  let altura = 'Altura: ' + document.getElementById('alturaOrcamento').value;
  let largura = 'Largura: ' + document.getElementById('larguraOrcamento').value;
  let coment = 'Comentário: ' + document.getElementById('comentOrcamento').value;

  // Define o número do WhatsApp e o separador de linha
  let numeroWhats = '5511985726758';
  let quebraDeLinha = '%0A';

  // Monta a mensagem com as informações coletadas
  var mensagem = encodeURIComponent(
    assuntos + quebraDeLinha +
    nome + quebraDeLinha +
    email + quebraDeLinha +
    num + quebraDeLinha +
    end + quebraDeLinha +
    servicosV + quebraDeLinha +
    servicosE + quebraDeLinha +
    altura + quebraDeLinha +
    largura + quebraDeLinha +
    coment
  );

  // Abre a janela do WhatsApp com a mensagem
  window.open("https://api.whatsapp.com/send?phone=" + numeroWhats + '&text=' + mensagem, "_blank");

  // Limpa os campos do formulário
  document.getElementById('nomeCliente').value = '';
  document.getElementById('emailCliente').value = '';
  document.getElementById('numeroCliente').value = '';
  document.getElementById('enderecoCliente').value = '';
  document.getElementById('idServicoVIDRO').value = '';
  document.getElementById('idServicoESPELHO').value = '';
  document.getElementById('alturaOrcamento').value = '';
  document.getElementById('larguraOrcamento').value = '';
  document.getElementById('comentOrcamento').value = '';

  // Submete o formulário para o servidor
  document.getElementById('formOrcamento').submit();
} */

  document.addEventListener('DOMContentLoaded', function() {
    const increaseBtn = document.getElementById('increase-font');
    const decreaseBtn = document.getElementById('decrease-font');
    
    function adjustFontSize(factor) {
        document.querySelectorAll('h1, h2, h3, h4, p').forEach(element => {
            // Obtém o tamanho atual da fonte
            let currentFontSize = window.getComputedStyle(element).fontSize;
            currentFontSize = parseFloat(currentFontSize); // Converte para número
            
            // Ajusta o tamanho da fonte com base no fator
            let newFontSize = currentFontSize * factor;
            // Define o novo tamanho da fonte
            element.style.fontSize = `${newFontSize}px`;
        });
    }

    increaseBtn.addEventListener('click', function() {
        adjustFontSize(1.1); // Aumenta o tamanho da fonte em 10%
    });

    decreaseBtn.addEventListener('click', function() {
        adjustFontSize(0.9); // Diminui o tamanho da fonte em 10%
    });
});

document.addEventListener('DOMContentLoaded', function() {
  const toggleBtn = document.getElementById('accessibility-toggle');
  const accessibilityBtns = document.getElementById('accessibility-btn');

  toggleBtn.addEventListener('click', function() {
      if (accessibilityBtns.classList.contains('show')) {
          accessibilityBtns.classList.remove('show');
          setTimeout(() => {
              accessibilityBtns.style.opacity = '0'; // Adiciona uma animação de desaparecimento
          }, 300); // Espera o tempo da animação antes de esconder
      } else {
          accessibilityBtns.style.opacity = '1'; // Adiciona uma animação de aparecimento
          accessibilityBtns.classList.add('show');
      }
  });
});


