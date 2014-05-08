<li class='dropdown'>
	<a href='#' class='dropdown-toggle' data-toggle='dropdown'>Catálogo <b class="caret"></b></a>
	<ul class='dropdown-menu'>
		<li><a href="<?=base_url()?>catalogo">Página principal</a></li>
		<li class='disabled'><a href='#'>Categorías</a></li>
		<?php
		foreach (Categoria::all(array('order' => 'nombre ASC')) as $categoria) {
			echo '<li><a href="'.base_url().'categoria/'.$categoria->url_nombre.'">'.$categoria->nombre.'</a></li>';
		}
		?>
	</ul>
</li>