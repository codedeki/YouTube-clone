<?php 
require_once("includes/config.php"); 
require_once("includes/classes/Account.php"); 
require_once("includes/classes/Constants.php"); 
require_once("includes/classes/FormSanitizer.php"); 

$account = new Account($con);

if (isset($_POST["submitButton"])) {
   
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);;
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

    $wasSuccessful = $account->login($username, $password);

    if ($wasSuccessful) {
       $_SESSION["userLoggedIn"] = $username;
       header("Location: index.php");
    }
}

function getInputValue($name) {
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in to YouTube</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

    <div class="signInContainer">
        <div class="column">
            <div class="header">
                <img src="assets/images/icons/VideoTubeLogo.png" title="site logo" alt="logo">
                <h3>Sign In</h3>
                <span>to continue to VideoTube</span>
            </div>

            <div class="loginForm">

                <form action="signIn.php" method="POST">
                    <input type="text" name="username" placeholder="Username" value="<?php getInputValue('username'); ?>" required autocomplete="off">
                    <input type="password" name="password" placeholder="Password" value="<?php getInputValue('password'); ?>" required autocomplete="off">
                    <?php echo $account->getError(Constants::$loginFailed); ?>
                    <input type="submit" name="submitButton" value="LOG IN">
                </form>
            </div>

            <a class="signInMessage" href="signUp.php">New to VideoTube? Sign up here!</a>
        </div>
    </div>




</body>
</html>