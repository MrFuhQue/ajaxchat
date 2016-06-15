<?php
$admins = "Slain";
$version = "2.0.3";
?>

<html>

<head>
<title>AJAX Chat - v2</title>
<link rel="stylesheet" type="text/css" href="css/cb_style.css">

<script type="text/javascript" src="lib/js/ajax.js"></script>
<script type="text/javascript" src="lib/js/chat.js"></script>

<link rel="shortcut icon" href="lib/emotes/favicon.ico" />

</head>

<body onbeforeunload="signInForm.signInButt.name='signOut';signInOut()" onload="hideShow('hide')" bgcolor=#000000 >

	<div id="chatBox"><center><span style="color:#FF2414"><b>Ajax Chat - Version: <?php echo $version; ?></b></span></center><hr></div>
	</div><div id="usersOnLine"><br /><span style="color:#FF2414"><center>Access Denied</center></span></div>
	<div id="serverRes"><center><span style="color:#FF2414"><?php echo $version; ?></span></center></div>
<form onsubmit="signInOut();return false" id="signInForm">
	<input id="userName" type="text">
	<input id="signInButt" name="signIn" type="submit" value="Sign in">
	<span id="signInName">User name</span>
	</form>
	<form onsubmit="sendMessage();return false" id="messageForm" class="field">
		<input id="message" type="text" width="10%">
</form>

<div id="box"><center>Emoticons</center><hr><center><img src="lib/emotes/smile" title=":)"> <img src="lib/emotes/sad" title=":("> <img src="lib/emotes/grin" title=":D"> <img src="lib/emotes/wink" title=";)"> <img src="lib/emotes/tongue" title=":P"> <img src="lib/emotes/crazy" title="o0"></center></div>
</body>
</html>
