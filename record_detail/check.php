<body>
  <form action="./record_detail.php" method="post"> 
    <input type="hidden" name="method" value="regist">  
    <input type="hidden" name="record_d_id" value="<?= $this->Model->id ?>">      
		<div>
    ニックネーム
    <?php echo $this->Model->nickname; 	?>
    </div>
    <div>
      コメント
			<?php echo $this->Model->come; ?>
    </div>
	
    <button type="submit">投稿</button>
  </form>
</body>