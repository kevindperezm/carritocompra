$(function() {

  $('body').on('click', '.mostrar-detalles', mostrarDetalles);
  $('body').on('submit', '.comprar-form', agregarProductoACarrito);

  function mostrarDetalles(event) {
    event.preventDefault();

    url = $(this).attr('href');
    cargarDialogoDeDetalles(this, url);
  }

  function cargarDialogoDeDetalles(elemento, url) {
    mostrarProgresoDeCarga(elemento);
    $.get(url, function(html) {
      mostrarDialogoDeDetalles(elemento, html);
    });
  }

  function mostrarProgresoDeCarga(elemento) {
    crearIndicadorDeCarga().insertAfter(elemento);
  }

  function crearIndicadorDeCarga() {
    url = location.origin + '/public/img/loader.gif';
    return $('<div class="loader text-center">' +
                '<img src="' + url + '">' +
             '</div>');
  }

  function mostrarDialogoDeDetalles(elemento, html) {
    $(html).modal();
    ocultarIndicadorDeCarga(elemento);
  }

  function ocultarIndicadorDeCarga(elemento) {
    $(elemento).next('.loader').remove();
  }

  function agregarProductoACarrito(event) {
    event.preventDefault();
    self = this

    mostrarProgresoDeCarga(self);
    url = $(this).attr('action');
    $.post(url, $(this).serialize(), function(json) {
      exitoAlAgregar(self, json);
    });
  }

  function exitoAlAgregar(elemento, json) {
    notificarExito('Producto añadido', json.mensaje);
    ocultarIndicadorDeCarga(elemento);
    cerrarDialogoDeDetalles();
    actualizarConteoDeCarrito();
  }

  function notificarExito(titulo, mensaje) {
    new PNotify({ title: titulo,
                  text:  mensaje,
                  type:  'success' });
  }

  function cerrarDialogoDeDetalles() {
    $('.modal.fade.in').modal('hide');
  }

  function actualizarConteoDeCarrito() {
    url = location.origin + '/carrito/conteo';
    $.get(url, function(html) {
      $('.conteo-carrito').html(html);
    });
  }

});
