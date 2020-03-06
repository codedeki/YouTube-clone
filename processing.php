<?php 

require_once("includes/header.php"); 
require_once("includes/classes/VideoUploadData.php"); 
require_once("includes/classes/VideoProcessor.php"); 

if(!isset($_POST["uploadButton"])) {
    echo "No file sent to page";
    exit();
}

// 1. create file upload data
$videoUploadData = new VideoUploadData( 
                            $_FILES["fileInput"], 
                            $_POST["titleInput"], 
                            $_POST["descriptionInput"], 
                            $_POST["privacyInput"],
                            $_POST["categoryInput"], 
                            $userLoggedInObj->getUserName()
                        );

// 2. process video data (upload)
$videoProcessor = new VideoProcessor($con); //$con comes form header file-> config.php
$wasSuccessful = $videoProcessor->upload($videoUploadData);
// 3. check if upload was successful
if ($wasSuccessful) {
    echo "Upload successful";
}

?>