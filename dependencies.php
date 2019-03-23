<?php
    //这个页面用来暴力引用dependencies。使用时直接include_once()即可。
echo '<link rel="stylesheet" href="./css/normalize.css">';
echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">';
echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
echo '<script src="./js/anijs.js"></script>';
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>';
include_once "./dbc.php";
?>
