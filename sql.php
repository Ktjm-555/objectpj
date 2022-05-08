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

		function query($sql) 
		{
			$result = mysqli_query($this->db, $sql);
			return $result;
		} 
}
?>