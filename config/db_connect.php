<?php
    //connect to database
    $conn = mysqli_connect('localhost','rahul','phpblog12345','cakezone');

    if(!$conn){
    echo 'connection error '.mysqli_connect_error();
    }
?>