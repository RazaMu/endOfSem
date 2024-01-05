<?php
session_start();
require 'Database.php'; // Your Database connection file
$db = new Database();
$conn = $db->getConnection();

// Retrieve the last 6 articles in descending order by article_created_date
$sql = "SELECT * FROM articles ORDER BY article_created_date DESC LIMIT 6"; // Replace with your actual table name and column names
$result = $conn->query($sql);

$articles = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Articles</title>
       <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>View Articles</h1>

<!-- List of Articles -->
<ul>
    <?php foreach ($articles as $article): ?>
    <li>
        <h3><?php echo htmlspecialchars($article['article_title']); ?></h3>
        <p><?php echo htmlspecialchars($article['article_full_text']); ?></p>
        <p>Created Date: <?php echo htmlspecialchars($article['article_created_date']); ?></p>
    </li>
    <?php endforeach; ?>
</ul>

</body>
</html>
