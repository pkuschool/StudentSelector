<?php session_start(); ?>
<!DOCTYPE html>
<!--本页面是为未来登陆系统做准备，目前无用。-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>登录 | 点名系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/main.css">
    <?php
    include_once("dependencies.php"); //Get Dependencies
    //主要登陆代码
    ?>
</head>

<body class="teal container">
    <form action="login.php" method="post" class="card-panel white z-depth-2">
    <div class="row">
        <div class="input-field col s12">
            <input placeholder="输入你注册时输入的邮箱" id="email" type="text" class="validate">
            <label for="first_name">邮箱</label>
        </div>
    </div>

        <div class="row">
            <div class="input-field col s12">
                <input placeholder="text" id="password" type="password" class="validate">
                <label for="password">密码</label>
            </div>
        </div>

    <button type="submit" class="btn ">登录</button>
    </form>
</body>

</html>