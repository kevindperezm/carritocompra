<?php if (isset($flash)) { ?>
  <div class="row">
    <div class='col-xs-12 alert alert-dismissable <?= $exito ? 'alert-success' : 'alert-warning' ?>'>
      <button class='close' data-dismiss='alert'>x</button>
      <?= $mensaje ?>
    </div>
  </div>
<?php } ?>
