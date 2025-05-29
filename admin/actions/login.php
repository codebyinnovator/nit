<?php
session_start();
require 'conn.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $identifier = trim($_POST['identifier']);
    $password = $_POST['password'];

    if (empty($identifier) || empty($password)) {
        $errors[] = "Both fields are required.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $identifier);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            if (password_verify($password, $user['password'])) {
                // Login success
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['first_name'] . ' ' . $user['last_name'],
                    'email' => $user['email']
                ];

                header("Location: ../../index.php");
                exit;
            } else {
                $errors[] = "Invalid email or password.";
            }
        } else {
            $errors[] = "Invalid email or password.";
        }
    }

    $_SESSION['login_errors'] = $errors;
    header("Location: ../../signup.php");
    exit;
}
