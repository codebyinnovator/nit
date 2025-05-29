<?php
require_once '../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id      = $_POST['id'];
    $title   = $_POST['title'];
    $author  = $_POST['author'];
    $content = $_POST['content'];
    $tags    = $_POST['tags'];

    // Fetch existing image filename
    $stmt = $pdo->prepare("SELECT image FROM blogs WHERE id = ?");
    $stmt->execute([$id]);
    $currentImage = $stmt->fetchColumn();

    $imageName = $currentImage;

    if (!empty($_FILES['image']['name'])) {
        $uploadDir = '../uploads/';
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $uploadPath = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            // Optionally delete the old image if it exists
            if ($currentImage && file_exists($uploadDir . $currentImage)) {
                unlink($uploadDir . $currentImage);
            }
        } else {
            die("Error uploading image.");
        }
    }

    // Update blog post
    $stmt = $pdo->prepare("UPDATE blogs SET title = ?, author = ?, image = ?, content = ?, tags = ? WHERE id = ?");
    $stmt->execute([$title, $author, $imageName, $content, $tags, $id]);

    header("Location: ../pages/view-blog.php");
    exit;
}
