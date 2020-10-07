<?php
	session_start();
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		header("location: index.php");
		exit;
	}
	require_once "connect.php";
	$username = $password = "";
	$username_err = $password_err = "";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(empty(trim($_POST["username"]))){
			$username_err = "Please enter username";
		}
		else{
			$username = trim($_POST["username"]);
		}
		
		if(empty(trim($_POST["password"]))){
			$password_err = "Please enter password";
		}
		else{
			$password = trim($_POST["password"]);
		}
		
		if(empty($username_err) && empty($password_err)){
			$sql = "SELECT id, username, password FROM users WHERE username = ?";
			if($stmt = mysqli_prepare($connect, $sql){
				mysqli_stmt_bind_param($stmt, "s", $param_username);
				$param_username = $username;
				
				if(mysqli_stmt_execute($stmt)){
					mysqli_stmt_store_result($stmt);
					
					if(mysqli_stmt_num_rows($stmt) == 1){
						mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
						if(mysqli_stmt_fetch($stmt){
							if(password_verify($password, $hashed_password){
								session_start();
								$_SESSION["loggedin"] = true;
								$_SESSION["id"] = $id;
								$_SESSION["username"] = $username;
								header("location: index.php");
							}
							else{
								$password_err = "Wrong password";
							}
						}
					}
					else{
						$username_err = "No account";
					}
				}
				else{
					echo "something went wrong.";
				}
			}
		}
		mysqli_stmt_close($stmt);
	}
?>
<!-- 
	TODO: TWEAK LOGIN PAGE
!-->
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="stylelogin.css" type="text/css">
</head>
<body style="background: url(bg2.png) no-repeat top center / cover;">
    <div style= "margin: 10%">
        <h2>Login</h2> 
        <form action="" method="post">
        <div class="container">
            <label><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>
            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required> 
            <button type="submit">Masuk</button>
            <input type="checkbox" checked="checked"><span> Ingat Saya</span>
        </div>
        <div class="container" style="background-color: #25333D; margin-top: 10px">
			<a href="register.php" class="regisbtn regislink">Registration</a>
            <a href="forgot.php" class="forgot">Lupa Password?</a>
        </div>
        </form>
    </div>
</body>
</html>