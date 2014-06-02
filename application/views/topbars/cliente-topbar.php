<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
   <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse1">
     <span class="sr-only">Mostrar navegación</span>
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
   </button>
   <a class="navbar-brand" href="<?=base_url()?>catalogo"><?=NOMBRE_TIENDA?></a>
 </div>

 <div class="collapse navbar-collapse" id='collapse1'>
  <ul class="nav navbar-nav">
    <li class='dropdown'>
      <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Categorías <b class="caret"></b></a>
      <ul class='dropdown-menu'>
        <?php
        foreach (Categoria::all(array('order' => 'nombre ASC')) as $categoria) {
          echo '<li><a href="'.base_url().'categoria/'.$categoria->url_nombre.'">'.$categoria->nombre.'</a></li>';
        }
        ?>
      </ul>
    </li>
  </ul>
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
</div>
</div>
</nav>