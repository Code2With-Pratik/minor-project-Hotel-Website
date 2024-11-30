<?php 
  require('admin/inc/db_config.php');
  session_start();
  require('admin/inc/essentials.php');

  // Fetch contact details
  $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
  $values = [1];
  $contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));

  // Fetch shutdown status
  $query = "SELECT `shutdown` FROM `settings` WHERE `sr_no` = 1";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);

  if ($row['shutdown'] == 1) {
      // Display the top section message
      echo "
      <div style='background-color: #DC143C; color: #ffff; text-align: center; padding: 10px; font-size: 18px;'>
          <strong><i class='bi bi-exclamation-triangle-fill'></i> Bookings are temporarily closed!</strong>
      </div>
      ";
  }
?>

<!-- Navbar -->
<nav id="nav-bar" class="navbar navbar-expand-lg bg-body-tertiary bg-white pg-lg-3 py-lg-2 shadow-sm sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">GrandStay</a>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link me-2" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link me-2" href="rooms.php">Rooms</a></li>
        <li class="nav-item"><a class="nav-link me-2" href="facilities.php">Facilities</a></li>
        <li class="nav-item"><a class="nav-link me-2" href="contact.php">Contact Us</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
      </ul>
      <div class="d-flex" role="search">
        <?php if(isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
          <!-- Display the logged-in user’s name and a logout button -->
          <span class="btn bg-warning shadow-none me-2">Hello  <i class="bi bi-person-circle"></i> <?php echo $_SESSION['u_name']; ?></span>
          <a href="logout.php" class="btn btn-outline-dark shadow-none">LOGOUT <i class="bi bi-box-arrow-right"></i></a>
        <?php else: ?>
          <!-- Display Login and Register buttons if not logged in -->
          <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
          <button type="button" class="btn btn-outline-dark shadow-none me-lg-2" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>


<!-- Login Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="login-form" method="POST" action="login_register.php">
        <div class="modal-header">
          <h1 class="modal-title fs-4 d-flex"><i class="bi bi-person-circle fs-3 me-2"></i>User Login</h1>
          <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control shadow-none" required>
          </div>
          <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="pass" class="form-control shadow-none" required>
          </div>
          <div class="d-flex align-item-center justify-content-between">
            <button type="submit" name="login" class="btn btn-dark shadow-none">LOGIN</button>
            <a href="admin/index.php" class="btn btn-success text-white text-decoration-none">Login As Admin</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Registration Modal -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="register-form" method="POST" action="login_register.php" enctype="multipart/form-data">
        <div class="modal-header">
          <h1 class="modal-title fs-4 d-flex"><i class="bi bi-person-plus-fill fs-3 me-2"></i>User Registration</h1>
          <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <span class="badge rounded-pill text-bg-light mb-3 text-wrap lh-base">
            Note: Your details must match your ID (Aadhar Card, Passport, Driving License, etc.), which will be required during check-in.
          </span>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input type="number" name="phone" class="form-control shadow-none" required oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);">
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control shadow-none" required rows="1"></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Pincode</label>
                <input type="number" name="pincode" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="cpass" class="form-control shadow-none" required>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <button type="submit" name="register" class="btn btn-dark shadow-none">Register</button>
            <button type="button" class="btn btn-light shadow-none" data-bs-dismiss="modal">Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
