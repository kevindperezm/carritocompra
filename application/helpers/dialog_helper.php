<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$GLOBALS['modal_count'] = 0;
function modal_dialog($title, $body, $footer, $button, $btnclasses = array()) { 
	$id = str_replace(' ', '_', $button); ?>
	<div class="modal fade" id='modal-<?php echo $GLOBALS['modal_count'] ?>'>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<?php if(!empty($title)) { ?><h4 class="modal-title"><?php echo $title ?></h4><?php } ?>
				</div>
				<div class="modal-body">
					<?php echo $body ?>
				</div>
				<div class="modal-footer">
					<?php echo $footer ?>
				</div>
			</div>
		</div>
	</div>
<?php 
	$boton = '<button class="btn ';
	foreach ($btnclasses as $attr => $value) {
		$boton .= "$value ";
	}
	$boton .= '" data-toggle="modal" data-target="#modal-'.$GLOBALS['modal_count'].'">'.$button.'</button>';
	$GLOBALS['modal_count']++;
	return $boton;
}

function confirm_dialog($title, $question, $button, $btnclasses = array()) {
	$footer = '
	<button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
	<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>';
	return modal_dialog($title, $question, $footer, $button, $btnclasses);
}

?>