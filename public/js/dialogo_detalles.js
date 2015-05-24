$(function() {

  $('body').on('click', '.mostrar-detalles', mostrarDetalles);

  function mostrarDetalles(event) {
    event.preventDefault();

    url = $(this).attr('href');
    cargarDialogoDeDetalles(url);
  }

  function cargarDialogoDeDetalles(url) {
    $.get(url, mostrarDialogoDeDetalles);
  }

  function mostrarDialogoDeDetalles(html) {
    $(html).modal();
  }

});
