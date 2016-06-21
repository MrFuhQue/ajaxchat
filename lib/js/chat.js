lastReceived=0;

// Hide the message form
function hideShow(hs){
if(hs=="hide"){
signInForm.signInButt.value="Connect"	
signInForm.signInButt.name="signIn"
messageForm.style.display="none"
signInForm.passw.style.display="block"
signInForm.userName.style.display="block"
signInName.innerHTML=""
}
if(hs=="show"){
signInForm.signInButt.value="Logout"
signInForm.signInButt.name="signOut"
messageForm.style.display="block"
signInForm.passw.style.display="none"
signInForm.userName.style.display="none"
signInName.innerHTML=signInForm.userName.value 
}
}


// Sign in and Out
function signInOut(){
	
if (signInForm.userName.value=="" ||signInForm.userName.value.indexOf(" ")>-1 || signInForm.userName.value=="0"){
alert("Error - Access Denied. - Username is not valid...");
signInForm.userName.focus();
return false;
}

if (signInForm.passw.value.indexOf(" ")>-1 || signInForm.passw.value==""){
alert("Error - Access Denied. - Password is not valid...");
signInForm.passw.focus();
return false;
}

// check admin
if (signInForm.passw.value!="admin217" && signInForm.userName.value=="Slain" || signInForm.userName.value=="slain"){
alert("Incorrect Password. Please Try Again.");
signInForm.passw.focus();
return false;
}



// Sign in
if (signInForm.signInButt.name=="signIn"){
data="user=" + signInForm.userName.value +"&oper=signin"
Ajax_Send("POST","lib/users.php",data,checkSignIn);
return false
}



// Sign out
if (signInForm.signInButt.name=="signOut"){
data="user=" + signInForm.userName.value +"&oper=signout"
Ajax_Send("POST","lib/users.php",data,checkSignOut);
return false
}
}

// Sign in response
function checkSignIn(res){
if(res=="userexist"){
alert("User already exists. Please Try Again.");
return false;
}
if(res=="signin"){
hideShow("show")

messageForm.message.focus()
updateInterval=setInterval("updateInfo()",1250);
serverRes.innerHTML="<center>Signing In</center>"
}
}

// Sign out response
function checkSignOut(res){
if(res=="usernotfound"){
serverRes.innerHTML="<center>Sign Out Error</center>";
res="signout"
}
if(res=="signout"){
hideShow("hide")
signInForm.userName.focus()
clearInterval(updateInterval)
serverRes.innerHTML="<center>Disconnected</center>"
return false
}
}

// Update info
function updateInfo(){
serverRes.innerHTML=""
dataupdate="user=" + signInForm.userName.value
Ajax_Send("POST","lib/users.php",dataupdate,showUsers)
Ajax_Send("POST","lib/receive.php","lastreceived="+lastReceived+"&user="+signInForm.userName.value,showMessages)
}

// update online users
function showUsers(res){
usersOnLine.innerHTML=res
}

// Update messages view
function showMessages(res){
serverRes.innerHTML=""
msgTmArr=res.split("<SRVTM>")
lastReceived=msgTmArr[1]
messages=document.createElement("span")
messages.innerHTML=msgTmArr[0]
chatBox.appendChild(messages)
chatBox.scrollTop=chatBox.scrollHeight
}

// Send message
function sendMessage(){
data="message="+messageForm.message.value+"&user="+signInForm.userName.value
serverRes.innerHTML="Sending"
Ajax_Send("POST","lib/send.php",data,sentOk)
}

// Sent Ok
function sentOk(res){
if(res=="sentok"){
messageForm.message.value=""
messageForm.message.focus()
serverRes.innerHTML="<center>Updating...</center>"
}
else{
serverRes.innerHTML="<center><font color=\"#FF0000\">Not sent</font></center>"
}
}
