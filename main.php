<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>主页</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    include_once("./dependencies.php");
    session_start();
    $o_msg = "";
    if ($_SESSION['p_list'] == null) {
        $_SESSION['p_list'] == new \Ds\Vector();
    }
    $p_data = $_SESSION['p_list'];
    if ($_POST['s_op'] == 'D') {
        $o_msg = "Deletion: ";
        foreach ($p_data as $key => $p_v) {
            if ($_p_v == $_POST['s_name']) {
                $p_data->remove($key);
                $o_msg.=$_p_v;
                $o_msg.=", ";
            }
        }
    } else if ($_POST['s_op'] == 'A') {
        $dupicatecheck = $p_data->contains(s_name);
        if (!$dupicatecheck) {
            $p_data->push($_POST['s_name']);
            $o_msg = "Added: ".$_POST['s.name'];
        }else{
            $o_msg = "Item Already Exist.";
        }
    }else{
        $randint = random_int(0, count($p_data));
        $o_msg = "Selected: " . $p_data->get($randint);
    }

    ?>
</head>

<body>
    <div id="container">
        <form action="main.php" method="post">
            <input type="text" name="s_name" id="s_name" class="card-panel teal">
            <input type="text" name="s_op" id="s_op" class="card-panel teal" value="A">
            <input type="submit" value="提交" class="waves-effect waves-light btn">
        </form>
        <p class="teal-text"><?php echo $o_msg;?></p>
    </div>
</body>

</html>