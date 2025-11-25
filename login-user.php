<?php
session_start();
require 'source.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Check for empty input
    if (empty($username) || empty($password)) {
        die("Please fill in all fields.");
    }

    // Fetch user by username
    $stmt = $conn->prepare("SELECT user_id, username, password, full_name FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // If user found
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $user['password'])) {
            // Login success - start session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];

            echo "Login successful. Welcome, " . htmlspecialchars($user['full_name']) . "!";
            // Optionally redirect:
            // header("Location: dashboard.php");
            // exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
