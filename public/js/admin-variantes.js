$(function(){
	// return;

	$('#variante-si').change(function(e){ 
		if ($(this).is(':checked')) {
			$('#detalles-variantes').show(); 
			$('#nueva-variante').show();
			activarColorDiv();
		}
	}).change();

	$('#variante-no').change(function(e){ 
		if ($(this).is(':checked')) {
			$('#detalles-variantes').hide(); 
			$('#nueva-variante').hide();
		}
	}).change();

	$('#nueva-variante').click(function(e){ 
		$('#detalles-variantes').append('<hr></hr>');
		var nuevo = $('#variantes-clonable').clone();
		nuevo.hide().appendTo('#detalles-variantes').find('.tipo-variante').change();
		nuevo.show();
		e.preventDefault();
	});

	$('#detalles-variantes').on('change', '.tipo-variante', function(e){
		var parent = $(this).parent().parent();
		var detalle = parent.find('.valor-variante-detalles');
		if (detalle.length == 0) { 
			var detalle = $('<div class="input-group valor-variante-detalles"></div>');
			detalle.appendTo(parent);
		}
		switch (parseInt($(this).val())) {
			case 1: 
			// Color
			$('<input class="valor-variante" type="hidden" name="valor-variante[]" value="#ffffff">').appendTo(detalle);
			$('<label class="input-group-addon">Color</label>').appendTo(detalle);
			$('<span class="form-control color"></button>').appendTo(detalle);
			$('<div class="input-group-btn"><button class="btn btn-default colorbtn" data-color="#ffffff">Seleccionar color</button></div>').appendTo(detalle);
			activarColorDiv();
			detalle.show();
			break;

			default: 
				detalle.hide().remove();
				break;
		}
	});

	function activarColorDiv() {
		var buttons = $('.colorbtn');
		buttons.each(function(){
			var self = $(this);
			var parent = self.parent().parent();
			self.ColorPicker({
				color: self.data('color'),

				onChange: function (hsb, hex, rgb) {
					parent.find('.color').css('background', '#' + hex);
					parent.find('.valor-variante').val('#' + hex);
				}
			});
		});
	}
});