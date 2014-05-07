$(function() {
	var $ = jQuery;

	$('body').on('click', '.comando', function(e){
		var cant = $('input:checkbox:checked').length;
		if (cant == 0 || ($(this).hasClass('confirmar') && !confirm($(this).data('confirmar')))) {
			return;
		}
		var v = $(this).data('comando');
		$("<input type='hidden' name='comando' value='"+v+"'>")
		.appendTo('#form-comando');
		$('#form-comando').submit();

	}).on('click', '#seleccionar-todos', function(e){
		$($(this).data('target')).find('input:checkbox').prop('checked', 'checked').change();

	}).on('click', '#seleccionar-ninguno', function(e){
		$($(this).data('target')).find('input:checkbox').removeAttr('checked').change();


	}).on('change', 'input:checkbox', function(e){
		var parent = $($(this).parent().parent());
		var v = $(this).val();
		var id = "input"+v;
		if ($(this).is(":checked")) {
			parent.addClass('warning');
			/* Añade el input a la form usada para enviar comandos masivos */
			$("<input id='"+id+"' type='hidden' name='seleccionados[]' value='"+v+"'>")
			.appendTo('#form-comando');
		} else {
			parent.removeClass('warning');
			/* Remueve el input d la form usada para enviar comandos masivos */
			$("#"+id).remove();
		}
	});

});