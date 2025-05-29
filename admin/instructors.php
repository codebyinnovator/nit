<?php
session_start();
include("../connect.php");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['add_instructor'])) {
    // Add new instructor
    $name = $_POST['name'];
    $position = $_POST['position'];
    $qualification = $_POST['qualification'];
    $bio = $_POST['bio'];

    // Handle image upload
    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
      $upload_dir = '../instructors/';
      if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
      }
      $file_name = uniqid() . '_' . basename($_FILES['image']['name']);
      $target_path = $upload_dir . $file_name;

      if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
        $image_path = 'instructors/' . $file_name;
      }
    }

    $stmt = $conn->prepare("INSERT INTO instructors (name, position, qualification, bio, image_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $position, $qualification, $bio, $image_path);
    if ($stmt->execute()) {
      $_SESSION['message'] = "Instructor added successfully!";
      $_SESSION['message_type'] = "success";
    } else {
      $_SESSION['message'] = "Error adding instructor: " . $conn->error;
      $_SESSION['message_type'] = "danger";
    }
    header("Location: instructors.php");
    exit();
  } elseif (isset($_POST['update_instructor'])) {
    // Update existing instructor
    $id = $_POST['id'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $qualification = $_POST['qualification'];
    $bio = $_POST['bio'];

    // Handle image upload
    $image_path = $_POST['current_image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
      $upload_dir = '../instructors/';
      $file_name = uniqid() . '_' . basename($_FILES['image']['name']);
      $target_path = $upload_dir . $file_name;

      if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
        $image_path = 'instructors/' . $file_name;
        // Delete old image if exists
        if (!empty($_POST['current_image']) && file_exists('../' . $_POST['current_image'])) {
          unlink('../' . $_POST['current_image']);
        }
      }
    }

    $stmt = $conn->prepare("UPDATE instructors SET name=?, position=?, qualification=?, bio=?, image_path=? WHERE id=?");
    $stmt->bind_param("sssssi", $name, $position, $qualification, $bio, $image_path, $id);
    if ($stmt->execute()) {
      $_SESSION['message'] = "Instructor updated successfully!";
      $_SESSION['message_type'] = "success";
    } else {
      $_SESSION['message'] = "Error updating instructor: " . $conn->error;
      $_SESSION['message_type'] = "danger";
    }
    header("Location: instructors.php");
    exit();
  }
}

// Handle delete action
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']); // Sanitize input

  try {
    // Start transaction
    $conn->begin_transaction();

    // First get image path to delete file
    $stmt = $conn->prepare("SELECT image_path FROM instructors WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      if (!empty($row['image_path']) && file_exists('../' . $row['image_path'])) {
        unlink('../' . $row['image_path']);
      }
    }

    // Delete instructor record
    $stmt = $conn->prepare("DELETE FROM instructors WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Commit transaction
    $conn->commit();

    $_SESSION['message'] = "Instructor deleted successfully!";
    $_SESSION['message_type'] = "success";
  } catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    $_SESSION['message'] = "Error deleting instructor: " . $e->getMessage();
    $_SESSION['message_type'] = "danger";
  }

  // Redirect to prevent form resubmission
  header("Location: instructors.php");
  exit();
}

// Fetch all instructors
$instructors = $conn->query("SELECT * FROM instructors ORDER BY name");

// Display session message if exists
if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
  $message_type = $_SESSION['message_type'];
  unset($_SESSION['message']);
  unset($_SESSION['message_type']);
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
    Manage Instructors
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
  <style>
    input,
    textarea,
    select {
      border: 1px solid #ccc !important;
      padding: 8px !important;
      border-radius: 4px !important;
      font-size: 14px !important;
    }

    .instructor-img-preview {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 15px;
    }

    .instructor-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 20px;
    }

    .bio-preview {
      max-height: 100px;
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
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
          <a class="nav-link text-dark" href="dashboard.php">
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
          <a class="nav-link active bg-gradient-dark text-white" href="instructors.php">
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Instructor</li>
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
    <div class="container py-4">
      <h1 class="mb-4">Manage Instructors</h1>

      <?php if (isset($message)): ?>
        <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
      <?php endif; ?>

      <!-- Instructor Form -->
      <div class="card mb-4">
        <div class="card-header">
          <h2><?php echo isset($_GET['edit']) ? 'Edit Instructor' : 'Add Instructor'; ?></h2>
        </div>
        <div class="card-body">
          <?php
          $edit_instructor = null;
          if (isset($_GET['edit'])) {
            $edit_id = intval($_GET['edit']);
            $edit_instructor = $conn->query("SELECT * FROM instructors WHERE id = $edit_id")->fetch_assoc();
          }
          ?>
          <form method="POST" enctype="multipart/form-data">
            <?php if ($edit_instructor): ?>
              <input type="hidden" name="id" value="<?php echo $edit_instructor['id']; ?>">
              <input type="hidden" name="current_image" value="<?php echo $edit_instructor['image_path']; ?>">
            <?php endif; ?>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Name*</label>
                  <input type="text" class="form-control" name="name" required
                    value="<?php echo $edit_instructor['name'] ?? ''; ?>">
                </div>

                <div class="mb-3">
                  <label class="form-label">Position*</label>
                  <input type="text" class="form-control" name="position" required
                    value="<?php echo $edit_instructor['position'] ?? ''; ?>">
                </div>

                <div class="mb-3">
                  <label class="form-label">Qualification</label>
                  <input type="text" class="form-control" name="qualification"
                    value="<?php echo $edit_instructor['qualification'] ?? ''; ?>">
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Profile Image</label>
                  <input type="file" class="form-control" name="image">
                  <?php if ($edit_instructor && !empty($edit_instructor['image_path'])): ?>
                    <div class="mt-2">
                      <img src="../<?php echo $edit_instructor['image_path']; ?>" class="instructor-img-preview">
                      <p>Current image</p>
                    </div>
                  <?php endif; ?>
                </div>
              </div>

              <div class="col-12">
                <div class="mb-3">
                  <label class="form-label">Bio</label>
                  <textarea class="form-control" name="bio" rows="4"><?php echo $edit_instructor['bio'] ?? ''; ?></textarea>
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'update_instructor' : 'add_instructor'; ?>">
              <?php echo isset($_GET['edit']) ? 'Update Instructor' : 'Add Instructor'; ?>
            </button>

            <?php if (isset($_GET['edit'])): ?>
              <a href="instructors.php" class="btn btn-secondary">Cancel</a>
            <?php endif; ?>
          </form>
        </div>
      </div>

      <!-- Instructors List -->
      <div class="card">
        <div class="card-header">
          <h2>Instructors List</h2>
        </div>
        <div class="card-body">
          <div class="row">
            <?php if ($instructors->num_rows > 0): ?>
              <?php while ($instructor = $instructors->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                  <div class="instructor-card">
                    <?php if (!empty($instructor['image_path'])): ?>
                      <img src="../<?php echo $instructor['image_path']; ?>" class="instructor-img-preview mx-auto d-block">
                    <?php else: ?>
                      <div class="instructor-img-preview mx-auto d-block bg-light d-flex align-items-center justify-content-center">
                        <i class="fas fa-user fa-3x text-muted"></i>
                      </div>
                    <?php endif; ?>

                    <h4 class="text-center"><?php echo $instructor['name']; ?></h4>
                    <p class="text-center text-muted"><?php echo $instructor['position']; ?></p>
                    <?php if ($instructor['qualification']): ?>
                      <p class="text-center"><small><?php echo $instructor['qualification']; ?></small></p>
                    <?php endif; ?>

                    <?php if ($instructor['bio']): ?>
                      <div class="bio-preview mt-2">
                        <p><?php echo $instructor['bio']; ?></p>
                      </div>
                    <?php endif; ?>

                    <div class="text-center mt-3">
                      <a href="instructors.php?edit=<?php echo $instructor['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                      <a href="instructors.php?delete=<?php echo $instructor['id']; ?>" class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure you want to delete <?php echo addslashes($instructor['name']); ?>?')">
                        Delete
                      </a>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
            <?php else: ?>
              <div class="col-12">
                <p class="text-center text-muted">No instructors found. Add your first instructor above.</p>
              </div>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

</body>

</html>