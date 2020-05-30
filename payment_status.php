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

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0"/>
    <link rel="stylesheet" href="./status_files/material.min.css">
    <link rel="stylesheet" type="text/css" href="./status_files/css.css">
    <script src="./status_files/material.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
    <title>Profile</title>

</head>
<body text="white">
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
      <a class="mdl-navigation__link" href="/index.php">Home</a>
      <a class="mdl-navigation__link" href="logout.php">Log out</a>
    </nav>
  </div>
    <section class="status">
        <div class="demo-card-wide mdl-card mdl-shadow--6dp">
            <div class="mdl-card__supporting-text">
                    <ul class="demo-list-three mdl-list">
                            <li class="mdl-list__item ">
                                    <span class="mdl-list__item-primary-content">
                                      <i class="material-icons mdl-list__item-avatar">person</i>
                                      <span>Name:<?php echo $_SESSION['username']; ?></span>
                                    </span>
                             </li>
                            <li class="mdl-list__item ">
                                            <span class="mdl-list__item-primary-content">
                                              <i class="material-icons mdl-list__item-avatar">label</i>
                                              <span>Email:<?php echo $_SESSION['email']; ?></span>
                                            </span>
                            </li>
			    <li class="mdl-list__item ">
                                            <span class="mdl-list__item-primary-content">
                                              <i class="material-icons mdl-list__item-avatar">label</i>
                                              <span>Badge:<?php echo $_SESSION['badge']; ?></span>
                                            </span>
                            </li>	
                            <li class="mdl-list__item ">
                                                <span class="mdl-list__item-primary-content">
                                                  <i class="material-icons mdl-list__item-avatar">format_list_bulleted</i>
                                                  <span>Easy:<?php echo $_SESSION['simple']; ?></span>
                                                </span>
                            </li>
                            <li class="mdl-list__item ">
                                                <span class="mdl-list__item-primary-content">
                                                  <i class="material-icons mdl-list__item-avatar">format_list_bulleted</i>
                                                  <span>Medium:<?php echo $_SESSION['medium']; ?></span>
                                                </span>
                            </li>
                            <li class="mdl-list__item ">
                                                <span class="mdl-list__item-primary-content">
                                                  <i class="material-icons mdl-list__item-avatar">format_list_bulleted</i>
                                                  <span>Hard:<?php echo $_SESSION['hard']; ?></span>
                                                </span>
                            </li>
                    </ul>
            </div>
        </div>
    </section>
</body>
</html>
