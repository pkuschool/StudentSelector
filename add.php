<?php
     $input = $_POST['name'];
     $con = mysqli_connect("localhost:3306",'root','15926807');
     mysqli_select_db($con,"bigproject");
     mysqli_query($con,"INSERT INTO choose (name) VALUES ('$input')");
     echo "people have added";
?>