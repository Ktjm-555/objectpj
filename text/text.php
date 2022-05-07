<?php
include_once '../index.php';
include_once '../library.php';

Class Text
{

  function __construct() 
  {
    include_once './text_model.php';

    // 毎回ここは通るところ、$_SESSIONに値があるかないかでクラスを呼び出す
    if (isset($_SESSION['text'])) {
      $this->Model = unserialize($_SESSION['text']);
    } else {
      $this->Model = new TextModel();
      $_SESSION['text'] = serialize($this->Model);
    }

    session_start();
  // @todo これいる？

  }
  // // 投稿する・表示もする
  function start() 
  {
    $this->input();

  }

  // 入力され初期化
  function input()
  {
    $this->Model->init();
    $this->main_page = 'input';
    $this->show();

  }

  // 確認へ
  function check(){
    $this->Model->set_value($_REQUEST);

    // エラーメッセージ
    $error_message = $this->Model->check_value();
    // var_dump($error_message);
    // exit();

    if ($error_message) {
      require_once '../library.php';
      include('./input.php');
    } else {
      $this->main_page = 'check';
      $this->show();
    }


  }

  // // 完了する

  // // 表示もかな？
  function show() {

    switch ($this->main_page) {
      case 'input':
        $error_message = '';
        break;
    }

    include 'main.php';


  }

}



?>
