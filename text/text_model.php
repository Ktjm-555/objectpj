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


}

?>
