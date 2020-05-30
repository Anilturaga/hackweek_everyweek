<?php
session_start();
if(empty($_SESSION['username']))
{
header("Location:log.php");
}
$username = $_COOKIE['username'];
setcookie("username","",time() - 3600);
setcookie($username,"",time() - 3600);
session_destroy(); 
header("Location:index.php");
?>