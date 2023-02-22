$(function () {
  var open = true;
  var menuWidth = 200;
  var menuPadding = "10px";

  // Ajusta o tamanho do menu e do conteúdo de acordo com o tamanho da tela
  function adjustMenu() {
    var windowSize = $(window).innerWidth();

    if (windowSize <= 768) {
      closeMenu();
    } else {
      openMenu();
    }
  }

  // Abre o menu
  function openMenu() {
    $(".menu").css({
      display: "block",
      width: menuWidth,
      padding: menuPadding,
    });
    $(".content").css({
      width: "calc(100% - " + menuWidth + "px)",
      left: menuWidth + "px",
    });
    $("header").css({
      width: "calc(100% - " + menuWidth + "px)",
      left: menuWidth + "px",
    });
    open = true;
  }

  // Fecha o menu
  function closeMenu() {
    $(".menu").css({ width: "0", padding: "0" });
    $(".content").css({ width: "100%", left: "0" });
    $("header").css({ width: "100%", left: "0" });
    open = false;
  }

  // Adiciona ação ao clique no botão
  $(".menu-btn").click(function () {
    if (open) {
      closeMenu();
    } else {
      openMenu();
    }
  });

  // Ajusta o menu ao tamanho da tela ao carregar a página
  adjustMenu();

  // Ajusta o menu ao tamanho da tela ao redimensionar a janela
  $(window).resize(function () {
    adjustMenu();
  });

  $("[formato=data]").mask("00/00/0000");

  // aqui é uma  uma mascara de data que vai ser utilizado lembrando que é necessario ter o (jquery.mask.js)

  $("[actionBtn=delete]").click(function () {
    var txtAlert = confirm("Deseja mesmo excluir esta serviço ? ");
    if (txtAlert == true) {
      return true;
    } else {
      return false;
    }
  });
});
