<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

 <!-- admin login form -->

 <div class="login-form text-center rounded bg-white shadow overflow-hidden ">
    <form>
        <h4 class="bg-dark text-white py-3">ADMIN LOGIN PANNEL</h4>
        <div class="p-4">
            <div class="mb-3">
                <input name="admin_name" type="text" class="form-control shadow-none text-center" placeholder="Admin Name">
            </div>
            <div class="mb-4">
                <input name="admin_pass" type="password" class="form-control shadow-none text-center" placeholder="Password">
            </div>
            <button name="login" type="submit" class="btn text-white custom-bg shadow-none">LOGIN</button>
        </div>
    </form>
  </div>
    




<?php require('inc/scripts.php'); ?>

</body>
</html>