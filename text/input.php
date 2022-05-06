<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿</title>
</head>
<body>
	<form action="./text.php" method="post">
    <input type="hidden" name="job" value="check">        
		<textarea name="output" cols="50" rows="10" placeholder="今日は何をした？"></textarea>
    <button type="submit">確認</button>
  </form>
</body>
</html>
