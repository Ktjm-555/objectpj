<?php
Class Sql
{
		var $db;
		
// 一番最初に読む　コンストラクタ
		function __construct() 
		{
			// mysqli_connect
			$db = mysqli_connect('localhost', 'root', 'root', 'objectpj');
			if (!$db) {
				die('接続失敗です。');
			} else {
				$this->db = $db;
			}
		}

		/**
   * 配列を返す *select等
   */
  function mysqli_query($sql)
  {
    // 決まったメソッド　mysqli_query
    $results = mysqli_query($this->db, $sql);

  // 元ある場所に戻る　＝受け取ることができる
    return $results;
  }


		function query($sql) 
		{
			$result = mysqli_query($this->db, $sql);
			return $result;
		} 

		// 一つのテーブルを出す
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