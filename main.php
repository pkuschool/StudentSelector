<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>主页</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    session_start();
    error_reporting(E_ERROR);
    include_once("./dependencies.php");
    //命令列表：D为按字符串删除，A为增加，S为随机选择，L为列出，C为清空。
    $o_msg = "";
    if ($_POST['strin'] != null) {
        $strin = $_POST['strin'];
    } else {
        $strin = "";
    }
    switch ($_GET['cmd']) {
        case 'add':
            addobj($strin);
            break;

        case 'del':
            deleteobj($strin);
            break;

        case 'clear':
            clearobj();
            break;
        default:
            # code...
            break;
    }
    if ($_SESSION['stulist'] == null) {
        $_SESSION['stulist'] = new \Ds\Vector();
    }
    function deleteobj($target = "")
    {
        $o_msg = "删除：";
        $deletesucc = false;
        foreach ($_SESSION['stulist'] as $key => $p_v) {
            if ($p_v == $target) {
                $_SESSION['stulist']->remove($key);
                $o_msg .= $p_v;
                $o_msg .= ", ";
                $deletesucc = true;
            }
        }
        if (!$deletesucc) {
            $o_msg = "项目不存在，无法删除。";
        }
        announce($o_msg);
    }
    function addobj($target = "")
    {
        if ($target != "") {
            $dupicatecheck = false;
            foreach ($_SESSION['stulist'] as $key => $p_v) {
                if ($p_v == $target) {
                    $dupicatecheck = true;
                }
            }
            if (!$dupicatecheck) {
                $_SESSION['stulist']->push($target);
                $o_msg = "已添加：" . $target;
            } else {
                $o_msg = "项目已存在。";
            }
        }
        announce($o_msg);
    }
    function clearobj()
    {
        $_SESSION['stulist']->clear();
        $o_msg = "清空完毕！";
        announce($o_msg);
    }
    function announce($in = "")
    {
        echo "<script>M.toast({html: '" . $in . "'})</script>";
    }

    ?>
    <script>
        function clearprompt() {
            var sure = confirm("是否清空？");
        }
    </script>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <div class="container">
        <div class="row" style="margin-top:10px;">

        </div>
        <ul class="collection with-header z-depth-1" style="padding: 0px 0px;">
            <li class="collection-header teal white-text row" style="padding-top: 5px;margin-bottom:0px;">
                <p style="font-size: 24px;margin-top: 5px;margin-bottom: 5px;" class="col s10">点名系统 0.0.2</p>
                <button class="btn col s1 blue white-text z-depth-1 waves-light waves-effect topbtn" onclick="window.open('./rand.php', '_blank')">随机</button>
                <button class="btn col s1 red white-text z-depth-1 waves-light waves-effect topbtn" onclick="clearprompt()">清空</button>
            </li>
            <li class="collection-item">
                <div>Alvin<a href="#!" class="secondary-content"><i class="material-icons">delete</i></a></div>
            </li>
        </ul>

        <p class="teal-text"><?php echo $o_msg; ?></p>
    </div>
</body>


</html>