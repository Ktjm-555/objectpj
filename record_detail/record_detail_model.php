<?php
include_once '../sql.php';

class RecordDetailModel
{
  //定義
  var $record;
  var $inputs  = [
    'nickname',
    'come',
    'record_d_id',
  ];

  //コンストラクタ
  function __construct()
  {
    $this->db = new Sql();
  }

  //投稿(record)の表示
  function set_record($record_id)
  {
    $sql="
      SELECT
        *,
        id as record_d_id
      FROM 
        record
      WHERE
        id = ".$record_id."
    ";
    // Point レコードを一個ずつ出すだが、ここでは、idでが一致するもの1点のみしかない。
    $results = $this->db->mysqli_query_one($sql);
    foreach ($results as $name => $value) {
      $this->$name = $value;
    }
  }

  //入力したものを受け取る
  function set_value($request)
  {
    $inputs = $this->inputs;
    foreach ($inputs as $input => $name) {
      // 受け取ったものに、キー＄name（フィールド:値）が存在するか
      if (array_key_exists($name, $request)) {
        $this->$name = $request[$name];       
      } else {
        $this->$name = NULL;
      }
    }
  }

  //入力していない場合の確認　
  function check_value()
  {
    $error ='';
    if (!strlen($_REQUEST['nickname']) || !strlen($_REQUEST['come'])){
      $error = '全て入力してください';
    }
    return $error;
  }

  //insertのSQL コメントを登録する
  function insert()
  {
    require_once '../library.php';
    $columns = array();
    $columns['nickname'] = "'".h($this->nickname)."'";
    $columns['come'] = "'".h($this->come)."'";
    $columns['record_d_id'] = "'".h($this->record_d_id)."'";

    $sql = "
      INSERT INTO
        comment
        (".implode(',', array_keys($columns)).")
      VALUES
        (".implode(',', $columns).")
    ";
    $this->db = new Sql();
    $res = $this->db->query($sql);
    return $res;
  }

  //コメント一覧の表示
  function set_comments($record_id) 
  {
    $sql ="
    SELECT 
      *
    FROM 
      comment
    WHERE
      record_d_id = ".$record_id."
    ORDER BY 
      id DESC 
    ";

    // Point　実行したものをresultsに入れている
    $results = $this->db->query($sql);
    // Point　テーブルのレコードを1行取得し、$rowに入れることを繰り返す＊連想配列となる
    while ($row = mysqli_fetch_assoc($results)) {
      // 配列を入れる器を作る　
      $comment = new stdClass();  
      // Point　name（Ex.come） value(Ex.input で入力した値)に当てはめる
      // Point　name（Ex.nickname）  value(Ex.inputで入力したときの時間)に当てはめる
      foreach($row as $name => $value) {
        $comment->$name = $value;
      }
      $comments[] = serialize($comment);
    }
    if (isset($comments)) {
      $this->comments = $comments;
  
    } else {
      $this->comments = [];
    }
  }

  //削除のsqlを実行
  function delete_do($comment_id)
  {    
    $sql = "
    DELETE
    FROM
      comment
    WHERE
      id = ".$comment_id."
    ";
    $res = $this->db->query($sql);
    return $res;
  }
}