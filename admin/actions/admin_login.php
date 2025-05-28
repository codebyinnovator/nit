<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once "conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['admin_email']);
    $password = $_POST['admin_password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Email and password are required.";
        header("Location: ../pages/sign-in.php");
        exit;
    }

    // Query admin table
    $stmt = $conn->prepare("SELECT * FROM admin_table WHERE admin_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    // Use the correct field name: admin_pass
    if ($admin && password_verify($password, $admin['admin_pass'])) {
        $_SESSION['admin'] = [
            'id' => $admin['id'],
            'email' => $admin['admin_email'],
            'name' => $admin['admin_name'] ?? ''
        ];

        header("Location: ../pages/dashboard.php");
        exit;
    } else {
        $_SESSION['error'] = "Invalid email or password.";
        header("Location: ../pages/sign-in.php");
        exit;
    }
}
