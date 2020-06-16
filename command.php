<html>
<head>
<link rel="stylesheet" href="styles.css">
<title>Command Center</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
if(isset($_COOKIE['passkey'])){
	echo '<h1>Light Control Center 0.6</h1>';			//makes sure user has login cookie
	echo '<br><br>';
}
else{
	header('location: index.html');						//redirects user if without cookie
}
if(isset($_POST['end'])){							//logout funcion
	setcookie('passkey','false',time() -1);					//sets cookie expiration to past
	header('location: index.html');						//redirects to entry point
}
if(isset($_POST['lightToggle'])){						//function for light toggle
	$modeFile=fopen("deviceMode.txt","r");
	$mode=fgetc($modeFile);							//checks device mode
	if($mode=='0'){}else{							//if it's in auto, dont allow toggle
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
	fclose($statusFile);fclose($modeFile);}					//close lightState file
}
if(isset($_POST['modeToggle'])){						//function for mode toggle
	$modeFile=fopen("deviceMode.txt","r");					//same code as light toggle function
	$mode=fgetc($modeFile);							//but operates on different file
	if($mode=='0'){								//not copy-pasted bc nano, so check
		fclose($modeFile);$modeFile=fopen("deviceMode.txt","w");	//here first for errors
		fwrite($modeFile,'1');
	}else if($mode=='1'){
		fclose($modeFile);$modeFile=fopen("deviceMode.txt","w");
		fwrite($modeFile,'0');
	}
	$statusPrint=1;
	fclose($statusFile);fclose($modeFile);
}
if(!isset($_POST['lightToggle'])||!isset($_POST['modeToggle'])){$statusPrint=1;} //allows status report on first load
if($statusPrint=='1'){								//prints light status to site
	$statusFile=fopen("lightState.txt","r");				//opens lightState file to read
	$status=fgetc($statusFile);						//get light state from file
	$modeFile=fopen("deviceMode.txt","r");					//opens deviceMode and gets mode
	$mode=fgetc($modeFile);
	$counter=0;								//counter for loop with one iteration
	while($counter=='0'){							//breaks after one iteration
		if($mode=='1'){							//only displays toggle if in manual mode
			if($status=='1'){
				echo '<h2 style="background-color:#d4d411">Light is on</h2>';
				echo '<h2 style="background-color:#fcba03">Web control mode</h2>';}
			//if light is on
			else if($status=='0'){
				echo '<h2 style="background-color:#404040">Light is off</h2>';
				echo '<h2 style="background-color:#fcba03">Web control mode</h2>';}
			//if light is off
		}else{
			if($status=='1'){
				echo '<h2 style="background-color:#d4d411">Light is on</h2>';
				echo '<h2 style="background-color:#fcba03">Automatic mode</h2>';}
			else if($status=='0'){
				echo '<h2 style="background-color:#404040">Light is off</h2>';
				echo '<h2 style="background-color:#fcba03">Automatic mode</h2>';}
		}
			//if site is in manual mode
		$counter++;							//break while loop
	}									//wont work without, idk why
	fclose($statusFile);fclose($modeFile);					//close lightState and mode file
	$statusPrint=0;								//disable status print module
}
?>
<br><br>
<form method='post'>								<!--form that gets light input-->
	<input type="submit" name='lightToggle' value='Toggle light'> 		<!--button that allows light toggling-->
	<br><br>
	<input type="submit" name='modeToggle' value='Toggle mode'>
	<br><br>
	<input type="submit" name='end' value='Logout'>				<!--button that allows logout-->
</form>

</body></html>
