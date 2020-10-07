<?php
	$connect = mysqli_connect("localhost", "root", "", "ssip");
	if($connect === false){
		die("ERROR: ga konek" . mysqli_connect_error());
	}
?>