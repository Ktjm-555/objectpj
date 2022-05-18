<body>
	<div class="wrapper_box1">
    <div class="display">
      <form action="./record.php" method="post"> 
        <input type="hidden" name="method" value="regist"> 
        <div class="content">       
          <?php 
            echo $this->Model->output;
          ?>
        </div>
    </div>
    <div class="button_n">
        <button type="submit">投稿</button>
      </form>
    </div>
  </div>
  <div class="wrapper_box2">
  <div class="button_t">
      <form action="./record.php" method="post" >
        <input type="hidden" name="method" value="start">
          <button type="submit"> 
          TOPページに戻る
          </button>
      </form>
    </div>
  </div>
</body>