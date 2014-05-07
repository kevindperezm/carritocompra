<li class='dropdown'>
	<a href='#' class='dropdown-toggle' data-toggle='dropdown'>Catálogo <b class="caret"></b></a>
	<ul class='dropdown-menu'>
		<li><a href="<?=base_url()?>catalogo">Inicio</a></li>
		<li class='divider'></li>
			<?php
			foreach (Categoria::all(array('order' => 'nombre ASC')) as $categoria) {
				echo '<li><a href="'.base_url().'categoria/'.$categoria->url_nombre.'">'.$categoria->nombre.'</a></li>';
			}
			?>
	</ul>
</li>