<html><head><title>auth</title></head><body>
<?php
					//create password variable
if($_POST["password"] == "testPass123"){						//hard coded password
					//hard coded password (excluded from github upload)

	setcookie('passkey','TRUE',time()+(86400*30),"/");	//set a password cookie good for a long time
	header('location: command.php');			//redirect to command center
}
else{
	header('location: login.php');				//if password is wrong, redirect to entry point
}
?>
</body></html> 
