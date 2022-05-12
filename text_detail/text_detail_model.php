<?php
include_once '../sql.php';

class TextDetailModel
{
  var $text;

  function __construct()
  {
    $this->db = new Sql();
  }

  function set_text($text_id)
  {
    $sql="
      SELECT
        *,
        id as text_d_id
      FROM 
        record
      WHERE
        id = ".$text_id."
    ";
    // レコードを一個ずつ出すだが、ここでは、idでが一致するもの1点のみしかない
    $results = $this->db->mysqli_query_one($sql);

    foreach($results as $name => $value) {
      $this->$name = $value;
    }
  //  echo 'fff:'.$this->text_d_id;
  }

  function set_comments($text_id){
    $sql ="
    SELECT 
      *
    FROM 
      comment
    WHERE
      text_d_id = ".$text_id."
    ORDER BY 
      id DESC 
    ";
    // 実行したものをresultsに入れている
    $results = $this->db->query($sql);
  
    
    // テーブルのレコードを1行取得し、$rowに入れることを繰り返す＊連想配列となる
      while ($row = mysqli_fetch_assoc($results)) {
        // 配列を入れる器を作る　
        $comment = new stdClass();  
        // name（Ex.come） value(Ex.input で入力した値)に当てはめる
        // name（Ex.nickname）  value(Ex.inputで入力したときの時間)に当てはめる
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
    
  var $inputs  = [
      'nickname',
      'come',
      'text_d_id',
  ];

  // function init()
  // {
  //   $inputs = $this->inputs;
  //   // 配列の中のカラムに値を振り分けるイメージ
  //   foreach ($inputs as $input) {
  //       $this->$input = NULL;
  //   }
  // }

  function set_value($request)
  {
    $inputs = $this->inputs;
    // var_dump($request);
    // exit();
    foreach ($inputs as $input => $name) {
     
      // 受け取ったものに、キー＄name（フィールド:値）が存在するか
      if (array_key_exists($name, $request)) {
        $this->$name = $request[$name];       
      } else {
        $this->$name = NULL;
      }
    }
  }
  function check_value()
  {
    $error ='';
    if (!strlen($_REQUEST['nickname']) || !strlen($_REQUEST['come'])){
      $error = '全て入力してください';
    }
    // 返す
    return $error;

  }

  function insert()
  {
    require_once '../library.php';
    $columns = array();
    $columns['nickname'] = "'".h($this->nickname)."'";
    $columns['come'] = "'".h($this->come)."'";
    $columns['text_d_id'] = "'".h($this->text_d_id)."'";


    // var_dump($columns);
    // exit();

    $sql = "
      INSERT INTO
        comment
        (".implode(',', array_keys($columns)).")
      VALUES
        (".implode(',', $columns).")
    ";
// var_dump($sql);
// exit();
    $this->db = new Sql();
   
    $res = $this->db->query($sql);
    // var_dump($sql);
    // exit();
    return $res;
  }

}