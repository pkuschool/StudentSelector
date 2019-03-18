<?php
     $con = mysqli_connect("localhost:3306",'root','15926807');
     mysqli_select_db($con,"bigproject");
     $result = mysqli_fetch_all(mysqli_query($con,"SELECT name FROM choose")) ;
     $output = [];
     foreach ($result as $value){
        array_push($output,$value[0]);
     };
     print_r($output);
?>