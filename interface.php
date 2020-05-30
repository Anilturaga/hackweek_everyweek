<?php
session_start();
if(empty($_SESSION['username']))
{
header("Location:log.php");
}
if($_SESSION['username'] !="admin" && $_SESSION['password'] !="mooshak")
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

<title>Reports</title>
<style type="text/css">
body,section.mdl-layout{
padding:0px;
margin:0px;
background-color:white;
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
  width:100%;
  height:87%;
  overflow-y:auto;
overflow-x:hidden;
display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: row;
  
}

table{
    height:100%;
    width:100%;
  color:black;

}

</style>
</head>

<body bgcolor="#212f3d" text="white">
<section class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
      <span class="mdl-layout-title">Reports</span>
  </header>
  <div class="mdl-layout__drawer">
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="">Admin</a>
      
      <a class="mdl-navigation__link" href="logout.php">Log out</a>
    </nav>
  </div>
  <main class="mdl-layout__content">
  <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">
    <thead>
    <tr>
    <th>S.no</th>
    <th class="">Roll number</th>
      <th>Year</th>
      <th class="">Email</th>
      <th>Simple</th>
      <th>Medium</th>
      <th>Hard</th>
      <th>Badge</th>
    </tr>
    </thead>
    <tbody>    

    <?php
        $q = "users";
        $sql="SELECT * FROM $q";
        $result = mysqli_query($con,$sql);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_array($result)){
              echo "<tr>
              <td>".$row['id']."</td>
              <td>".$row['username']."</td>
              <td>".$row['year']."</td>
              <td>".$row['email']."</td>
              <td>".$row['simple']."</td>
              <td>".$row['medium']."</td>
              <td>".$row['hard']."</td>
              <td>".$row['badge']."</td>
              </tr>";
          }
        }



    ?>
    </tbody>
    </table>


  </main>
  </section>
  </body>
