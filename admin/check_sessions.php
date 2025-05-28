<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: nit/admin/pages/sign-in.php");
    exit;
}
