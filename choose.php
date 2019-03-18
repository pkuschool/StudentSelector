<?php
    $con = mysqli_connect("localhost:3306",'root','15926807');
    mysqli_select_db($con,"bigproject");
    $result = mysqli_query($con,"SELECT name FROM choose");
    $data = mysqli_fetch_all($result,MYSQLI_NUM);
    $return = $data[rand(0,count($data) - 1)];
    echo $return[0]
?>