<body>
  <div class="wrapper_box1">
    <div class="display">
      <form action="./record_detail.php" method="post"> 
        <input type="hidden" name="method" value="regist">  
        <input type="hidden" name="record_d_id" value="<?= $this->Model->record_d_id ?>">
        <div class="content">       
          ニックネーム:
          <?php echo $this->Model->nickname; 	?>
        </div>
        <div class="content">       
          コメント:
          <?php echo $this->Model->come; ?>
        </div>
    </div>
    <div class="button_n">
        <button type="submit">投稿</button>
      </form> 
    </div>
  </div>
  <div class="wrapper_box2">
    <div class="button_t">
        <form action="./record_detail.php" method="post" >
          <input type="hidden" name="method" value="start">
          <input type="hidden" name="record_d_id" value="<?= $this->Model->record_d_id ?>">
            <button type="submit"> 
              TOPページに戻る
            </button>
        </form>
    </div>
    </form>
</body>