<!--本页面是专门的连接SQL页面，方便统一调试。开发用，等待接入。-->
<?php
include_once "./dbpwd.php";
$base = mysqli_connect("localhost", "stuselect", $dbpwd, "stuselectbase");
if (mysqli_connect_errno($base)) {
    echo "<p class='red card-panel white-text'><i class='material-icons left'>error_outline</i>连接 MySQL 失败: " . mysqli_connect_error( ) ."</p>";
}
?>