<?php
if(isset($_COOKIE['passkey'])){
	header('location: command.php');
}
?>
<html>
<head>
	<title>Command Login</title>							<!--use common css sheet-->
	<link rel="stylesheet" href="styles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<h1 title="please enter password">Enter the Home Password</h1>
	<br><br>
	<form action="authenticate.php" method="post">					<!--get password and hand-->
		<input type="password" name="password"/><br>				<!--off to auth program-->
		<input type="submit" value='Enter Command Center'/>
	</form>
	<br>
</body>
</html>
