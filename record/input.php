
<body>
	<form action="./text.php" method="post">
    <input type="hidden" name="method" value="check">        
		<textarea name="output" cols="50" rows="10" placeholder="今日は何をした？"></textarea>
		<?php 
			if (!isset($error_message)) {
				echo '投稿ありがとう';
			} else {
				echo $error_message;
			}
		?>
    <button type="submit">確認</button>
	</form>
	<?php if (isset($this->Model->texts)){ ?>
	<h1>投稿一覧</h1>
		<?php foreach ($this->Model->texts as $text) { ?>
			<!-- serialize セッションを保持のため形を変える
		モデルを持ち運べる　ファイルを解凍して出す的な感じ -->
		<?php $t = unserialize($text); ?>
		<div>
			<a href="../text_detail/text_detail.php?id=<?php echo $t->id; ?>"><?php echo $t->output; ?></a>
			<a href="../text_detail/text_detail.php?id=<?php echo $t->id; ?>"><?php echo $t->created; ?></a>
		</div>

  	<?php } ?> 
	<?php } ?>

</body>

