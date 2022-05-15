<?php
include_once '../sql.php';

Class RecordModel
{
  //定義
  var $record;

  //コンストラクタ
  function __construct() 
  {
    $this->db = new Sql();
  }

  //投稿一覧表示
  function set_records()
  {
    $sql ="
    SELECT 
      *
    FROM 
      record
    ORDER BY 
      id DESC 
    ";
    // Point 実行したものをresultsに入れている
    $results = $this->db->query($sql);
    //　Point テーブルのレコードを1行取得し、$rowに入れることを繰り返す＊連想配列となる
    while ($row = mysqli_fetch_assoc($results)) {
      // Point 配列を入れる器を作る　
      $record = new stdClass();  
      //　Point name（Ex.output） value(Ex.input で入力した値)に当てはめる
      //　Point name（Ex.created）  value(Ex.inputで入力したときの時間)に当てはめる
      foreach($row as $name => $value) {
        $record->$name = $value;
      }
      //　Point　$recordは　outputとcreatedからできた配列になる
      $records[] = serialize($record);
    }
    $this->records = $records;
  }
 
  //まず初期化　　＠todo 今後valueを残す仕様の際に利用する可能あり。
  function init()
  {
    $this->record = NULL;
  }

  //値を受け取る
  function set_value($request)
  {
    if (isset($_REQUEST['output'])){
      $this->output =  $request['output'];
    } 
  }

  //入力していない場合の確認
  function check_value()
  {
    $error ='';
    if (!strlen($_REQUEST['output'])){
      $error = '何か入力してください';
    }
    return $error;
  }

  //insertのSQL 投稿を登録する
  function insert()
  {
    require_once '../library.php';
    // Point 初期化は、値がない場合がある場合に初期値を設定する。
    $column = "'".h($this->output)."'";
    
    $sql = "
      INSERT INTO
        record
        (output)
        VALUES
        ($column)
    ";
    $this->db = new Sql();
    $results = $this->db->query($sql);
    return $results;
  }
}
?>
