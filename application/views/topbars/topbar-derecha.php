<ul class='nav navbar-nav navbar-right'>
	<li>
		<a href='<?=base_url()?>carrito'>
			<i class='glyphicon glyphicon-shopping-cart'></i> Carrito
			<?=$this->load->helper('carrito_helper'); boton_carrito($this);?>
		</a>
	</li>
	<p class='navbar-text' style="margin-left: 1.1em">
		<i class='glyphicon glyphicon-user'></i> 
		<?=$this->session->userdata('user_nombre')?>
	</p>
	<li><a href="<?=base_url()?>logout">Salir</a></li>
</ul>