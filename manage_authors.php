<?php
session_start();
require 'Database.php'; // Your Database connection file
$db = new Database();
$conn = $db->getConnection();

// Handle POST request for adding a new user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) {
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone_number = $conn->real_escape_string($_POST['phone_number']);
    $user_name = $conn->real_escape_string($_POST['user_name']);
    $password = $conn->real_escape_string($_POST['password']);
    $user_type = $conn->real_escape_string($_POST['user_type']);
    $access_time = $conn->real_escape_string($_POST['access_time']);
    $profile_image = $conn->real_escape_string($_POST['profile_image']);
    $address = $conn->real_escape_string($_POST['address']);

    // The SQL statement to add a new user
    $sql = "INSERT INTO users (Full_Name, email, phone_Number, User_Name, Password, UserType, AccessTime, profile_Image, Address)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $full_name, $email, $phone_number, $user_name, $password, $user_type, $access_time, $profile_image, $address);
    $stmt->execute();
    // More error handling and success messages would be required here
}

// Retrieve users from the database
$users = [];
$sql = "SELECT * FROM users"; // Replace with your actual table name
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="dashboard_styles.css">
</head>
<body>

<h1>Manage Users</h1>

<!-- Add User Form -->
<form action="manage_users.php" method="post">
    <label for="full_name">Full Name:</label>
    <input type="text" id="full_name" name="full_name" required><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>
    <label for="phone_number">Phone Number:</label>
    <input type="tel" id="phone_number" name="phone_number" required><br>
    <label for="user_name">User Name:</label>
    <input type="text" id="user_name" name="user_name" required><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    <label for="user_type">User Type:</label>
    <input type="text" id="user_type" name="user_type" required><br>
    <label for="access_time">Access Time:</label>
    <input type="text" id="access_time" name="access_time" required><br>
    <label for="profile_image">Profile Image:</label>
    <input type="text" id="profile_image" name="profile_image" required><br>
    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required><br>

    <!-- Add more input fields as needed for user details -->
    <input type="submit" name="add_user" value="Add User">
</form>

<!-- List of Users -->
<table>
    <tr>
        <th>User Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo htmlspecialchars($user['User_Name']); ?></td>
        <td><?php echo htmlspecialchars($user['email']); ?></td>
        <td>
            <a href="edit_user.php?id=<?php echo $user['userId']; ?>">Edit</a> | <!-- Replace with your actual edit page and id parameter -->
            <a href="delete_user.php?id=<?php echo $user['userId']; ?>" onclick="return confirm('Are you sure?');">Delete</a> <!-- Replace with your actual delete script and id parameter -->
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
