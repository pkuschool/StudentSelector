<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>管理 | 点名系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
include_once "./dependencies.php"; //加载依赖项
session_start();

error_reporting(E_ERROR);
$o_msg = "";
if ($_POST['strin'] != null) { //尽管不允许提交空的添加字符串，还是以防万一写一下。
    $strin = $_POST['strin'];
} else {
    $strin = "";
}
$strin = strip_tags($strin);
$strin = preg_replace('# #','',$strin); //去除字符串中所有空格
if ($strin != null and $strin != "") { //判断分割的字符串在去空格后是否为空
    $strin_array = explode("/", $strin); //按"/"拆分非空字符串
} else {
    $strin_array = array();
}
foreach ($strin_array as $key => $value) {
    $strin_array[$key] = trim($value); //去除姓名数组中各个字符串前后空格
}
$strin_array = array_unique($strin_array);
switch ($_POST['cmd']) { //指令判定
    case 'add':
        addobj($strin_array);
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
    $_SESSION['stulist'] = new \Ds\Vector(); //初次运行为null，如果直接装Vector操作会爆炸。
}
function deleteobj($target = "") //按字符串删除

{
    global $o_msg;
    $o_msg = "已删除 ";
    $deletesucc = 0; //删除次数：0为未删除，1为删除了一次，以此类推
    foreach ($_SESSION['stulist'] as $key => $p_v) {
        if ($p_v == $target) {
            $_SESSION['stulist']->remove($key);
            $deletesucc++; //确认删除成功
        }
    }
    if ($deletesucc == 0) {
        $o_msg = "学生未录入，无法删除";
    } else {
        $o_msg .= $target;
        if ($deletesucc > 1) {
            $o_msg .= "(" . $deletesucc . ")"; //如果发现删除了多个，则提示。
        }
    }
    announce($o_msg);
}
function addobj($target = array()) //添加

{
    global $o_msg;
    if (count($target) != 0) { //判断传入的是否为空字符串
        $addlen = 0;
        $lastadd = "NaN";
        foreach ($target as $key => $value) {
            if ($value == null || $value == "") {
                continue;
            }
            $dup = false;

            foreach ($_SESSION['stulist'] as $srckey => $srcvalue) {
                if ($value == $srcvalue) {
                    $dup = true;
                }
            }
            if (!$dup) {
                $_SESSION['stulist']->push($value);
                $addlen++;
                $lastadd = $value;
            }
        }
        if ($addlen > 1) {
            $o_msg = "已添加 " . $addlen . " 个学生。";
        } else if ($addlen == 1) {
            $o_msg = "已添加 " . $lastadd;
        } else {
            $o_msg = "添加失败。所有要添加的项目均已存在。";
        }
        announce($o_msg);
    }
}
function clearobj() //清空

{
    global $o_msg;
    $countlength = count($_SESSION['stulist']);
    $_SESSION['stulist']->clear(); //清空整个列表
    $o_msg = "已移除所有学生，共 " . $countlength . " 个。";
    announce($o_msg);
}

?>
    <script>
        function clearprompt() {
            var sure = confirm("是否清空列表？");
            if (sure) {
                post('main.php', {
                    cmd: 'clear',
                    strin: ''
                }) //发送关闭指令
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

<body class=" teal lighten-3 white-on-small" style=" font-family: '思源黑体', 'PingFang SC', 'Segoe UI';">
    <div class="container centwindow">
        <ul class="collection with-header z-depth-2" style="padding: 0px 0px;">
            <li class="collection-header teal white-text row z-depth-2" style="padding-top: 5px;margin-top: 0px;margin-bottom: 0;">
                <p style="font-size: 24px;margin-top: 5px;margin-bottom: 5px;font-weight: 350;" class="col">点名系统 0.0.3</p>
                <?php if (count($_SESSION['stulist']) != 0) {?>
                    <div class="right topbtn">
                        <i class="material-icons topbtn selectbtn color-transition" title="点名" onclick="window.open('./rand.php', '_self')">group</i>
                        <i class="material-icons topbtn delbtn color-transition" title="清空" onclick="clearprompt()">delete_sweep</i>

                    </div>

                    <!-- <button class="btn col s1 blue white-text z-depth-1 waves-light waves-effect topbtn"></button>
                            <button class="btn col s1 red white-text z-depth-1 waves-light waves-effect topbtn"></button> -->
                <?php
}?>
            </li>
            <li class="collection-item">
                <form action="./main.php" method="post" class="row" style="margin-bottom: 0px;">
                    <input type="text" name="strin" id="strin" class="validate col s12" placeholder="请输入要添加学生的名字，添加多个请以/分隔，回车以提交。" required>
                    <input type="text" name="cmd" id="cmd" value="add" class="hide">
                    <button type="submit" class="btn col s1 hide" style="height: 3rem;font-size: 30px;"><i class="material-icons">add</i></button>
                </form>
            </li>
            <?php if ($o_msg != "") {?>
                <li class="collection-item">
                    <p class="teal-text"><span style="font-size:20px; margin-bottom: 10px;"><?php echo $o_msg; ?></span></p>
                </li>

            <?php
}

foreach ($_SESSION['stulist'] as $key => $value) {
    ?>
                <li class="collection-item">
                    <div><?php echo htmlspecialchars($value) ?><a class="secondary-content"><i class="material-icons delbtn dred color-transition" onclick="post('main.php',{cmd: 'del', strin: '<?php echo $value; ?>'})">delete</i></a></div>
                </li><?php

}
?>
        </ul>


    </div>
</body>
<script src="./js/select.js"></script>


</html>
<?php

function announce($in = "")
{
    echo "<script>M.toast({html: '" . $in . "'})</script>";
}
?>