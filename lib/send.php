<?php
//start session
session_start();

//call session vars
include('core.php');

//set initial variables
$message=strip_tags($_POST['message']);
$message=stripslashes($message);
$user=strip_tags($_POST['user']);
$user=stripslashes($user);
$adm=$_SESSION['adm'];
$tl=$_SESSION['tl'];
$bot=$_SESSION['bot'];
$msg = explode(" ", $message);

//determine account level
if(in_array($_POST['user'],$adm)){
	//administrator
	$user = "<span style='color:red'><b>".$_POST['user']."</b></span>";
}else {
	//guest
	$user = "<span style='color:#00cc00'><b>".$user."</b></span>"; 
}
 
//set room file
$room_file=file("src/lobby.txt",FILE_IGNORE_NEW_LINES);

//deny blank form submission
if($msg[0] == "" || (isset($msg[0]) != true)) {
	exit();
}

//emotes
if(isset($message)){
	$message = str_replace("/like","<img src='lib/emotes/like'>",$message);
	$message = str_replace("/hate","<img src='lib/emotes/hate'>",$message);
	$message = str_replace(":D","<img src='lib/emotes/grin'>",$message);
	$message = str_replace(":)","<img src='lib/emotes/smile'>",$message);
	$message = str_replace(":(","<img src='lib/emotes/sad'>",$message);
	$message = str_replace(";)","<img src='lib/emotes/wink'>",$message);
	$message = str_replace("o0","<img src='lib/emotes/crazy'>",$message);
	$message = str_replace(":P","<img src='lib/emotes/tongue'>",$message);
	$message = str_replace("/fp","<img src='lib/emotes/fp'>",$message);
	$message = str_replace("xD","<img src='lib/emotes/xD'>",$message);
}

//commands
if($msg[0] == "/slap") {
	//to slap a chatter
	$target = $msg[1];
	$message = " <i><b>".$user."</b> slaps <b>".$target."</b> in the face!</i>";
    $room_file[]=time()."<!@!> - ".$tl." - ".$bot."<span style='color:white'>: ".$message."</span>";	
} elseif ($msg[0] == "/me") {
	//to describe an action or verb you are doing
	$message = str_replace("/me", "", $message);
	$room_file[]=time()."<!@!> - ".$tl." - <span style='color:#00cc00'>*<i><b>".$user."</b> ".$message."</i>*</span>";
}elseif ($msg[0] == "/img") {
	//to display an image in chat
	$message = str_replace("/img ".$msg[1]."", "<br /><img src='".$msg[1]."' style='max-height: 600px; max-width: 800px;' g>",$message);
	$room_file[]=time()."<!@!> - ".$tl." - <b>".$user."</b>: <span style='color:white'>".$message."</span>";
}elseif ($msg[0] == "/bb") {
	//to say goodbye to a chatter - All credit to NeCRoN99 - this is a simplified version of his command from his chat.
	$rand = rand(1,9);
	$message = str_replace("/bb","<span style='color:#00cc00'><b>".$user."</b></span> says 'Goodbye!' <br /><img src='lib/img/".$rand.".jpg' height='300' width='400'>",$message);
	$room_file[]=time()."<!@!> - ".$tl." - <b>".$bot."</b>: <span style='color:white'>".$message."</span>";
}elseif ($msg[0] =="/say") {
	//speak as Slaiborg. The Chatroom Bot 
	$message = str_replace("/say","",$message);
	$room_file[]=time()."<!@!> - ".$tl." - <b>".$bot."</b>: <span style='color:white'>".$message."</span>";
}elseif ($msg[0] == "/url") {
	//share a link with a fellow chatter
    $message = "<a href='http://".$target."'>Click Here</a>";
    $room_file[]=time()."<!@!> - ".$tl." - <b>".$user."</b>: <span style='color:white'>".$message."</span>";
}elseif ($msg[0] == "/help") {
	//self explanitory - help command structure
	if ($msg[1] == "slap") {
		$room_file[]=time()."<!@!> - ".$tl." - <b>".$bot."</b>: <span style='color:white'> <b>SYNTAX</b>: /slap <i>[target]</i> - <b>USAGE:</b><i> to slap a fellow chatter</i></span>"; 	
	}elseif ($msg[1] == "url"){
		$room_file[]=time()."<!@!> - ".$tl." - <b>".$bot."</b>: <span style='color:white'> <b>SYNTAX</b>: /url <i>[url_link]</i> - <b>USAGE:</b><i> to share a url link</i></span>"; 
	}elseif ($msg[1] == "color") {
		$room_file[]=time()."<!@!> - ".$tl." - <b>".$bot."</b>: <span style='color:white'> <b>SYNTAX</b>: /color <i>[color] [message]</i> - <b>USAGE:</b><i> to send a colored message</i></span>"; 
	}elseif ($msg[1] == "say") {
		$room_file[]=time()."<!@!> - ".$tl." - <b>".$bot."</b>: <span style='color:white'> <b>SYNTAX</b>: /say <i>[message]</i> - <b>USAGE:</b><i> to send a message as 'Slaiborg'</i></span>"; 
	}elseif ($msg[1] == "me") {
		$room_file[]=time()."<!@!> - ".$tl." - <b>".$bot."</b>: <span style='color:white'> <b>SYNTAX</b>: /me <i>[message]</i> - <b>USAGE:</b><i> to describe a verb/action</i></span>"; 
	}elseif ($msg[1] == "img") {
		$room_file[]=time()."<!@!> - ".$tl." - <b>".$bot."</b>: <span style='color:white'> <b>SYNTAX</b>: /img <i>[img_link]</i> - <b>USAGE:</b><i> to share an image</i></span>"; 
	}elseif ($msg[1] == "bb") {
		$room_file[]=time()."<!@!> - ".$tl." - <b>".$bot."</b>: <span style='color:white'> <b>SYNTAX</b>: /bb - <b>USAGE:</b><i> to say goodbye to a fellow chatter</i></span>"; 
	}else {
	$room_file[]=time()."<!@!> - ".$tl." - <b>".$bot."</b>: <span style='color:white'> <b>Commands:</b> <i>/slap, /url, /img, /color, /say, /url, /me</i> - For syntax, use '/help [command]'</span>";
} 
}elseif ($msg[0] == "/color") {
	//send a colored message
	$message = str_replace("/color","",$message);
	$message = str_replace($msg[1], "",$message);
	$room_file[]=time()."<!@!> - ".$tl." - <b>".$user."</b>: <span style='color:".$msg[1]."'>".$message."</span>";
}else {
    $room_file[]=time()."<!@!> - ".$tl." - <b>".$user."</b>: <span style='color:white'>".$message."</span>";
}	

if (count($room_file)>10)$room_file=array_slice($room_file,1);
$file_save=fopen("src/lobby.txt","w+");
flock($file_save,LOCK_EX);
for($line=0;$line<count($room_file);$line++){
fputs($file_save,$room_file[$line]."\n");
};
flock($file_save,LOCK_UN);
fclose($file_save);
echo "sentok";
exit();

?>
