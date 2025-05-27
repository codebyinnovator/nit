<?php
require_once '../conn.php'; // use secure PDO connection

$title = $_POST['title'];
$author = $_POST['author'];
$content = $_POST['content'];
$tags = $_POST['tags'];

$imageName = null;

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../uploads/';
    $imageTmpPath = $_FILES['image']['tmp_name'];
    $originalName = basename($_FILES['image']['name']);
    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (in_array($ext, $allowedTypes)) {
        $newFileName = uniqid('blog_', true) . '.' . $ext;
        $destPath = $uploadDir . $newFileName;

        if (!move_uploaded_file($imageTmpPath, $destPath)) {
            die("Error: Failed to move uploaded file.");
        }

        $imageName = $newFileName;
    } else {
        die("Error: Only image files (jpg, png, gif, etc.) are allowed.");
    }
}


$stmt = $pdo->prepare("INSERT INTO blogs (title, author, image, content, tags, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->execute([$title, $author, $imageName, $content, $tags]);


header("Location: ../pages/create-blog.php");
exit;
