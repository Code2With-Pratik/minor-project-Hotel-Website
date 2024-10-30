<?php
  require('inc/essentials.php');
  adminLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">


 <div class="conatiner-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between">
    <h3 class="mb-0">ADMIN PANEL</h3>
    <a href="logout.php" class="btn btn-light btn-sm" >LOG OUT</aclass>
 </div>




    <?php require('inc/scripts.php'); ?> 
</body>
</html>