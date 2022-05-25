<?php
include_once '/app/sql.php';

Class RecordModel {
  /**
  　　* 定義
   */
  var $record;

  /**
  　　* コンストラクタ
   */
  function __construct() {
    $this->db = new Sql();
  }
  /**
  　　* 投稿一覧表示
   */
  function set_records() {
    $sql ="
    SELECT 
      *
    FROM 
      record
    ORDER BY 
      id DESC 
    ";
    //　実行したものをresultsに入れている
    $results = $this->db->query($sql);
    //　テーブルのレコードを1行取得し、$rowに入れることを繰り返す＊連想配列となる
    while ($row = mysqli_fetch_assoc($results)) {
      //　配列を入れる器を作る　
      $record = new stdClass();  
      // name（Ex.output） value(Ex.input で入力した値)に当てはめる
      //　name（Ex.created）  value(Ex.inputで入力したときの時間)に当てはめる
      foreach($row as $name => $value) {
        $record->$name = $value;
      }
      //　$recordは　outputとcreatedからできた配列になる
      $records[] = serialize($record);
    }
    $this->records = $records;
  }

  /**
  　　*  まず初期化　　＠todo 今後valueを残す仕様の際に利用する可能あり。
   */
  function init() {
    $this->record = NULL;
  }

  /**
  　　* 入力された値を受け取る
   */
  function set_value($request) {
    if (isset($_REQUEST['output'])) {
      $this->output =  $request['output'];
    } 
  }

  /**
  　　* 入力していない場合の確認
   */
  function check_value() {
    $error ='';
    if (!strlen($_REQUEST['output'])) {
      $error = '何か入力してください';
    }
    return $error;
  }

  /**
  　　* insertのSQL 投稿を登録する
   */
  function insert() {
    require_once '/app/library.php';
    //　初期化は、値がない場合がある場合に初期値を設定する。
    $column = "'".h($this->output)."'";
    
    $sql = "
      INSERT INTO
        record
        (output)
        VALUES
        ($column)
    ";
    $this->db = new Sql();
    $results  = $this->db->query($sql);
    return $results;
  }

  /**
  　　* deleteのSQL 投稿を削除する
   */
  function delete_do($id) {    
    $sql = "
    DELETE
    FROM
      record
    WHERE
      id = ".$id."
    ";
    $res = $this->db->query($sql);
    return $res;
  }
}
?>
