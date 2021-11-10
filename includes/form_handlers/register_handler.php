<?php

$first_name = ""; // First name of the user
$last_name = ""; // Last name of the user
$email = ""; // Email name of the user
$email_confirmation = ""; // Email Confirmation name of the user
$password = ""; // Password of the user
$password_confirmation = ""; // Password Confirmation of the user
$error_array = array(); // Error array holds the error messages
$user = array();

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
        $profile_pic = "";

        if ($rand == 1) {
            $profile_pic = "C:\xampp\htdocs\The Truth\assets\images\profile_pics\female1.jpg";
        } else if ($rand == 2) {
            $profile_pic = "C:\xampp\htdocs\The Truth\assets\images\profile_pics\female2.jpg";
        }  // must determine male or female.

    $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$first_name', '$last_name', '$username', '$email', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");
        
    array_push($error_array, "<span style='color: red'> Account creation successful. Go ahead and login! </span> <br>");
        
        // Clearing session variables will
        $_SESSION['register_first_name'] = "";
        $_SESSION['register_last_name'] = "";
        $_SESSION['register_email'] = "";
        $_SESSION['register_email_confirmation'] = "";
        $_SESSION['register_password'] = "";
        $_SESSION['register_password_confirmation'] = "";
        
    }
}
?>