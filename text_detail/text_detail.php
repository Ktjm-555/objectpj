<?php
include_once '../index.php';
include_once '../library.php';

class output_detail
{

  function __construct()
  {
    include_once './text_detail_model.php';

    if (isset( $_SESSION['text_detail'])) {
      $this->Model = unserialize($_SESSION['text_detail']);
    } else {
      $this->Model = new RecipeDetailModel();
      $_SESSION['text_detail'] = serialize($this->Model);
    }
    session_start();
  }
  
  function start()
  {
    $this->main();
  }

  function main()
  {
    if (isset($_REQUEST['id'])) {
      $this->text_id = $_REQUEST['id'];
    }

    $this->Model->set_text($this->text_id);
    $_SESSION['text'] = serialize($this->Model);

    
    $this->main_page = 'main_page';
    $this->display();

  }

  function display()
  {
    require_once '../library.php';
    include 'main.php';
  }
}

