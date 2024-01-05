<?php
session_start();
require 'Database.php'; // Your Database connection file

$db = new Database();
$conn = $db->getConnection();

// Initialize variables to hold profile details
$full_name = $email = $phone_number = $password = $address = "";

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone_number = $conn->real_escape_string($_POST['phone_number']);
    // Password should be hashed in a real application
    $password = $conn->real_escape_string($_POST['password']);
    $address = $conn->real_escape_string($_POST['address']);
    
    // Assuming you have a method to validate data
    // Update profile details in database
    $sql = "UPDATE users SET Full_Name=?, email=?, phone_Number=?, Password=?, Address=? WHERE userId=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $full_name, $email, $phone_number, $password, $address, $_SESSION['user_id']);
    
    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="dashboard_styles.css">
</head>
<body>

<div class="update-container">
    <form action="update_profile.php" method="post">
        <h2>Update Profile</h2>
        <div class="input-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number">
        </div>
        <div class="input-group">
            <label for="password">New Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="input-group">
            <label for="address">Address</label>
            <textarea id="address" name="address"></textarea>
        </div>
        <button type="submit" class="update-btn">Update</button>
    </form>
</div>

</body>
</html>
