<body>
  <form action="./text.php" method="post"> 
    <input type="hidden" name="method" value="regist">        
		<?php 
			echo $this->Model->output;
		?>
    <button type="submit">投稿</button>
  </form>
</body>