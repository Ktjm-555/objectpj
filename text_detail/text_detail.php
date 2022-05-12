<?php
include_once '../index.php';
include_once '../library.php';

class text_detail
{

  function __construct()
  {
    include_once './text_detail_model.php';

    if (isset( $_SESSION['text_detail'])) {
      $this->Model = unserialize($_SESSION['text_detail']);
    } else {
      $this->Model = new TextDetailModel();
      $_SESSION['text_detail'] = serialize($this->Model);
    }
//  var_dump($this->Model);
//  exit();
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
    } else {
      require_once '../library.php';
      header('Location:../text/text.php');
    }

    $this->Model->set_text($this->text_id);
    $_SESSION['text_detail'] = serialize($this->Model);
  //  echo 'ooo:'.$this->Model->text_d_id;


    // comment の初期化
    // commentを入力して反映したら消す
    // $this->Model->init();
    $this->main_page = 'main_page';
    $this->show();

  }

  function check(){
    
    // 内容を受け取る
    $this->Model->set_value($_REQUEST);
// echo 'ccc:'.$this->Model->text_d_id;
    // エラーメッセージ
    $error_message = $this->Model->check_value();
    // var_dump($error_message);
    // exit();

    if ($error_message) {
      require_once '../library.php';
      $this->main_page = 'main_page';
      include('./main.php');
      
    } else {
      $_SESSION['text_detail'] = serialize($this->Model);
  
      $this->main_page = 'check';
      $this->show();
    }
  }

  function regist()
  {
    $this->Model = unserialize($_SESSION['text_detail']);
   
    $res = $this->Model->insert();


      if (!$res) {
        $error_message = 'できていませんよ！何かがおかしいよ！';
        require_once '../library.php';
        $this->main_page = 'main_page';
        include('./main.php');
      } else {
        $_REQUEST['id'] = $this->Model->text_d_id;

        //セッションの削除
        // unset($_SESSION['text_detail']);
        // $this->main_page = 'main_page';
        $this->main();
      }
    
  }

  function show()
  {

    require_once '../library.php';
    //  var_dump($this->main_page);
    //   exit();
    switch ($this->main_page) {
      case 'main_page':
        $error_messages = array();
        $this->Model->set_comments($this->text_id);
        $_SESSION['comment'] = serialize($this->Model->comments);
    
        break;
      
      
      default:
        break;
    }

    include 'main.php';
  }
}

