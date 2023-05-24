<?php

$database = "RESIDENCIAL";
$username = "root";
$password = "";

try{
    $conn = mysqli_connect("localhost",$username,$password,$database,);

}catch(PDOException $e){
    echo 'ERROR: '.$e->getMessage();

}

?> 
