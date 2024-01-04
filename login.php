<?php
session_start();
include('db_connect.php');

if(isset($_POST['login'])) {
  $phone_number = $_POST['phone_number'];
  $password = hash('sha256', $_POST['password']); // Assuming SHA256 as per your insertion

  $sql = "SELECT * FROM member WHERE phone_number = '$phone_number' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $_SESSION['login_user'] = $phone_number; // Set the session
    header("location: orders.php"); // Redirect to orders page
  } else {
    echo "Your Login Name or Password is invalid";
  }
}
?>
