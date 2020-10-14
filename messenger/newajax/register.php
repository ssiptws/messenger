<?php
	SESSION_START();
	include('header.php');
	$registerError = '';
	if (!empty($_POST['username']) && !empty($_POST['password'])) {
		include ('Chat.php');
		$chat = new Chat();
		$register = $chat->registerUsers($_POST['username'], $_POST['password']);	
		if(empty($register)) {
			header("Location: login.php");
		} else {
			$registerError = "Invalid username or password!";
	}
}
?>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" href="css/stylelogin.css" type="text/css">
    <link rel="stylesheet" href="css/stylesendiri.css" type="text/css">
</head>
<body style="background: url(assets/bg2.png) no-repeat top center / cover;">
        <div class="containerlogin">
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
        <form method="post">
        <div class="containerlogin">
			<div class="formgroup">
				<?php if($registerError){ ?>
					<div class="alert alert-warning"><?php echo $registerError; ?></div>
				<?php } ?>
			</div>
			<div class="formgroup">
				<label><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="username" required>
			</div>
			<div class="formgroup">
				<label><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" required> 
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

    <script src="js/app.js"></script>
</body>
</html>