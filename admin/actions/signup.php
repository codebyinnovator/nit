<?php
require '../conn.php';

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


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
    try {
        $stmt->execute([$first_name, $last_name, $email, $hashedPassword]);
        header("Location: ../../signup.html");
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            die("Email already registered.");
        }
        die("Error: " . $e->getMessage());
    }
}
