<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    session_start();
    include_once("./dependencies.php");
    if (count($_SESSION['stulist']) > 0) {
        $randint = random_int(0, count($_SESSION['stulist']) - 1);
        //echo count($_SESSION['stulist'])."<br>";
        //echo $randint;
        $o_msg = "选择了：" . $_SESSION['stulist']->get($randint);
    } else {
        $o_msg = "班级内无人。";
    }
    ?>
</head>

<body>
    <div class="container">

    </div>
</body>

</html>