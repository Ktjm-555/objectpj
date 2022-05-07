<?php
 /**
   * エスケープ処理
   */
  function h($value)
  {
    return htmlspecialchars($value, ENT_QUOTES);
  }

?>