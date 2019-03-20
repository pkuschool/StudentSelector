<?php
     $img = $_FILES["file"];
     $imgtrace = "upload/" . $img["name"];
     $input = $_POST['name'];
     $con = mysqli_connect("localhost:3306",'root','15926807');
     mysqli_select_db($con,"bigproject");
     mysqli_query($con,"INSERT INTO choose (name,img) VALUES ('$input','$imgtrace')");
     echo "people have added";
     move_uploaded_file($img["tmp_name"],$imgtrace)
?>