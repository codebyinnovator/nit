<?php
require 'conn.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['admin_name']);
    $email = trim($_POST['admin_email']);
    $password = trim($_POST['admin_password']);

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if admin already exists
    $check = "SELECT * FROM admin_table WHERE admin_email = ?";
    $stmt = mysqli_prepare($conn, $check);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        die("Admin email already exists.");
    }

    $insert = "INSERT INTO admin_table (name, admin_email, admin_pass) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insert);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../pages/admin_accounts.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
