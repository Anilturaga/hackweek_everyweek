<?php
session_start();
if(empty($_SESSION['username']))
{
header("Location:log.php");
}
$con = mysqli_connect('localhost','mec','Test1234','mec');
if (!$con) {
    die("Connection failed :_ |" );
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0"/>
<link rel="stylesheet" href="./material.min.css">
<script src="./material.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<title>Hack select!</title>
<style type="text/css">
body,section.body,div.mdl-layout{
padding:0px;
margin:0px;
background-color:black;
width:100%;
height:100%;
overflow-y:hidden;
overflow-x:hidden;
font-size:17px;
text-align: center;
color:white;
}
header{
    height:13%;
width:100%;
background-color: #00bcd4 ;
display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: row;
    
}
span.mdl-layout-title{
margin:auto;
    text-decoration: underline;
    //color:white !important;
    font-size:150%;
    display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: row;
  }
main{
    height:87%;
width:100%;
display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: row;
  background-color:white;

}
section.name{
    height:30%;
width:100%;
display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  color: black !important; 

}
section.cat{
    height:70%;
width:100%;
display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;

}
  div.button{
      width:30%;
      height:7%;
      padding:3%;
margin:0px;
  }
  button,form{
      width:100%;
      height:100%;
  }
</style>


</head>
<body bgcolor="#212f3d" text="white">
<section class="body">
<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
      <span class="mdl-layout-title">Hackweek every week!</span>
  </header>
  <div class="mdl-layout__drawer">
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="/payment_status.php"><?php echo $_SESSION['username']; ?></a>
      <a class="mdl-navigation__link" href="">Badge:<?php echo $_SESSION['badge']; ?></a>
      <a class="mdl-navigation__link" href="">Simple:<?php echo $_SESSION['simple']; ?></a>
      <a class="mdl-navigation__link" href="">Medium:<?php echo $_SESSION['medium']; ?></a>
      <a class="mdl-navigation__link" href="">Hard:<?php echo $_SESSION['hard']; ?></a>
      
      <a class="mdl-navigation__link" href="logout.php">Log out</a>
    </nav>
  </div>
  <main class="mdl-layout__content">
  <section class="name"><h3>Please choose your complexity<br></h3><br>
  <p>
  1.All questions will be replaced every week.<br>
  2.Every solution should be submitted in <em>.txt</em> format at the corresponding question page.<br>
</p></section>
  <section class="cat">
  <div class="button">
  <form action="/index1.php" method="post">
    <!-- Accent-colored raised button -->
<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="background-color: #00bcd4" type="submit" name="submit" value="simple" formaction="/index1.php">
  Easy
</button></form>
</div> <div class="button">
<form action="/index1.php" method="post">
<!-- Accent-colored raised button -->
<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="background-color: #00bcd4" type="submit" name="submit" value="medium" formaction="/index1.php">
  Medium
</button></form></div>
<div class="button">
<form action="/index1.php" method="post">
<!-- Accent-colored raised button -->
<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="background-color: #00bcd4" type="submit" name="submit" value="hard" formaction="/index1.php">
  Hard
</button></form>
</div>


  </section>
  </main>
</div>



</section>
</html>
