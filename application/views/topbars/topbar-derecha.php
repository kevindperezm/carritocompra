<ul class='nav navbar-nav navbar-right'>
	<li>
		<a href='<?=base_url()?>carrito'>
			<i class='glyphicon glyphicon-shopping-cart'></i> Carrito
			<?=$this->load->helper('carrito_helper'); boton_carrito($this);?>
		</a>
	</li>
	<li>
		<a href='<?=base_url()?>usuario'>
			<i class='glyphicon glyphicon-user'></i> 
			<?=$this->session->userdata('user_nombre')?>
		</a>
	</li>
	<li class='pull-right'><a href="<?=base_url()?>logout">Salir</a></li>
</ul>