<?php
session_start();
include('db_connect.php');

// Check if the user is logged in and the member_id is set in the session
if (isset($_SESSION['login_user']) && isset($_SESSION['member_id'])) {
    $member_id = $_SESSION['member_id'];

    // Fetch payment data for the logged-in user
    $paymentSql = "SELECT * FROM payment WHERE member_id = '$member_id';";
    $payments = $conn->query($paymentSql);
    // It's better to fetch the data here instead of storing it in the session due to size limitations and data freshness
    $paymentData = $payments->fetch_all(MYSQLI_ASSOC);
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
    <!-- Only display data if the user is logged in and payments are available -->
    <?php if (isset($_SESSION['login_user']) && !empty($paymentData)): ?>
        <h2>Payment Details for: <?php echo $_SESSION['login_user']; ?></h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paymentData as $payment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($payment['date']); ?></td>
                        <td><?php echo htmlspecialchars($payment['amount']); ?></td>
                        <td><?php echo htmlspecialchars($payment['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <!-- Show some message or content if not logged in or no payments -->
        <p>No payment details available.</p>
    <?php endif; ?>
</body>
</html>
