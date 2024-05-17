$('.servicoDegrade').slick({
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
  document.querySelector('.message').classList.add('hidden');
}, 15000);

function enviarOrcamento() {

  let assuntos = "Site Vidracaria";
  let nome = 'Nome: ' + document.getElementById('nome').value;
  let num = 'Telefone: ' + document.getElementById('num').value;
  let email = 'E=mail: ' + document.getElementById('email').value;
  let end = 'Endereço: ' + document.getElementById('end').value;
  let servicosV = 'Serviço de Vidro: ' + document.getElementById('servicosVidro').value;
  let ServicosE = 'Serviço de Esquadria: ' + document.getElementById('servicosEsquadria').value;
  let altura = 'Altura: ' + document.getElementById('altura').value;
  let largura = 'Largura: ' + document.getElementById('largura').value;
  let coment = 'Comentário: ' + document.getElementById('coment').value;

  let numeroWhats = '5511985726758';

  let quebraDeLinha = '%0A';

  var mensagem = encodeURIComponent(assunto + quebraDeLinha + nome + quebraDeLinha + email + quebraDeLinha + num + quebraDeLinha + end + quebraDeLinha + servicosV + quebraDeLinha + ServicosE + quebraDeLinha + coment);

  window.open("https://api.whatsapp.com/send?phone" + numeroWhats + '&text=' + mensagem, "_blank");

  document.getElementById('nome').value ='';
  document.getElementById('email').value ='';
  document.getElementById('num').value ='';
  document.getElementById('end').value ='';
  document.getElementById('servicosVidro').value ='';
  document.getElementById('servicosEsquadria').value ='';
  document.getElementById('coment').value ='';
  
}
