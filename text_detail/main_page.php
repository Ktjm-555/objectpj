<div class="button">
    <form action="../text/text.php" method="post" >
      <input type="hidden" name="method" value="start">
        <button type="submit"> 
        TOPページに戻る
        </button>
    </form>
<div>
  <?php if (isset($this->Model->output) && isset($this->Model->created)) { ?>
    <?php echo $this->Model->output; ?>
    <?php echo $this->Model->created; ?>
  <?php } ?> 
</div>
<div>
  <h1>コメント</h1>
</div>
<div>
<form action="./text_detail.php" method="post">
    <input type="hidden" name="method" value="check">
    <input type="hidden" name="text_d_id" value="<?= $this->Model->text_d_id ?>">
    <div>
      <input type="text" name="nickname" size="35" maxlength="255" value="">
    <div>

    <div>
		  <textarea name="come" cols="50" rows="10"></textarea>
    </div>
		<?php 
			if (!isset($error_message)) {
				echo 'コメントありがとう';
			} else {
				echo $error_message;
			}
		?>
    <button type="submit">確認</button>
	</form>
  コメント表示
	<?php if (isset($this->Model->comments)){ ?>
		<?php foreach ($this->Model->comments as $comment) { ?>
      <?php $c = unserialize($comment); ?>
      <div>
        <?php echo $c->come; ?>
        <?php echo $c->created; ?>
      </div>
    <?php } ?>
  <?php } ?>

</div>
