<?php
// Database configuration
$servername = "localhost";  // Change to your server name or IP address
$username = "root";         // Your database username
$password = "";             // Your database password
$dbname = "expense_tracker";  // Your database name

try {
    // Create PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Connection successful
    echo "Connected successfully!";
}
catch(PDOException $e) {
    // Connection failed
    echo "Connection failed: " . $e->getMessage();
}
?>
