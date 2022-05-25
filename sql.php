<?php
Class Sql {
	/**
　　  * 定義
   */
	var $db;
		
	/**
  　　* コンストラクタ
   */
	function __construct() {
		$db = mysqli_connect('us-cdbr-east-05.cleardb.net', 'b40e7da217ecbc', '43749863', 'heroku_963ac50667f4cd7');
		// $db = new mysqli('localhost:8889', 'root', 'root', 'recipenpj'); 
		if (!$db) {
			die('接続失敗です。');
		} else {
			$this->db = $db;
		}
	}

	/**
  　　* SQL実行
   */
	function query($sql) {
		$result = mysqli_query($this->db, $sql);
		return $result;
	} 

	/**
  　　* SQL実行 レコードを一個だけ取り出すとき
   */	
	// @riho ここわからない　上のと使い分け？
	function mysqli_query_one($sql) {
   $result = mysqli_query($this->db, $sql);
		if ($result) {
      $row = mysqli_fetch_assoc($result);
      return $row;
    } else {
      return false;
    }
  }		
}
?>