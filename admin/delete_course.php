<?php
include("../connect.php");

if(isset($_GET['id'])) {
    // Validate and sanitize input
    $id = intval($_GET['id']);
    
    try {
        // 1. Get course image path before deleting
        $stmt = $conn->prepare("SELECT course_image FROM courses WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows === 0) {
            header("Location: courses.php?error=course_not_found");
            exit();
        }
        
        $course = $result->fetch_assoc();
        
        // 2. Delete the physical image file
        if(!empty($course['course_image']) && file_exists("../".$course['course_image'])) {
            if(!unlink("../".$course['course_image'])) {
                throw new Exception("Failed to delete image file");
            }
        }
        
        // 3. Delete database record
        $stmt = $conn->prepare("DELETE FROM courses WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if(!$stmt->execute()) {
            throw new Exception("Database delete failed");
        }
        
        header("Location: courses.php?deleted=1");
        exit();
        
    } catch(Exception $e) {
        error_log("Delete Error: ".$e->getMessage());
        header("Location: courses.php?error=delete_failed");
        exit();
    }
} else {
    header("Location: courses.php");
    exit();
}
?>