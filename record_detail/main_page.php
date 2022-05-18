<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
?>
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
          <div class="content">
            <?php echo $this->Model->created; ?>
          </div>
          <div class="content">
            <?php echo $this->Model->output; ?>
          </div>
        </div>
      <?php } ?> 
   
    <?php if (isset($this->Model->comments)){ ?>
      <div class="message">
          コメント表示
      </div>
      <?php foreach ($this->Model->comments as $comment) { ?>
        <?php $c = unserialize($comment); ?>
        <div class="clip-box">
          <div class="content">
            <?php echo $c->created; ?>
            <?php echo $c->nickname; ?>
          </div>
          <div class="content">
            <?php echo $c->come; ?>
          </div>
        </div>
      <?php } ?>
    <?php } ?>
    <div class="button_t">
      <form action="../record/record.php" method="post" >
        <input type="hidden" name="method" value="start">
          <button type="submit"> 
          TOPページに戻る
          </button>
      </form>
    </div>
  </div>
</body>