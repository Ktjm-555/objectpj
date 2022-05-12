<?php
include_once '../sql.php';

Class TextModel
{
  // var $input = [
  //   '1'=>array(
  //     'output',
  //   )
  //   ];
  var $output;
  var $text;
  
  function __construct() 
  {
    $this->db = new Sql();
  }

  function set_texts()
  {
    $sql ="
    SELECT 
      *
    FROM 
      record
    ORDER BY 
      id DESC 
    ";
    // 実行したものをresultsに入れている
    $results = $this->db->query($sql);
    // var_dump($sql);
    // テーブルのレコードを1行取得し、$rowに入れることを繰り返す＊連想配列となる
      while ($row = mysqli_fetch_assoc($results)) {
        // 配列を入れる器を作る　
        $text = new stdClass();  
        // name（Ex.output） value(Ex.input で入力した値)に当てはめる
        // name（Ex.created）  value(Ex.inputで入力したときの時間)に当てはめる
        foreach($row as $name => $value) {
          $text->$name = $value;
        }
        // $textは　outputとcreatedからできた配列になる
        $texts[] = serialize($text);
      }
        $this->texts = $texts;
        // var_dump($texts);
        // exit();




    // // 一列ずつ抜き出している
    // while ($row = mysqli_fetch_assoc($results)) {
    //   // からのクラス　stdClass　new器ができる
    //   $text = new stdClass();    
    //   // @riho 一個のみの場合は？ 
    //   foreach($row as $name => $value) {
    //     $text->$name = $value;
    //   }
    //   $texts[] = serialize($text);
    // }
    //   // ＄this->model
    // $this->texts = $text;
  }
 

  // まず初期化
  function init()
  {
    // かければいらない
    // foreach ($input as $name) {
      $this->output = NULL;
    // }  
  }

  function set_value($request)
  {
    // $error_message = '';
    if (isset($_REQUEST['output'])){
      $this->output =  $request['output'];
    } 
  }

  function check_value()
  {
    $error ='';
    if (!strlen($_REQUEST['output'])){
      $error = '何か入力してください';
    }
    // 返す
    return $error;

  }

  function insert()
  {
    require_once '../library.php';
    // 初期化は、値がない場合がある場合に初期値を設定する。
    $column = "'".h($this->output)."'";
    
    $sql = "
        INSERT INTO
          record
          (output)
        VALUES
          ($column)
    ";
    // exit($sql);
    $this->db = new Sql();
    $results = $this->db->query($sql);

    return $results;

  }


}

?>
