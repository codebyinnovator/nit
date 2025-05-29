<?php
include('../connect.php');

// Helper function to get old image path
function getOldImagePath($conn, $slide_id)
{
  $query = "SELECT image_path FROM slider WHERE id = $slide_id";
  $result = mysqli_query($conn, $query);
  if ($result && $row = mysqli_fetch_assoc($result)) {
    return $row['image_path'];
  }
  return '';
}

// Initialize variables
$errors = [];
$success = '';
$current_slide = null;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Sanitize and validate input
  $slide_id = isset($_POST['slide_id']) ? intval($_POST['slide_id']) : 0;
  $title = isset($_POST['slide_title']) ? mysqli_real_escape_string($conn, trim($_POST['slide_title'])) : '';
  $description = isset($_POST['slide_description']) ? mysqli_real_escape_string($conn, trim($_POST['slide_description'])) : '';
  $content_position = isset($_POST['content_position']) ? mysqli_real_escape_string($conn, trim($_POST['content_position'])) : 'center';
  $text_color = isset($_POST['text_color']) ? mysqli_real_escape_string($conn, trim($_POST['text_color'])) : '#ffffff';
  $title_color = isset($_POST['title_color']) ? mysqli_real_escape_string($conn, trim($_POST['title_color'])) : '#ffffff';

  // Validate required fields
  if (empty($title)) {
    $errors[] = "Slide title is required";
  }

  // Handle file upload
  $image_path = '';
  if (isset($_FILES['slide_image']) && $_FILES['slide_image']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = '../home_images/';
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $file_info = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($file_info, $_FILES['slide_image']['tmp_name']);

    if (!in_array($mime_type, $allowed_types)) {
      $errors[] = "Only JPG, PNG, GIF, and WebP files are allowed";
    } else {
      // Generate unique filename
      $ext = pathinfo($_FILES['slide_image']['name'], PATHINFO_EXTENSION);
      $filename = 'slide_' . time() . '_' . uniqid() . '.' . $ext;
      $destination = $upload_dir . $filename;

      if (move_uploaded_file($_FILES['slide_image']['tmp_name'], $destination)) {
        $image_path = 'home_images/' . $filename;

        // Delete old image if exists
        if ($slide_id > 0) {
          $old_image = getOldImagePath($conn, $slide_id);
          if (!empty($old_image) && file_exists('../' . $old_image)) {
            unlink('../' . $old_image);
          }
        }
      } else {
        $errors[] = "Failed to upload image";
      }
    }
  }

  // If no errors, proceed with database operation
  if (empty($errors)) {
    if ($slide_id > 0) {
      // Update existing slide
      if (!empty($image_path)) {
        $query = "UPDATE slider SET 
                          title = '$title',
                          description = '$description',
                          content_position = '$content_position',
                          text_color = '$text_color',
                          title_color = '$title_color',
                          image_path = '$image_path'
                          WHERE id = $slide_id";
      } else {
        $query = "UPDATE slider SET 
                          title = '$title',
                          description = '$description',
                          content_position = '$content_position',
                          text_color = '$text_color',
                          title_color = '$title_color'
                          WHERE id = $slide_id";
      }
      $result = mysqli_query($conn, $query);

      if ($result) {
        $success = "Slide updated successfully";
        $current_slide = [
          'id' => $slide_id,
          'title' => $title,
          'description' => $description,
          'content_position' => $content_position,
          'text_color' => $text_color,
          'title_color' => $title_color,
          'image_path' => $image_path ?: getOldImagePath($conn, $slide_id)
        ];
      } else {
        $errors[] = "Failed to update slide: " . mysqli_error($conn);
      }
    } else {
      // Insert new slide
      $sort_order_query = "SELECT MAX(sort_order) as max_order FROM slider";
      $sort_result = mysqli_query($conn, $sort_order_query);
      $sort_row = mysqli_fetch_assoc($sort_result);
      $new_sort_order = $sort_row['max_order'] + 1;

      $query = "INSERT INTO slider (title, description, content_position, text_color, title_color, image_path, sort_order, is_active)
                      VALUES ('$title', '$description', '$content_position', '$text_color', '$title_color', '$image_path', $new_sort_order, 1)";
      $result = mysqli_query($conn, $query);

      if ($result) {
        $slide_id = mysqli_insert_id($conn);
        $success = "Slide added successfully";
        $current_slide = [
          'id' => $slide_id,
          'title' => $title,
          'description' => $description,
          'content_position' => $content_position,
          'text_color' => $text_color,
          'title_color' => $title_color,
          'image_path' => $image_path
        ];
      } else {
        $errors[] = "Failed to add slide: " . mysqli_error($conn);
      }
    }
  }
}

// Handle delete action
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
  $delete_id = intval($_GET['delete']);

  // Get image path first
  $query = "SELECT image_path FROM slider WHERE id = $delete_id";
  $result = mysqli_query($conn, $query);
  if ($row = mysqli_fetch_assoc($result)) {
    if (!empty($row['image_path']) && file_exists('../' . $row['image_path'])) {
      unlink('../' . $row['image_path']);
    }
  }

  // Delete from database
  $query = "DELETE FROM slider WHERE id = $delete_id";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $success = "Slide deleted successfully";
  } else {
    $errors[] = "Failed to delete slide: " . mysqli_error($conn);
  }
}

// Get all slides for the list
$slides = [];
$query = "SELECT * FROM slider ORDER BY sort_order ASC";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
  $slides[] = $row;
}

// Get current slide data if editing
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
  $edit_id = intval($_GET['edit']);
  $query = "SELECT * FROM slider WHERE id = $edit_id";
  $result = mysqli_query($conn, $query);
  $current_slide = mysqli_fetch_assoc($result);
} elseif (!empty($slides)) {
  $current_slide = $slides[0];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Material Dashboard 3 by Creative Tim
  </title>
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
  <style>
    .admin-container {
      max-width: 100%;
      padding: 20px;
    }

    .slider-management {
      display: flex;
      gap: 20px;
    }

    .slides-list {
      width: 300px;
      background: white;
      border-radius: 5px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 15px;
      max-height: 80vh;
      overflow-y: auto;
    }

    .slide-item {
      padding: 12px;
      margin-bottom: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .slide-item:hover {
      background-color: #f0f0f0;
    }

    .slide-item.active {
      border-color: #3498db;
      background-color: #e8f4fc;
    }

    .slide-item h3 {
      margin-bottom: 5px;
      font-size: 16px;
    }

    .slide-item p {
      color: #666;
      font-size: 14px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .add-slide-btn {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #27ae60;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
      text-align: center;
      font-weight: 600;
    }

    .add-slide-btn:hover {
      background-color: #2ecc71;
    }

    .slide-editor {
      flex: 1;
      background-color: white;
      border-radius: 5px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #333;
    }

    .form-group input[type="text"],
    .form-group textarea,
    .form-group input[type="file"],
    .form-group select,
    .form-group input[type="color"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 16px;
    }

    .form-group textarea {
      min-height: 100px;
      resize: vertical;
    }

    .form-group input[type="file"] {
      padding: 8px;
    }

    .form-group input[type="color"] {
      height: 50px;
      padding: 5px;
    }

    .form-row {
      display: flex;
      gap: 20px;
    }

    .form-row .form-group {
      flex: 1;
    }

    .btn {
      background-color: #3498db;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s;
      margin-right: 10px;
    }

    .btn:hover {
      background-color: #2980b9;
    }

    .btn-danger {
      background-color: #e74c3c;
    }

    .btn-danger:hover {
      background-color: #c0392b;
    }

    .btn-success {
      background-color: #27ae60;
    }

    .btn-success:hover {
      background-color: #2ecc71;
    }

    .image-preview-container {
      margin-top: 20px;
      text-align: center;
    }

    .current-image {
      max-width: 100%;
      max-height: 200px;
      margin-bottom: 10px;
      border: 1px solid #ddd;
      padding: 5px;
      background: #f5f5f5;
    }

    .image-upload-info {
      font-size: 14px;
      color: #666;
      margin-top: 5px;
    }

    .preview-section {
      margin-top: 30px;
      background-color: white;
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .preview-slider {
      position: relative;
      height: 400px;
      overflow: hidden;
      margin-bottom: 20px;
      border: 1px solid #ddd;
    }

    .preview-slide {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-size: cover;
      background-position: center;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .preview-content {
      max-width: 800px;
      padding: 20px;
    }

    .preview-content h1 {
      font-size: 36px;
      margin-bottom: 20px;
    }

    .preview-content p {
      font-size: 18px;
      margin-bottom: 30px;
      line-height: 1.6;
    }

    .preview-btn {
      display: inline-block;
      background-color: #8bc34a;
      color: white;
      padding: 12px 30px;
      text-decoration: none;
      border-radius: 4px;
      font-weight: 600;
    }

    .action-buttons {
      margin-top: 20px;
      display: flex;
      justify-content: space-between;
    }

    .color-preview {
      display: inline-block;
      width: 20px;
      height: 20px;
      border: 1px solid #ddd;
      margin-left: 10px;
      vertical-align: middle;
    }

    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border: 1px solid transparent;
      border-radius: 4px;
    }

    .alert-success {
      color: #3c763d;
      background-color: #dff0d8;
      border-color: #d6e9c6;
    }

    .alert-danger {
      color: #a94442;
      background-color: #f2dede;
      border-color: #ebccd1;
    }
  </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href=" dashboard.php " target="_blank">
        <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">Creative Tim</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="dashboard.php">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="home.php">
            <i class="material-symbols-rounded opacity-5">home</i>
            <span class="nav-link-text ms-1">Home</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" data-bs-toggle="collapse" href="#blogMenu" role="button" aria-expanded="false" aria-controls="blogMenu">
            <i class="material-symbols-rounded opacity-5">article</i>
            <span class="nav-link-text ms-1">Blog</span>
          </a>

          <div class="collapse ms-4" id="blogMenu">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link text-dark" href="view-blog.php">
                  <i class="material-symbols-rounded opacity-5">visibility</i>
                  <span class="nav-link-text ms-1">View Blogs</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="blog-create.php">
                  <i class="material-symbols-rounded opacity-5">add_circle</i>
                  <span class="nav-link-text ms-1">Create Blog</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="admin_accounts.php">
            <i class="material-symbols-rounded opacity-5">supervisor_account</i>
            <span class="nav-link-text ms-1">Admin Accounts</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="courses.php">
            <i class="material-symbols-rounded opacity-5">school</i>
            <span class="nav-link-text ms-1">Courses</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="aboutus.php">
            <i class="material-symbols-rounded opacity-5">info</i>
            <span class="nav-link-text ms-1">About Us</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="instructors.php">
            <i class="material-symbols-rounded opacity-5">school</i>
            <span class="nav-link-text ms-1">Instructor</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control">
            </div>
          </div>
          <ul class="navbar-nav d-flex align-items-center  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="material-symbols-rounded fixed-plugin-button-nav">settings</i>
              </a>
            </li>
            <li class="nav-item dropdown pe-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-symbols-rounded">notifications</i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                  <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="../pages/sign-in.html" class="nav-link text-body font-weight-bold px-0">
                <i class="material-symbols-rounded">account_circle</i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-2">
      <div class="row">
        <div class="admin-container">
          <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
          <?php endif; ?>

          <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
              <?php foreach ($errors as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <div class="slider-management">
            <div class="slides-list">
              <h3>Slides</h3>
              <?php foreach ($slides as $slide): ?>
                <div class="slide-item <?php echo ($current_slide && $current_slide['id'] == $slide['id']) ? 'active' : ''; ?>"
                  onclick="window.location.href='?edit=<?php echo $slide['id']; ?>'">
                  <h3><?php echo htmlspecialchars($slide['title']); ?></h3>
                  <p><?php echo htmlspecialchars(substr($slide['description'], 0, 50) . (strlen($slide['description']) > 50 ? '...' : '')); ?></p>
                </div>
              <?php endforeach; ?>
            </div>

            <div class="slide-editor">
              <?php if ($current_slide): ?>
                <form id="slide-form" action="" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="slide_id" value="<?php echo $current_slide['id']; ?>">

                  <div class="form-row">
                    <div class="form-group">
                      <label for="slide_title">Slide Title</label>
                      <input type="text" id="slide_title" name="slide_title"
                        value="<?php echo htmlspecialchars($current_slide['title']); ?>"
                        placeholder="Enter slide title" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="slide_description">Slide Description</label>
                    <textarea id="slide_description" name="slide_description"
                      placeholder="Enter slide description"><?php echo htmlspecialchars($current_slide['description']); ?></textarea>
                  </div>

                  <div class="form-row">
                    <div class="form-group">
                      <label for="content_position">Content Position</label>
                      <select id="content_position" name="content_position">
                        <option value="left" <?php echo ($current_slide['content_position'] == 'left') ? 'selected' : ''; ?>>Left</option>
                        <option value="center" <?php echo ($current_slide['content_position'] == 'center') ? 'selected' : ''; ?>>Center</option>
                        <option value="right" <?php echo ($current_slide['content_position'] == 'right') ? 'selected' : ''; ?>>Right</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="text_color">Text Color <span class="color-preview" id="text-color-preview"
                          style="background-color: <?php echo htmlspecialchars($current_slide['text_color']); ?>"></span></label>
                      <input type="color" id="text_color" name="text_color"
                        value="<?php echo htmlspecialchars($current_slide['text_color']); ?>">
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group">
                      <label for="title_color">Title Color <span class="color-preview" id="title-color-preview"
                          style="background-color: <?php echo htmlspecialchars($current_slide['title_color']); ?>"></span></label>
                      <input type="color" id="title_color" name="title_color"
                        value="<?php echo htmlspecialchars($current_slide['title_color']); ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="slide_image">Slide Background Image</label>
                    <input type="file" id="slide_image" name="slide_image" accept="image/*">
                    <p class="image-upload-info">Recommended size: 1920x800px (will be cropped to fit)</p>

                    <?php if (!empty($current_slide['image_path'])): ?>
                      <div class="image-preview-container">
                        <p>Current Image:</p>
                        <img src="../<?php echo htmlspecialchars($current_slide['image_path']); ?>" id="current-image-preview" class="current-image" alt="Current Slide Image">
                      </div>
                    <?php endif; ?>
                  </div>

                  <div class="action-buttons">
                    <div>
                      <button type="submit" class="btn btn-success">Save Changes</button>
                      <button type="button" class="btn" onclick="window.location.href='?'">Cancel</button>
                    </div>
                    <button type="button" class="btn btn-danger"
                      onclick="if(confirm('Are you sure you want to delete this slide?')) { window.location.href='?delete=<?php echo $current_slide['id']; ?>'; }">
                      Delete Slide
                    </button>
                  </div>
                </form>

                <div class="preview-section">
                  <h2>Slide Preview</h2>
                  <div class="preview-slider">
                    <div class="preview-slide" id="preview-slide"
                      style="background-image: url('../<?php echo htmlspecialchars($current_slide['image_path']); ?>');">
                      <div class="preview-content" id="preview-content" style="text-align: <?php echo htmlspecialchars($current_slide['content_position']); ?>">
                        <h1 id="preview-title" style="color: <?php echo htmlspecialchars($current_slide['title_color']); ?>">
                          <?php echo htmlspecialchars($current_slide['title']); ?>
                        </h1>
                        <p id="preview-description" style="color: <?php echo htmlspecialchars($current_slide['text_color']); ?>">
                          <?php echo htmlspecialchars($current_slide['description']); ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              <?php else: ?>

              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-symbols-rounded py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Material UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-symbols-rounded">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark active" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2  active ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-info w-100" href="https://www.creative-tim.com/product/material-dashboard-pro">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["M", "T", "W", "T", "F", "S", "S"],
        datasets: [{
          label: "Views",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "#43A047",
          data: [50, 45, 22, 28, 50, 60, 76],
          barThickness: 'flex'
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: '#e5e5e5'
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 10,
              font: {
                size: 14,
                lineHeight: 2
              },
              color: "#737373"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#737373',
              padding: 10,
              font: {
                size: 14,
                lineHeight: 2
              },
            }
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["J", "F", "M", "A", "M", "J", "J", "A", "S", "O", "N", "D"],
        datasets: [{
          label: "Sales",
          tension: 0,
          borderWidth: 2,
          pointRadius: 3,
          pointBackgroundColor: "#43A047",
          pointBorderColor: "transparent",
          borderColor: "#43A047",
          backgroundColor: "transparent",
          fill: true,
          data: [120, 230, 130, 440, 250, 360, 270, 180, 90, 300, 310, 220],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          },
          tooltip: {
            callbacks: {
              title: function(context) {
                const fullMonths = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                return fullMonths[context[0].dataIndex];
              }
            }
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [4, 4],
              color: '#e5e5e5'
            },
            ticks: {
              display: true,
              color: '#737373',
              padding: 10,
              font: {
                size: 12,
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#737373',
              padding: 10,
              font: {
                size: 12,
                lineHeight: 2
              },
            }
          },
        },
      },
    });

    var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

    new Chart(ctx3, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Tasks",
          tension: 0,
          borderWidth: 2,
          pointRadius: 3,
          pointBackgroundColor: "#43A047",
          pointBorderColor: "transparent",
          borderColor: "#43A047",
          backgroundColor: "transparent",
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [4, 4],
              color: '#e5e5e5'
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#737373',
              font: {
                size: 14,
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [4, 4]
            },
            ticks: {
              display: true,
              color: '#737373',
              padding: 10,
              font: {
                size: 14,
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>

  <script>
    // Live preview functionality
    document.getElementById('slide_title')?.addEventListener('input', function() {
      document.getElementById('preview-title').textContent = this.value;
    });

    document.getElementById('slide_description')?.addEventListener('input', function() {
      document.getElementById('preview-description').textContent = this.value;
    });

    document.getElementById('button_text')?.addEventListener('input', function() {
      document.getElementById('preview-btn-text').textContent = this.value;
    });

    // Color pickers functionality
    document.getElementById('text_color')?.addEventListener('input', function() {
      document.getElementById('preview-description').style.color = this.value;
      document.getElementById('text-color-preview').style.backgroundColor = this.value;
    });

    document.getElementById('title_color')?.addEventListener('input', function() {
      document.getElementById('preview-title').style.color = this.value;
      document.getElementById('title-color-preview').style.backgroundColor = this.value;
    });

    document.getElementById('button_color')?.addEventListener('input', function() {
      document.getElementById('preview-button').style.color = this.value;
      document.getElementById('button-color-preview').style.backgroundColor = this.value;
    });

    // Image preview functionality
    document.getElementById('slide_image')?.addEventListener('change', function(e) {
      if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();

        reader.onload = function(event) {
          document.getElementById('preview-slide').style.backgroundImage = `url('${event.target.result}')`;
          if (document.getElementById('current-image-preview')) {
            document.getElementById('current-image-preview').src = event.target.result;
          }
        }

        reader.readAsDataURL(e.target.files[0]);
      }
    });

    // Content position change
    document.getElementById('content_position')?.addEventListener('change', function() {
      const previewContent = document.getElementById('preview-content');
      previewContent.style.textAlign = this.value;

      if (this.value === 'left') {
        previewContent.style.marginRight = 'auto';
        previewContent.style.marginLeft = '0';
      } else if (this.value === 'right') {
        previewContent.style.marginLeft = 'auto';
        previewContent.style.marginRight = '0';
      } else {
        previewContent.style.marginLeft = 'auto';
        previewContent.style.marginRight = 'auto';
      }
    });
  </script>

</body>

</html>