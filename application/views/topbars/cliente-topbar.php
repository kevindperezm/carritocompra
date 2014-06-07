<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
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
  <?php $this->load->view('topbars/topbar-derecha.php'); ?>
</div>
</div>
</nav>