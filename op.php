<?php
    include_once("./dependencies.php");      //加载依赖项
    session_start();

    error_reporting(E_ERROR);
    $o_msg = "";
    if ($_POST['strin'] != null) {    //尽管不允许提交空的添加字符串，还是以防万一写一下。
        $strin = $_POST['strin'];
    } else {
        $strin = "";
    }
    $strin = strip_tags($strin);
    $strin = trim($strin);    //去除字符串前后空格；中间的空格的去除还没做
    if ($strin != null and $strin != "") {    //判断分割的字符串在去左右空格后是否为空
        $strin_array = explode("/", $strin);    //按"/"拆分非空字符串
    } else {
        $strin_array = array();
    }
    foreach ($strin_array as $key => $value) {
        $strin_array[$key] = trim($value);    //去除姓名数组中各个字符串前后空格
    }
    $strin_array = array_unique($strin_array);
    switch ($_POST['cmd']) {  //指令判定
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
        $_SESSION['stulist'] = new \Ds\Vector();  //初次运行为null，如果直接装Vector操作会爆炸。
    }
    function deleteobj($target = "")  //按字符串删除
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
    function addobj($target = array())  //添加
    {
        global $o_msg;
        if (count($target) != 0) {  //判断传入的是否为空字符串
            $addlen = 0;
            $lastadd = "NaN";
            foreach ($target as $key => $value) {
                if ($value == NULL || $value == "") {
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