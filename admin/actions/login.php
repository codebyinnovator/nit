<?php
session_start();
require '../conn.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $identifier = trim($_POST['identifier']);
    $password = $_POST['password'];

    if (empty($identifier) || empty($password)) {
        $errors[] = "Both fields are required.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :identifier");
        $stmt->bindParam(':identifier', $identifier);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
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
    }
}


$_SESSION['login_errors'] = $errors;
header("Location: ../../signup.php");
exit;
