<?php 
$con = new mysqli ("localhost", "root", "", "userdb");

if(mysqli_connect_errno()) {
    echo "Error connecting: ". mysqli_connect_errno();
}
$query = mysqli_query($con, "INSERT INTO identification_table VALUES(NULL, 'Rory')");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Truth</title>
</head>
<body>
    Hello World! Yeah! This
</body>
</html>
