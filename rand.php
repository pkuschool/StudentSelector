<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>随机 | 点名系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <script>
        function reloadp() {
            history.go(0);

        }
    </script>
</head>

<body class="blue" style=" font-family: '思源黑体', 'PingFang SC', 'Segoe UI';">
    <div class="container  white-text center centered center-align">
        <div class=" card-panel white black-text hoverable waves-effect waves-ripple" style="margin-top: 300px;width: 100%" onclick="setTimeout(reloadp,350);">
            <p class=" blue-grey-text" style="font-size: 75px;"><?php
                                                                session_start();
                                                                error_reporting(E_ERROR);
                                                                include_once("./dependencies.php");
                                                                if (count($_SESSION['stulist']) > 0) {
                                                                    $randint = random_int(0, count($_SESSION['stulist']) - 1);
                                                                    //echo count($_SESSION['stulist'])."<br>";
                                                                    //echo $randint;
                                                                    $o_msg = $_SESSION['stulist']->get($randint);
                                                                } else {
                                                                    $o_msg = "空空如也";
                                                                }
                                                                echo $o_msg; ?></p>

        </div>
        <div onclick="window.open('main.php', '_self')" class="btn blue darken-3 white-text waves-ripple waves-effect"><i class="material-icons">home</i></div>
    </div>
</body>

</html>