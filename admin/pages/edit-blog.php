<?php
// Include DB connection
require_once __DIR__ . '/../conn.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('Blog ID is missing.');
}

$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = ?");
    $stmt->execute([$id]);
    $blog = $stmt->fetch();

    if (!$blog) {
        die("Blog not found.");
    }
} catch (PDOException $e) {
    die("Error fetching blog: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Blog Post</h2>
        <form action="../actions/update_blog.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($blog['id']) ?>">

            <div class="mb-3">
                <label class="form-label">Blog Title</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($blog['title']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Author</label>
                <input type="text" name="author" class="form-control" value="<?= htmlspecialchars($blog['author']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="5" required><?= htmlspecialchars($blog['content']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Tags</label>
                <input type="text" name="tags" class="form-control" value="<?= htmlspecialchars($blog['tags']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Change Cover Image (optional)</label>
                <input type="file" name="image" class="form-control">
                <?php if (!empty($blog['image'])): ?>
                    <p class="mt-2">Current Image:</p>
                    <img src="../uploads/<?= htmlspecialchars($blog['image']) ?>" style="width: 200px; height: auto;">
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-success">Update Blog</button>
            <a href="view-blog.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>