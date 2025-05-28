<?php
require 'conn.php';

if (!isset($_GET['id'])) {
    header("Location: ../pages/admin_accounts.php");
    exit;
}

$id = intval($_GET['id']);
$query = "SELECT * FROM admin_table WHERE id = $id";
$result = mysqli_query($conn, $query);
$admin = mysqli_fetch_assoc($result);

if (!$admin) {
    die("Admin not found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Form</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
</head>

<body>

    <!-- Edit Form UI -->
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-gradient-primary text-white rounded-top-4">
                        <h5 class="mb-0 text-white">Edit Admin Account</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="../actions/admin_update.php" method="POST">
                            <input type="hidden" name="id" value="<?= $admin['id'] ?>">

                            <!-- Name -->
                            <div class="form-floating mb-4">
                                <input type="text" name="admin_name" id="adminName" class="form-control" placeholder="Full Name" value="<?= htmlspecialchars($admin['name']) ?>" required>
                                <label for="adminName">Full Name</label>
                            </div>

                            <!-- Email -->
                            <div class="form-floating mb-4">
                                <input type="email" name="admin_email" id="adminEmail" class="form-control" placeholder="Email" value="<?= htmlspecialchars($admin['admin_email']) ?>" required>
                                <label for="adminEmail">Email</label>
                            </div>

                            <!-- Password -->
                            <div class="form-floating mb-4">
                                <input type="password" name="admin_password" id="adminPassword" class="form-control" placeholder="New Password">
                                <label for="adminPassword">New Password (leave blank to keep current)</label>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between">
                                <a href="../actions/create_blog.php" class="btn btn-outline-secondary">Cancel</a>
                                <button type="submit" class="btn btn-success px-4">Update Admin</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>