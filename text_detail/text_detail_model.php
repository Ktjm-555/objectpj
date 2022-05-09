<?php
include_once '../sql.php';

class OutputDetailModel
{
  
  function __construct()
  {
    $this->db = new Sql();
  }

  function set_output($output_id)
  {
    $sql="
      SELECT
        *,
      FROM 
        output
      WHERE
        id = ".$output_id."
    ";
    // レコードを一個ずつ出すだが、ここでは、idでが一致するもの1点のみしかない
    $results = $this->db->mysqli_query_one($sql);

    // オブジェクト化したい　$recipe->
    $output = new stdClass();
    foreach($results as $name => $value) {
      $output->$name = $value;
    }

    $this->output = serialize($output);
  
  }
}