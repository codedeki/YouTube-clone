<?php 
require_once("includes/config.php"); 
require_once("includes/classes/Account.php"); 
require_once("includes/classes/Constants.php"); 
require_once("includes/classes/FormSanitizer.php"); 


$account = new Account($con);

if (isset($_POST["submitButton"])) {
    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);

    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);

    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
    $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);

    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
    $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

    $wasSuccessful = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);

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
                <h3>Sign Up</h3>
                <span>to continue to VideoTube</span>
            </div>

            <div class="loginForm">

                <form action="signUp.php" method="POST">


                    <input type="text" name="firstName" placeholder="First Name" value="<?php getInputValue('firstName'); ?>" autocomplete="off" required>
                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    
                    <input type="text" name="lastName" placeholder="Last Name" value="<?php getInputValue('lastName'); ?>" autocomplete="off" required>
                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>

                    <input type="text" name="username" placeholder="Username" value="<?php getInputValue('username'); ?>" autocomplete="off" required>
                    <?php echo $account->getError(Constants::$usernameTaken); ?>
                    <?php echo $account->getError(Constants::$usernameCharacters); ?>

                    <input type="email" name="email" placeholder="Email" value="<?php getInputValue('email'); ?>" autocomplete="off" required>
                    <input type="email" name="email2" placeholder="Confirm Email" value="<?php getInputValue('email2'); ?>" autocomplete="off" required>
                    <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$emailInvalid); ?>
                    <?php echo $account->getError(Constants::$emailTaken); ?>

                    <input type="password" name="password" placeholder="Password" autocomplete="off" required>
                    <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                    <?php echo $account->getError(Constants::$passwordLength); ?>
                    <input type="password" name="password2" placeholder="Confirm Password" autocomplete="off" required>

                    <input type="submit" name="submitButton" value="SUBMIT">


                </form>
            </div>

            <a class="signInMessage" href="signIn.php">Already have an account? Sign in here!</a>
        </div>
    </div>




</body>
</html>