<body>
  <div class="wrapper_come_box">
    <div class="message">
      <?php 
        if (!isset($error_message)) {
          echo 'コメントありがとう';
        } else {
          echo $error_message;
        }
      ?>
    </div>
    <div class="input">
      <form action="./record_detail.php" method="post">
        <input type="hidden" name="method" value="check">
        <input type="hidden" name="record_d_id" value="<?= $this->Model->record_d_id ?>">
        <div class="entry">
          <input type="text" name="nickname" size="35" maxlength="255" placeholder="nickname">
        </div>
        <div class="entry">
          <textarea name="come" cols="50" rows="10" placeholder="コメントはここよん"></textarea>
        </div>
    </div>
    <div class="button_n">
        <button type="submit">確認</button>
      </form>
    </div>
  </div>
	<div class="wrapper_box2">
    <?php if (isset($this->Model->output) && isset($this->Model->created)) { ?>
      <div class="clip-box-a">
        <p class="content"><?php echo $this->Model->created; ?></p>
        <p class="content"><?php echo $this->Model->output; ?></p>
      </div>
    <?php } ?> 
   
    <?php if (isset($this->Model->comments)){ ?>
      <div class="message">コメント表示</div>
      <?php foreach ($this->Model->comments as $comment) { ?>
        <?php $c = unserialize($comment); ?>
        <div class="clip-box">
          <div class="contents">
            <div class="content">
              <p class="come"><?php echo $c->created; ?></p>
              <p class="come"><?php echo $c->nickname; ?></p>
            </div>
            <p class="content"><?php echo $c->come; ?></p>
          </div>
          <div class="button_d">
					<form action="./record_detail.php" method="post">
            <input type="hidden" name="method" value="delete">
            <input type="hidden" name="record_d_id" value="<?php echo $c->record_d_id; ?>">
						<input type="hidden" name="id" value="<?php echo $c->id; ?>">
						<button type="submit">削除する</button>
					</form>
    		</div>
        </div>
      <?php } ?>
    <?php } ?>
    <div class="button_t">
      <form action="../record/record.php" method="post" >
        <input type="hidden" name="method" value="start">
        <button type="submit">TOPページに戻る</button>
      </form>
    </div>
  </div>
</body>