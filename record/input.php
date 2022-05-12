
<body>
	<form action="./record.php" method="post">
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
	<?php if (isset($this->Model->records)){ ?>
	<h1>投稿一覧</h1>
		<?php foreach ($this->Model->records as $record) { ?>
			<!-- serialize セッションを保持のため形を変える
		モデルを持ち運べる　ファイルを解凍して出す的な感じ -->
		<?php $r = unserialize($record); ?>
		<div>
			<a href="../record_detail/record_detail.php?id=<?php echo $r->id; ?>"><?php echo $r->output; ?></a>
			<a href="../record_detail/record_detail.php?id=<?php echo $r->id; ?>"><?php echo $r->created; ?></a>
		</div>

  	<?php } ?> 
	<?php } ?>

</body>

