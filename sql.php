<?php
Class Sql
{
	var $db;
		
	// 一番最初に読む　コンストラクタ
	function __construct() 
	{
		$db = mysqli_connect('us-cdbr-east-05.cleardb.net', 'b40e7da217ecbc', '43749863', 'heroku_963ac50667f4cd7');
		// $db = new mysqli('localhost:8889', 'root', 'root', 'recipenpj'); 
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