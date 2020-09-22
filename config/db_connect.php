<?php
    //connect to database
    $conn = mysqli_connect('localhost','rahul','newUser@123','cake_zone');

    if(!$conn){
    echo 'connection error '.mysqli_connect_error();
    }
?>