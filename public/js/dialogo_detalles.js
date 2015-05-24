$(function() {

  $('body').on('click', '.mostrar-detalles', mostrarDetalles);
  $('body').on('submit', '.comprar-form', agregarProductoACarrito);

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

  function agregarProductoACarrito(event) {
    event.preventDefault();

    url = $(this).attr('action');
    $.post(url, $(this).serialize(), exitoAlAgregar);
  }

  function exitoAlAgregar(json) {
    notificarExito('Producto añadido', json.mensaje);
  }

  function notificarExito(titulo, mensaje) {
    new PNotify({ title: titulo,
                  text:  mensaje,
                  type:  'success' });
  }

});
