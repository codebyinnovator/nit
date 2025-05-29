<?php
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = htmlspecialchars(trim($_POST['f_name']));
    $last_name = htmlspecialchars(trim($_POST['l_name']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $repeat_password = $_POST['r_password'];

    if ($password !== $repeat_password) {
        die("Passwords do not match.");
    }

    if (!$email) {
        die("Invalid email address.");
    }

    // Check for duplicate email
    $checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->store_result();
    if ($checkStmt->num_rows > 0) {
        die("Email already registered.");
    }

    // Insert new user
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashedPassword);

    if ($stmt->execute()) {
        header("Location: ../../signup.html?success=1");
        exit();
    } else {
        die("Error: " . $stmt->error);
    }
}
