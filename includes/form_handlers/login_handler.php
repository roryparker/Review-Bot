<?php

if (isset($_POST['login_button'])) {
    $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); // Sanitize email

    $_SESSION['log_email'] = $email; // Stores email in session variables
    $password = md5($_POST['log_password']); // Get password

    $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    $check_login_query = mysqli_num_rows($check_database_query); // -------------> Pushes an error due to mysqli_num_rows and php version ???
    // $check_login_query = $check_database_query -> mysqli_num_rows(); // -------------> Pushes an error due to mysqli_num_rows and php version ???
    // $check_login_query = mysqli_query($con, $check_database_query) or die("Error");

    if ($check_login_query == 1) {
        $row = mysqli_fetch_array($check_database_query);
        $username = $row['username'];

        $user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND user_closed='yes'" ); // reopens closed account
        if(mysqli_num_rows($user_closed_query) == 1) {
            $reopen_account = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'" );
        }

        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    }
    else {
        array_push($error_array, "Email or password was incorrect<br>");
    }
}

?>