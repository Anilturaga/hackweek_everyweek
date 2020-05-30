<?php
session_start();
$spassword_tooltip = "Must contain 8 or more characters that are of at least one number, and one uppercase and lowercase letter";
$susername_tooltip = "Please use the roll number given to you";
$lusername_tooltip = "";
$lpassword_tooltip = "";

if(isset($_COOKIE['username'])){
$con=mysqli_connect("localhost","mec","Test1234");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_select_db($con,"mec");
$username= $_COOKIE['username'];
$password=$_COOKIE[$username];

$res=mysqli_query($con,"SELECT * FROM users WHERE username='$username'");
$rows=mysqli_num_rows($res);

//echo $rows;
if($rows==1){
while($data=mysqli_fetch_assoc($res))
{
  $dbusername=$data['username'];
  $dbpassword=$data['password'];
  $dbsimple=$data['simple'];
  $dbmedium=$data['medium'];
  $dbhard=$data['hard'];
  $dbyear=$data['year'];
  $dbbadge = $data['badge'];
}

if($username==$dbusername && $password==$dbpassword)
{
  $_SESSION['username']=$dbusername;
  $_SESSION['year']=$dbyear;
  $_SESSION['simple']=$dbsimple;
  $_SESSION['medium']=$dbmedium;
  $_SESSION['hard']=$dbhard;
  $_SESSION['badge']=$dbbadge;
header("Location:index.php");
}

}
mysqli_close($con);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
$con=mysqli_connect("localhost","mec","Test1234");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_select_db($con,"mec");
if($_POST["submit"] == "login"){
$username=cinput($_POST['username']);
$password=cinput($_POST['password']);
if($username=="admin" && $password=="mooshak"){
$_SESSION['username']="admin";
$_SESSION['password']="mooshak";
header("Location:interface.php");
mysqli_close($con);

}
$res=mysqli_query($con,"SELECT * FROM users WHERE username='$username'");
$rows=mysqli_num_rows($res);

//echo $rows;
if($rows==1){
while($data=mysqli_fetch_assoc($res))
{
$dbusername=$data['username'];
$dbpassword=$data['password'];
$dbemail = $data['email'];
$dbsimple=$data['simple'];
$dbmedium=$data['medium'];
$dbhard=$data['hard'];
$dbyear=$data['year'];
$dbbadge = $data['badge'];
}

if($username==$dbusername && $password==$dbpassword)
{
$_SESSION['username']=$dbusername;
$_SESSION['year']=$dbyear;
$_SESSION['email']=$dbemail;
$_SESSION['simple']=$dbsimple;
$_SESSION['medium']=$dbmedium;
$_SESSION['hard']=$dbhard;
$_SESSION['badge']=$dbbadge;
setcookie("username",$username,time() + (86400 * 30), "/");
setcookie($username,$password,time() + (86400 * 30), "/");
header("Location:index.php");
}
else
{
$lpassword_tooltip="Wrong Password";

}
}
else
{
$lusername_tooltip="Username does not exist";
}

mysqli_close($con);
}
if ($_POST["submit"] == "signup"){
$username=cinput($_POST['username']);
$password=cinput($_POST['password']);
$email=$_POST['email'];
$year=$_POST['year'];


$res=mysqli_query($con,"SELECT * FROM users WHERE username='$username'");
$rows=mysqli_num_rows($res);

//echo $rows;
if($rows>0){
$susername_tooltip = "Roll number already taken";
}else{

echo "username".$username."nickname".$nickname;
$sql= "INSERT INTO users (username, password,email,year,simple,medium,hard)
VALUES ('$username', '$password', '$email',$year,0,0,0)";
$sqi= "INSERT INTO reports (username,year,email,simple,medium,hard,badge)
VALUES ('$username',$year, '$email',0,0,0,0)";
if (mysqli_query($con,$sqi)){

}else{
die("Error occured");
}
if (mysqli_query($con,$sql)) {
$_SESSION['username']=$username;
$_SESSION['year']=$year;
$_SESSION['email']=$email;
$_SESSION['simple']=0;
$_SESSION['medium']=0;
$_SESSION['hard']=0;
$_SESSION['badge'] = 0;
setcookie("username",$username,time() + (86400 * 30), "/");
setcookie($username,$password,time() + (86400 * 30), "/");
header("Location:index.php");

} else {
    echo "Error: ". mysqli_error($con) ;
}

mysqli_close($con);
}

}

}
function cinput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="viewport" content="initial-scale=1">
<link rel="stylesheet" href="./material.min.css">
<script src="./material.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<title>Login</title>
<style>
body,form{
height:100%;
width:100%;
padding:0px;
margin:0px;
overflow-y:hidden;
}
header.mdl-tabs__tab-bar{
height:10%;
background-color: #00bcd4 ;
display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: row;
}
section.mdl-tabs__panel{
height:90%;
display: flex;
  align-items: center;
  justify-content: center;

}
section.about{
margin:2% 2% 0% 5%;
overflow-y:auto;
overflow-x:hidden;
}
@media screen and (max-width:600px) {
     /* start of phone styles */

div.tabs{
width:80%;
height:100%;
display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: row;
}
div.login{
height:70%;
width:90%;
display: flex;
    margin-left: auto;
    margin-right: auto;
position:relative;
top:15%;
flex-direction: column;
}
div.log{
height:30%;
}
div.signup{
height:100%;
width:90%;
display: block;
    margin-left: auto;
    margin-right: auto;
	 overflow-y: scroll; 
position:relative;
top:2%;
}
div.sign{
height:20%;
}
button.test{
background-color: #00bcd4 ;
display: block;
    margin-left: auto;
    margin-right: auto;
}
}
@media screen and (min-width:600px) {
div.login{
height:50%;
width:50%;
display: flex;
    margin-left: auto;
    margin-right: auto;
position:relative;
top:25%;
flex-direction: column;
}

div.signup{
height:90%;
width:50%;
display: block;
    margin-left: auto;
    margin-right: auto;
	 overflow-y: scroll; 
position:relative;
top:3%;
}

button.test{
background-color: #00bcd4 ;
display: block;
    margin-left: auto;
    margin-right: auto;
}
}
div.mdl-textfield{
display: block;
    margin-left: auto;
    margin-right: auto;
width:100%;
}

</style>
</head>
<body class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">

<header class="mdl-tabs__tab-bar">
<div class="logo">
</div>
<div class="tabs">
      <a href="#login" class="mdl-tabs__tab is-active">Login</a>
      <a href="#signup" class="mdl-tabs__tab">Signup</a>
      <a href="#about" class="mdl-tabs__tab">About</a></div>
  </header>

  <section class="mdl-tabs__panel is-active " id="login">
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
<div class="login mdl-card mdl-shadow--6dp">
  <div class="log mdl-card__title ">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" name="username" id="sample1" required>
    <label class="mdl-textfield__label" for="sample1">Roll number</label>
  <div class="mdl-tooltip" for="sample1"><?php echo $lusername_tooltip; ?></div>
</div>

 

  </div>
<div class="log mdl-card__title ">
     <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" name="password" type="password" id="sample2" required>
    <label class="mdl-textfield__label" for="sample2">Password</label>
<div class="mdl-tooltip" for="sample2"><?php echo $lpassword_tooltip; ?></div>

  </div>
  </div>
 
  <div class=" mdl-card__actions">
    <button id="demo-menu-lower-right" type="submit" value="login" name="submit" class="test mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-cell--bottom mdl-cell--bottom">
   Login
</button>
  </div>
  
</div>
</form>
  </section>
  <section class="mdl-tabs__panel" id="signup">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
<div class="signup mdl-card mdl-shadow--6dp">
  <div class="sign mdl-card__title ">


  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" name="username" id="sample3" pattern="^[A-Z0-9]{10,10}" required autocomplete="off">
    <label class="mdl-textfield__label" for="sample3">Roll Number</label>
<div class="mdl-tooltip" for="sample3"><?php echo $susername_tooltip; ?></div>
  </div>

 

  </div>
<div class="sign mdl-card__title ">
     <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" name="password" type="password" id="sample4" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
    <label class="mdl-textfield__label" for="sample4">Password</label>
 <div class="mdl-tooltip" for="sample4"><?php echo $spassword_tooltip; ?></div>
  </div>
  </div>
<div class="sign mdl-card__title ">
     <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" name="password" type="password" id="sample5" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
    <label class="mdl-textfield__label" for="sample5">Re-enter Password</label>
  </div>
  </div>
<div class="sign mdl-card__title ">
     <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" name="email" type="email" id="sample6" required>
    <label class="mdl-textfield__label" for="sample6">Email id</label>
  </div>
  </div> 
  <div class="mdl-card__actions">
Engineering year:
<input type="radio" name="year" value="1" checked>1
  <input type="radio" name="year" value="2">2
  <input type="radio" name="year" value="3">3
<input type="radio" name="year" value="4">4
</div> <div class="mdl-card__actions">
    <button id="demo-menu-lower-right" type="submit" name="submit" value="signup" class="test mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-cell--bottom mdl-cell--bottom">
Signup
</button>
  </div>
  
</div>
</form>
  </section>
  <section class="mdl-tabs__panel about" id="about">
  </section>
</body>
</html>
