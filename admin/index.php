<?php
require('inc/essentials.php');
require('inc/db_config.php');

session_start();
if ((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
    redirect('dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" href="../images/logo/hotel-logo.avif">
    <?php require('inc/links.php'); ?>
</head>
<style>
    .bg-custom {
    background-color: #fff3e0;
    }
    div.form-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
    }

    .form-container h4 {
        cursor: pointer;
    }

    .hidden {
        display: none;
    }

    .back-btn {
        display: inline-block;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 10px 20px;
        background-color: #fd7e14; /* Warm Orange */
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
    }

    .back-btn:hover {
        background-color: #0056b3; /* Darker Blue */
    }
</style>
<body class="bg-custom">
  <div class="d-flex justify-content-center align-items-center mt-4">
    <a href="../index.php" class="text-decoration-none">
        <h1 class="display-4 mt-4 h-font text-dark">GrandStay</h1>
        <span class="badge bg-primary">Only Admin or Authorised person can login</span>
    </a>
   </div> 
  <!-- Login and Register Form -->
  <div class="form-container text-center rounded bg-white shadow overflow-hidden">
    <!-- Back Button -->
    <a href="../index.php" class="back-btn">Back to Front Page</a>

    <!-- Toggle Headers -->
    <h4 id="login-tab" class="bg-dark text-white py-3">ADMIN LOGIN</h4>
    <h4 id="register-tab" class="bg-dark text-white py-3 hidden">ADMIN REGISTER</h4>

    <!-- Login Form -->
    <form id="login-form" method="POST" class="p-4">
        <div class="mb-3">
            <input name="admin_name" required type="text" class="form-control shadow-none text-center" placeholder="Admin Name">
        </div>
        <div class="mb-4">
            <input name="admin_pass" required type="password" class="form-control shadow-none text-center" placeholder="Password">
        </div>
        <button name="login" type="submit" class="btn text-white custom-bg shadow-none">LOGIN</button>
        <p class="mt-3">
            Don't have an account? <span id="show-register" class="text-primary" style="cursor:pointer;">Register here</span>
        </p>
    </form>

    <!-- Register Form -->
    <form id="register-form" method="POST" class="p-4 hidden">
        <div class="mb-3">
            <input name="admin_name" required type="text" class="form-control shadow-none text-center" placeholder="Admin Name">
        </div>
        <div class="mb-3">
            <input name="admin_pass" required type="password" class="form-control shadow-none text-center" placeholder="Password">
        </div>
        <div class="mb-4">
            <input name="admin_pass_confirm" required type="password" class="form-control shadow-none text-center" placeholder="Confirm Password">
        </div>
        <button name="register" type="submit" class="btn text-white custom-bg shadow-none">REGISTER</button>
        <p class="mt-3">
            Already have an account? <span id="show-login" class="text-primary" style="cursor:pointer;">Login here</span>
        </p>
    </form>
  </div>

  <?php
  // Login Logic
  if (isset($_POST['login'])) {
      $frm_data = filteration($_POST);
      $query = "SELECT * FROM `admin_cred` WHERE `admin_name`=? AND `admin_pass`=?";
      $values = [$frm_data['admin_name'], $frm_data['admin_pass']];

      $res = select($query, $values, "ss");
      if ($res->num_rows == 1) {
          $row = mysqli_fetch_assoc($res);
          $_SESSION['adminLogin'] = true;
          $_SESSION['adminId'] = $row['sr_no'];
          redirect('dashboard.php');
      } else {
          alert('error', 'Login failed - Invalid Credentials!');
      }
  }

  // Registration Logic
  if (isset($_POST['register'])) {
      $frm_data = filteration($_POST);

      // Validate password match
      if ($frm_data['admin_pass'] !== $frm_data['admin_pass_confirm']) {
          alert('error', 'Passwords do not match!');
          exit;
      }

      // Check if admin name already exists
      $check_query = "SELECT * FROM `admin_cred` WHERE `admin_name`=?";
      $check_res = select($check_query, [$frm_data['admin_name']], "s");

      if ($check_res->num_rows > 0) {
          alert('error', 'Admin name already exists!');
          exit;
      }

      // Insert new admin credentials
      $insert_query = "INSERT INTO `admin_cred`(`admin_name`, `admin_pass`) VALUES (?,?)";
      $values = [$frm_data['admin_name'], $frm_data['admin_pass']];
      $res = insert($insert_query, $values, "ss");

      if ($res) {
          alert('success', 'Admin registered successfully! Please login.');
          // Auto-fill login form after registration
          echo "<script>
                  document.getElementById('login-tab').classList.remove('hidden');
                  document.getElementById('register-tab').classList.add('hidden');
                  document.getElementById('login-form').classList.remove('hidden');
                  document.getElementById('register-form').classList.add('hidden');
              </script>";
      } else {
          alert('error', 'Registration failed!');
      }
  }
  ?>

<?php require('inc/scripts.php'); ?>

<script>
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const loginTab = document.getElementById('login-tab');
    const registerTab = document.getElementById('register-tab');
    const showRegister = document.getElementById('show-register');
    const showLogin = document.getElementById('show-login');

    // Switch to Register Form
    showRegister.addEventListener('click', () => {
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
        loginTab.classList.add('hidden');
        registerTab.classList.remove('hidden');
    });

    // Switch to Login Form
    showLogin.addEventListener('click', () => {
        registerForm.classList.add('hidden');
        loginForm.classList.remove('hidden');
        registerTab.classList.add('hidden');
        loginTab.classList.remove('hidden');
    });
</script>

</body>
</html>
