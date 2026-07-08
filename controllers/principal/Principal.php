<?php

class Principal extends Controller{

  public function __construct()
  {
    return parent::__construct();
  }

  function index(){
    $mensaje = $this->model->getPrueba();
    echo "Desde el principal...". $mensaje;
  }
}
?>