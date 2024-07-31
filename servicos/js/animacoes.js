/*BANNER*/
$('.banner').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
});


/*SLIDE SERVICO*/
$('.slideServico').slick({
  slidesToShow: 3,
  slidesToScroll: 3,
  autoplay: true,
  autoplaySpeed: 10000,

  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 700,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

/*GALERIA*/
$('.galeria div').slick({
  slidesToShow: 5,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 5000,

  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3
      }
    },
    {
      breakpoint: 700,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]

});

$('.boxProjeto').slick({
  slidesToShow: 3,
  slidesToScroll: 3,
  autoplay: true,
  autoplaySpeed: 5000,

  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 700,
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
  /* console.log("SAI DAQUI! " + top); */
  if (top > 700) {
    document.getElementById("menu-fixo").classList.add("menuFixo");
  } else {
    document.getElementById("menu-fixo").classList.remove("menuFixo");
  }
}

/* FORM CONTATO WHATSAPP*/



function EnviarWhats() {

  let assuntos = "Site Oficina Auto Mestre";
  let nome = 'Nome: ' + document.getElementById('nome').value;
  let fone = 'Telefone: ' + document.getElementById('fone').value;
  let email = 'E=mail: ' + document.getElementById('email').value;
  let mens = 'Mensagem: ' + document.getElementById('mens').value;

  let numeroWhats = '5511985726758';

  let quebraDeLinha = '%0A';

  var mensagem = encodeURIComponent(assunto + quebraDeLinha + nome + quebraDeLinha + email + quebraDeLinha + fone + quebraDeLinha + mens);

  window.open("https://api.whatsapp.com/send?phone" + numeroWhats + '&text=' + mensagem, "_blank");

  document.getElementById('nome').value ='';
  document.getElementById('email').value ='';
  document.getElementById('fone').value ='';
  document.getElementById('mens').value ='';
}
