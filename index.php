<?php require_once("includes/header.php"); ?>



<?php 
// session_destroy(); //reset whole session
// unset($_SESSION["userLoggedIn"]); //reset only one variable in session
if (isset($_SESSION["userLoggedIn"])) {
    echo "user is logged in" . $_SESSION["userLoggedIn"];
}
else {
    echo "not logged in";
}


?>


<?php require_once("includes/footer.php"); ?>