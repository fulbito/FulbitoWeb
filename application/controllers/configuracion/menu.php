<?php

class Menu extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
                
    $this->load->library('grocery_CRUD');
    $this->load->database();
    $this->load->helper('url');

    $this->grocery_crud->set_language("spanish");
  }

  function show_menu() {      
    $this->load->view('configuracion/menu');
  }
  

}
