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