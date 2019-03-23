<?php session_start(); ?>
<!DOCTYPE html><!--本页面是为未来登陆系统做准备，目前无用。-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>登录 | 点名系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/main.css">
    <?php
        //主要登陆代码
    ?>
</head>
<body>
    <form action="login.php" method="post">
        <input type="email" name="email" id="email"><!--架构设计：无密码，仅邮件，无专用登陆系统-->
        <input type="submit" value="submit"><!--此按钮回调到自身页面，扔给给上面的PHP代码做登录。-->
    </form>
</body>
</html>