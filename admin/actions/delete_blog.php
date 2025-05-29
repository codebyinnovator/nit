<?php
require_once '../conn.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = intval($_POST['id']);

        // Delete the blog image if it exists
        $stmt = $pdo->prepare("SELECT image FROM blogs WHERE id = ?");
        $stmt->execute([$id]);
        $blog = $stmt->fetch();

        if ($blog && $blog['image']) {
            $imagePath = __DIR__ . '/../uploads/' . $blog['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath); // delete image file
            }
        }

        // Delete the blog from the database
        $stmt = $pdo->prepare("DELETE FROM blogs WHERE id = ?");
        $stmt->execute([$id]);

        // Redirect back to blog list
        header("Location: ../view-blog.php");
        exit;
    } else {
        echo "Invalid blog ID.";
    }
} else {
    echo "Invalid request.";
}
