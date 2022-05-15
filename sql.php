<?php
Class Sql
{
	var $db;
		
	// 一番最初に読む　コンストラクタ
	function __construct() 
	{
		$db = new PDO('mysql:dbname=heroku_ccea7749e346fc5;host=us-cdbr-east-05.cleardb.net;charset=utf8','b9a24da0030579','84dd6a30');
		if (!$db) {
			die('接続失敗です。');
		} else {
			$this->db = $db;
		}
	}

	//配列を返す *select等 
  function mysqli_query($sql)
  {
    // Point 決まったメソッド　mysqli_query
    $results = mysqli_query($this->db, $sql);
    return $results;
  }

	function query($sql) 
	{
		$result = mysqli_query($this->db, $sql);
		return $result;
	} 

	//一つのテーブルを出す
	function mysqli_query_one($sql)
  {
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