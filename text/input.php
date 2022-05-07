
<body>
	<form action="./text.php" method="post">
    <input type="hidden" name="method" value="check">        
		<textarea name="output" cols="50" rows="10" placeholder="今日は何をした？"></textarea>
		<?php 
			if ($error_message) {
				echo $error_message;
			}
		?>
    <button type="submit">確認</button>
  </form>
</body>

