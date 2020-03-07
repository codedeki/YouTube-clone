<?php 
require_once("includes/config.php"); 
require_once("includes/classes/User.php"); 
require_once("includes/classes/Video.php"); 

$usernameLoggedIn = User::isLoggedIn() ? $_SESSION["userLoggedIn"] : "";
$userLoggedInObj = new User($con, $usernameLoggedIn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to YouTube</title>
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="assets/js/commonActions.js" defer></script>
    <script src="assets/js/userActions.js" defer></script>
</head>
<body>
    <div id="pageContainer">

        <div id="mastHeadContainer">
            <button class="navShowHide">
                <img src="assets/images/icons/menu.png" title="menu bar" alt="menu bar" >
            </button>

            <a class="logoContainer" href="index.php">
                <img src="assets/images/icons/VideoTubeLogo.png" title="site logo" alt="logo">
            </a>

            <div class="searchBarContainer">
                <form action="search.php" method="GET">
                    <input type="text" class="searchBar" name="term" placeholder="search...">
                    <button class="searchButton">
                        <img src="assets/images/icons/search.png" alt="search button">
                    </button>
                </form>
            </div>

            <div class="userIcons">
                <a href="upload.php">
                    <img src="assets/images/icons/upload.png" alt="">
                </a>    
                <a href="upload.php">
                    <img src="assets/images/profilePictures/default.png" alt="">
                </a>    
                
            </div>

        </div>

        <div id="sideNavContainer" style="display:none">

        </div>

        <div id="mainSectionContainer" class="leftPadding">
            
            <div id="mainContentContainer">