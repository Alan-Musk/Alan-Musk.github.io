<?php
session_start();
include('db_connect.php');

if (isset($_POST['login'])) {
    $phone_number = $_POST['phone_number'];
    $password = hash('sha256', $_POST['PASSWORD']); // Assuming SHA256 as per your insertion

    // Authenticate the user first
    $sql = "SELECT * FROM member WHERE phone_number = '$phone_number' AND PASSWORD = '$password';";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetching the member_id from the result to use it for payment details
        $user = $result->fetch_assoc();
        $_SESSION['login_user'] = $phone_number; // Set the session
        $_SESSION['member_id'] = $user['member_id']; // Set the member_id in the session

        // Redirect to orders page where the payments will be displayed
        header("location: orders.php");
        exit(); // Make sure to terminate the script after a redirect
    } else {
        echo "Your Login Name or Password is invalid";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Payments</title>
</head>
<body>

    <!-- The payments data will be displayed in orders.php, so we redirect there upon successful login -->

</body>
</html>
