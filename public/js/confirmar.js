$(function(e){
	$('body').on('click', '.confirmar:not(.comando)', function(e){
		if (!confirm($(this).data('confirmar'))) {
			e.preventDefault();
		}
	});
});