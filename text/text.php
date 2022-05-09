<?php
include_once '../index.php';
include_once '../library.php';

Class Text
{

  function __construct() 
  {
    include_once './text_model.php';

    // 毎回ここは通るところ、$_SESSIONに値があるかないかでクラスを呼び出す
    if (isset($_SESSION['output'])) {
      $this->Model = unserialize($_SESSION['output']);
    } else {
      $this->Model = new TextModel();
      $_SESSION['output'] = serialize($this->Model);
    }

  // @todo これいる？
    session_start();

    


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
    // 内容を受け取る
    $this->Model->set_value($_REQUEST);

    // エラーメッセージ
    $error_message = $this->Model->check_value();
    // var_dump($error_message);
    // exit();

    if ($error_message) {
      require_once '../library.php';
      include('./input.php');
    } else {
      $_SESSION['output'] = $this->Model;
      $this->main_page = 'check';
      $this->show();
    }
  }

  // 登録、投稿する
  function regist()
  {
    $this->Model = $_SESSION['output'];
    $res = $this->Model->insert();

    if (!$res) {
      $error_message = 'できていませんよ！何かがおかしいよ！';
      require_once '../library.php';
      include('./input.php');
    } else {

      //セッションの削除
      unset($_SESSION['output']);
      $this->main_page = 'thank';
      $this->show();
    }


  }

  // 表示
  function show() {

    switch ($this->main_page) {
      case 'input':
        $error_message = '';
        $this->Model->set_texts();
        $_SESSION['display'] = $this->Model->texts;
        break;
    }

    
    // var_dump($_SESSION['display']);
    // exit();

    include 'main.php';


  }

}



?>
