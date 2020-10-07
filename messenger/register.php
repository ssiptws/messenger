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
    <link rel="stylesheet" href="regismenu.css" type="text/css">
</head>
<body >
        <div class="container">
        	
      <div class="navbar">
        <div class="menu">
          <h3 class="logo"><span style="color: red">IMPOSTOR</span> Mess<span>enger</span></h3>
          <div class="hamburger-menu">
            <div class="bar"></div>
          </div>
        </div>
      </div>

      <div class="main-container">
        <div class="main">
          <header>
            <div class="overlay">
              <div class="inner">
                <h2>Signup</h2> 

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		
        <div class="containerlogin">
		
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
				<input type="password" placeholder="Enter Password" name="confirm_password" value="<?php echo $confirm_password; ?>" required> 
				<span class="help-block"><?php echo $confirm_password_err; ?></span>
			</div>
			
            <button type="submit">Register</button>
        </div>
		
        <div class="containerlogin" style="background-color: #25333D; margin-top: 10px;">
			<p style="color : WHITE"> Sudah punya akun? <a href="login.php" style="color: white">Login disini</a>.</p>
        </div>
		
        </form>
              </div>
            </div>
          </header>
        </div>

        <div class="shadow one"></div>
        <div class="shadow two"></div>
      </div>

      <div class="links">
        <ul>
          <li>
            <a href="index.html" style="--i: 0.05s;">Home</a>
          </li>
          <li>
            <a href="login.php" style="--i: 0.1s;">Login</a>
          </li>
          <li>
            <a href="messeging.php" style="--i: 0.15s;">Messege</a>
          </li>
          <li>
            <a href="#" style="--i: 0.2s;">Profile</a>
          </li>
          <li>
            <a href="#" style="--i: 0.25s;">Setting</a>
          </li>
        </ul>
      </div>
    </div>

    <script src="app.js"></script>
</body>
</html>