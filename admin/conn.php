<?php

$conn = new mysqli("localhost","root","","poll");


if(!$conn){
    die($conn->error);
}


?>