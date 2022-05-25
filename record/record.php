<?php
include_once '/app/index.php';

Class Record {
  /**
  　　* コンストラクタ
   */
  function __construct() {
    include_once '/app/library.php';
    include_once '/app/record/record_model.php';
    //　毎回ここは通るところ、$_SESSIONに値があるかないかでクラスを呼び出す
    if (isset($_SESSION['record'])) {
      $this->Model = unserialize($_SESSION['record']);
    } else {
      $this->Model = new RecordModel();
      $_SESSION['record'] = serialize($this->Model);
    }
    session_start();
  }

  function start() {
    $this->input();
  }

  /**
  　　* 初期化
   */
  function input() {
    $this->Model->init();
    $this->main_page = 'input';
    $this->show();
  }

  /**
　　　　　　* 投稿確認
  　　*/
  function check() {
    $this->Model->set_value($_REQUEST);
;
    //　入力していない場合の確認　エラーを表示する
    $error_message = $this->Model->check_value();

    if ($error_message) {
      $this->main_page = 'input';
      include '/app/record/main.php';
    } else {
      $_SESSION['record'] = $this->Model->output;
      $this->main_page = 'check';
      $this->show();
    }
  }

  /**
　　　　　　* 投稿の登録、投稿する
  　　*/
  function regist() {
    $this->Model->output = $_SESSION['record'];
    $res = $this->Model->insert();

    if (!$res) {
      $error_message = 'できていませんよ！何かがおかしいよ！';
      $this->main_page = 'input';
      include '/app/record/main.php';
    } else {
      //　セッションの削除　＊更新とかしてもう一度データが入るのを防ぐ。
      unset($_SESSION['record']);
      $this->main_page = 'thank';
      $this->show();
    }
  }

  /**
　　　　　　* 削除
　　　　　　*/
  function delete() {
    $this->res = $this->Model->delete_do($_REQUEST['id']);
    if ($this->res){
      $this->input();
    } else {
      $error_message = 'できていませんよ！何かがおかしいよ！';
      $this->input();
    }
  }

  /**
　　　　　　* 画面遷移
　　　　　　*/
  function show() {
    switch ($this->main_page) {
      case 'input':
        $error_message = '';
        $this->Model->set_records();
        $_SESSION['record'] = $this->Model->records;
      break;
    }
    include 'main.php';
  }
}
?>
