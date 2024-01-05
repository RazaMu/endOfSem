<?php
session_start();
require 'Database.php';

$db = new Database();
$conn = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password']; // This is plain text password, not recommended.

    // SQL query without password hashing.
    $sql = "SELECT * FROM users WHERE email = ? AND Password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Check user type
        if ($user['UserType'] === 'Super_User') {
            // Set session variables
            $_SESSION['user_id'] = $user['userId'];
            $_SESSION['user_type'] = $user['UserType'];
            // Redirect to dashboard or wherever you want
            header("Location: admin_dashboard.php");
            exit();
        } else {
            // User is not a Super_User.
            echo "Access denied. You are not a super user.";
        }
    } else {
        // No user found with the email/password combination.
        echo "Invalid email or password.";
    }
    $stmt->close();
}
$conn->close();
?>
