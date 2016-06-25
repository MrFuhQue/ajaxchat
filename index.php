<?php

include('lib/core.php');

$ver = $_SESSION['ver'];

?>

<html>

<head>
<title>Ajax/jQuery Chat</title>
<link rel="stylesheet" type="text/css" href="css/cb_style.css">

<script type="text/javascript" src="lib/js/ajax.js"></script>
<script type="text/javascript" src="lib/js/chat.js"></script>

<link rel="shortcut icon" href="lib/emotes/favicon.ico" />

</head>

<body onbeforeunload="signInForm.signInButt.name='signOut';signInOut()" onload="hideShow('hide')" bgcolor=#000000 >

	<div id="chatBox"><center><span style="color:#FF2414"><b>Ajax/jQuery & PHP Chat - Beta - Version: <?php echo $ver; ?></b></span></center><hr></div>
	<div id="usersOnLineHeader">
      <center><img src='lib/emotes/user'>Online Users<img src='lib/emotes/user'></center>
    </div>
	
	<div id="usersOnLine"><br /><span style="color:#FF2414"><center>Access Denied</center></span></div>
	<div id="serverRes"><center><span style="color:#FF2414"><?php echo $ver; ?></span></center></div>
<form onsubmit="signInOut();return false" id="signInForm">
	<input id="userName" type="text" maxlength="12" autocomplete="off" placeholder="username">
	<input id="passw" type="text" autocomplete="off" placeholder="password">
	<input id="signInButt" name="signIn" type="submit" value="Sign in">
	<span id="signInName">User name</span>
	</form>
	<form onsubmit="sendMessage();return false" id="messageForm" class="field">
		<input id="message" type="text" width="10%" autocomplete="off" maxlength="100">
</form>

<div id="box"><center>Emoticons: </center><center><img src="lib/emotes/like" title="/like"> <img src="lib/emotes/smile" title=":)"> <img src="lib/emotes/sad" title=":("> <img src="lib/emotes/grin" title=":D"> <img src='lib/emotes/weed' title='/weed'><br/> <img src="lib/emotes/hate" title="/hate"> <img src="lib/emotes/wink" title=";)"> <img src="lib/emotes/tongue" title=":P"> <img src="lib/emotes/crazy" title="o0"> <img src='lib/emotes/cry' title=":'("></center></div>
</body>
</html>
