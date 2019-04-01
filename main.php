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
    switch ($_POST['cmd']) {
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
        global $o_msg;
        $o_msg = "已删除 ";
        $deletesucc = false;
        foreach ($_SESSION['stulist'] as $key => $p_v) {
            if ($p_v == $target) {
                $_SESSION['stulist']->remove($key);
                $o_msg .= $p_v;
                $deletesucc = true;
            }
        }
        if (!$deletesucc) {
            $o_msg = "学生未录入，无法删除";
        }
        announce($o_msg);
    }
    function addobj($target = "")
    {
        global $o_msg;
        if ($target != "") {
            $dupicatecheck = false;
            foreach ($_SESSION['stulist'] as $key => $p_v) {
                if ($p_v == $target) {
                    $dupicatecheck = true;
                }
            }
            if (!$dupicatecheck) {
                $_SESSION['stulist']->push($target);
                $o_msg = $target . " 添加成功";
            } else {
                $o_msg = "学生已存在";
            }
        }
        announce($o_msg);
    }
    function clearobj()
    {
        global $o_msg;
        $countlength = count($_SESSION['stulist']);
        $_SESSION['stulist']->clear();
        $o_msg = "已移除所有学生，共 " . $countlength . " 个。";
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
            if (sure) {
                post('main.php', {
                    cmd: 'clear',
                    strin: ''
                })
            }
        }

        function post(path, params, method) {
            method = method || "post"; // Set method to post by default if not specified.

            // The rest of this code assumes you are not using a library.
            // It can be made less wordy if you use one.
            var form = document.createElement("form");
            form.setAttribute("method", method);
            form.setAttribute("action", path);

            for (var key in params) {
                if (params.hasOwnProperty(key)) {
                    var hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden");
                    hiddenField.setAttribute("name", key);
                    hiddenField.setAttribute("value", params[key]);

                    form.appendChild(hiddenField);
                }
            }

            document.body.appendChild(form);
            form.submit();
        }
    </script>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body class=" teal" style=" font-family: '思源黑体', 'PingFang SC', 'Segoe UI';">
    <div class="container" style="width:50%;">
        <ul class="collection with-header z-depth-1" style="padding: 0px 0px;margin-top: 100px;margin-bottom: 100px;">
            <li class="collection-header teal white-text row" style="padding-top: 5px;margin-top: 0px;margin-bottom: 0;">
                <p style="font-size: 24px;margin-top: 5px;margin-bottom: 5px;font-weight: 350;" class="col s10">点名系统 0.0.2</p>
                <?php if (count($_SESSION['stulist']) != 0) { ?>
                <button class="btn col s1 blue white-text z-depth-1 waves-light waves-effect topbtn" onclick="window.open('./rand.php', '_self')"><i class="material-icons">control_camera</i></button>
                <button class="btn col s1 red white-text z-depth-1 waves-light waves-effect topbtn" onclick="clearprompt()"><i class="material-icons">clear_all</i></button>
                <?php
            } ?>
            </li>
            <li class="collection-item">
                <form action="./main.php" method="post" class="row" style="margin-bottom: 0px;">
                    <input type="text" name="strin" id="strin" class="validate col s11" placeholder="输入要添加学生的名字..." required>
                    <input type="text" name="cmd" id="cmd" value="add" class="hide">
                    <button type="submit" class="btn col s1" style="height: 3rem;font-size: 30px;"><i class="material-icons">add</i></button>
                </form>
            </li>
            <?php if ($o_msg != "") { ?>
            <li class="collection-item">
                <p class="teal-text"><span style="font-size:20px; margin-bottom: 10px;"><?php echo $o_msg; ?></span></p>
            </li>

            <?php
        }

        foreach ($_SESSION['stulist'] as $key => $value) {
            ?>
            <li class="collection-item">
                <div><?php echo $value; ?><a class="secondary-content"><i class="material-icons" onclick="post('main.php',{cmd: 'del', strin: '<?php echo $value; ?>'})">close</i></a></div>
            </li><?php

                }
                ?>
        </ul>


    </div>
</body>
<script src="./js/select.js"></script>


</html>