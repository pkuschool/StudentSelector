<?php
  session_start();
  include_once("./dbconnect.php")
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>点名系统</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="./res/main.css">
  <script src="./res/main.js"></script>
</head>
<body>
  <h1>点名系统</h1>
  <form action="" method="post">
    <label for="s_names">姓名</label><input type="text" name="s_names" id="s_names"><br />
    <input type="submit" value="提交">
  </form>
</body>
</html>
