<?php 

require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration Page</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css" />
    <script 
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <script src="assets/js/register.js"></script>
</head>



<body>

    <?php                         

            // if(isset($_POST['register_button'])) {   // Code block doesn't work
            //     echo '
            //     <script>

            //     $(document).ready(function() {
            //         $("#first").hide();
            //         $("#second").show();
            //     });

            //     </script>
            //     ';
            // }

    ?>

    <div class="wrapper">

        <div class="login_box">

            <div class="login_header">
                <h1> Welcome to KWORKR </h1>
                <h2>The review based HR System </h2>

            </div>

            <div id="first">

                <form action="register.php" method="POST">
                    <input type="email" 
                           name="log_email" 
                           placeholder="Email Address" 
                           value=" <?php 
                            if (isset($_SESSION['log_email'])) { 
                                echo $_SESSION['log_email']; 
                            } ?>" required>
                    <br>
                    <input type="password" 
                           name="log_password" 
                           placeholder="Password">
                    <br>
                    <input type="submit" 
                           name="login_button" 
                           placeholder="Login">
                    <br>
                    <?php if (in_array("Email or password was incorrect<br>", $error_array)) { 
                        echo "Email or password was incorrect<br>";
                    }
                    
                    ?>

                    <br>
                    
                    <a href="#" 
                       id="signin" 
                       class="signin">Already have an account, then sign in!</a>
                </form>

            </div>


            <div id="second">

                <form action="register.php" method="POST">

                    <input type="text" 
                           name="register_first_name" 
                           placeholder="First Name"
                           value="<?php if (isset($_SESSION['register_first_name'])) { echo $_SESSION['register_first_name']; } ?>"
                           required>
                    <br>

                    <?php if (in_array("Your first name must be between 2 and 25 characters.<br>", $error_array)) {echo "Your first name must be between 2 and 25 characters. <br>";} ?>

                    <input type="text" 
                           name="register_last_name" 
                           placeholder="Last Name"
                           value="<?php if (isset($_SESSION['register_last_name'])) { echo $_SESSION['register_last_name']; } ?>"
                           required>
                    <br>
                    <?php if(in_array("Your last name must be between 2 and 25 characters.<br>", $error_array)) {echo "Your last name must be between 2 and 25 characters. <br>";} ?>
                    <input type="email" 
                           name="register_email" 
                           placeholder="Email Address"
                           value="<?php if (isset($_SESSION['register_email'])) { echo $_SESSION['register_email']; } ?>"
                           required>
                    <br>
                    <input type="email" 
                           name="register_email_confirmation" 
                           placeholder="Confirm Email Address"
                           value="<?php if (isset($_SESSION['register_email_confirmation'])) { echo $_SESSION['register_email_confirmation']; } ?>"
                           required>
                    <br>

                    <?php if(in_array("This email address is already in use<br>", $error_array)) { echo "This email address is already in use <br>";}
                          if(in_array("This email address is using an invalid format. <br>", $error_array)) { echo "This email address is using an invalid format. <br>";}
                          if(in_array("The email address does not match.<br>", $error_array)) { echo "The email address does not match. <br>";} ?>


                    <input type="password" 
                           name="register_password" 
                           autocomplete="on" 
                           placeholder="Password"
                           value="<?php if (isset($_SESSION['register_password'])) { echo $_SESSION['register_password'];} ?>"
                           required>
                    <br>
                    <input type="password" 
                           name="register_password_confirmation" 
                           autocomplete="on"
                           placeholder="Confirm Password"
                           value="<?php if (isset($_SESSION['register_password_confirmation'])) { echo $_SESSION['register_password_confirmation'];} ?>"
                           required>
                    <br>
                    <?php 
                        if(in_array("Your password must be between 5 and 30 characters.<br>", $error_array)) { echo "Your password must be between 5 and 30 characters. <br>";}
                        if(in_array("Your password can only contain letters or numbers.<br>", $error_array)) { echo "Your password can only contain letters or numbers. <br>";}
                        if(in_array("Your password does not match. Please try again.<br><br>", $error_array)) { echo "Your password does not match. Please try again. <br>";} ?>

                        <input type="submit" 
                               name="register_button" 
                               value="Register" required>
                        <br>

                    <?php if(in_array("<span style='color: red'> Account creation successful. Go ahead and login! </span> <br>", $error_array)) { echo "<span style='color: red'> Account creation successful. Go ahead and login! </span> <br>";} ?>
                          <a href="#" 
                             id="signup" 
                             class="signup">Need an account? Register here!
                          </a>

                </form>

            </div>

        </div>

    </div>

</body>

</html>
