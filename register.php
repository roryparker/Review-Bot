<?php 
session_start(); // start session for stored variables.
$con = new mysqli ("localhost", "root", "", "userdb");

if(mysqli_connect_errno()) {
    echo "Error connecting: ". mysqli_connect_errno();
}
$first_name = ""; // First name of the user
$last_name = ""; // Last name of the user
$email = ""; // Email name of the user
$email_confirmation = ""; // Email Confirmation name of the user
$password = ""; // Password of the user
$password_confirmation = ""; // Password Confirmation of the user
$error_array = array(); // Error array holds the error messages

if(isset($_POST['register_button'])) {

    // Registration form values

    // Registration form values for First Name
    $first_name = strip_tags($_POST['register_first_name']);  //Remove HTML tags
    $first_name = str_replace(' ', '', $first_name); // Removes spaces
    $first_name = ucfirst(strtolower($first_name)); //Uppercase first letter
    $_SESSION['register_first_name'] = $first_name; // Stores the first name into a session variable

    // Registration form values for Last Name
    $last_name = strip_tags($_POST['register_last_name']);  //Remove HTML tags
    $last_name = str_replace(' ', '', $last_name); // Removes spaces
    $last_name = ucfirst(strtolower($last_name)); //Uppercase first letter
    $_SESSION['register_last_name'] = $last_name; // Stores the last name into a session variable

    // Registration form values for Email
    $email = strip_tags($_POST['register_email']);  //Remove HTML tags
    $email = str_replace(' ', '', $email); // Removes spaces
    $email = ucfirst(strtolower($email)); //Uppercase first letter
    $_SESSION['register_email'] = $email; // Stores the email into a session variable

     // Registration form values for Email Confirmation
     $email_confirmation = strip_tags($_POST['register_email_confirmation']);  //Remove HTML tags
     $email_confirmation = str_replace(' ', '', $email_confirmation); // Removes spaces
     $email_confirmation = ucfirst(strtolower($email_confirmation)); //Uppercase first letter
     $_SESSION['register_email_confirmation'] = $email_confirmation; // Stores the email confirmation into a session variable

    // Registration form values for Password
    $password = strip_tags($_POST['register_password']);  //Remove HTML tags
    $_SESSION['register_password'] = $password; // Stores the password into a session variable

    // Registration form values for Password Confirmation
    $password_confirmation = strip_tags($_POST['register_password_confirmation']);  //Remove HTML tags
    $_SESSION['register_password_confirmation'] = $password_confirmation; // Stores the password confirmation into a session variable

    $date = date("D-F-Y");

    if($email == $email_confirmation) {
        
        //Check if email is in valid format
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            
            //Check if email already exists
            $e_check  = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

            //Count number of rows returned
            $num_rows = mysqli_num_rows($e_check);

            if($num_rows > 0) {
                array_push($error_array, "This email address is already in use.<br>");
            }
        }
        else {
            array_push($error_array, "This email is using an invalid format.<br>");
        }

    }
    else {
        array_push($error_array, "The email address does not match.<br>");  // Error - code resolves to this echo regardless of action.
    }

    if (strlen($first_name) > 25 || strlen($first_name) < 2) {
        array_push($error_array, "Your first name must be between 2 and 25 characters.<br>");
    }

    if (strlen($last_name) > 25 || strlen($last_name) < 2) {
        array_push($error_array, "Your last name must be between 2 and 25 characters.<br>");
    }

    if ($password != $password_confirmation) {
        array_push($error_array, "Your password does not match. Please try again.<br>");
    }
    else {
        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($error_array, "Your password can only contain letters or numbers.<br>");
        }
    }

    if (strlen($password) > 30 || strlen($password) < 5) {
        array_push($error_array, "Your password must be between 5 and 30 characters.<br>");
    }

    if(empty($error_array)) {
        $password = md5($password); // Encrypt password before sending to database.<br>"

        // Generate username by concatenating first and last names.
        $username = strtolower($first_name . "_" . $last_name);

        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username' ");

        $i = 0;
        // if username exists add number to username
        while (mysqli_num_rows($check_username_query) != 0) { 
            $i++; 
            $username = $username . "_" . $i;
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username");
        }

        //Profile photo
        $rand = rand(1, 30);

        if ($rand == 1)
            $profile_pic = "C:\xampp\htdocs\The Truth\assets\images\profile_pics\female1.jpg"; 
        else if ($rand == 2)
            $profile_pic = "C:\xampp\htdocs\The Truth\assets\images\profile_pics\female2.jpg";

        $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$first_name', '$last_name', '$username', '$email', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");
        
        
        

        
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration Page</title>
</head>
<body>

<form action="register.php" method="post">
    <input type="text" name="register_first_name" placeholder="First Name" value="<?php if (isset($_SESSION['register_first_name'])) { echo $_SESSION['register_first_name']; } ?>" required>
    <br>
    <?php if(in_array("Your first name must be between 2 and 25 characters.<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>

    <input type="text" name="register_last_name" placeholder="Last Name" value="<?php if (isset($_SESSION['register_last_name'])) { echo $_SESSION['register_last_name']; } ?>" required>
    <br>
    <?php if(in_array("Your last name must be between 2 and 25 characters.<br>", $error_array)) echo "Your last name must be between 2 and 25 characters.<br>"; ?>
    
    <input type="email" name="register_email" placeholder="Email Address" value="<?php if (isset($_SESSION['register_email'])) { echo $_SESSION['register_email']; } ?>"required>
    <br>    
    <input type="email" name="register_email_confirmation" placeholder="Confirm Email Address" value="<?php if (isset($_SESSION['register_email_confirmation'])) { echo $_SESSION['register_email_confirmation']; } ?>"required>
    <br>

    <?php if(in_array("This email address is already in use<br>", $error_array)) echo "This email address is already in use<br>";
          if(in_array("This email address is using an invalid format.<br>", $error_array)) echo "This email address is using an invalid format.<br>";
          if(in_array("The email address does not match.<br>", $error_array)) echo "The email address does not match.<br>"; ?>

    
    <input type="password" name="register_password" autocomplete="on" placeholder="Password" value="<?php if (isset($_SESSION['register_password'])) { echo $_SESSION['register_password']; } ?>"required>
    <br>    
    <input type="password" name="register_password_confirmation" autocomplete="on" placeholder="Confirm Password" value="<?php if (isset($_SESSION['register_password_confirmation'])) { echo $_SESSION['register_password_confirmation']; } ?>" required>
    <br>
    <?php if(in_array("Your password must be between 5 and 30 characters.<br>", $error_array)) echo "Your password must be between 5 and 30 characters.<br>";
          if(in_array("Your password can only contain letters or numbers.<br>", $error_array)) echo "Your password can only contain letters or numbers.<br>";
          if(in_array("Your password does not match. Please try again.<br><br>", $error_array)) echo "Your password does not match. Please try again.<br>"; ?>

    
    <input type="submit" name="register_button" value="Register" required>
</form>
    
</body>
</html>