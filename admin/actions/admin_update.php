<?php
require 'conn.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $name = htmlspecialchars(trim($_POST['admin_name']));
    $email = filter_var(trim($_POST['admin_email']), FILTER_VALIDATE_EMAIL);
    $password = trim($_POST['admin_pass']);

    if ($password) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE admin_table SET  name = ?, admin_email = ?, admin_pass = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $hashed, $id);
    } else {
        $query = "UPDATE admin_table SET  name = ?, admin_email = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssi", $name, $email, $id);
    }

    mysqli_stmt_execute($stmt);
    header("Location: ../admin_accounts.php");
    exit;
}
