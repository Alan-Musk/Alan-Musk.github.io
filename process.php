<?php
// Connection parameters
$host = 'localhost';  
$dbUser = 'mysql'; //database username
$dbPassword = 'Fanzf12345'; // database password
$dbName = 'zhang_s1546489_fan'; // database name

// Create connection using object-oriented style
$con_maria = new mysqli($host, $dbUser, $dbPassword, $dbName);

// Check connection
if ($con_maria->connect_error) {
    die("Connection failed: " . $con_maria->connect_error);
}

// Check if method is POST for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phoneNumber = $_POST['PhoneNumber'] ?? '';
    $password = $_POST['Password'] ?? '';  

    // Prepared statement to prevent SQL Injection
    $stmt = $con_maria->prepare("SELECT member_id, password FROM member WHERE phone_number = ? LIMIT 1");
    $stmt->bind_param("s", $phoneNumber); // 's' specifies the variable type => 'string'

    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            $member_id = $row['member_id'];
            
            // Query to get all payments for the member
            $paymentQuery = "SELECT description, date FROM payment WHERE member_id = ?";
            $paymentStmt = $con_maria->prepare($paymentQuery);
            $paymentStmt->bind_param("i", $member_id);
            $paymentStmt->execute();
            $paymentResult = $paymentStmt->get_result();

            // Display all payments
            if ($paymentResult->num_rows > 0) {
                while($paymentRow = $paymentResult->fetch_assoc()) {
                    echo "Description: " . $paymentRow['description'] . " - Date: " . $paymentRow['date'] . "<br>";
                }
            } else {
                echo "No payments found for the member.";
            }
        } else {
            echo "Login unsuccessful. Please check your credentials.";
        }
    } else {
        echo "Login unsuccessful. Please check your credentials.";
    }
    $stmt->close();
} else {
    echo "Invalid request method.";
}

// Provide a button to go back to the login form
echo '<button onclick="history.go(-1);">Go Back To Login</button>';

// Close connection
$con_maria->close();
?>
