<?php
include('db_connect.php');
session_start();

if(!isset($_SESSION['login_user'])){
  header("location:login.php");
  die();
}

// Fetch order data from database
$sql = "SELECT * FROM payment WHERE member_id = (SELECT member_id FROM member WHERE phone_number = '".$_SESSION['login_user']."')";
$result = $conn->query($sql);

// Display the order data
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "Date: " . $row["date"]. " - Amount: " . $row["amount"]. "<br>";
  }
} else {
  echo "0 results";
}
?>
