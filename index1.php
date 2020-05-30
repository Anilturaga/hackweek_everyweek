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

<title>Hack them!</title>
<style type="text/css">
body,section.body,div.mdl-layout{
padding:0px;
margin:0px;
background-color:white;
width:100%;
height:100%;
overflow-y:auto;
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
  width:100%;
  height:87%;
  overflow-y:auto;
overflow-x:hidden;
display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: row;
  
}

div.temp{
  height:30%;
  width:80%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  
  margin-left:10%;
  margin-top:5%;
  margin-bottom:5%;
  padding:1%;
  background-color:white;
  color:black;
 
}
div.des,div.button{
  height:50%;
  width:100%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  color:black;
}
form{
  width:100%;
  height:100%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: row;
  color:black;
}
div.button{
  //border-style: solid;
  //border-width: 0.09px;
}
div.mdl-button{
  background-color: #00bcd4;
  color:white !important;
}
button.mdl-navigation__link{
  font-size:100%;
  color:black !important;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}
</style>


</head>
<body bgcolor=#212f3d text="white"  >
<section class="body">
<!-- Simple header with fixed tabs. -->
<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header  mdl-shadow--2dp">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">Hackweek every week</span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation. We hide it in small screens. -->
      <nav class="mdl-navigation mdl-layout--large-screen-only">
      <form action='/question.php' method='post'>
        <button class="mdl-button mdl-js-button mdl-navigation__link" type="submit" name="submit" value="simple" formaction="/index1.php">Simple</button>
        <button class="mdl-button mdl-js-button mdl-navigation__link" type="submit" name="submit" value="medium" formaction="/index1.php">Medium</button>
        <button class="mdl-button mdl-js-button mdl-navigation__link" type="submit" name="submit" value="hard" formaction="/index1.php">Hard</button>

      </form>
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <nav class="mdl-navigation">
    <a class="mdl-navigation__link" href="/payment_status.php"><?php echo $_SESSION['username']; ?></a>
      <a class="mdl-navigation__link" href="">Badge:<?php echo $_SESSION['badge']; ?></a>
      <a class="mdl-navigation__link" href="">Simple:<?php echo $_SESSION['simple']; ?></a>
      <a class="mdl-navigation__link" href="">Medium:<?php echo $_SESSION['medium']; ?></a>
      <a class="mdl-navigation__link" href="">Hard:<?php echo $_SESSION['hard']; ?></a>
      <a class="mdl-navigation__link" href="/index.php">Home</a>
      <a class="mdl-navigation__link" href="logout.php">Log out</a>
    </nav>
  </div>
  <main class="mdl-layout__content">
    <!-- Your content goes here -->
    <?php
    clearstatcache();
    $q = $_POST['submit'];
    echo $q;
    $_SESSION['page'] = $q;
    $sql="SELECT * FROM $q";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_array($result)){
        echo "<div class='temp mdl-shadow--2dp'>
        <div class='des'><b>Question
    ".$row['id']."</b>".$row['description']."
  </div>
        <div class='button'>
        <form action='/question.php' method='post'>
        <button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent' style='background-color: #00bcd4' type='submit' name='submit' value=".$row['id'].">
        View more
      </button></form>
        </div>
      </div>";
      }
    }
   

  ?>
    
  </main>
</div>


</section>
</body>
</html
