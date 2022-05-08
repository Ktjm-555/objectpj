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
  
  function __construct() 
  {
    $this->db = new Sql();
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

  // function register()
  // {
  //   $result = $this->insert();
  //   return $result;
  // }

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
