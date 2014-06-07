<?php

class Acerca_de extends CI_Controller {
  public function index() { $this->show(); }

  public function show() {
    load_template($this, 'acerca_de', $data);
  }

}

?> 
