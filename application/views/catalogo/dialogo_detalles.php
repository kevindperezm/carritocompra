<div class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <p>
          <button type="button" class="close" data-dismiss="modal">
            <i class="glyphicon glyphicon-remove"></i>
          </button>
        </p>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <?php echo $this->load->view('parciales/detalles-producto', true); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
