
<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['PhoneNumber']) && isset($_POST['Password']) && isset($_POST['confirm_Password'])) {
        $phone = $_POST['PhoneNumber'];
        $password = $_POST['Password'];
        $confirm =& $_POST['confirm_Password'];

        if ($confirm != $password) {
            $_SESSION['message']['error'] = 'Two passwords do not match';
            return header('location: index.html');
        }
        $conn = new mysqli('127.0.0.1', 'root', '', 'zhang_s1546489_fan');
        $conn->set_charset('UTF8');

        $sql = 'select * from `member` where phone_number = ?';
        $statement = $conn->prepare($sql);

        $statement->bind_param('s', $phone);
        $statement->execute();
        $result = $statement->get_result();


        if ($result->num_rows > 0) {
            $_SESSION['message']['error'] = '用户名已存在';
            return header('location: index.html');
        }
        $sql = 'INSERT INTO member (phone_number, PASSWORD) VALUES (?, ?)';
        $statement = $conn->prepare($sql);

        $statement->bind_param('ss', $phone, $password);

        if ($statement->execute()) {

            $_SESSION['message']['success'] = 'Registration successful, please log in';
            header('location: index.html');
            exit;
        } else {
            // Check for errors if the insert failed
            $_SESSION['message']['error'] = 'Registration failed, please try again: ' . $statement->error;
            header('location: index.html');
            exit;
        }
    }
} else {

    // Form not submitted, you might want to redirect or show a message
    $_SESSION['message']['error'] = '请通过表单提交';
    header('location: membership.php');
    exit;
}
?>