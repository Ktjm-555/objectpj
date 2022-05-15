<?php
  ini_set('display_errors', 'On');
  
  // URLのパラメータを読み取る
  $uri = $_SERVER['REQUEST_URI'];
  $paras = array();
  $paras = explode('/', $uri);

  // パラメーターがあるなしによって、uriの.phpの前を指定する
  if (array_key_exists(2, $paras) && !empty($paras[2])) { 
    $page = $paras[2];
  } else {
    $page = 'text';
  }

// そのページを読み込む
  include_once ($page.'/index.php');

// クラスを読み込む準備
  $func = ucfirst($page);
  $class = new $func();

// 使うメソッドを受け取っていたら受け取る
  $method = '';
  if (array_key_exists('method', $_REQUEST)) {
    $method = $_REQUEST['method'];
  }

// Point strlen 文字列が入ってれば、、、
// classに飛んでね
  if (strlen($method)) {
    $class->{$method}();
  } else {
    $class->start();
  }
?>