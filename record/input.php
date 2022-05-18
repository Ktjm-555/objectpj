<?php
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);
?>
<body>
	<div class="wrapper_box1">
		<div class="message">
			<?php 
				if (!isset($error_message)) {
					echo '投稿ありがとう';
				} else {
					echo $error_message;
				}
			?>
		</div>
		
		<div class="input">
			<form action="/record/record.php" method="post">
					<input type="hidden" name="method" value="check">        
					<textarea name="output" cols="50" rows="10" placeholder="投稿はここよん"></textarea>
		</div>
		<div class="button_n">
			<button type="submit">確認</button>
			</form>	
		</div>
	</div>
	<div class="wrapper_box2">
		<?php if (isset($this->Model->records)){ ?>
		<div class="message">
			投稿一覧
		</div>
			<?php foreach ($this->Model->records as $record) { ?>
			<?php $r = unserialize($record); ?>
			<div class="clip-box">
				<div class="content">
					<a href="../record_detail/record_detail.php?id=<?php echo $r->id; ?>"><?php echo $r->created; ?></a>
				</div>
				<div class="content">
					<a href="../record_detail/record_detail.php?id=<?php echo $r->id; ?>"><?php echo $r->output; ?></a>
				</div>
			</div>
			<?php } ?> 
		<?php } ?>
		<?php if (isset($error_message) && !isset($this->Model->records)){ ?>
			<div class="button_t">
				<form action="./record.php" method="post" >
					<input type="hidden" name="method" value="start">
						<button type="submit"> 
						TOPページに戻る
						</button>
				</form>
			</div>
		<?php } ?>
	</div>

</body>

