<?php

Class TextModel
{
  var $input = [
    '1'=>array(
      'output',
    )
    ];

  function __construct() 
  {
    $this->db = new Sql();
  }
  
  // まず初期化
  function init()
  {
    foreach ($input as $name) {
      $this->$name = NULL;
    }  
  }



}

