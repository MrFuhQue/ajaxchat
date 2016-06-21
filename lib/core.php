<?php
session_start();

//script version
$_SESSION['ver'] = "0.0.3";

//set chatroom bot name
$_SESSION['bot'] = "<span style='color:red'><b>Chatbot</b></span>";

//set administrative users - for a single administrator,
//replace all other admin names with a zero.
//Example: $_SESSION['adm'] = array("yourname", "0","0");
$_SESSION['adm'] = array("mrfuhque","madgod","0");



//set timestamp
$ts = date('h:i:s');
$_SESSION['tl'] = "<span style='font-size:12px; color:white;'>[".$ts."]</span>";


?>
