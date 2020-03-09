<?php 
require_once("includes/header.php");
require_once("includes/classes/LikedVideosProvider.php");

If (!User::isLoggedIn()) {
    header("Location: signIn.php");
}

$likedVideosProvider = new LikedVideosProvider($con, $userLoggedInObj);
$videos = $likedVideosProvider->getVideos();

$videoGrid = new VideoGrid($con, $userLoggedInObj);
?>

<div class="largeVideoGridContainer">
    <?php 
    if(sizeof($videos) > 0) {
        echo $videoGrid->createLarge($videos, "Videos that you have liked", false);
    }
    else {
        echo "You have not liked any videos yet";
    }

    ?>

</div>