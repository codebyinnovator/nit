<?php
require 'conn.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM admin_table WHERE id = $id";
    mysqli_query($conn, $query);
}

header("Location: ../pages/admin_accounts.php");
exit;
