<?php
Class Sql{
		var $db;
		
// 一番最初に読む　コンストラクタ
		function __construct() 
		{
			// mysqli_connect
			$db = new myquli('localhost', 'root', 'root', 'objectpj');
			if (!$db) {
				die('接続失敗です。');
			} else {
				$this->db = $db;
			}
		}
}
?>