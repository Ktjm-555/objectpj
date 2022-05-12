<body>
  <div class="button">
      <form action="./record.php" method="post" >
        <input type="hidden" name="method" value="start">
          <button type="submit"> 
          TOPページに戻る
          </button>
      </form>
  <div>
  <form action="./record.php" method="post"> 
    <input type="hidden" name="method" value="regist">        
		<?php 
			echo $this->Model->output;
		?>
    <button type="submit">投稿</button>
  </form>
</body>