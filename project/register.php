<?php
require_once 'includes/functions.php'; // Includes the registerUser function
require_once 'includes/database/db_connect.php';

$response = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and collect form input
    $f_name = trim($_POST['f_name'] ?? '');
    $s_name = trim($_POST['s_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $re_password = $_POST['re_password'] ?? ''; // Added re-enter password
    $salary = $_POST['salary'] ?? '';

    // Basic validation
    if (!$f_name || !$s_name || !$email || !$password || !$re_password || !$salary) {
        $response = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response = 'Invalid email format.';
    } elseif ($password !== $re_password) {
        $response = 'Passwords do not match.';
    } elseif (!is_numeric($salary)) {
        $response = 'Monthly income must be a number.';
    } else {
        // Call register function
        $result = registerUser($conn, $f_name, $s_name, $email, $password, (float)$salary);
        $response = $result['message'];  // Use the response message from the function
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker - Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Expense Tracker</h1>
    <div class="auth-buttons">
        <a class="btn" href="index.php">Index</a>
        <a class="btn" href="login.php">Login</a>
    </div>
</header>

<main>
    <div class="form-container">
        <form method="POST" action="register.php">
            <h2>Registration Form</h2>

            <?php if ($response): ?>
                <p class="error-message"><?= $response; ?></p>
            <?php endif; ?>

            <input type="text" name="f_name" placeholder="Enter First Name" required><br>
            <input type="text" name="s_name" placeholder="Enter Surname" required><br>
            <input type="email" name="email" placeholder="Enter Email Address" required><br>
            <input type="password" name="password" placeholder="Enter Password" required><br>
            <input type="password" name="re_password" placeholder="Re-Enter Password" required><br>
            <input type="number" step="0.01" name="salary" placeholder="Enter Monthly Income" required><br>

            <button type="submit">Submit</button>
        </form>
    </div>
</main>

</body>
</html>