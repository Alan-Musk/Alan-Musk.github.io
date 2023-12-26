<?php
// Assuming you've got the user's PhoneNumber and Password via POST method from your form
$phoneNumber = $_POST['PhoneNumber'] ?? '';
$password = $_POST['Password'] ?? '';  // Ideally, this should be hashed

// Connection parameters
$host = 'localhost';  // or your database host
$dbUser = 'username'; // your database username
$dbPassword = 'password'; // your database password
$dbName = 'database'; // your database name

// Create connection
$con_maria = @mysqli_connect($host, $dbUser, $dbPassword, $dbName);

// Check connection
if (!$con_maria) {
    die("Connection failed: " . mysqli_connect_error());
}

// Escape user inputs for security
$phoneNumber = mysqli_real_escape_string($con_maria, $phoneNumber);
$password = mysqli_real_escape_string($con_maria, $password);  // Remember to hash the password

// Your query to check the member's credentials
// IMPORTANT: This is a simplistic approach; in a real application, you should use prepared statements to prevent SQL injection
$query = "SELECT member_id, password FROM member WHERE phone_number = '$phoneNumber' AND password = '$password'";  // Replace 'password' with the hashed password column if applicable

$result = mysqli_query($con_maria, $query);

// Check if login is successful
if (mysqli_num_rows($result) > 0) {
    // Get the member_id from the result
    $row = mysqli_fetch_assoc($result);
    $member_id = $row['member_id'];

    // Query to get all payments for the member
    $paymentQuery = "SELECT description, date FROM payment WHERE member_id = $member_id";
    $paymentResult = mysqli_query($con_maria, $paymentQuery);

    // Display all payments
    if (mysqli_num_rows($paymentResult) > 0) {
        while($paymentRow = mysqli_fetch_assoc($paymentResult)) {
            echo "Description: " . $paymentRow['description'] . " - Date: " . $paymentRow['date'] . "<br>";
        }
    } else {
        echo "No payments found for the member.";
    }
} else {
    echo "Login unsuccessful. Please check your credentials.";

    // Provide a button to go back to the login form
    echo '<button onclick="history.go(-1);">Go Back To Login</button>';
}

// Close connection
mysqli_close($con_maria);
?>
