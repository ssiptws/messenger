<?php 
    session_start();
    include('header.php');
    $loginError = '';
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
	include ('Chat.php');
	$chat = new Chat();
	$user = $chat->loginUsers($_POST['username'], $_POST['password']);	
	if(!empty($user)) {
		$_SESSION['username'] = $user[0]['username'];
		$_SESSION['userid'] = $user[0]['userid'];
		$chat->updateUserOnline($user[0]['userid'], 1);
		$lastInsertId = $chat->insertUserLoginDetails($user[0]['userid']);
		$_SESSION['login_details_id'] = $lastInsertId;
		header("Location:index.php");
	} else {
		$loginError = "Invalid username or password!";
	}
}

?>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="stylelogin.css" type="text/css">
</head>
<body style="background: url(bg2.png) no-repeat top center / cover;">
    <div style= "margin: 10%">
        <h2>Login</h2> 
        <form method="post">
        <div class="containerlogin">
            <div class="formgroup">
                <?php if ($loginError ) { ?>
					<div class="alert alert-warning"><?php echo $loginError; ?></div>
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
			
            <button type="submit">Masuk</button>
            <input type="checkbox" checked="checked"><span> Ingat Saya</span>
        </div>
        <div class="containerlogin" style="background-color: #25333D; margin-top: 10px">
			<a href="register.php" class="regisbtn regislink">Registration</a>
            <a href="forgot.php" class="forgot">Lupa Password?</a>
        </div>
        </form>
    </div>
</body>
</html>