<?php
session_start();

include('core.php');
$adm = $_SESSION['adm'];
$admin = $_SESSION['admin'];
$bot = $_SESSION['bot'];
$tl = $_SESSION['tl'];


function saveUsers($onlineusers_file){
$file_save=fopen("src/onlineusers.txt","w+");
flock($file_save,LOCK_EX);
for($line=0;$line<count($onlineusers_file);$line++){
fputs($file_save,$onlineusers_file[$line]."\n");
};
flock($file_save,LOCK_UN);
fclose($file_save);
}

$onlineusers_file=file("src/onlineusers.txt",FILE_IGNORE_NEW_LINES);
$jroom=file("src/lobby.txt",FILE_IGNORE_NEW_LINES);

if (isset($_POST['user'],$_POST['oper'])){
$user= '<img src="lib/emotes/user" title="user"><b>'.$_POST['user'].'</b>';

if (in_array($_POST['user'],$adm)) {
	$user = "<span style='color:red'><img src='lib/emotes/admin'><b>".$_POST['user']."</b></span>";
}
		
$oper=$_POST['oper'];

$userexist=in_array($user,$onlineusers_file);
if ($userexist)$userindex=array_search($user,$onlineusers_file);

if($oper=="signin" && $userexist==false){
$_SESSION['act'] = time();
$onlineusers_file[]=$user;
saveUsers($onlineusers_file);
if (count($jroom)>10)$jroom=array_slice($jroom,1);
$file_save=fopen("src/lobby.txt","w+");
$jroom[]=time()."<!@!> - ".$tl." - <b>".$bot."</b>: <i><span style='color:#00cc00'>".$user."</span><span style='color:white'> has joined the room!</span></i>";
for($line=0;$line<count($jroom);$line++){
fputs($file_save,$jroom[$line]."\n");
};
flock($file_save,LOCK_UN);
fclose($file_save);
echo "signin";
exit();
}

if($oper=="signin" && $userexist==true){
echo "userexist";
exit();
}

if($oper=="signout" && $userexist==true){
if (count($jroom)>10)$jroom=array_slice($jroom,1);
$file_save=fopen("src/lobby.txt","w+");
$jroom[]=time()."<!@!> - ".$tl." - <b>".$bot."</b>: <i><span style='color:#00cc00'>".$user."</span><span style='color:white'> has disconnected from the chat!</span></i>";
for($line=0;$line<count($jroom);$line++){
fputs($file_save,$jroom[$line]."\n");
};
flock($file_save,LOCK_UN);
fclose($file_save);
array_splice($onlineusers_file,$userindex,1);
saveUsers($onlineusers_file);
echo "signout";
exit();
}

if(isset($_SESSION['act']) && (time() - $_SESSION['act'] > 600)) {
array_splice($onlineusers_file,$userindex,1);
saveUsers($onlineusers_file);
echo "signout";
exit();
}

if($oper=="signout" && $userexist==false){
echo "usernotfound";
exit();
}
}

$olu=join("<br>",$onlineusers_file);
echo $olu;
?>

