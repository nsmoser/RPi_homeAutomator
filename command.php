<html>
<head>
<link rel="stylesheet" href="styles.css">
<title>Command Center</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
// crack smoking room is room 0
//sex dungeon is room 1
if(isset($_COOKIE['passkey'])){
	echo '<h1>Light Control Center 0.8</h1>';			//makes sure user has login cookie
	echo '<br><br>';
	echo '<h2>Room: Crack Smoking Room</h2>';
	echo '<br><br>';
}
else{
	header('location: index.html');						//redirects user if without cookie
}
if(isset($_POST['end'])){							//logout funcion
	setcookie('passkey','false',time() -1);					//sets cookie expiration to past
	header('location: index.html');						//redirects to entry point
}
if(isset($_POST['room1'])){
	header('location: http://192.168.0.7/index.html');
}
if(isset($_POST['lightToggle'])){						//function for light toggle
	$statusFile=fopen("lightState.txt","r");				//open lightState file to read
	$lightState=fgetc($statusFile);						//get light state from file
	if($lightState=='0'){
		fclose($statusFile);$statusFile=fopen("lightState.txt","w");	//wipe file and reopen as write
		fwrite($statusFile,'1');					//write opposite state
	}else if($lightState=='1'){
		fclose($statusFile);$statusFile=fopen("lightState.txt",'w');	//wipe file and reopen as write
		fwrite($statusFile,'0');					//write opposite state
	}
	$statusPrint=1;								//activate status print module
	fclose($statusFile);							//close lightState file
}
if(!isset($_POST['lightToggle'])){$statusPrint=1;} //allows status report on first load
if($statusPrint=='1'){								//prints light status to site
	$statusFile=fopen("lightState.txt","r");				//opens lightState file to read
	$status=fgetc($statusFile);						//get light state from file
	$counter=0;								//counter for loop with one iteration
	while($counter=='0'){							//breaks after one iteration
		if($status=='1'){
			echo '<h2 style="background-color:#d4d411">Light is on</h2>';}
			//if light is on
		else if($status=='0'){
			echo '<h2 style="background-color:#404040">Light is off</h2>';}
			//if site is in manual mode
		$counter++;							//break while loop
	}									//wont work without, idk why
	fclose($statusFile);							//close lightState and mode file
	$statusPrint=0;								//disable status print module
}
?>
<br><br>
<form method='post'>								<!--form that gets light input-->
	<input type="submit" name='lightToggle' value='Toggle light'> 		<!--button that allows light toggling-->
	<br><br>
	<input type="submit" name='room1' value='Go to Sex Dungeon'>		<!--button that switches rooms-->
	<br><br>
	<input type="submit" name='end' value ='Logout'>			<!--button that logs out user-->
	<br><br>
</form>

</body></html>
