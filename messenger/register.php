<?php
	require_once "connect.php";
	$username = $password = $confirm_password = "";
	$username_err = $password_err = $confirm_password_err = "";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(empty(trim($_POST["username"]))){
			$username_err = "Please enter a username.";
		}
		else{
			$sql = "SELECT id FROM users WHERE username = ?";
			if($stmt = mysqli_prepare($connect, $sql)){
				mysqli_stmt_bind_param($stmt, "s", $param_username);
				$param_username = trim($_POST["username"]);
				if(mysqli_stmt_execute($stmt)){
					mysqli_stmt_store_result($stmt);
					if(mysqli_stmt_num_rows($stmt) == 1){
						$username_err = "This username already exist.";
					}
					else{
						$username = trim($_POST["username"]);
					}
				}
				else{
					echo "Something went wrong. Please try again later.";
				}
				mysqli_stmt_close($stmt);
			}
		}
		if(empty(trim($_POST["password"]))){
			$password_err = "Please enter a password.";     
		} 
		elseif(strlen(trim($_POST["password"])) < 6){
			$password_err = "Password must have atleast 6 characters.";
		} 
		else{
			$password = trim($_POST["password"]);
		}
		if(empty(trim($_POST["confirm_password"]))){
			$confirm_password_err = "Please confirm password.";
		}
		else{
			$confirm_password = trim($_POST["confirm_password"]);
			if(empty($password_err) && ($password != $confirm_password)){
				$confirm_password_err = "Password mismatch.";
			}
		}
		if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
			$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
			if($stmt = mysqli_prepare($connect, $sql)){
				mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
				$param_username = $username;
				$param_password = password_hash($password, PASSWORD_DEFAULT);
				if(mysqli_stmt_execute($stmt)){
					header("location: login.php");
				}
				else{
					echo "Something went wrong";
				}
				mysqli_stmt_close($stmt);
			}
		}
		mysqli_close($connect);
	}
?>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" href="stylelogin.css" type="text/css">
</head>
<body style="background-color: #2980b9">
    <div style= "margin: 10%">
        <h2>Signup</h2> 
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="container">
			<div class="formgroup <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
				<label><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="username" value="<?php echo $username; ?>" required>
				<span class="help-block"><?php echo $username_err; ?></span>
			</div>
			<div class="formgroup <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
				<label><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" value="<?php echo $password; ?>" required> 
				<span class="help-block"><?php echo $password_err; ?></span>
			</div>
			<div class="formgroup <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
				<label><b>Confirm Password</b></label>
				<input type="password" placeholder="Enter Password" name="confirm_password" value="<?php echo $confirm_password; ?> required> 
				<span class="help-block"><?php echo $confirm_password_err; ?></span>
			</div>
            <button type="submit">Register</button>
        </div>
        <div class="container" style="background-color: #13232f; margin-top: 10px">
			<p> Sudah punya akun? <a href="login.php"> Login disini</a>.</p>
			<!-- <a href="register.php" class="regisbtn regislink">Registration</a>
            <a href="forgot.php" class="forgot">Lupa Password?</a> -->
        </div>
        </form>
    </div>
</body>
</html>
	
	
	
	
	
	