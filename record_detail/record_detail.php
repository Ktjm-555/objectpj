<?php
include_once '../index.php';
include_once '../library.php';

class Record_detail
{
  var $record_id;
  //コンストラクタ
  function __construct()
  {
    include_once './record_detail_model.php';

    if (isset( $_SESSION['record_detail'])) {
      $this->Model = unserialize($_SESSION['record_detail']);
    } else {
      $this->Model = new RecordDetailModel();
      $_SESSION['record_detail'] = serialize($this->Model);
    }
    session_start();
  }
  
  function start()
  {
    $this->main();
  }

  //recordのidを受け取る
  function main()
  {
    if (is_null($this->record_id)){
      if (isset($_REQUEST['id'])) {
        $this->record_id = $_REQUEST['id'];
      } else {
        require_once '../library.php';
        header('Location:../record/record.php');
      }
    } 

    //投稿(record)の表示
    $this->Model->set_record($this->record_id);
    $_SESSION['record_detail'] = serialize($this->Model);
    //ページ表示
    $this->main_page = 'main_page';
    $this->show();
  }

  //コメント確認
  function check(){
    //内容を受け取る
    $this->Model->set_value($_REQUEST);
    //入力していない場合の確認　エラーを表示する
    $error_message = $this->Model->check_value();
    if ($error_message) {
      require_once '../library.php';
      $this->main_page = 'main_page';
      include('./main.php');
    } else {
      $_SESSION['record_detail'] = serialize($this->Model);
      $this->main_page = 'check';
      $this->show();
    }
  }

  //コメントの登録、投稿する
  function regist()
  {
    $this->Model = unserialize($_SESSION['record_detail']);
    $res = $this->Model->insert();

    if (!$res) {
      $error_message = 'できていませんよ！何かがおかしいよ！';
      var_dump($error_message);
      exit();
      require_once '../library.php';
      $this->main_page = 'main_page';
      include('./main.php');
    } else {
      $_REQUEST['id'] = $this->Model->record_d_id;
      //　Point　完了ページなしで詳細表示画面に戻る
      $this->main();
    }
  }

  //削除
  function delete()
  {
    $this->res = $this->Model->delete_do($_REQUEST['id']);
    $this->record_id = $_REQUEST['record_d_id'];
    
    if ($this->res){
      $this->main();
    } else {
      $this->main();
    }
  }

  //画面遷移
  function show()
  {
    require_once '../library.php';
    switch ($this->main_page) {
      case 'main_page':
        $error_messages = array();
        //コメント一覧の表示
        $this->Model->set_comments($this->record_id);
        $_SESSION['comment'] = serialize($this->Model->comments);
      break;
      default:
      break;
    }
    include 'main.php';
  }
}

