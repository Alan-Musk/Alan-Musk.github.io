<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone_number = $_POST['PhoneNumber']; // Make sure this variable name matches throughout
    $Password = $_POST['Password'];
    // Prepare SQL with placeholders
    $conn = new mysqli('127.0.0.1', 'root', '', 'zhang_s1546489_fan');
    $conn->set_charset('UTF8');

    $sql = 'select * from `member` where phone_number = ? and PASSWORD= ? ';
    $statement = $conn->prepare($sql);

    $statement->bind_param('ss', $phone_number, $Password);
    $statement->execute();
    $result = $statement->get_result();


    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();
        $_SESSION['login_user'] = $phone_number; // Set the session
        $_SESSION['member_id'] = $user['member_id']; // Set the member_id in the session

        // Redirect to orders.php to display the payment details
        header("location: orders.php");
        exit; // Important to prevent further script execution after a redirect
    } else {
        $_SESSION['message']['error'] = "Your Login Name or Password is invalid";
        // Redirect back to the login page or display the error
        header("location: dd.html"); // Assuming 'index.html' is your login page
        exit;
    }
}
?>