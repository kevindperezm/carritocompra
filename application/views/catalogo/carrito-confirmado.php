<div class="row" style='margin-top: 1em'>
	<div class='col-xs-12'>
		<div class='alert alert-dismissable alert-success'>
			<button class='close' data-dismiss='alert'>x</button>
			Su compra ha sido registrada. Los detalles de su pedido se 
			muestran abajo.
		</div>
	</div>
</div>
<hr>
<div class='row'>
	<div class='col-xs-12'>
		<!-- <div class='well'> -->
			<a class='btn btn-primary' href='<?=link_pagina($this, 'catalogo', 'catalogo')?>'>Volver al catálogo</a>
		<!-- </div> -->
	</div>
</div>	
<div class='row'>
	<div class='col-xs-12'>
		<div id='detalles-pedido'>
			<?=$this->load->view('admin/pedidos/tabla-detalles')?>
		</div>
	</div>
</div>