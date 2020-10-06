<?php
    // include_once("pass.php");
    $c=$_GET["c"];
    $con=mysqli_connect("localhost","root","","ssip");
    $res=mysqli_query($con,"INSERT INTO messege (msg, msg_time) VALUES ('$c', now())");
//    if($res) echo $c." is successfully written into database table";
//    else echo "error";
?>